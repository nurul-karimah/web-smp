<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // ✅ 1. Menampilkan semua tagihan untuk admin
    public function lihatTagihan()
    {
        $tagihan = Pembayaran::with('user')->get();
        return view('pembayaran.tagihan', compact('tagihan'));
    }

    // ✅ 2. Menampilkan riwayat pembayaran siswa yang sedang login
    public function lihatPembayaran()
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())->get();
        return view('pembayaran.riwayat', compact('pembayaran'));
    }

    // ✅ 3. Upload bukti pembayaran siswa
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'jumlah_tagihan' => 'required|numeric',
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'user_id' => Auth::id(),
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'tanggal_tagihan' => now(),
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'MENUNGGU',
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload');
    }

    // ✅ 4. Konfirmasi pembayaran oleh admin
    public function konfirmasiPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pembayaran = 'LUNAS';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    // ✅ 5. Menampilkan status pembayaran siswa yang login
    public function statusPembayaran()
    {
        $status = Pembayaran::where('user_id', Auth::id())->get();
        return view('pembayaran.status', compact('status'));
    }

    // ✅ 6. Form tambah tagihan oleh admin
    public function create()
    {
        $siswa = User::where('role', 'siswa')->get(); // Jika Anda menggunakan Spatie, pakai: User::role('siswa')->get();
        return view('pembayaran.create', compact('siswa'));
    }

    // ✅ 7. Simpan tagihan baru oleh admin
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_tagihan' => 'required|numeric',
            'tanggal_tagihan' => 'required|date',
        ]);

        Pembayaran::create([
            'user_id' => $request->user_id,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'tanggal_tagihan' => $request->tanggal_tagihan,
            'status_pembayaran' => 'BELUM',
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    // ✅ 8. Form edit status pembayaran oleh admin
    public function edit($id)
    {
        $pembayaran = Pembayaran::with('user')->findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    // ✅ 9. Update status pembayaran oleh admin
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:LUNAS,BELUM,MENUNGGU',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->save();

        return redirect()->route('pembayaran.index')->with('success', 'Status pembayaran berhasil diperbarui');
    }
}
