<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\CatatanPerkembanganAnak;
use App\Models\Siswa;
use App\Models\DataAkademikPaud;

use Illuminate\Http\Request;

class CatatanPerkembanganAnakController extends Controller
{
    public function storeCatatanPerkembangan(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exist:siswa,id',
            'dataakademik_id' => 'required|exists:date_akademik_paud,id',
            'absensi_id' => 'required|exists:absensi,id',
            'kehadiran' => 'required|integer',
            'catatan_khusus' => 'nullable|string',
            'tanggal_pencatatan' => 'required:date',
        ]);

        $kehadiran = Absensi::where('siswa_id', $request->siswa_id)->where('status', 'Hadir')->count();

        $catatanPerkembangan = CatatanPerkembanganAnak::create([
            'siswa_id' => $request->siswa_id,
            'dataakademik_id' => $request->dataakademik_id,
            'absensi_id' => $request->absensi_id,
            'kehadiran' => $kehadiran,
            'catatan_khusus' => $request->catatan_khusus,
            'tanggal_pencatatan' => $request->tanggal_pencatatan,
            'tanggapan_orang_tua' => null,
        ]);

        if ($catatanPerkembangan) {
            return redirect('/catatanperkembangananaka')->with('success', 'Data Catatan Akademik Telah ditambahkan');
        } else {
            return redirect('/showForm/CatatanPerkembangan')->with('error', 'gagal ditambahkan');
        }
    }


    public function indexCatatanPerkembangan()
    {

        $data = CatatanPerkembanganAnak::with(['siswa', 'date_akademik_paud', 'absensi'])->get();

        return view('guru.catatanPerkembangan', compact('data'));
    }



    public function showFormData()
    {

        return view('guru.TambahData');
    }
}
