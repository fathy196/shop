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
    return redirect()->back()->with('success', 'Item added to cart');
}
public function viewCart()
{
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    $total = $cartItems->sum(fn ($item) => $item->quantity * $item->price);

    return view('cart', compact('cartItems', 'total'));
}
public function updateCart(Request $request)
{
    // dd($request->all());
    // dd($request->input('quantity'));

    $quantities = $request->input('quantity'); 

    foreach ($quantities as $productId => $quantity) {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    return redirect()->route('cart.view')->with('success', 'Cart updated successfully');
}
public function removeFromCart($id)
{
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();
    
    
    return redirect()->route('cart.view')->with('success', 'product removed from cart');
}
}
