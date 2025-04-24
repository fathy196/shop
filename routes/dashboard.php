<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//         return view('dashboard.index');
//     })->middleware(['auth', 'verified','is_admin'])->name('dashboard');



Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/users', [HomeController::class, 'showUsers'])->name('showUsers');
    Route::get('/admins', [HomeController::class, 'showAdmins'])->name('showAdmins');
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class)->except('show')->middleware('is_admin');
