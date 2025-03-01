<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($request->product_id);

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => DB::raw('quantity + ' . $request->quantity),
                'price' => $product->price,
            ]
        );
        // dd($cartItem);
        $cartItem->refresh();

        // return response()->json(['message' => 'Item added to cart', 'cartItem' => $cartItem]);
        return redirect()->back()->with('status', 'Product added to cart');
    }
    public function viewCart()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);
        // dd($cartItems);
        return view('cart', compact('cartItems', 'total'));
    }
    public function updateCart(Request $request)
    {
        // dd($request->all());
        // dd($request->input('quantity'));
        // Validate the input

        $request->validate([
            'quantity.*' => 'required|integer|min:1', // Ensure each quantity is a positive integer
        ]);

        $quantities = $request->input('quantity');

        foreach ($quantities as $productId => $quantity) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->update(['quantity' => $quantity]);
        }

        return redirect()->route('cart.view')->with('status', 'Cart updated successfully');
    }
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();


        return redirect()->route('cart.view')->with('status', 'product removed from cart');
    }
}
