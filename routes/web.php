<?php

use Illuminate\Support\Facades\Route;

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
});

Route::get('/AboutUs', function () {
    return view('AboutUs');
});

Route::get('/Equipment', function () {
    return view('Equipment');
});

Route::get('/home', function () {
    return view('home');
});
