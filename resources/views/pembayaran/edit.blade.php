@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <h3>Edit Data Pembayaran</h3>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/updatePembayaran', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="total_bayar" class="form-label">Total Bayar</label>
                <input type="number" class="form-control" name="total_bayar"
                    value="{{ old('total_bayar', $pembayaran->total_bayar) }}" required>
            </div>

            <!-- Digunakan Untuk (readonly) -->
            <div class="mb-3">
                <label for="digunakan_untuk" class="form-label">Digunakan Untuk</label>
                <input type="text" class="form-control" name="digunakan_untuk"
                    value="{{ old('digunakan_untuk', $pembayaran->digunakan_untuk) }}" readonly>
            </div>

            <!-- Tanggal Bayar (default ke hari ini jika kosong) -->
            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" class="form-control"
                    value="{{ old('tanggal_bayar', $tanggalBayar) }}">
            </div>


            <div class="mb-3">
                <label for="bukti_bayar" class="form-label">Bukti Bayar</label>
                @if ($pembayaran->bukti_pembayaran)
                    <p><a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">Lihat File Saat
                            Ini</a>
                    </p>
                @endif
                <input type="file" class="form-control" name="bukti_bayar">
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
