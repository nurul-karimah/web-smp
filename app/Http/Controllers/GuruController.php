<?php

namespace App\Http\Controllers;

use App\Models\DataAkademikPaud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Orantua;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class GuruController extends Controller
{
    public function showGuru()
    {
        $guru = Guru::all();

        return view('dataGuru', compact('guru'));
    }

    public function regisGuru()
    {
        return view('guru.register');
    }

    public function regisAksi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nip' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:guru'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tgl_lahir' => ['required', 'string', 'max:255'],
            'foto' =>  'required|mimes:jpeg,jpg,png|max:2048',
            'jenkel' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/guru', $foto->hashName());

        Guru::insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tgl_lahir' => $request->tgl_lahir,
            'foto' => $foto->hashName(),
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,

        ]);

        return redirect('/guru')->with('success', 'Data Guru telah ditambahkan');
    }

    public function editGuru($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function updateGuru(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nip' => ['required', 'string', 'max:255', 'unique:guru,nip,' . $guru->id],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:guru,email,' . $guru->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'tgl_lahir' => ['required', 'string', 'max:255'],
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'jenkel' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto) {
                Storage::delete('public/guru/' . $guru->foto);
            }

            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/guru');
            $fotoName = basename($fotoPath);
        } else {
            $fotoName = $guru->foto; // Pertahankan foto lama jika tidak ada foto baru
        }

        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $guru->password,
            'tgl_lahir' => $request->tgl_lahir,
            'foto' => $fotoName,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
        ]);

        return redirect('/guru')->with('success', 'Data Guru Telah Diperbarui');
    }

    public function destroyGuru($id)
    {
        $guru = Guru::findOrFail($id);
        // Hapus foto jika ada 
        if ($guru->foto) {
            Storage::delete('public/guru/' . $guru->foto);
        }

        // Hapus data Guru
        $guru->delete();
        return redirect('/guru')->with('success', 'Data Guru Telah dihapus');
    }


    public function dashboard()
    {
        $guru = Auth::guard('guru')->user();
        if (!$guru) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }


        $data = DataAkademikPaud::count();
        $nilaiA = DataAkademikPaud::where('grade', 'A')->count();
        $nilaiB = DataAkademikPaud::where('grade', 'B')->count();
        $nilaiC = DataAkademikPaud::where('grade', 'C')->count();
        $nilaiD = DataAkademikPaud::where('grade', 'D')->count();
        $nilaiE = DataAkademikPaud::where('grade', 'E')->count();


        return view('guru.dashboard', compact('guru', 'data', 'nilaiA', 'nilaiB', 'nilaiC', 'nilaiD', 'nilaiE'));
    }


    public function navbar()
    {
        $guru = Auth::guard('guru')->user();
        if (!$guru) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }
        return view('layouts.guru', compact('guru'));
    }

    public function showLoginForm()
    {
        return view('guru.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('guru')->attempt($credentials)) {
            return redirect()->intended('/guru/dashboard')->with('success', 'Login Berhasil');
        } else {
            return redirect()->back()->with('error', 'Email Atau Password salah');
        }
    }

    public function logout()
    {
        $guru = Auth::guard('guru')->user();
        if (!$guru) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }
        Auth::guard('guru')->logout();
        return redirect('/guru/login')->with('success', 'Logout Berhasil');
    }


    public function dataSiswa()
    {
        $guru = Auth::guard('guru')->user();
        if (!$guru) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }
        $siswa = Siswa::with('orantua')->get();



        return view('guru.datasiswa', compact('siswa'));
    }


    public function kehadiran(Request $request)
    {
        // Ambil tanggal absensi dari request
        $tanggalAbsensi = $request->input('tanggal_absensi');


        $data = siswa::all();

        // jika tanggal absensi dipilih, ambil data absesnsi sesuai tanggal
        if ($tanggalAbsensi) {
            // Ambil data absensi berdasarkan tanggal
            $absensi = Absensi::where('tanggal', $tanggalAbsensi)->get();

            $kehadiran = [];
            foreach ($data as $siswa) {
                $kehadiran[$siswa->id] = $absensi->where('siswa_id', $siswa->id);
            }

            return view('guru.kehadiran', compact('data', 'kehadiran', 'tanggalAbsensi'));
        }

        return view('guru.kehadiran', compact('data'));
    }
}
