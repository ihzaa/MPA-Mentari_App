<?php

use App\Http\Controllers\backend\kategoriController;
use App\Http\Controllers\backend\posterController;
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
    // Route::get('/kategori', function () {
    //     return view('BackEnd.pages.kategori');
    // })->name('kategori');

    //Kategori
    Route::get('/kategori', [kategoriController::class, 'getKategori'])->name('kategori_get');
    Route::post('/tambahKategori', [kategoriController::class, 'addKategori'])->name('kategori_add');
    Route::post('/editKategori/{id}', [kategoriController::class, 'editKategori'])->name('kategori_edit');
    Route::get('/hapusKategori/{id}', [kategoriController::class, 'hapusKategori'])->name('kategori_hapus');

    //Poster
    Route::get('/poster', [posterController::class, 'getPoster'])->name('poster_get');
    Route::post('/tambahPoster', [posterController::class, 'addPoster'])->name('poster_add');
    Route::post('/editPoster/{id}', [posterController::class, 'editPoster'])->name('poster_edit');
    Route::get('/hapusPoster/{id}', [posterController::class, 'hapusPoster'])->name('poster_hapus');
});
