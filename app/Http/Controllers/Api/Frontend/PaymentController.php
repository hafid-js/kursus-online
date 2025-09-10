<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    use ApiResponseTrait;

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
                'return_url' => route('api.payment.paypal.success'),
                'cancel_url' => route('api.payment.paypal.cancel'),
            ],
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => config('gateway_settings.paypal_currency'),
                    'value' => $payableAmount,
                ],
            ]],
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return $this->sendResponse(['redirect_url' => $link['href']], 'PayPal redirect URL generated.');
                }
            }
        }

        return $this->sendError('Failed to create PayPal payment.');
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];

            try {
                OrderService::storeOrder(
                    $capture['id'],
                    auth()->id(),
                    'approved',
                    cartTotal(),
                    $capture['amount']['value'],
                    $capture['amount']['currency_code'],
                    'paypal'
                );

                return $this->sendResponse(null, 'Payment successful.');
            } catch (\Throwable $e) {
                return $this->sendError('Payment succeeded but failed to save order.', 500);
            }
        }

        return $this->sendError('Payment not completed.', 400);
    }

    public function createMidtransTransaction(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $items = json_decode($request->items, true);
        $total = array_reduce($items, function ($carry, $item) {
            return $carry + ($item['price'] * ($item['quantity'] ?? 1));
        }, 0);

        $discount = cartTotalDiscount() ?? 0;
        $grossAmount = max(0, $total - $discount);

        $params = [
            'transaction_details' => [
                'order_id' => generateOrderId(),
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $this->sendResponse(['token' => $snapToken], 'Midtrans token generated.');
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

            return $this->sendResponse(null, 'Order saved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Failed to save order.', 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $expectedSignature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('midtrans.server_key'));

        if ($request->signature_key !== $expectedSignature) {
            return $this->sendError('Invalid signature', 403);
        }

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            OrderService::storeOrder(
                $request->transaction_id,
                null,
                'approved',
                $request->gross_amount,
                $request->gross_amount,
                'IDR',
                'midtrans'
            );
        }

        return $this->sendResponse(null, 'Notification handled.');
    }

    public function payWithStripe()
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));

        $amount = cartTotal() * 100;

        $response = StripeSession::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => config('gateway_settings.stripe_currency'),
                    'product_data' => ['name' => 'Course'],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('api.payment.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('api.payment.stripe.cancel'),
        ]);

        return $this->sendResponse(['redirect_url' => $response->url], 'Stripe redirect URL generated.');
    }

    public function stripeSuccess(Request $request)
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));

        $session = StripeSession::retrieve($request->session_id);

        if ($session->payment_status === 'paid') {
            try {
                OrderService::storeOrder(
                    $session->payment_intent,
                    auth()->id(),
                    'approved',
                    cartTotal(),
                    $session->amount_total / 100,
                    $session->currency,
                    'stripe'
                );

                return $this->sendResponse(null, 'Payment successful.');
            } catch (\Throwable $e) {
                return $this->sendError('Payment processed but order saving failed.', 500);
            }
        }

        return $this->sendError('Stripe payment failed.', 400);
    }

    public function stripeCancel()
    {
        return $this->sendError('Payment was cancelled.', 400);
    }

    private function getUsdToIdrRate()
    {
        $response = Http::get('https://api.exchangerate.host/latest?base=USD&symbols=IDR');

        return $response->json()['rates']['IDR'] ?? 16000;
    }
}
