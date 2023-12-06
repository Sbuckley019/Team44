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

Route::get('/AboutUs', function () {
    return view('AboutUs');
});

Route::get('/Equipment', function () {
    return view('Equipment');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/Signup', function () {
    return view('signup');
})->name('signup');

Route::get('/Login', function () {
    return view('login');
})->name('login');