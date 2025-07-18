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
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;

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
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================================
// GURU
// ===================================
Route::get('/guru/login', [GuruController::class, 'showLoginForm'])->name('guru.login');
Route::post('/guru/login', [GuruController::class, 'login']);
Route::post('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

Route::middleware(['auth:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/navbar', [GuruController::class, 'navbar']);

    Route::get('/guru', [GuruController::class, 'showGuru'])->name('showGuru');
    Route::get('/registerGuru', [GuruController::class, 'regisGuru'])->name('regisGuru');
    Route::post('/registerGuru/create', [GuruController::class, 'regisAksi']);
    Route::get('/guru/{id}/edit', [GuruController::class, 'editGuru']);
    Route::post('/guru/{id}/update', [GuruController::class, 'updateGuru']);
    Route::get('/guru/{id}/hapus', [GuruController::class, 'destroyGuru']);
    Route::get('/datasiswa', [GuruController::class, 'dataSiswa']);
    Route::get('/kehadiran', [GuruController::class, 'kehadiran']);
});

// ===================================
// ORANGTUA
// ===================================
Route::get('/loginOrangtua', [OrangtuaController::class, 'Login'])->name('loginOrangtua');
Route::post('/loginAksi', [OrangtuaController::class, 'LoginAksi']);
Route::post('/orangtua/logout', [OrangtuaController::class, 'logout'])->name('orangtua.logout');

Route::middleware(['auth:orangtua'])->group(function () {
    Route::get('/orangtua/dashboard', [OrangtuaController::class, 'dashboard'])->name('orangtua.dashboard');
    Route::get('/orangtua/navbar', [OrangtuaController::class, 'navbarOrangtua']);
    Route::get('/orangtua/profile', [OrangtuaController::class, 'profile']);
    Route::get('/orangtua/rekapBelajar', [OrangtuaController::class, 'rekapPendidikan']);

    // Absensi siswa
    Route::get('/absensi', [OrangtuaController::class, 'showAbsensi']);
    Route::get('/absensi/showForm', [OrangtuaController::class, 'showFormAbsensi']);
    Route::post('/absensi/aksi', [OrangtuaController::class, 'createAbsensi']);

    // Pembayaran
    Route::get('/pembayaran-siswa', [OrangtuaController::class, 'pembayaranSiswa'])->name('orangtua.pembayaran');
    Route::post('/pembayaran/upload', [PembayaranController::class, 'upload'])->name('pembayaran.upload');
});

// CRUD ORANGTUA
Route::get('/orangtua', [OrangtuaController::class, 'showOrangtua'])->name('showorangtua');
Route::get('/regisOrangtua', [OrangtuaController::class, 'regisOrangtua'])->name('registerOrtu');
Route::post('/registerOrangtua/aksi', [OrangtuaController::class, 'regisAksi']);
Route::get('/orangtua/cari', [OrangtuaController::class, 'orangtuaCari']);
Route::get('/orangtua/view/{id}', [OrangtuaController::class, 'viewData']);
Route::get('/orangtua/edit/{id}', [OrangtuaController::class, 'editData']);
Route::post('/orangtua/update/{id}', [OrangtuaController::class, 'updateData']);
Route::get('/orangtua/hapus/{id}', [OrangtuaController::class, 'destroyOrangtua']);

// ===================================
// ADMIN
// ===================================
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Tagihan & Pembayaran
    Route::get('/pembayaran-admin', [PembayaranController::class, 'lihatTagihan'])->name('pembayaran.admin');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::post('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');
});

// ===================================
// SISWA
// ===================================
Route::get('/siswa/register/{id}', [SiswaController::class, 'RegisterSiswa']);
Route::post('/siswa/registerAksi', [SiswaController::class, 'regisaksi']);

// ===================================
// DATA AKADEMIK
// ===================================
Route::get('/dataakademik', [DataAkademikPaudController::class, 'showData']);
Route::get('/dataakademik/create', [DataAkademikPaudController::class, 'create']);
Route::post('/dataakademik/create/aksi', [DataAkademikPaudController::class, 'store']);
Route::get('/data/keseluruhan/{id}', [DataAkademikPaudController::class, 'keseluruhanData']);
Route::get('/export-data/{id}', [ExportRaportSiswa::class, 'exportDataAkademik']);
Route::get('/data/edit/{id}', [DataAkademikPaudController::class, 'edit']);
Route::post('/data/update/{id}', [DataAkademikPaudController::class, 'updateData']);

// ===================================
// CATATAN PERKEMBANGAN ANAK
// ===================================
Route::get('/catatanperkembangananaka', [CatatanPerkembanganAnakController::class, 'indexCatatanPerkembangan']);
Route::post('/aksi/addCatatanPerkembangan', [CatatanPerkembanganAnakController::class, 'storeCatatanPerkembangan']);
Route::get('/showForm/CatatanPerkembangan', [CatatanPerkembanganAnakController::class, 'showFormData']);
