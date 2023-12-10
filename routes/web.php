<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

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

Route::get('/Basket', function () {
    return view('basket');
})->name('basket');

Route::get('/remove', function () {
    return view('home');
})->name('remove');