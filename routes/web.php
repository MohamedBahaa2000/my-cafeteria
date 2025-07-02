<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\ProductShopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;



Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');});

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');});

// products
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin/products')->group(function () {
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');});
});

// user product shop
Route::middleware(['auth'])->group(function () {
Route::get('/shop', [ProductShopController::class, 'index'])->name('shop');

Route::post('/cart/add/{id}', [ProductShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ProductShopController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/place-order', [ProductShopController::class, 'placeOrder'])->name('cart.order');
 Route::delete('/cart/remove/{id}', [ProductShopController::class, 'removeFromCart'])->name('cart.remove');
});

// admin orders
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin/orders')
    ->name('orders.')
    ->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/create', [AdminOrderController::class, 'create'])->name('create');
        Route::post('/', [AdminOrderController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminOrderController::class, 'show'])->name('show');
        Route::post('/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('status');
        Route::delete('/{id}', [AdminOrderController::class, 'destroy'])->name('destroy');

        
        
    });


// admin dashboard
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');});

// admin users
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin/users')->name('users.')->group(function () {
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/create', [UserController::class, 'create'])->name('create');
Route::post('/', [UserController::class, 'store'])->name('store');
Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::put('/{id}', [UserController::class, 'update'])->name('update');
Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy'); });
Route::delete('/{id}/cancel', [UserOrderController::class, 'cancel'])->name('cancel');


// user orders
Route::middleware(['auth'])->prefix('my-orders')->name('myorders.')->group(function () {
Route::get('/', [UserOrderController::class, 'index'])->name('index');
Route::get('/{id}', [UserOrderController::class, 'show'])->name('show');
Route::delete('/{id}/cancel', [UserOrderController::class, 'cancel'])->name('cancel');});

// category
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index'); 
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');

});







require __DIR__.'/auth.php';
