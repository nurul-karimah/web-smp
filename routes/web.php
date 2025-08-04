<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DataAkademikPaudController;
use App\Http\Controllers\ExportRaportSiswa;
use App\Http\Controllers\CatatanPerkembanganAnakController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\User;
// Home
Route::get('/', function () {
    if (Auth::guard('guru')->check()) {
        return redirect('/guru/dashboard')->with('error', 'Anda harus logout terlebih dahulu.');
    }
    return view('welcome');
});

// Default Laravel auth
require __DIR__ . '/auth.php';

// Profile (hanya user biasa dengan guard `web`)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $jumlahDisetujui = Pendaftaran::where('status', 'disetujui')->count();
        $jumlahDitolak = Pendaftaran::where('status', 'ditolak')->count();
        $jumlahSudahBayar = Pendaftaran::where('status', 'diterima')->count();

        $trafik = Pendaftaran::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = $trafik->pluck('tanggal');
        $data = $trafik->pluck('total');

        // Hitung gender
        $jumlahLaki = Pendaftaran::where('jenis_kelamin', 'laki-laki')->count();
        $jumlahPerempuan = Pendaftaran::where('jenis_kelamin', 'perempuan')->count();
        $jumlahRegister = User::All()->count();

        return view('dashboard', compact(
            'jumlahDisetujui',
            'jumlahDitolak',
            'jumlahSudahBayar',
            'labels',
            'data',
            'jumlahLaki',
            'jumlahPerempuan',
            'jumlahRegister'
        ));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






// ===================================
// ADMIN
// ===================================
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// ===================================
// SISWA
// ===================================
Route::get('/siswa/register/{id}', [SiswaController::class, 'RegisterSiswa']);
Route::post('/siswa/registerAksi', [SiswaController::class, 'regisaksi']);
Route::get('/dashboardSiswa', [SiswaController::class, 'index'])->name('dashboardSiswa');
Route::get('/dataPendaftaranSiswa', [PendaftaranController::class, 'getPendaftaranSiswa'])->name('dataPendaftaranSiswa');
Route::get('/getDataSiswa', [SiswaController::class, 'getDataSiswa']);
Route::get('/editDataSiswa/{id}', [RegisteredUserController::class, 'edit']);
Route::put('/editDataSiswa/{id}', [RegisteredUserController::class, 'update'])->name('user.update');
Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
Route::get('/siswa/password', [SiswaController::class, 'formUbahPassword'])->name('siswa.password.form');
Route::post('/siswa/password', [SiswaController::class, 'ubahPassword'])->name('siswa.password.update');




// data pendaftaran

Route::get('/pendaftaran', [PendaftaranController::class, 'create']);
Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaranInAdmin', [PendaftaranController::class, 'getPendaftaranAdmin'])->name('pendaftaran.admin');

Route::post('/pendaftaran/update-status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
Route::get('/getFormUpdatePendaftaran/{id}', [PendaftaranController::class, 'edit']);
Route::put('/updatePendaftaran/{id}', [PendaftaranController::class, 'updatePendaftaran']);
Route::get('/showPendaftaran/{id}', [PendaftaranController::class, 'show']);
Route::delete('/deletePendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
Route::get('/status-pendaftaran', [PendaftaranController::class, 'statusPendaftaran'])->name('status.pendaftaran');
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');





// data pembayaran 
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/getPembayaran', [PembayaranController::class, 'getPembayaranSiswa'])->name('pembayaran.index');
Route::get('/getPembayaranAdmin', [PembayaranController::class, 'getPembayaranAdmin'])->name('pembayaran.admin');
Route::post('/updateStatusPembayaran', [PembayaranController::class, 'updateStatusPembayaran'])->name('pembayaran.updateStatus');
Route::get('/getFormUpdatePembayaran/{id}', [PembayaranController::class, 'editPembayaran']);
Route::put('/updatePembayaran/{id}', [PembayaranController::class, 'updatePembayaran']);
