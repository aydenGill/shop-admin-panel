<?php

use App\Livewire\Categories\All as AllCategories;
use App\Livewire\ProductGallery\Add as AddGallery;
use App\Livewire\ProductGallery\All as AllGallery;
use App\Livewire\Products\Add as AddProduct;
use App\Livewire\Products\All as AllProducts;
use App\Livewire\Users\All as AllUsers;
use Illuminate\Support\Facades\Route;

Route::get('/login-without-password', function () {
    $user = \App\Models\User::first();
    auth()->login($user);

    return redirect()->route('dashboard');
});

Route::view('/', 'welcome');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('users', AllUsers::class)->name('admin.users');
    Route::get('categories', AllCategories::class)->name('admin.categories');
    Route::get('products', AllProducts::class)->name('admin.products');
    Route::get('products/create', AddProduct::class)->name('admin.products.add');
    Route::get('products/{product}/gallery', AllGallery::class)->name('admin.products.gallery');
    Route::get('products/{product}/gallery/create', AddGallery::class)->name('admin.products.gallery.create');
});
