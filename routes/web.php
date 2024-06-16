<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ArticleController;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/class', function() {
    return Inertia::render('Api/Index');
})->middleware(['auth:sanctum', 'verified'])->name('api');

Route::get('/dashboard', function () {
    Cache::remember('weather', now()->addHour(), fn () => Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'q' => 'Kuressaare',
        'appId' => 'fd58ec2777db435cfa40c95ef6e0f73a',
        'units' => 'metric'
    ])->json());
    
    return Inertia::render('Dashboard', [
        'weatherData' => Cache::get('weather'),
        'blogs' => Blog::with('comments')->get(),
        'users' => User::all()
    ]);
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::get('/store', function () {
    return Inertia::render('Store/Store', [
        'products' => Product::all(),
        'cart' => session()->get('cart')
    ]);
})->middleware(['auth', 'verified'])->name('store');

Route::get('/maps', function () {
    return Inertia::render('Maps');
})->middleware(['auth', 'verified'])->name('maps');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('blog', BlogController::class)->except('update');
    Route::post('blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update');

});

Route::resource('comment', CommentController::class)->except('update');
Route::post('comment/update/{comment}', [CommentController::class, 'update'])->name('comment.update');

Route::resource('cart', StoreController::class)->except('update');

Route::post('/shopping-cart-add', [ShoppingCartController::class, 'addToCart'])->name('shoppingCart.add');
// Route::get('/checkout', [ShoppingCartController::class, 'showCheckout'])->name('shop.checkout');
Route::delete('/shopping-cart-delete', [ShoppingCartController::class, 'destroyProduct'])->name('shoppingCart.destroy');

Route::get('/checkout', [StripeController::class, 'index'])->name('stripeCheckout');

Route::resource('articles', ArticleController::class)->withTrashed();
Route::post('/{article}/comment', [CommentController::class, 'store'])->name('comment.post');
Route::delete('/{comment}/comment', [CommentController::class, 'destroy'])->name('comment.delete');

Route::get('/class', function() {
    return Inertia::render('Api/Index');
})->middleware(['auth:sanctum', 'verified'])->name('api');

Route::get('admin/dashboard', [ArticleController::class, 'class'])->
    middleware(['auth', 'admin']);

    Route::resource('cart', StoreController::class)->except('update');

    Route::post('/shopping-cart-add', [ShoppingCartController::class, 'addToCart'])->name('shoppingCart.add');
    // Route::get('/checkout', [ShoppingCartController::class, 'showCheckout'])->name('shop.checkout');
    Route::delete('/shopping-cart-delete', [ShoppingCartController::class, 'destroyProduct'])->name('shoppingCart.destroy');
    
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');

require __DIR__.'/auth.php';
