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

        <div class="row">
            @if ($pendaftaran)
                <h4 class="mt-5">Data Pendaftaran Anda</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $pendaftaran->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td>{{ $pendaftaran->nisn }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $pendaftaran->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $pendaftaran->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $pendaftaran->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $pendaftaran->agama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pendaftaran->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td
                                class="{{ $pendaftaran->status === 'menunggu persetujuan' ? 'bg-warning text-dark' : ($pendaftaran->status === 'diterima' ? 'bg-success text-white' : 'bg-danger text-white') }}">
                                {{ ucfirst($pendaftaran->status) }}
                            </td>

                        <tr>
                            <th>Alasan</th>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#alasanModal">
                                    Lihat Alasan
                                </button>
                            </td>
                        </tr>

                        </tr>


                    </tbody>
                </table>
                <a href="{{ url('/getFormUpdatePendaftaran', $pendaftaran->id) }}" class="btn btn-info">Update Data</a>
            @else
                <div class="alert alert-warning mt-4">
                    Anda belum mengisi data pendaftaran.
                </div>
            @endif


            <!-- Modal -->
            <div class="modal fade" id="alasanModal" tabindex="-1" aria-labelledby="alasanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alasanModalLabel">Alasan Persetujuan / Penolakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            @if ($pendaftaran->status === 'ditolak')
                                {{ $pendaftaran->alasan ?? 'Tidak ada alasan yang diberikan.' }}
                            @elseif ($pendaftaran->status === 'diterima')
                                Pendaftaran Anda telah disetujui lakukan pembayaran pada menu pembayaran.
                            @else
                                Belum ada keputusan.
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <script>
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.remove();
                });
            }, 2000); // hilang dalam 4 detik
        </script>


    </div>
@endsection
