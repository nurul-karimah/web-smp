@extends('layouts.orangtua')

@section('content')
    <h2>Daftar Tagihan Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihan as $item)
                <tr>
                    <td>{{ $item->jumlah_tagihan }}</td>
                    <td>{{ $item->tanggal_tagihan }}</td>
                    <td>{{ $item->status_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
