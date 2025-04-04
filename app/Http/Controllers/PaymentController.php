<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymobService;

class PaymentController extends Controller
{
    protected $paymob;

    public function __construct(PaymobService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function initiatePayment(Request $request)
    {
        $authToken = $this->paymob->getAuthToken();
        $order = $this->paymob->createOrder($authToken, $request->amount, env('PAYMOB_MERCHANT_ID'));

        if (!isset($order['id'])) {
            return back()->with('error', 'Failed to create order');
        }

        $billingData = [
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john.doe@example.com",
            "phone_number" => "01000000000",
            "city" => "Cairo",
            "country" => "EG",
        ];

        $paymentKey = $this->paymob->getPaymentKey($authToken, $order['id'], $request->amount, env('PAYMOB_INTEGRATION_ID'), $billingData);

        if (!isset($paymentKey['token'])) {
            return back()->with('error', 'Failed to generate payment key');
        }

        $iframeUrl = $this->paymob->getIframeUrl($paymentKey['token']);
        return redirect($iframeUrl);
    }
    public function handleCallback(Request $request)
{
    $data = $request->all();

    if ($data['success']) {
        return "Payment Successful!";
    } else {
        return "Payment Failed!";
    }
}
}
