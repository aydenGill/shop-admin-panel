<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Users\All as AllUsers;
use \App\Livewire\Categories\All as AllCategories;
use \App\Livewire\Products\All as AllProducts;
use \App\Livewire\Products\Add as AddProduct;


Route::view('/', 'welcome');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::get('users',AllUsers::class)->name('admin.users');
    Route::get('categories',AllCategories::class)->name('admin.categories');
    Route::get('products',AllProducts::class)->name('admin.products');
    Route::get('products/create',AddProduct::class)->name('admin.products.add');
});
