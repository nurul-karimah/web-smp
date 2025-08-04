<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftaran;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    private function generateNoPendaftaran()
    {
        $today = Carbon::now()->format('Ymd');
        $countToday = Pendaftaran::whereDate('created_at', \Carbon\Carbon::today())->count() + 1;
        $noUrut = str_pad($countToday, 3, '0', STR_PAD_LEFT);
        return $today . $noUrut;
    }

    public function create()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Cek apakah user ini sudah pernah daftar
        $cekPendaftaran = Pendaftaran::where('user_id', $userId)->first();

        if ($cekPendaftaran) {
            return redirect()->route('dataPendaftaranSiswa')->with('error', 'Data pendaftaran Anda sudah ada di database.');
        }

        // Kalau belum pernah daftar, lanjutkan proses
        $noPendaftaran = $this->generateNoPendaftaran();
        return view('pendaftaran.create', compact('noPendaftaran'));
    }




    public function getPendaftaranSiswa()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        $pendaftaran = Pendaftaran::select(
            'no_pendaftaran',
            'id',
            'no_pendaftaran',
            'nisn',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'penerima_kip',
            'alamat',
            'rt',
            'rw',
            'desa',
            'kecamatan',
            'sekolah_asal',
            'dokumen_ijazah',
            'dokumen_kk',
            'dokumen_raport',
            'nilai_raport_akhir',
            'status',
            'alasan'
        )->where('user_id', $userId)->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        return view('siswa.dataPendaftaran', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nisn' => 'required|string|max:20|unique:pendaftarans,nisn',
                'nama_lengkap' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string',
                'agama' => 'required|string',
                'penerima_kip' => 'required|in:Ya,Tidak',
                'alamat' => 'required|string',
                'sekolah_asal' => 'required|string',
                'rt' => 'required|string|max:10',
                'rw' => 'required|string|max:10',
                'desa' => 'required|string|max:100',
                'kecamatan' => 'required|string|max:100',
                'dokumen_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'dokumen_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'dokumen_raport' => 'required|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'nilai_raport_akhir' => 'required|numeric|min:0|max:100',
            ]);

            $today = Carbon::now();
            $prefix = $today->format('Ymd'); // TahunBulanTanggal

            $last = Pendaftaran::whereDate('created_at', $today->toDateString())->count() + 1;
            $noPendaftaran = $prefix . str_pad($last, 3, '0', STR_PAD_LEFT);

            $ijazah = $request->file('dokumen_ijazah')->store('public/img/document');
            $kk = $request->file('dokumen_kk')->store('public/img/document');
            $raport = $request->file('dokumen_raport')->store('public/img/document');

            if (!$ijazah || !$kk || !$raport) {
                return redirect()->back()->with('error', 'Gagal mengunggah dokumen.');
            }


            Pendaftaran::create([
                'user_id' => Auth::id(),
                'no_pendaftaran' => $noPendaftaran,
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'penerima_kip' => $request->penerima_kip,
                'alamat' => $request->alamat,
                'sekolah_asal' => $request->sekolah_asal,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'dokumen_ijazah' => basename($ijazah),
                'dokumen_kk' => basename($kk),
                'dokumen_raport' => basename($raport),
                'nilai_raport_akhir' => $request->nilai_raport_akhir,
                'status' => 'menunggu persetujuan',
                'alasan' => null,
            ]);


            return redirect()->route('dataPendaftaranSiswa')->with('success', 'Pendaftaran berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Pendaftaran gagal, silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:pendaftarans,id',
                'status' => 'required|in:menunggu persetujuan,diterima,ditolak',
                'alasan' => 'nullable|string|max:255',
            ]);

            $pendaftaran = Pendaftaran::find($request->id);
            $pendaftaran->status = $request->status;

            // Simpan alasan hanya jika ditolak
            if ($request->status === 'ditolak') {
                $pendaftaran->alasan = $request->alasan;
            } else {
                $pendaftaran->alasan = null; // reset alasan kalau disetujui atau menunggu
            }

            $pendaftaran->save();

            return response()->json(['success' => 'Status berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    public function getPendaftaranAdmin(Request $request)
    {
        // Ambil tahun dari parameter query, default tahun sekarang
        $tahun = $request->input('tahun', date('Y'));
        $query = $request->input('query');

        // Query awal berdasarkan tahun
        $pendaftarans = Pendaftaran::whereYear('created_at', $tahun);

        // Jika ada query pencarian, filter berdasarkan kolom yang diminta
        if (!empty($query)) {
            $pendaftarans->where(function ($q) use ($query) {
                $q->where('nama_lengkap', 'like', '%' . $query . '%')
                    ->orWhere('no_pendaftaran', 'like', '%' . $query . '%')
                    ->orWhere('alamat', 'like', '%' . $query . '%')
                    ->orWhere('tempat_lahir', 'like', '%' . $query . '%');
            });
        }

        $pendaftarans = $pendaftarans->get();

        return view('dataPendaftaranSiswa', compact('pendaftarans', 'tahun'));
    }



    public function updatePendaftaran(Request $request, $id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);

            $request->validate([
                'nisn' => 'required|string|max:20|unique:pendaftarans,nisn,' . $id,
                'nama_lengkap' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string',
                'agama' => 'required|string',
                'penerima_kip' => 'required|in:Ya,Tidak',
                'alamat' => 'required|string',
                'sekolah_asal' => 'required|string',
                'rt' => 'required|string|max:10',
                'rw' => 'required|string|max:10',
                'desa' => 'required|string|max:100',
                'kecamatan' => 'required|string|max:100',
                'dokumen_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'dokumen_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'dokumen_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20048',
                'nilai_raport_akhir' => 'required|numeric|min:0|max:100',
            ]);

            // Update file jika diupload baru
            if ($request->hasFile('dokumen_ijazah')) {
                Storage::delete('public/img/document/' . $pendaftaran->dokumen_ijazah);
                $ijazah = $request->file('dokumen_ijazah')->store('public/img/document');
                $pendaftaran->dokumen_ijazah = basename($ijazah);
            }

            if ($request->hasFile('dokumen_kk')) {
                Storage::delete('public/img/document/' . $pendaftaran->dokumen_kk);
                $kk = $request->file('dokumen_kk')->store('public/img/document');
                $pendaftaran->dokumen_kk = basename($kk);
            }

            if ($request->hasFile('dokumen_raport')) {
                Storage::delete('public/img/document/' . $pendaftaran->dokumen_raport);
                $raport = $request->file('dokumen_raport')->store('public/img/document');
                $pendaftaran->dokumen_raport = basename($raport);
            }

            // Update data selain status & alasan
            $pendaftaran->update([
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'penerima_kip' => $request->penerima_kip,
                'alamat' => $request->alamat,
                'sekolah_asal' => $request->sekolah_asal,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'nilai_raport_akhir' => $request->nilai_raport_akhir,
            ]);

            return redirect()->route('dataPendaftaranSiswa')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.edit', compact('pendaftaran'));
    }


    public function getPendaftaranSaya()
    {
        $userId = Auth::id(); // Ambil ID user yang login
        $pendaftaran = Pendaftaran::where('user_id', $userId)->first();

        if ($pendaftaran) {
            return response()->json([
                'success' => true,
                'data' => $pendaftaran
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftaran tidak ditemukan.'
            ], 404);
        }
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        return view('Showpendaftaran', compact('pendaftaran'));
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Jika ada file dokumen yang perlu dihapus dari storage, bisa ditambahkan di sini

        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function statusPendaftaran()
    {
        $userId = Auth::id(); // Mendapatkan ID user yang login
        $pendaftaran = Pendaftaran::where('user_id', $userId)->first();

        return view('siswa.status-pendaftaran', compact('pendaftaran'));
    }
}
