<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\BasketController;
use \App\Http\Controllers\api\ProfileController;

Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'Login'])->name('api.login');
    Route::post('register', [AuthController::class, 'Register'])->name('api.register');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (){

   Route::get('profile',[ProfileController::class,'index'])->name('api.home');
   Route::get('home' , [HomeController::class , 'index'])->name('api.home');
   Route::get('product/wishlist', [ProductController::class, 'wishlist'])->name('api.product.wishlist');
   Route::resource('product',ProductController::class)->except(['store','update','delete','edit']);
   Route::get('product/{product}/like', [LikeController::class, 'likeProduct'])->name('api.product.like');

   Route::get('basket',[BasketController::class,'index'])->name('api.basket');
    Route::post('basket/add',[BasketController::class,'add'])->name('api.basket.add');
    Route::post('basket/delete',[BasketController::class,'delete'])->name('api.basket.delete');
});
