@extends('layouts.sidebar')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h3 class="mb-4">Data Pembayaran</h3>

        {{-- Tombol Buat Pembayaran --}}
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Buat Pembayaran</a>

        @if ($pembayarans->isEmpty())
            {{-- Jika Belum Ada Pembayaran --}}
            <div class="alert alert-info">Belum ada pembayaran. Berikut rincian tagihan Anda:</div>



            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Baju Batik</th>
                        <td>Rp{{ number_format(70000, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Jas Almamater</th>
                        <td>Rp{{ number_format(150000, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Seragam Olahraga</th>
                        <td>Rp{{ number_format(130000, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Rompi dan Atribut</th>
                        <td>Rp{{ number_format(100000, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><strong>Rp{{ number_format(450000, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @else
            {{-- Jika Sudah Ada Pembayaran --}}
            @if (session('success'))
                <div class="alert alert-success mt-4">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-bordered">
                <tbody>
                    @foreach ($pembayarans as $pembayaran)
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                <img src="{{ asset('/storage/img/bukti/' . $pembayaran->bukti_pembayaran) }}"
                                    alt="Bukti Pembayaran" width="150">

                            </td>
                        </tr>
                        <tr>
                            <th>Total Dibayarkan</th>
                            <td>Rp{{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Digunakan Untuk</th>
                            <td>{{ $pembayaran->digunakan_untuk }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($pembayaran->status) }}</td>
                        </tr>
                        <tr>
                            <th>Alasan</th>
                            <td>{{ $pembayaran->alasan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Tombol Update Pembayaran --}}
            @if (!$pembayarans->isEmpty())
                <a href="{{ url('/getFormUpdatePembayaran/' . $pembayarans->first()->id) }}"
                    class="btn btn-warning mb-3 ms-2">Update Pembayaran</a>
            @endif
        @endif
    </div>
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.remove();
            });
        }, 2000); // hilang dalam 4 detik
    </script>
@endsection
