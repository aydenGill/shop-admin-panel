<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Users\All as AllUsers;


Route::view('/', 'welcome');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::get('users',AllUsers::class)->name('admin.users');
});
