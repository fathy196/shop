<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//         return view('dashboard.index');
//     })->middleware(['auth', 'verified','is_admin'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::middleware(['is_admin'])->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/users', [HomeController::class, 'showUsers'])->name('showUsers');
    Route::get('/admins', [HomeController::class, 'showAdmins'])->name('showAdmins');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class)->except('show')->middleware('is_admin');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

});

