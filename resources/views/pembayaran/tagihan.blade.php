@extends('layouts.app')
@section('content')
<h2>Daftar Tagihan</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Nama Siswa</th>
        <th>Jumlah Tagihan</th>
        <th>Tanggal Tagihan</th>
    </tr>
    @foreach($tagihan as $t)
    <tr>
        <td>{{ $t->user->name ?? 'N/A' }}</td>
        <td>Rp {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}</td>
        <td>{{ $t->tanggal_tagihan }}</td>
    </tr>
    @endforeach
</table>
@endsection
