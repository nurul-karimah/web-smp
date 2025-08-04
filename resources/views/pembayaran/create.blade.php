@extends('layouts.sidebar') <!-- Ganti jika layout kamu berbeda -->

@section('content')
    <div class="container">
        <h2>Form Pembayaran</h2>



        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                <input type="file" class="form-control" name="bukti_pembayaran" required>
                @error('bukti_pembayaran')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="total_dibayarkan" class="form-label">Total Dibayarkan</label>
                <input type="number" class="form-control" name="total_dibayarkan" required>
                @error('total_dibayarkan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="digunakan_untuk" class="form-label">Digunakan Untuk</label>
                <input type="text" class="form-control" name="digunakan_untuk" value="ppdb" required>
                @error('digunakan_untuk')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection
