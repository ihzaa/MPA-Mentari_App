<?php

use App\Http\Controllers\User\Keranjang\AddToCartController;
use App\Http\Controllers\User\Keranjang\CartController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::prefix('keranjang')->name('keranjang.')->middleware('auth:user')->group(function () {
        Route::post('addOneItem', [AddToCartController::class, 'addOneItem'])->name('addOneItem');
        Route::get('/', [CartController::class, 'index'])->name('index');
    });
});
