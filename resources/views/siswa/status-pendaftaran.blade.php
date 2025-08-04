@extends('layouts.sidebar') {{-- Ganti sesuai layout utama kamu --}}

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h4 class="mb-4">Status Pendaftaran</h4>

            @php
                $status = $pendaftaran->status;
            @endphp

            @if ($status === 'diterima')
                <div class="text-center text-success">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill display-1 animate__animated animate__bounceIn"></i>
                    </div>
                    <h5 class="animate__animated animate__fadeIn">Pendaftaran Anda <strong>DITERIMA</strong></h5>
                    <p class="animate__animated animate__fadeInUp">Silahkan lanjutkan proses pendaftaran ulang dan
                        pembayaran.</p>
                </div>
            @elseif ($status === 'menunggu')
                <div class="text-center text-warning">
                    <div class="mb-3">
                        <i class="bi bi-hourglass-split display-1 animate__animated animate__pulse animate__infinite"></i>
                    </div>
                    <h5 class="animate__animated animate__fadeIn">Pendaftaran Anda Sedang <strong>DIPROSES</strong></h5>
                    <p class="animate__animated animate__fadeInUp">Harap menunggu konfirmasi dari admin.</p>
                </div>
            @elseif ($status === 'ditolak')
                <div class="text-center text-danger">
                    <div class="mb-3">
                        <i class="bi bi-x-circle-fill display-1 animate__animated animate__shakeX"></i>
                    </div>
                    <h5 class="animate__animated animate__fadeIn">Pendaftaran Anda <strong>DITOLAK</strong></h5>
                    <p class="animate__animated animate__fadeInUp">Karena ada beberapa dokumen dan data yang belum lengkap
                        atau tidak jelas.</p>
                </div>
            @else
                <div class="text-center text-secondary">
                    <i class="bi bi-info-circle-fill display-1"></i>
                    <h5>Status belum tersedia.</h5>
                </div>
            @endif
        </div>
    </div>
@endsection
