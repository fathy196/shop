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

    public function checkout(Request $request)
    {
       
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Please login to proceed');
        }

        // Validate the cart has items
        $cart = Auth::user()->cartItems;
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('status', 'Your cart is empty!');
        }

        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']) + 80; // Add shipping cost

        // Step 1: Get Paymob authentication token
        $authToken = $this->paymob->getAuthToken();
        
        // Step 2: Create an order on Paymob
        $order = $this->paymob->createOrder($authToken, $totalAmount, env('PAYMOB_MERCHANT_ID'));

        if (!isset($order['id'])) {
            return back()->with('status', 'Order creation failed');
        }

        // Billing information (dummy data for now)
        $billingData = [
            "first_name" => Auth::user()->name ?? "fathy",
            "last_name" => "Doe",
            "email" => Auth::user()->email ?? "john@example.com",
            "phone_number" => "01000000000",
            "city" => "Cairo",
            "country" => "EG",
            "apartment" => "12",  // REQUIRED
            "floor" => "3",       // REQUIRED
            "street" => "123 Example St", // REQUIRED
            "building" => "5B",   // REQUIRED
            "shipping_method" => "PKG",
            "postal_code" => "12345",
            "state" => "Cairo"
        ];
        // Step 3: Get payment key
        $paymentKey = $this->paymob->getPaymentKey($authToken, $order['id'], $totalAmount, env('PAYMOB_INTEGRATION_ID'), $billingData);

        if (!isset($paymentKey['token'])) {
            return back()->with('status', 'Payment key generation failed');
        }

        // Step 4: Redirect to Paymob payment iframe
        return redirect($this->paymob->getIframeUrl($paymentKey['token']));
    }
    
}
