<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\BasketItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');

Route::name('checkout')->group(function () {
    Route::post('/checkout/shipping', [CheckoutController::class, 'validateShipping'])->name('.shipping');
    Route::post('/checkout/payment', [CheckoutController::class, 'validatePayment'])->name('.payment');
    Route::post('/checkout/submit', [CheckoutController::class, 'checkout'])->name('.submit');
});


Route::get('/', [HomeController::class, 'homeProductCarousels'])
    ->name('home');


Route::get('/about', function () {
    return Inertia::render('About');
});
Route::get('/contact', function () {
    return Inertia::render('Contact');
});
Route::get('/feedback', function () {
    return Inertia::render('Feedback');
});
Route::get('/product/{product_id}', [ProductItemController::class, 'show'])->name('product.show');

Route::name('products')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('.create');
    Route::get('/products/{category_id?}', [ProductController::class, 'index'])->name('.index');
    Route::post('/products', [ProductController::class, 'store'])->name('.store')->middleware('web');
});

Route::name('favourite')->group(function () {
    Route::get('/favourites', [FavouritesController::class, 'index'])->name('.index');
    Route::post('/favourite/add', [FavouritesController::class, 'FavouriteOrNot'])->name('.add');
});

Route::name('orders')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('.index');
});

Route::name('review')->group(function () {
    Route::post('/review', [ReviewController::class, 'helpfulReview'])->name('.helpful');
    Route::get('/reviews/{productId}', [ReviewController::class, 'index'])->name('.index');
});

Route::name('feedback')->group(function () {
    //Route::get('/feedback', [FeedbackController::class, 'index'])->name('.index');
    Route::post('/feedback/add', [FeedbackController::class, 'store'])->name('.store');
    Route::post('/feedback/read/{feedbackId}', [FeedbackController::class, 'read'])->name('.read');
});

Route::name('contact')->group(function () {
    //Route::get('/contact', [ContactController::class, 'index'])->name('.index');
    Route::post('/contact/add', [ContactController::class, 'store'])->name('.store');
    Route::post('/contact/read/{contactId}', [ContactController::class, 'read'])->name('.read');
});

Route::get('/basket', function () {
    return Inertia::render('Basket');
});
Route::name('basket')->group(function () {
    Route::post('/basket/add/', [BasketController::class, 'addOrUpdateProduct'])->name('.add');
    Route::post('/basket/remove/', [BasketController::class, 'removeProduct'])->name('.remove');
});

Route::middleware(['auth'])->group(function () {
    Route::name('basketItem')->group(function () {
        Route::get('/basketItem/{basket_id}', [BasketItemController::class, 'show'])->name('.show');
        Route::post('/basketItem/edit/{basket_id}', [BasketItemController::class, 'editQuantity'])->name('.editQuantity');
        Route::post('/basketItem/remove/{basket_id}', [BasketItemController::class, 'removeFromBasket'])->name('.remove');
    });
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('admin/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    //Route::get('/customers', [UserController::class, 'index'])->name('customer.index');

    Route::name('products')->group(function () {
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('.destroy');
        Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('.adminIndex');
    });
});


require __DIR__ . '/auth.php';
