<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use App\Models\Orangtua;

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
}
