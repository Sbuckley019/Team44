<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\OrderController;

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


Route::get('/Signup', function () {
    return view('signup');
})->name('signup');

Route::get('/Login', function () {
    return view('login');
})->name('login');

Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
   
Route::get('/order/edit', [OrderController::class, 'edit'])->name('order.edit');
   
Route::get('/order/show', [OrderController::class, 'show'])->name('order.show');
   