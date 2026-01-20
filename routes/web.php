<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MerekController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('penjualan/laporan', [PenjualanController::class, 'laporan'])->middleware('auth')->name('penjualan.laporan');
Route::resource('penjualan', PenjualanController::class)->middleware('auth');
Route::resource('produk', ProdukController::class);
Route::resource('merek', MerekController::class);
