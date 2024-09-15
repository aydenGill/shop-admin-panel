<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\BasketController;
use App\Http\Controllers\api\v1\CommentController;
use App\Http\Controllers\api\v1\HomeController;
use App\Http\Controllers\api\v1\LikeController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\OrderController;
use App\Http\Controllers\api\v1\ProductController;
use App\Http\Controllers\api\v1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'Login'])->name('api.login');
    Route::post('register', [AuthController::class, 'Register'])->name('api.register');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    Route::get('profile', [ProfileController::class, 'index'])->name('api.home');
    Route::post('profile', [ProfileController::class, 'update'])->name('api.home');
    Route::get('home', [HomeController::class, 'index'])->name('api.home');

    Route::prefix('search')->group(function () {
        Route::get('filter', [HomeController::class, 'filter'])->name('api.search.data');
        Route::get('', [HomeController::class, 'search'])->name('api.search.data');
    });

    Route::get('product/wishlist', [ProductController::class, 'wishlist'])->name('api.product.wishlist');
    Route::resource('product', ProductController::class)->except(['store', 'update', 'delete', 'edit']);
    Route::get('product/{product}/like', [LikeController::class, 'likeProduct'])->name('api.product.like');

    Route::get('comment/{product}', [CommentController::class, 'index'])->name('api.comment');
    Route::post('comment', [CommentController::class, 'store'])->name('api.comment.store');

    Route::prefix('basket')->group(function () {
        Route::get('', [BasketController::class, 'index'])->name('api.basket');
        Route::post('add', [BasketController::class, 'add'])->name('api.basket.add');
        Route::post('delete', [BasketController::class, 'delete'])->name('api.basket.delete');
        Route::post('buy', [BasketController::class, 'buy'])->name('api.basket.buy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('', [OrderController::class, 'index']);
    });

    Route::get('address', [ProfileController::class, 'address'])->name('api.address');
    Route::post('address', [ProfileController::class, 'store_address'])->name('api.address.store');

    Route::get('notifications', [NotificationController::class, 'index'])->name('api.notifications');
    Route::get('notifications/unread', [NotificationController::class, 'unread'])->name('api.notifications');
});
