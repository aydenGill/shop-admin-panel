<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;


Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'Login']);
    Route::post('register', [AuthController::class, 'Register']);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (){
   Route::get('home' , [HomeController::class , 'index']);
});
