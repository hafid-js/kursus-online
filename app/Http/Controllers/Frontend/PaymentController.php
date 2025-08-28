<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function orderSuccess()
    {
        return view('frontend.pages.order-success');
    }

    public function orderFailed()
    {
        return view('frontend.pages.order-failed');
    }

    public function paypalConfig(): array
    {
        return [
            'mode' => config('gateway_settings.paypal_mode'),
            'sandbox' => [
                'client_id' => config('gateway_settings.paypal_client_id'),
                'client_secret' => config('gateway_settings.paypal_client_secret'),
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => config('gateway_settings.paypal_client_id'),
                'client_secret' => config('gateway_settings.paypal_client_secret'),
                'app_id' => config('gateway_settings.paypal_app_id'),
            ],

            'payment_action' => 'Sale',
            'currency' => config('gateway_settings.paypal_currency'),
            'notify_url' => '',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];
    }

    public function payWithPaypal()
    {
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();

        $payableAmount = cartTotal();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $payableAmount,
                    ],
                ],
            ],
        ]);

        if (isset($response['id']) && null != $response['id']) {
            foreach ($response['links'] as $link) {
                if ('approve' == $link['rel']) {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && 'COMPLETED' === $response['status']) {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];

            $transactionId = $capture['id'];

            $mainAmount = cartTotal();
            $paidAmount = $capture['amount']['value'];
            $currency = $capture['amount']['currency_code'];

            $orderId = generateOrderId();

            try {
                OrderService::storeOrder(
                    $orderId,
                    auth()->user()->id,
                    'approved',
                    $mainAmount,
                    $paidAmount,
                    $currency,
                    'paypal',
                    $transactionId
                );

                return redirect()->route('paypal.success');
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return redirect()->route('paypal.failed');
    }

    public function createMidtransTransaction(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Decode items dari request
        $items = json_decode($request->items, true);
        $totalUSD = 0;
        foreach ($items as $item) {
            $totalUSD += $item['price'] * ($item['quantity'] ?? 1);
        }

        $rate = $this->getUsdToIdrRate();
        $totalIDR = round($totalUSD * $rate);

        $params = [
            'transaction_details' => [
                'order_id' => generateOrderId(),
                'gross_amount' => $totalIDR,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'token' => $snapToken,
        ]);
    }

    public function storeAfterPayment(Request $request)
    {
        try {
            OrderService::storeOrder(
                $request->transaction_id,
                auth()->id(),
                'approved',
                $request->main_amount,
                $request->paid_amount,
                $request->currency,
                'midtrans'
            );

            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            OrderService::storeOrder(
                $request->transaction_id,
                auth()->id(),
                'approved',
                $request->gross_amount,
                $request->gross_amount,
                'IDR',
                'midtrans'
            );
        }

        return response()->json(['message' => 'OK']);
    }

    private function getUsdToIdrRate()
    {
        $response = Http::get('https://api.exchangerate.host/latest?base=USD&symbols=IDR');

        return $response->json()['rates']['IDR'] ?? 16000; // default fallback
    }

    public function payWithStripe()
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));

        $payableAmount = (cartTotal() * 100);
        $quantityCount = cartTotal();

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('gateway_settings.stripe_currency'),
                        'product_data' => [
                            'name' => 'Course',
                        ],
                        'unit_amount' => $payableAmount,
                    ],
                    'quantity' => $quantityCount,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($response->url);
    }

    public function stripeSuccess(Request $request)
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));

        $response = StripeSession::retrieve($request->session_id);
        if ('paid' === $response->payment_status) {
            $transactionId = $response->payment_intent;
            $mainAmount = cartTotal();
            $paidAmount = $response->amount_total / 100;
            $currency = $response->currency;

            try {
                OrderService::storeOrder(
                    $transactionId,
                    auth()->user()->id,
                    'approved',
                    $mainAmount,
                    $paidAmount,
                    $currency,
                    'stripe',
                );

                return redirect()->route('paypal.success');
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return redirect()->route('paypal.failed');
    }

    public function stripeCancel(Request $request)
    {
        return redirect()->route('paypal.failed');
    }
}
