<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.role:user'])->group(function () {

    Route::get('user/{id}/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('user/{id}/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('user/{id}/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.delete');

    Route::get('/user/{user}/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/order/add', [OrderController::class, 'store'])->name('order.add');
    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/user/{user}/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/user/{user}/order/{order}', [OrderController::class, 'cancel'])->name('order.cancel');

    Route::post('/user/{user}/product/{product}/comment/create', [CommentController::class, 'store'])->name('product.comment.store');
});

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'check.role:admin'])->name('dashboard');

Route::middleware(['auth', 'check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::post('products/{id}/restore', [\App\Http\Controllers\Admin\ProductController::class, 'restore'])->name('products.restore');
    Route::resource('users', UserController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');

    Route::resource('comments', AdminCommentController::class)->only(['index', 'show', 'destroy']);
});

Route::get('/categories', action: [CategoryController::class, 'index'])->name('categories');
Route::get('/category/{category}', action: [CategoryController::class, 'show'])->name('category.show');
Route::get('/products', action: [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', action: [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{product}/comments/load', [ProductController::class, 'loadMoreComments'])->name('product.comments.load');





require __DIR__ . '/auth.php';
