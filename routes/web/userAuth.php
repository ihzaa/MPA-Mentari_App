<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::name('login.')->prefix('login')->middleware('guest')->group(function () {
        Route::get('', [LoginController::class, 'loginGet'])->name('get');
        Route::post('', [LoginController::class, 'loginPost'])->name('post');
    });
    Route::name('register.')->prefix('register')->middleware('guest')->group(function () {
        Route::get('', [RegisterController::class, 'registerGet'])->name('get');
        Route::post('', [RegisterController::class, 'registerPost'])->name('post');
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
