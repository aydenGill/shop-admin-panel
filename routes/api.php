<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;


Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'Login']);
    Route::post('register', [AuthController::class, 'Register']);
});
