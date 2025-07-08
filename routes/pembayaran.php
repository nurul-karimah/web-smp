Route::middleware(['auth'])->group(function () {
    Route::get('/tagihan', [PembayaranController::class, 'lihatTagihan'])->name('tagihan.index');
    Route::get('/pembayaran', [PembayaranController::class, 'lihatPembayaran'])->name('pembayaran.index');
    Route::post('/pembayaran/upload', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.upload');
    Route::post('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');
    Route::get('/status', [PembayaranController::class, 'statusPembayaran'])->name('pembayaran.status');
});
