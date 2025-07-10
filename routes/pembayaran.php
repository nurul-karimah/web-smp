<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembayaranController;

// Pastikan semua route ini hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Menampilkan semua tagihan (untuk admin atau user tertentu)
    Route::get('/tagihan', [PembayaranController::class, 'lihatTagihan'])->name('tagihan.index');

    // Menampilkan halaman pembayaran (form upload bukti pembayaran)
    Route::get('/pembayaran', [PembayaranController::class, 'lihatPembayaran'])->name('pembayaran.index');

    // Proses upload bukti pembayaran
    Route::post('/pembayaran/upload', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.upload');

    // Admin mengkonfirmasi pembayaran berdasarkan ID
    Route::post('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');

    // Menampilkan status pembayaran (untuk user melihat status tagihannya)
    Route::get('/status', [PembayaranController::class, 'statusPembayaran'])->name('pembayaran.status');
});
