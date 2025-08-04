<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use App\Models\Orangtua;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function RegisterSiswa($id)
    {

        $orangtua = Orangtua::findOrFail($id);
        $siswa = Siswa::where('orangtua_id', $id)->first();

        if ($siswa) {
            return redirect('/orangtua')->with('success', 'Orangtua wali sudah mempunyai peserta didik');
        }


        return view('siswa.Register', compact('orangtua'));
    }

    public function regisaksi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nis' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'string', 'max:255'],
            'usia' => ['required', 'string', 'max:255'],
            'jenkel' => ['required', 'string', 'max:255'],
            'foto' => 'required|mimes:jpeg,jpg,png|max:2048',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/siswa', $foto->hashName());

        Siswa::insert([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenkel,
            'foto' => $foto->hashName(),
            'orangtua_id' => $request->orangtua_id,
        ]);

        return redirect('/orangtua')->with('success', 'Data Siswa Telah disimpan');
    }

    public function index()
    {
        // Hitung total pendaftar
        $totalPendaftar = Pendaftaran::count();

        // Hitung berkas yang lengkap
        $berkasLengkap = Pendaftaran::whereNotNull('dokumen_ijazah')
            ->where('dokumen_ijazah', '!=', '')
            ->whereNotNull('dokumen_kk')
            ->where('dokumen_kk', '!=', '')
            ->whereNotNull('dokumen_raport')
            ->where('dokumen_raport', '!=', '')
            ->count();
        // Hitung jumlah pembayaran
        $jumlahPembayaran = Pembayaran::count();

        // Hitung jumlah pendaftar yang sudah diverifikasi
        $diverifikasi = Pendaftaran::where('status', 'diterima')->count();

        // Hitung jumlah kunjungan halaman menggunakan session
        $kunjungan = session()->get('kunjungan_dashboard', 0);
        session(['kunjungan_dashboard' => $kunjungan + 1]);

        return view('siswa.dashboard', compact(
            'totalPendaftar',
            'berkasLengkap',
            'diverifikasi',
            'jumlahPembayaran',
            'kunjungan'
        ));
    }

    public function getDataSiswa(Request $request)
    {
        $query = User::where('role', 'siswa');

        if ($request->has('query') && $request->query != '') {
            $search = $request->query('query');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }

        $siswaUsers = $query->get();

        return view('dataSiswa', compact('siswaUsers'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('siswa.profile', compact('user'));
    }

    public function formUbahPassword()
    {
        return view('siswa.ubah-password');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
