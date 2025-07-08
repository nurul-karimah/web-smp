<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DataAkademikPaudController;
use App\Http\Controllers\ExportRaportSiswa;
use App\Http\Controllers\CatatanPerkembanganAnakController;
use App\Models\CatatanPerkembanganAnak;
use App\Models\DataAkademikPaud;
use App\Models\Orantua;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    // periksa apakah guru sudah login menggunakan guard 'guru'
    if (Auth::guard('guru')->check()) {

        return redirect('/guru/dashboard')->with('error', 'Anda Harus Logout Terlebih dahulu');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';

// DATA GURU 
Route::get('/guru', [GuruController::class, 'showGuru'])->name('showGuru');
Route::get('/registerGuru', [GuruController::class, 'regisGuru'])->name('regisGuru');
Route::post('/registerGuru/create', [GuruController::class, 'regisAksi']);
Route::get('/guru/{id}/edit', [GuruController::class, 'editGuru']);
Route::post('/guru/{id}/update', [GuruController::class, 'updateGuru']);
Route::get('/guru/{id}/hapus', [GuruController::class, 'destroyGuru']);
Route::get('/datasiswa', [GuruController::class, 'dataSiswa']);
Route::get('/kehadiran', [GuruController::class, 'kehadiran']);





Route::middleware(['auth:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard']);
    Route::get('/guru/navbar', [GuruController::class, 'navbar']);
});
Route::middleware(['auth:orangtua'])->group(function () {
    Route::get('/orangtua/dashboard', [OrangtuaController::class, 'dashboard']);
    Route::get('/orangtua/navbar', [OrangtuaController::class, 'navbarOrangtua']);
});

Route::get('/guru/login', [GuruController::class, 'showLoginForm']);
Route::post('/guru/login', [GuruController::class, 'login']);
Route::post('/guru/logout', [GuruController::class, 'logout']);




// DATA ORANG TUA 
Route::get('/orangtua', [OrangtuaController::class, 'showOrangtua'])->name('showorangtua');
Route::get('/regisOrangtua', [OrangtuaController::class, 'regisOrangtua'])->name('registerOrtu');
Route::post('/registerOrangtua/aksi', [OrangtuaController::class, 'regisAksi']);
Route::get('/orangtua/cari', [OrangtuaController::class, 'orangtuaCari']);
Route::get('/orangtua/view/{id}', [OrangtuaController::class, 'viewData']);
Route::get('/orangtua/edit/{id}', [OrangtuaController::class, 'editData']);
Route::post('/orangtua/update/{id}', [OrangtuaController::class, 'updateData']);
Route::get('/orangtua/hapus/{id}', [OrangtuaController::class, 'destroyOrangtua']);

Route::get('/welcome2', [ProfileController::class, 'welcome2']);



// DATA SISWA 
Route::get('/siswa/register/{id}', [SiswaController::class, 'RegisterSiswa']);
Route::post('/siswa/registerAksi', [SiswaController::class, 'regisaksi']);


// DATA AKADEMIK SISWA 
Route::get('/dataakademik', [DataAkademikPaudController::class, 'showData']);
Route::get('/dataakademik/create', [DataAkademikPaudController::class, 'create']);
Route::post('/dataakademik/create/aksi', [DataAkademikPaudController::class, 'store']);
Route::get('/data/keseluruhan/{id}', [DataAkademikPaudController::class, 'keseluruhanData']);
Route::get('/export-data/{id}', [ExportRaportSiswa::class, 'exportDataAkademik']);
Route::get('/data/edit/{id}', [DataAkademikPaudController::class, 'edit']);
Route::post('/data/update/{id}', [DataAkademikPaudController::class, 'updateData']);


// S_orangtua

Route::get('/loginOrangtua', [OrangtuaController::class, 'Login'])->name('loginOrangtua');
Route::post('/loginAksi', [OrangtuaController::class, 'LoginAksi']);
Route::get('/orangtua/rekapBelajar', [OrangtuaController::class, 'rekapPendidikan']);
Route::post('/orangtua/logout', [OrangtuaController::class, 'logout']);
Route::get('/orangtua/profile', [OrangtuaController::class, 'profile']);
Route::get('/absensi', [OrangtuaController::class, 'showAbsensi']);
Route::get('/absensi/showForm', [OrangtuaController::class, 'showFormAbsensi']);
Route::post('/absensi/aksi', [OrangtuaController::class, 'createAbsensi']);

// Route::get('/orangtua/dashboard', [OrangtuaController::class, 'dashboard']);


// Catatan Perkembangan Anak 
Route::get('/catatanperkembangananaka', [CatatanPerkembanganAnakController::class, 'indexCatatanPerkembangan']);
Route::post('/aksi/addCatatanPerkembangan', [CatatanPerkembanganAnakController::class, 'storeCatatanPerkembangan']);
Route::get('/showForm/CatatanPerkembangan', [CatatanPerkembanganAnakController::class, 'showFormData']);

require __DIR__.'/pembayaran.php';

use App\Http\Controllers\PembayaranController;

Route::middleware(['auth'])->group(function () {
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
});
