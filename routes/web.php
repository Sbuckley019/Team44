<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BasketController;

use App\Http\Controllers\BasketItemController;

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
    return view('Register');
})->name('register');

Route::get('/Passchange', function () {
    return view('passchange');
})->name('passchange');

Route::get('/Orders', function () {
    return view('orders');
})->name('orders');

Route::get('/Basket', function () {
    return view('basket');
})->name('basket');

Route::get('/plist', [ProductController::class, 'index'])->name('products.index');

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
    Route::get('/products', [ProductController::class, 'index'])->name('.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('.create');
    Route::post('/products', [ProductController::class, 'store'])->name('.store')->middleware('web');
});

Route::name('register')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('.create');
    Route::post('/createuser', [UserController::class, 'store'])->name('.store')->middleware('web');
    Route::post('/loguser', [UserController::class, 'login'])->name('.login')->middleware('web');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('checkout')->group(function () {
        Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
        Route::post('/basket/add/{productId}', [BasketController::class, 'addProduct'])->name('basket.add');
        Route::post('/basket/remove/{productId}', [BasketController::class, 'addProduct'])->name('basket.remove');
        Route::post('/basket/edit/{productId}', [BasketController::class, 'editQuantity'])->name('basket.editQuantity');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('item')->group(function () {
        Route::get('/basketItem/{basket_id}', [BasketItemController::class, 'show'])->name('basketItem.show');
        Route::post('/basketItem/edit/{basket_id}', [BasketItemController::class, 'editQuantity'])->name('basketItem.editQuantity');
        Route::post('/basketItem/remove/{basket_id}', [BasketItemController::class, 'removeFromBasket'])->name('basketItem.remove');
    });
});
