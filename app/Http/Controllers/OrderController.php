<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('orders.show', compact('order'));
    }

    // Checkout Process
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);
        $user = Auth::user();

        return view('checkout', compact('cartItems', 'total', 'user'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }

        // Validate request data
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:cash_on_delivery,credit_card',
        ]);

        // Update user info if changed
        $user->update([
            'phone' => $request->phone,
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartItems->sum(fn($item) => $item->quantity * $item->price),
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'status' => 'pending',
            ]);
        }

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        if ($request->payment_method === 'credit_card') {
            // Redirect to Paymob Checkout Controller
            return redirect()->route('paymob.checkout', ['order_id' => $order->id]);
        }
        // For cash on delivery, just redirect to confirmation
        return redirect()->route('orders.confirmation', $order->id)
            ->with('success', 'Order placed successfully!');

    }

    public function confirmation(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('orders.confirmation', compact('order'));
    }

}