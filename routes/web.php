<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BasketController;

use App\Http\Controllers\BasketItemController;
use App\Http\Controllers\CookieController;

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

Route::get("/Checkout", function () {
    return view("Checkout");
})->name('checkout');

Route::get("/Contact", function () {
    return view("ContactUs");
})->name('contact');

Route::get('/AboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/Equipment', function () {
    return view('equipment');
});

Route::get('/', [CookieController::class, 'index'])->name('home');

Route::get('/Register', function () {
    return view('Register');
})->name('register');

Route::get('/Passchange', function () {
    return view('passchange');
})->name('passchange');

Route::get('/Orders', function () {
    return view('orders');
})->name('orders');

Route::post('/changepass', [UserController::class, 'updatePassword'])->name('users.updatePassword');
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('web');

Route::get('/remove', function () {
    return view('home');
})->name('remove');

Route::name('productcategories')->group(function () {
    Route::get('/productcategories', [ProductCategoryController::class, 'index'])->name('.index');
    Route::get('/productcategories/create', [ProductCategoryController::class, 'create'])->name('.create');
    Route::post('/productcategories', [ProductCategoryController::class, 'store'])->name('.store')->middleware('web');
});

Route::name('products')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('.create');
    Route::get('/products/{id?}', [ProductController::class, 'index'])->name('.index');
    Route::post('/products', [ProductController::class, 'store'])->name('.store')->middleware('web');
    Route::post('/products/search', [ProductController::class, 'search'])->name('.search')->middleware('web');
});

Route::name('register')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('.create');
    Route::post('/createuser', [UserController::class, 'store'])->name('.store')->middleware('web');
    Route::post('/loguser', [UserController::class, 'login'])->name('.login')->middleware('web');
});

Route::name('basket')->group(function () {
    Route::get('/basket', [BasketController::class, 'index'])->name('.index');
    Route::post('/basket/add/{productId}', [BasketController::class, 'addProduct'])->name('.add');
    Route::post('/basket/remove/{productId}', [BasketController::class, 'addProduct'])->name('.remove');
    Route::post('/basket/edit/{productId}', [BasketController::class, 'editQuantity'])->name('.editQuantity');
});


Route::middleware(['auth'])->group(function () {
    Route::name('basketItem')->group(function () {
        Route::get('/basketItem/{basket_id}', [BasketItemController::class, 'show'])->name('.show');
        Route::post('/basketItem/edit/{basket_id}', [BasketItemController::class, 'editQuantity'])->name('.editQuantity');
        Route::post('/basketItem/remove/{basket_id}', [BasketItemController::class, 'removeFromBasket'])->name('.remove');
    });
});

Route::get('/Product', function () {
    return view('Product');
});
