<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\BasketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/Contact", function () {
    return view("ContactUs");
})->name('contact');

Route::get('/AboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/Equipment', function () {
    return view('equipment');
});

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/Register', function () {
    return view('register');
})->name('register');

Route::middleware(['auth'])->group(function () {
    Route::prefix('checkout')->group(function () {
        Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
        Route::post('/basket/add/{productId}', [BasketController::class, 'addProduct'])->name('basket.add');
        Route::post('/basket/remove/{productId}', [BasketController::class, 'addProduct'])->name('basket.remove');
        Route::post('/basket/edit/{productId}', [BasketController::class, 'editQuantity'])->name('basket.editQuantity');
    });
});
