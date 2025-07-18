<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Orangtua melihat halaman pembayaran
    public function pembayaranSiswa()
    {
        $orangtua = Auth::guard('orangtua')->user();

        if (!$orangtua) {
            return redirect('/')->with('error', 'Sesi tidak ditemukan');
        }

        return view('pembayaran.pembayaranSiswa', compact('orangtua'));
    }

    // Admin melihat semua tagihan
    public function lihatTagihan()
    {
        $tagihan = Pembayaran::with('siswa')->get();
        return view('pembayaran.index-siswa ', compact('tagihan'));
    }

    // Siswa melihat riwayat pembayaran (jika ada fitur untuk siswa login)
    public function lihatPembayaran()
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())->get();
        return view('pembayaran.index-admin', compact('pembayaran'));
    }

    // Admin melihat semua pembayaran
    public function indexSiswa()
    {
        $tagihan = Pembayaran::with('siswa')->get();
        return view('pembayaran.index-siswa', compact('tagihan'));
    }

    // Upload bukti pembayaran oleh orangtua
    public function upload(Request $request)
    {
        $request->validate([
            'jumlah_tagihan' => 'required|numeric',
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $orangtua = Auth::guard('orangtua')->user();
        $siswa = Siswa::where('orangtua_id', $orangtua->id)->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'siswa_id' => $siswa->id,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'tanggal_tagihan' => now(),
            'status_pembayaran' => 'belum lunas',
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->route('orangtua.pembayaran')->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    // Admin mengonfirmasi pembayaran
    public function konfirmasiPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pembayaran = 'lunas';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    // Orangtua atau siswa melihat status pembayaran
    public function statusPembayaran()
    {
        $status = Pembayaran::where('user_id', Auth::id())->get();
        return view('pembayaran.status', compact('status'));
    }

    // Admin form tambah tagihan
    public function create()
    {
        $siswa = Siswa::all();
        return view('pembayaran.create', compact('siswa'));
    }

    // Admin simpan tagihan
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'jumlah_tagihan' => 'required|numeric',
            'tanggal_tagihan' => 'required|date',
        ]);

        Pembayaran::create([
            'siswa_id' => $request->siswa_id,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'tanggal_tagihan' => $request->tanggal_tagihan,
            'status_pembayaran' => 'belum lunas',
        ]);

        return redirect()->route('pembayaran.siswa')->with('success', 'Tagihan berhasil ditambahkan');
    }

    // Admin edit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::with('siswa')->findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    // Admin update status pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:lunas,belum lunas',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->save();

        return redirect()->route('pembayaran.siswa')->with('success', 'Status pembayaran berhasil diperbarui');
    }

    // Admin melihat semua pembayaran
    public function adminLihatSemua()
    {
        $pembayaran = Pembayaran::with('siswa')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }
}
