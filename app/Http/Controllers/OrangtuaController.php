<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Orangtua;
use App\Models\Siswa;
use App\Models\DataAkademikPaud;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Pembayaran;



class OrangtuaController extends Controller
{
    public function indexSiswa()
{
    $orangtua = Auth::guard('orangtua')->user();

    if (!$orangtua) {
        return redirect('/')->with('error', 'Sesi tidak ditemukan');
    }

    $siswa = Siswa::where('orangtua_id', $orangtua->id)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan');
    }

    $tagihan = Pembayaran::where('siswa_id', $siswa->id)->get();

    return view('S_orangtua.pembayaranSiswa', compact('tagihan', 'orangtua', 'siswa'));
}

    //
    public function showOrangtua()
    {
        $orangtua = Orangtua::all();

        return view('dataOrangtua', compact('orangtua'));
    }

    public function regisOrangtua()
    {


        return view('orangtua.register');
    }

    public function regisAksi(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:orangtua'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nomor_telepon' => ['required', 'string', 'max:50'],
            'foto' => 'required|mimes:jpeg,jpg,png|max:2048',
            'jenkel' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/orangtua', $foto->hashName());

        Orangtua::insert([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'foto' => $foto->hashName(),
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
        ]);

        return redirect('/orangtua')->with('success', 'Data Orang Tua Telah ditambahkan');
    }

    public function orangtuaCari(Request $request)
    {

        $query = $request->input('query');
        $orangtua = Orangtua::where('nama', 'LIKE', "%$query%")
            ->orWhere('nik', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->orWhere('nomor_telepon', 'LIKE', "$query")
            ->orWhere('jenkel', 'LIKE', "%$query%")
            ->orWhere('alamat', 'LIKE', "%$query%")
            ->get();

        return view('dataOrangtua', compact('orangtua'))->with('sukses', 'Hasil Pencarian');
    }

    public function viewData($id)
    {
        $orangtua = Orangtua::findOrFail($id);

        $orangtua = orangtua::where('orangtua_id', $id)->get();



        return view('orangtua.viewData', compact('orangtua', 'siswa'));
    }

    public function editData($id)
    {
        $orangtua = Orangtua::findOrFail($id);

        return view('orangtua.editData', compact('orangtua'));
    }

    public function updateData(Request $request, $id)
    {

        $orangtua = Orangtua::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'nomor_telepon' => ['required', 'string', 'max:255'],
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'jenkel' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('foto')) {
            // Hapus Foto lama jika ada 
            if ($orangtua->foto) {
                Storage::delete('public/orangtua/' . $orangtua->foto);
            }

            // simpan foto baru 
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/orangtua');
            $fotoName = basename($fotoPath);
        } else {
            $fotoName = $orangtua->foto; // pertahankan foto lama jika tidak ada foto baru 
        }

        $orangtua->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $orangtua->password,
            'nomor_telepon' => $request->nomor_telepon,
            'foto' => $fotoName,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
        ]);

        return redirect('/orangtua')->with('success', 'Data Orangtua Telah diupdate');
    }


    public function destroyOrangtua($id)
    {
        $orangtua = Orangtua::findOrFail($id);

        $siswa = Siswa::where('orangtua_id', $id)->get();

        if ($orangtua->foto) {
            Storage::delete('public/orangtua/' . $orangtua->foto);
        }

        foreach ($siswa as $s) {
            if ($s->foto) {
                Storage::delete('public/siswa/' . $s->foto);
            }
            $s->delete();
        }

        $orangtua->delete();


        return redirect('/orangtua')->with('success', 'Data orangtua dan siswanya sudah dihapus');
    }



    // INI DATA AUTH ORANG TUA 

    public function Login()
    {
        return view('S_orangtua.login');
    }

 public function LoginAksi(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::guard('orangtua')->attempt($credentials)) {
        return redirect('/pembayaran-siswa')->with('success', 'Login Berhasil');
    } else {
        return redirect()->back()->with('error', 'Email Atau Password salah');
    }
}


    public function dashboard()
    {
        $orangtua = Auth::guard('orangtua')->user();

        if (!$orangtua) {
            return redirect('/')->with('error', 'Sesi tidak ditemukan');
        }
        // dd($orangtua); // Tambahkan ini untuk debugging


        return view('S_orangtua.dashboard', compact('orangtua'));
    }

    public function navbarOrangtua()
    {
        $orangtua = Auth::guard('orangtua')->user();
        if (!$orangtua) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }
        return view('layouts.orangtua', compact('orangtua'));
    }


    public function rekapPendidikan(Request $request)
    {

        $orangtua = Auth::guard('orangtua')->user();
        if (!$orangtua) {
            return redirect('/')->with('error', 'fitur ini membutuhkan sesi');
        }

        $orangtua_id = $orangtua->id;

        $siswa = Siswa::where('orangtua_id', $orangtua_id)->first();
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan');
        }

        // ambil semester yang dipilih 
        $semester = $request->get('semester', 1);
        //ambil tahun ajaran yang dipilih, jika tidak ada yang dipilih gunakan default atau tahun ajaran saat ini
        $tahun_ajaran = $request->get('tahun_ajaran', DataAkademikPaud::select('tahun_ajaran')->first()->tahun_ajaran);




        $data = DataAkademikPaud::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran', $tahun_ajaran)
            ->where('semester', $semester)
            ->with('siswa')
            ->get();

        if (!$data) {
            return view('S_orangtua.rekapPendidikan')->with('error', 'Belum Registrasi Siswa');
        }

        $tahunAjaranList = DataAkademikPaud::select('tahun_ajaran')->distinct()->get();
        return view('S_orangtua.rekapPendidikan', compact('data', 'orangtua', 'tahun_ajaran', 'tahunAjaranList'));
    }

    public function logout()
    {
        $guru = Auth::guard('orangtua')->user();

        if (!$guru) {
            return redirect('/')->with('error', 'Tidak ada sesi Untuk logout');
        }

        Auth::guard('orangtua')->logout();

        return redirect('/')->with('success', 'Anda Telah Logout');
    }


    public function Profile()
    {
        $orangtua = Auth::guard('orangtua')->user();

        if (!$orangtua) {
            return redirect('/')->with('error', 'Fitur ini membutuhkan sesi');
        }
        $siswa = Siswa::where('orangtua_id', $orangtua->id)->with('orangtua')->first();
        $data = DataAkademikPaud::where('siswa_id', $siswa->id)->first();



        return view('S_orangtua.profile', compact('siswa', 'orangtua', 'data'));
    }

    public function showAbsensi()
    {
        $orangtua = Auth::guard('orangtua')->user();
        $siswa = Siswa::where('orangtua_id', $orangtua->id)->first();

        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->with('siswa')
            ->get();

        foreach ($absensi as $data) {
            if ($data->lokasi) {
                // Ambil lokasi sebagai POINT dan ubah ke format WKT (Well-Known Text)
                $lokasi = DB::selectOne("SELECT ST_AsText(lokasi) AS lokasi FROM absensi WHERE id = ?", [$data->id]);

                // Parsing lokasi POINT ke format lat, lng
                if ($lokasi && isset($lokasi->lokasi)) {
                    preg_match('/POINT\(([-0-9\.]+) ([-0-9\.]+)\)/', $lokasi->lokasi, $matches);
                    if (count($matches) == 3) {
                        $latitude = $matches[2];
                        $longitude = $matches[1];
                        // Buat URL Google Maps
                        $data->maps_url = "https://www.google.com/maps?q={$latitude},{$longitude}";
                    }
                }
            }
        }

        return view('S_orangtua.absensi', compact('orangtua', 'absensi'));
    }

    public function showFormAbsensi()
    {
        $orangtua = Auth::guard('orangtua')->user();

        if (!$orangtua) {
            return redirect('/')->with('error', 'Sesi Tidak ditemukan');
        }

        $siswa = Siswa::where('orangtua_id', $orangtua->id)->first();

        $data = DataAkademikPaud::where('siswa_id', $siswa->id)
            ->with('siswa')
            ->first();

        if (!$data) {
            return redirect('/absensi')->with('error', 'siswa belum masuk kedalam data akademik');
        }

        $today = now()->format('Y-m-d');

        $absenHariIni = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', $today)
            ->first();

        if ($absenHariIni) {
            return redirect('/absensi')->with('error', 'Absensi Untuk Hari Ini Sudah Dilakukan');
        }


        return view('S_orangtua.formAbsen', compact('data'));
    }

    public function createAbsensi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string', 'max:255'],
            'gambar' => ['required'], // Validasi untuk base64 string
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menangani gambar base64 dan menyimpannya
        $gambarBase64 = $request->gambar;

        // Memastikan base64 string valid
        if (strpos($gambarBase64, 'data:image/') === 0) {
            // Mengambil jenis file gambar (jpg/png)
            preg_match('/^data:image\/(\w+);base64,/', $gambarBase64, $type);
            $fileType = $type[1]; // Tipe file (jpg/png)

            // Menghapus metadata base64
            $gambarBase64 = str_replace('data:image/' . $fileType . ';base64,', '', $gambarBase64);
            $gambarBase64 = str_replace(' ', '+', $gambarBase64);

            // Nama file acak
            $imageName = Str::random(10) . '.' . $fileType;

            // Menyimpan gambar di folder public/storage/absensi
            File::put(public_path('storage/absensi') . '/' . $imageName, base64_decode($gambarBase64));
        } else {
            return redirect()->back()->with('error', 'Format gambar tidak valid.')->withInput();
        }

        // Menyimpan lokasi
        $lokasi = "POINT(" . $request->longitude . " " . $request->latitude . ")";
        // Menyimpan data absensi ke database
        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'semester' => $request->semester,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => $imageName, // Nama file gambar yang sudah disimpan
            'lokasi' => DB::raw("ST_GeomFromText('{$lokasi}')"),
        ]);

        return redirect('/absensi')->with('success', 'Absensi Berhasil');
    }

 public function pembayaransiswa()
{
    $orangtua = Auth::guard('orangtua')->user();

    if (!$orangtua) {
        return redirect('/')->with('error', 'Sesi tidak ditemukan');
    }

    $siswa = Siswa::where('orangtua_id', $orangtua->id)->get();

    if ($siswa->isEmpty()) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan untuk orangtua ini');
    }

    $riwayat = Pembayaran::whereIn('siswa_id', $siswa->pluck('id'))->get();
    $statusAktif = Pembayaran::whereIn('siswa_id', $siswa->pluck('id'))
        ->where('status_pembayaran', 'BELUM LUNAS')
        ->first();

    return view('S_orangtua.pembayaranSiswa', compact('orangtua', 'riwayat', 'statusAktif'));
}

}