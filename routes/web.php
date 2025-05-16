<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/send-email', [CategoryController::class, 'sendEmail']);


// Route::post('/pay', [PaymentController::class, 'initiatePayment'])->name('pay');
// Route::post('/paymob/callback', [PaymentController::class, 'handleCallback']);
// Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');


Route::get('orders', function () {
    return view('orders.index');
});
// Route::get('emaill', function () {
//     return view('emails.welcome');
// });

Route::get('/dashboard2', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('products/{id}', [ProductController::class,'show'])->name('products.show');

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::patch('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');


require __DIR__ . '/auth.php';



// Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
// Route::get('/products',[ProductController::class, 'index'])->name('products.index');
// Route::get('/product/{id}',[ProductController::class, 'show'])->name('product.show');







Route::resource('orders', OrderController::class)->only(['index', 'show']);

// Checkout process routes
Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('checkout', [OrderController::class, 'placeOrder'])->name('checkout.process');
Route::get('orders/{order}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');

Route::get('/paymob/checkout/{order_id}', [CheckoutController::class, 'checkout'])->name('paymob.checkout');
