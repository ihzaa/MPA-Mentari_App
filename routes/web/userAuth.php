<?php

use App\Http\Controllers\User\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::name('login.')->prefix('login')->middleware('guest')->group(function () {
        Route::get('', [LoginController::class, 'loginGet'])->name('get');
        Route::post('', [LoginController::class, 'loginPost'])->name('post');
    });

    Route::middleware('auth:user')->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
