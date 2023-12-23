<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\BasketController;
use \App\Http\Controllers\api\ProfileController;

Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'Login']);
    Route::post('register', [AuthController::class, 'Register']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (){

   Route::get('profile',[ProfileController::class,'index']);
   Route::get('home' , [HomeController::class , 'index']);
   Route::get('product/wishlist', [ProductController::class, 'wishlist'])->name('product.wishlist');
   Route::resource('product',ProductController::class)->except(['store','update','delete','edit']);
   Route::get('product/{product}/like', [LikeController::class, 'likeProduct']);

   Route::get('basket',[BasketController::class,'index']);
    Route::post('basket/add',[BasketController::class,'add']);
    Route::post('basket/delete',[BasketController::class,'delete']);
});
