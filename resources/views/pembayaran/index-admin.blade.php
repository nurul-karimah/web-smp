@extends('layouts.admin')

@section('content')
<h2>Daftar Pembayaran Siswa</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Jumlah Tagihan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayaran as $item)
        <tr>
            <td>{{ $item->siswa->nama ?? 'Tidak ditemukan' }}</td>
            <td>Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}</td>
            <td>{{ $item->tanggal_tagihan }}</td>
            <td>{{ strtoupper($item->status_pembayaran) }}</td>
            <td>
                @if($item->bukti_pembayaran)
                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
                @else
                    Tidak Ada
                @endif
            </td>
            <td>
                <form action="{{ route('admin.konfirmasi', $item->id) }}" method="POST">
                    @csrf
                    <select name="status_pembayaran">
                        <option value="lunas" {{ $item->status_pembayaran == 'lunas' ? 'selected' : '' }}>LUNAS</option>
                        <option value="belum lunas" {{ $item->status_pembayaran == 'belum lunas' ? 'selected' : '' }}>BELUM LUNAS</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
