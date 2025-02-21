<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function payment()
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('company.paypal.success'),
                "cancel_url" => route('company.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()
            ->route('paypal.cancel')
            ->with('error', '支払い中に問題が発生しました。');
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->query('token'));

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            return redirect()
                ->route('company.dashboard')
                ->with('success', '支払いが完了しました。');
        }

        return redirect()
            ->route('home')
            ->with('error', '支払いの処理中に問題が発生しました。');
    }

    public function cancel()
    {
        return redirect()
            ->route('home')
            ->with('error', '支払いがキャンセルされました。');
    }
}
