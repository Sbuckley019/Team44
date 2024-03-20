<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;

Route::get("/Checkout", function () {
    return view("Checkout");
})->name('checkout');

Route::get('/Orders', function () {
    return view('orders');
})->name('orders');

Route::name('products')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('.create');
    Route::post('/products', [ProductController::class, 'store'])->name('.store')->middleware('web');
});

Route::name('order')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('.index')->middleware('admin');
    Route::post('/basket/checkout', [OrderController::class, 'checkout'])->name('.checkout');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::post('/create-account', [UserController::class, 'createAccount'])->name('create.account');
