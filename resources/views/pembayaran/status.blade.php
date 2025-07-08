@extends('layouts.app')
@section('content')
<h2>Status Pembayaran</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>
    @foreach($status as $s)
    <tr>
        <td>Rp {{ number_format($s->jumlah_tagihan, 0, ',', '.') }}</td>
        <td>{{ $s->tanggal_tagihan }}</td>
        <td>{{ $s->status_pembayaran }}</td>
    </tr>
    @endforeach
</table>
@endsection
