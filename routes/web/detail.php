<?php

use App\Http\Controllers\User\DetailController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');
});
