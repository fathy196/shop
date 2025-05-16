<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymobService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $paymob;

    public function __construct(PaymobService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function checkout(Request $request, $order_id)
    {

        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Please login to proceed');
        }

        $user = Auth::user();

        $order = Order::with('items')->findOrFail($order_id);

        $totalAmount = $order->total + 80; // Shipping included

        // Step 1: Get Paymob token
        $authToken = $this->paymob->getAuthToken();

        // Step 2: Create order on Paymob
        $paymobOrder = $this->paymob->createOrder($authToken, $totalAmount, env('PAYMOB_MERCHANT_ID'));

        if (!isset($paymobOrder['id'])) {
            return back()->with('status', 'Paymob order creation failed');
        }

        $billingData = [
            "first_name" => $user->name,
            "last_name" => "Customer",
            "email" => $user->email,
            "phone_number" => $user->phone,
            "city" => "Cairo",
            "country" => "EG",
            "apartment" => "12",
            "floor" => "3",
            "street" => "Some Street",
            "building" => "123",
            "shipping_method" => "PKG",
            "postal_code" => "12345",
            "state" => "Cairo"
        ];

        // Step 3: Get payment key
        $paymentKey = $this->paymob->getPaymentKey(
            $authToken,
            $paymobOrder['id'],
            $totalAmount,
            env('PAYMOB_INTEGRATION_ID'),
            $billingData
        );

        if (!isset($paymentKey['token'])) {
            return back()->with('status', 'Failed to generate payment key');
        }

        // Step 4: Redirect to Paymob Iframe
        return redirect($this->paymob->getIframeUrl($paymentKey['token']));
    }

}
