<?php

use App\Http\Controllers\backend\auth\loginController as AdminLogin;
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

Route::get('/', function () {
    return view('FrontEnd.templates.all');
});


Route::get('4dm1n/login', [AdminLogin::class, 'getLogin'])->name('admin_login_get')->middleware('guest');
Route::post('4dm1n/login', [AdminLogin::class, 'postLogin'])->name('admin_login_post')->middleware('guest');

Route::name('admin_')->prefix('4dm1n')->middleware('auth:admin')->group(function () {
    Route::get('logout', [AdminLogin::class, 'logout'])->name('logout');

    // Route::get('/', function () {
    //     return view('BackEnd.templates.all');
    // })->name('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
