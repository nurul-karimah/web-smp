@extends('layouts.app')
@section('content')
<h2>Riwayat Pembayaran</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Bukti</th>
        <th>Status</th>
    </tr>
    @foreach($pembayaran as $p)
    <tr>
        <td>Rp {{ number_format($p->jumlah_tagihan, 0, ',', '.') }}</td>
        <td>{{ $p->tanggal_tagihan }}</td>
        <td>
            @if($p->bukti_pembayaran)
                <img src="{{ asset('storage/' . $p->bukti_pembayaran) }}" width="100">
            @else
                Tidak ada
            @endif
        </td>
        <td>{{ $p->status_pembayaran }}</td>
    </tr>
    @endforeach
</table>
@endsection
