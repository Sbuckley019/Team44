<?php


use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProductCategoryController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\BasketController;

use App\Http\Controllers\BasketItemController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\CheckoutController;

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

Route::get("/PastOrders", function () {
    return view("PastOrders");
})->name('PastOrder');

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

Route::name('feedback')->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('.index')->middleware('admin');
    Route::post('/feedback/add', [FeedbackController::class, 'store'])->name('.store')->middleware('web');
    Route::post('/feedback/read/{feedbackId}', [FeedbackController::class, 'read'])->name('.read')->middleware('web');
});

Route::name('productcategories')->group(function () {
    Route::get('/productcategories', [ProductCategoryController::class, 'index'])->name('.index');
    Route::get('/productcategories/create', [ProductCategoryController::class, 'create'])->name('.create');
    Route::post('/productcategories', [ProductCategoryController::class, 'store'])->name('.store')->middleware('web');
});

Route::name('products')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('.create');
    Route::get('/products/refresh', [ProductController::class, 'refresh'])->name('.refresh');
    Route::get('/products', [ProductController::class, 'index'])->name('.index');   
    Route::post('/products', [ProductController::class, 'store'])->name('.store')->middleware('web');
});

Route::get('/products/{product}', [ProductItemController::class, 'show'])->name('products.show');

Route::name('favourite')->group(function () {
    Route::get('/favourite', [FavouritesController::class, 'index'])->name('.index');
    Route::post('/favourite/{productId}', [FavouritesController::class, 'FavouriteOrNot'])->name('.add')->middleware('web');
});

Route::name('register')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('.create');
    Route::post('/createuser', [UserController::class, 'store'])->name('.store')->middleware('web');
    Route::post('/loguser', [UserController::class, 'login'])->name('.login')->middleware('web');
});

Route::name('basket')->group(function () {
    Route::get('/basket', [BasketController::class, 'index'])->name('.index');
    Route::post('/basket/add/{productId}', [BasketController::class, 'addProduct'])->name('.add');
    Route::post('/basket/remove/{productId}', [BasketController::class, 'removeProduct'])->name('.remove');
    Route::post('/basket/edit/{productId}', [BasketController::class, 'editQuantity'])->name('.editQuantity');
});

Route::name('order')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('.index')->middleware('admin');
    Route::post('/basket/checkout', [OrderController::class, 'checkout'])->name('.checkout');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');


Route::middleware(['auth'])->group(function () {
    Route::name('basketItem')->group(function () {
        Route::get('/basketItem/{basket_id}', [BasketItemController::class, 'show'])->name('.show');
        Route::post('/basketItem/edit/{basket_id}', [BasketItemController::class, 'editQuantity'])->name('.editQuantity');
        Route::post('/basketItem/remove/{basket_id}', [BasketItemController::class, 'removeFromBasket'])->name('.remove');
    });
});

Route::post('/create-account', [UserController::class, 'createAccount'])->name('create.account');

Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('products.adminIndex')->middleware('admin');

Route::get('admin/orders', function () {
    return view('admin.orders');
})->name('admin.orders')->middleware('admin');


Route::get('/customers', [UserController::class, 'index'])->name('customer.index')->middleware('admin');






Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');



    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});






Route::middleware(['admin'])->get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::middleware(['admin'])->put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::middleware(['admin'])->delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::middleware(['admin'])->get('/admin/products', [ProductController::class, 'adminIndex'])->name('products.adminIndex');



