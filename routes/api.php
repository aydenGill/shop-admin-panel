<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\ProductController;


Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'Login']);
    Route::post('register', [AuthController::class, 'Register']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (){
   Route::get('home' , [HomeController::class , 'index']);
   Route::get('product/wishlist', [ProductController::class, 'wishlist'])->name('product.wishlist');
   Route::resource('product',ProductController::class)->except(['store','update','delete','edit']);
   Route::get('product/{product}/like', [LikeController::class, 'likeProduct']);
});
