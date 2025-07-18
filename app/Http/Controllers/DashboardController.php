<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPendaftar = Siswa::count();
        $dataLengkap     = Siswa::where('data_lengkap', true)->count();
        $berkasLengkap   = Siswa::where('berkas_lengkap', true)->count();
        $diverifikasi    = Siswa::where('diverifikasi', true)->count();

        return view('dashboard.index', compact(
          'jumlahPendaftar',
            'dataLengkap',
            'berkasLengkap',
            'diverifikasi'
        ));
    }
}
