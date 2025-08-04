@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <h3 class="mb-4">Statistik Pendaftaran</h3>

        <div class="row">
            @php
                $boxes = [
                    [
                        'title' => 'Total Pendaftar',
                        'count' => $totalPendaftar,
                        'icon' => 'fas fa-users',
                        'color' => 'primary',
                    ],
                    [
                        'title' => 'Dokumen Lengkap',
                        'count' => $berkasLengkap,
                        'icon' => 'fas fa-file-upload',
                        'color' => 'success',
                    ],
                    [
                        'title' => 'Telah Diverifikasi',
                        'count' => $diverifikasi,
                        'icon' => 'fas fa-check-circle',
                        'color' => 'info',
                    ],
                    [
                        'title' => 'Pembayaran Masuk',
                        'count' => $jumlahPembayaran,
                        'icon' => 'fas fa-money-bill-wave',
                        'color' => 'warning',
                    ],
                    [
                        'title' => 'Aktivitas Mengunjungi Halaman',
                        'count' => $kunjungan,
                        'icon' => 'fas fa-chart-line',
                        'color' => 'danger',
                    ],
                ];
            @endphp

            @foreach ($boxes as $box)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card text-white bg-{{ $box['color'] }} shadow h-100 py-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="h5 font-weight-bold">{{ $box['title'] }}</div>
                                <div class="h3">{{ $box['count'] }}</div>
                            </div>
                            <div class="icon">
                                <i class="{{ $box['icon'] }} fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        <h4 class="mt-5">Informasi Umum</h4>
        <div class="card">
            <div class="card-body">
                <h5>Selamat Datang di Sistem Pendaftaran!</h5>
                <p>Silakan ikuti alur pendaftaran berikut untuk memastikan proses berjalan dengan lancar:</p>
                <ol>
                    <li><strong>Mendaftarkan Diri:</strong> Klik menu <em>Pendaftaran</em> di sebelah kiri dan isi data diri
                        secara lengkap.</li>
                    <li><strong>Unggah Persyaratan:</strong> Setelah mengisi data, unggah dokumen berikut:
                        <ul>
                            <li>Scan Ijazah (jika ada/ijazah sementara)</li>
                            <li>Scan Kartu Keluarga (KK)</li>
                            <li>Scan Rekap Nilai Rapor</li>
                        </ul>
                    </li>
                    <li><strong>Pembayaran:</strong> Lakukan pembayaran sesuai informasi yang tertera.</li>
                    <li><strong>Upload Bukti Pembayaran:</strong> Buka menu <em>Upload Bukti Pembayaran</em> di sebelah
                        kiri, lalu unggah bukti pembayaran Anda.</li>
                </ol>
                <p>Pastikan semua data dan dokumen yang diunggah valid dan sesuai ketentuan. Terima kasih telah mendaftar!
                </p>
            </div>
        </div>

    </div>
@endsection
