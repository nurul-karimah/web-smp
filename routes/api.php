<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;

use App\Models\Pendaftaran;

Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('/pendaftaranSiswa', [PendaftaranController::class, 'store']);
  Route::get('/getPendafranSaya', [PendaftaranController::class, 'getPendaftaranSaya']);
  Route::get('/getPembayaranSiswa', [PembayaranController::class, 'getPembayaranSiswa']);
});
