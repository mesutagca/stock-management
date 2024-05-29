<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('users/{id}/delete', [UserController::class, 'destroy'])->whereNumber('id')->name('users.purge');
    Route::get('users/{id}/approve', [UserController::class, 'approve'])->whereNumber('id')->name('users.approve');
    Route::get('users/{id}/disapprove', [UserController::class, 'disapprove'])->whereNumber('id')->name('users.disapprove');
    Route::resource('users', UserController::class);

    Route::get('categories/{id}', [CategoryController::class, 'destroy'])->whereNumber('id')->name('categories.destroy');
    Route::resource('categories', CategoryController::class);

    Route::get('products/{id}', [ProductController::class, 'destroy'])->whereNumber('id')->name('products.destroy');
    Route::resource('products', ProductController::class);
});

Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
