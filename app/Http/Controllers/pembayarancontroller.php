<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;

class PembayaranController extends Controller
{

    public function create()
    {
        $user = Auth::user();

        // Cek apakah user sudah pernah melakukan pembayaran
        $pembayaran = Pembayaran::where('user_id', $user->id)->first();

        if ($pembayaran) {
            return redirect()->back()->with('error', 'Anda Sudah Melakukan Pembayaran. Status: ' . $pembayaran->status);
        }

        return view('pembayaran.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'total_dibayarkan' => 'required|numeric',
            'digunakan_untuk' => 'required|string',
        ]);

        $bukti_bayar = $request->file('bukti_pembayaran')->store('public/img/bukti');


        // Simpan ke database
        Pembayaran::create([
            'user_id' => Auth::id(),
            'bukti_pembayaran' => basename($bukti_bayar),
            'total_bayar' => $request->total_dibayarkan,
            'digunakan_untuk' => $request->digunakan_untuk,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dan file disimpan terenkripsi di public.');
    }

    public function getPembayaranSiswa()
    {
        $pembayarans = Pembayaran::where('user_id', Auth::id())->get();

        return view('pembayaran.index', compact('pembayarans'));
    }

    public function getPembayaranAdmin(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Ambil semua pembayaran sesuai tahun dan load user serta pendaftaran terkait
        $pembayaran = Pembayaran::with(['user', 'pendaftaran'])
            ->whereYear('created_at', $tahun)
            ->get();

        return view('pembayaran.pembayaranAdmin', compact('pembayaran', 'tahun'));
    }

    public function updateStatusPembayaran(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:pembayarans,id',
                'status' => 'required|in:menunggu persetujuan,diterima,ditolak',
                'alasan' => 'nullable|string|max:255',
            ]);

            $pendaftaran = Pembayaran::find($request->id);
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

    public function updatePembayaran(Request $request, $id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);

            $request->validate([
                'total_bayar' => 'required|numeric',
                'digunakan_untuk' => 'required|string',
                'tanggal_bayar' => 'required|date',
                'bukti_bayar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20048',
            ]);

            if ($request->hasFile('bukti_bayar')) {
                // Hapus file lama jika ada
                if ($pembayaran->bukti_pembayaran && file_exists(public_path('img/bukti/' . $pembayaran->bukti_pembayaran))) {
                    unlink(public_path('img/bukti/' . $pembayaran->bukti_pembayaran));
                }

                $file = $request->file('bukti_bayar');
                $namaFileBaru = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/bukti'), $namaFileBaru); // simpan ke public/img/bukti

                $pembayaran->bukti_pembayaran = $namaFileBaru;
            }

            // Update data lainnya
            $pembayaran->total_bayar = $request->total_bayar;
            $pembayaran->digunakan_untuk = $request->digunakan_untuk;
            $pembayaran->tanggal_bayar = $request->tanggal_bayar;
            $pembayaran->save();

            return redirect()->route('pembayaran.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }



    public function editPembayaran($id)
    {
        $tanggalBayar = now()->format('Y-m-d');
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran', 'tanggalBayar'));
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus file bukti pembayaran jika ada
        if ($pembayaran->bukti_pembayaran && Storage::exists('public/img/bukti/' . $pembayaran->bukti_pembayaran)) {
            Storage::delete('public/img/bukti/' . $pembayaran->bukti_pembayaran);
        }

        // Hapus data dari database
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
