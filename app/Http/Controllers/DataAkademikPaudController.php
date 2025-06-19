<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\DataAkademikPaud;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DataAkademikPaudController extends Controller
{

    public function showData(Request $request)
    {

        $gurus = Auth::guard('guru')->user();





        if (!$gurus) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }

        // ambil semster yang dipilih, jika tidak ada yang dipilih ambil semster 1
        $semester = $request->get('semester', 1);
        // ambil tahun ajaran yang dipilih, jika tidak ada yang dipilih gunakan default atau tahun ajaran saat ini
        $tahun_ajaran = $request->get('tahun_ajaran', DataAkademikPaud::select('tahun_ajaran')->first()->tahun_ajaran);

        $data = DataAkademikPaud::where('semester', $semester)
            ->where('tahun_ajaran', $tahun_ajaran)
            ->with('siswa')
            ->get();


        $tahunAjaranList = DataAkademikPaud::select('tahun_ajaran')->distinct()->get();
        return view('data-akademik.data', compact('data', 'semester', 'tahun_ajaran', 'tahunAjaranList'));
    }
    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();
        $gurus = Auth::guard('guru')->user();



        if (!$gurus) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }

        return view('data-akademik.create', compact('siswas', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'guru_id' => 'required|exists:guru,id',
            'perkembangan_fisik' => 'nullable|string',
            'perkembangan_kognitif' => 'nullable|string',
            'perkembangan_sosial_emosional' => 'nullable|string',
            'perkembangan_bahasa' => 'nullable|string',
            'kegiatan_belajar' => 'nullable|string',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'nilai_fisik' => 'required|integer|max:255',
            'nilai_kognitif' => 'required|integer|max:255',
            'nilai_sosial' => 'required|integer|max:255',
            'nilai_bahasa' => 'required|integer|max:255',
            'nilai_belajar' => 'required|integer|max:255',

        ]);

        // Cek apakah data akademik untuk siswa ini sudah ada untuk kombinasi siswa_id, semester, dan tahun_ajaran
        $existData = DataAkademikPaud::where('siswa_id', $request->siswa_id)
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->first();
        if ($existData) {
            // jika data sudah ada , kembali dengan pesan error

            return redirect('/dataakademik/create')->with('error', 'Data Akadmik untuk siswa ini sudah ada');
        }

        // hitung nilai akhir berdasarkan bobot presentase

        $nilaiAkhir = (

            ($request->nilai_fisik * 0.10) +
            ($request->nilai_kognitif * 0.20) +
            ($request->nilai_sosial * 0.20) +
            ($request->nilai_bahasa * 0.20) +
            ($request->nilai_belajar * 0.30)

        );

        $grade = '';
        // tentukan grade berdasarkan nilai akhir

        if ($nilaiAkhir >= 80) {
            $grade = 'A';
        } elseif ($nilaiAkhir >= 70) {
            $grade = 'B';
        } elseif ($nilaiAkhir >= 60) {
            $grade = 'C';
        } elseif ($nilaiAkhir >= 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        $nilaiAkhir = round($nilaiAkhir);

        $dataAkademik = DataAkademikPaud::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'perkembangan_fisik' => $request->perkembangan_fisik,
            'perkembangan_kognitif' => $request->perkembangan_kognitif,
            'perkembangan_sosial_emosional' => $request->perkembangan_sosial_emosional,
            'perkembangan_bahasa' => $request->perkembangan_bahasa,
            'kegiatan_belajar' => $request->kegiatan_belajar,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_fisik' => $request->nilai_fisik,
            'nilai_kognitif' => $request->nilai_kognitif,
            'nilai_sosial' => $request->nilai_sosial,
            'nilai_bahasa' => $request->nilai_bahasa,
            'nilai_belajar' => $request->nilai_belajar,
            'jumlah' => $nilaiAkhir,
            'grade' => $grade
        ]);


        if ($dataAkademik) {
            return redirect('/dataakademik')->with('success', 'Data akademik berhasil ditambahkan.');
        } else {

            return redirect('/dataakademik/create')->with('error', 'Gagal menyimpan data akademik.');
        }
    }

    public function keseluruhanData($id)
    {
        $gurus = Auth::guard('guru')->user();


        if (!$gurus) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }
        $data = DataAkademikPaud::with('siswa', 'guru')
            ->where('id', $id)
            ->first();

        return view('data-akademik.keseluruhan', compact('data'));
    }


    public function edit($id)
    {
        $gurus = Auth::guard('guru')->user();

        if (!$gurus) {
            return redirect('/')->with('error', 'sesi tidak ada');
        }
        $data = DataAkademikPaud::with('siswa')
            ->where('id', $id)
            ->first();


        $siswas = Siswa::orderBy('nama')->get();


        return view('data-akademik.edit_data', compact('data', 'siswas', 'gurus'));
    }


    public function updateData(Request $request, $id)
    {
        $data = DataAkademikPaud::findOrFail($id);

        $data2 = DataAkademikPaud::with('siswa')
            ->where('id', $id)
            ->first();

        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswa,id',
            'guru_id' => 'required|exists:guru,id',
            'perkembangan_fisik' => 'nullable|string',
            'perkembangan_kognitif' => 'nullable|string',
            'perkembangan_sosial_emosional' => 'nullable|string',
            'perkembangan_bahasa' => 'nullable|string',
            'kegiatan_belajar' => 'nullable|string',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'nilai_fisik' => 'required|integer|max:255',
            'nilai_kognitif' => 'required|integer|max:255',
            'nilai_sosial' => 'required|integer|max:255',
            'nilai_bahasa' => 'required|integer|max:255',
            'nilai_belajar' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nilaiAkhir = (

            ($request->nilai_fisik * 0.10) +
            ($request->nilai_kognitif * 0.20) +
            ($request->nilai_sosial * 0.20) +
            ($request->nilai_bahasa * 0.20) +
            ($request->nilai_belajar * 0.30)

        );

        $grade = '';
        // tentukan grade berdasarkan nilai akhir

        if ($nilaiAkhir >= 80) {
            $grade = 'A';
        } elseif ($nilaiAkhir >= 70) {
            $grade = 'B';
        } elseif ($nilaiAkhir >= 60) {
            $grade = 'C';
        } elseif ($nilaiAkhir >= 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        $nilaiAkhir = round($nilaiAkhir);


        $data->update([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'perkembangan_fisik' => $request->perkembangan_fisik,
            'perkembangan_kognitif' => $request->perkembangan_kognitif,
            'perkembangan_sosial_emosional' => $request->perkembangan_sosial_emosional,
            'perkembangan_bahasa' => $request->perkembangan_bahasa,
            'kegiatan_belajar' => $request->kegiatan_belajar,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_fisik' => $request->nilai_fisik,
            'nilai_kognitif' => $request->nilai_kognitif,
            'nilai_sosial' => $request->nilai_sosial,
            'nilai_bahasa' => $request->nilai_bahasa,
            'nilai_belajar' => $request->nilai_belajar,
            'jumlah' => $nilaiAkhir,
            'grade' => $grade,
        ]);

        return redirect('/dataakademik')->with('success', 'Data Akademik Telah Diupdate untuk ' . $data2->siswa->nama);
    }
}
