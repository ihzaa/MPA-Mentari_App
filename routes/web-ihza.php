<?php

use App\Http\Livewire\Admin\Items\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin_')->prefix('4dm1n')->middleware('auth:admin')->group(function () {
    Route::prefix('kategori')->group(function () {
        Route::get('{id_items}/items', Index::class)->name('list.item.by.category');
    });
});
