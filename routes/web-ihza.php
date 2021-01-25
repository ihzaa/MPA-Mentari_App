<?php

use App\Http\Controllers\itemController;
use App\Http\Livewire\Admin\Items\CreateAndUpdate;
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
        Route::get('{id_items}/items/livewire', Index::class)->name('list.item.by.category');

        Route::get('{id}/items', [itemController::class, 'index'])->name('list.item.category');
        Route::get('{id}/item/delete', [itemController::class, 'delete'])->name('item.delete');
        Route::get('{id}/item/add', [itemController::class, 'addGet'])->name('list.add.get');
        Route::post('{id}/item/add', [itemController::class, 'addPost'])->name('list.add.post');
        Route::get('{id}/item/edit/{id_item}', [itemController::class, 'editGet'])->name('list.edit.get');
        Route::post('{id}/item/edit/{id_item}', [itemController::class, 'editPost'])->name('list.edit.post');
    });
});
