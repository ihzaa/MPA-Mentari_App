<?php

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\kategoriController;
use App\Http\Controllers\backend\posterController;
use App\Http\Controllers\backend\transaksiController;
use App\Http\Controllers\pengaturanController;
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
    //Setting
    Route::get('/pengaturan', [pengaturanController::class, 'index'])->name('pengaturan');
    Route::post('/pengaturan/ubahPassword', [pengaturanController::class, 'edit_password'])->name('edit_password');

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
    Route::get('/transaksi', [transaksiController::class, 'getUserTransaction'])->name('transaksi_get');
    Route::get('/transaksi/{id}', [transaksiController::class, 'getDetailTransaction'])->name('detail_get');
    Route::get('/transaksiDetail/{id}', [transaksiController::class, 'showDetailTransaction'])->name('transaksi_detail');
    Route::get('/kirim/{id}', [transaksiController::class, 'kirim'])->name('kirim');
    Route::get('/batalkirim/{id}', [transaksiController::class, 'batalKirim'])->name('batal_kirim');

    //Promo
    Route::get('/hapusPromo/{id}', [DashboardController::class, 'hapusPromo'])->name('promo_hapus');

    //Whatsapp
    Route::get('/whatsapp', [DashboardController::class, 'kirimWhatsapp'])->name('whatsapp');
});
