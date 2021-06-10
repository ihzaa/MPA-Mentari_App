<?php

use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;

Route::name('user.product.')->prefix('produk')->group(function () {
    Route::get('{id}', [ProductController::class, 'detail'])->name('detail');
});
