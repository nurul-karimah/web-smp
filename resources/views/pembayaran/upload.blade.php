@extends('layouts.app')
@section('content')
<h2>Upload Bukti Pembayaran</h2>
<form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Jumlah Tagihan:</label>
    <input type="number" name="jumlah_tagihan" required><br><br>

    <label>Upload Bukti (JPG/PNG):</label>
    <input type="file" name="bukti_pembayaran" required><br><br>

    <button type="submit">Upload</button>
</form>
@endsection
