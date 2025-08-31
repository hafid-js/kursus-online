<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function orderSuccess()
    {
        return response()->json(['message' => 'Order success']);
    }

    public function orderFailed()
    {
        return response()->json(['message' => 'Order failed'], 400);
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
                    return response()->json([
                        'approval_url' => $link['href'],
                    ]);
                }
            }
        }

        return response()->json(['error' => 'Failed to create PayPal order'], 500);
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

            try {
                OrderService::storeOrder(
                    $transactionId,
                    auth()->user()->id,
                    'approved',
                    $mainAmount,
                    $paidAmount,
                    $currency,
                    'paypal'
                );

                return response()->json(['message' => 'Order completed successfully']);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Order processing failed'], 500);
            }
        }

        return response()->json(['error' => 'Payment not completed'], 400);
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
                        'product_data' => ['name' => 'Course'],
                        'unit_amount' => $payableAmount,
                    ],
                    'quantity' => $quantityCount,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return response()->json(['checkout_url' => $response->url]);
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
                    'stripe'
                );

                return response()->json(['message' => 'Order completed successfully']);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Order processing failed'], 500);
            }
        }

        return response()->json(['error' => 'Payment not completed'], 400);
    }

    public function stripeCancel(Request $request)
    {
        return response()->json(['message' => 'Payment cancelled'], 400);
    }
}
