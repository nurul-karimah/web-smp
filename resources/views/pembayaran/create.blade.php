@extends('layouts.app')
@section('content')
<h2>Tambah Tagihan Pembayaran</h2>

<form action="{{ route('pembayaran.store') }}" method="POST">
    @csrf
    <label for="user_id">Pilih Siswa:</label>
    <select name="user_id" required>
        @foreach($siswa as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
    </select><br><br>

    <label>Jumlah Tagihan:</label>
    <input type="number" name="jumlah_tagihan" required><br><br>

    <label>Tanggal Tagihan:</label>
    <input type="date" name="tanggal_tagihan" required><br><br>

    <button type="submit">Simpan Tagihan</button>
</form>
@endsection
