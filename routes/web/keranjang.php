<?php

use App\Http\Controllers\User\Keranjang\AddToCartController;
use App\Http\Controllers\User\Keranjang\CartController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::prefix('keranjang')->name('keranjang.')->middleware('auth:user')->group(function () {
        Route::post('addOneItem', [AddToCartController::class, 'addOneItem'])->name('addOneItem');
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/', [CartController::class, 'checkOut'])->name('checkOut');
        Route::post('/decrease/item/quantity', [CartController::class, 'decrease'])->name('decrease.item.quantity');
        Route::post('/increase/item/quantity', [CartController::class, 'increase'])->name('increase.item.quantity');
        Route::post('/change/item/quantity', [CartController::class, 'changeQuantity'])->name('change.item.quantity');
        Route::post('/delete', [CartController::class, 'delete'])->name('delete.item');
    });
});
