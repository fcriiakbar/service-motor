<?php

use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pelanggan', PelangganController::class)->except('show');
Route::resource('kendaraan', KendaraanController::class)->except('show');
Route::resource('daftar-service', DaftarServiceController::class)->except('show');
Route::resource('data-service', DataServiceController::class)->except('show');
Route::resource('pembayaran', PembayaranController::class)->except('show');