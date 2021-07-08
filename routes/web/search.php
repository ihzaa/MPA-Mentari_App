<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('', [HomeController::class, 'home'])->name('search');
});
