@extends('layouts.app')
@section('content')
<h2>Edit Status Pembayaran</h2>

<form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Siswa:</label>
    <input type="text" value="{{ $pembayaran->user->name }}" readonly><br><br>

    <label>Jumlah Tagihan:</label>
    <input type="text" value="Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}" readonly><br><br>

    <label>Status Pembayaran:</label>
    <select name="status_pembayaran" required>
        <option value="BELUM" {{ $pembayaran->status_pembayaran == 'BELUM' ? 'selected' : '' }}>BELUM</option>
        <option value="MENUNGGU" {{ $pembayaran->status_pembayaran == 'MENUNGGU' ? 'selected' : '' }}>MENUNGGU</option>
        <option value="LUNAS" {{ $pembayaran->status_pembayaran == 'LUNAS' ? 'selected' : '' }}>LUNAS</option>
    </select><br><br>

    <button type="submit">Update Status</button>
</form>
@endsection
