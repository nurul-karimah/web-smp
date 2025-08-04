<x-app-layout>
    <div class="container">
        <div class="w-75 mx-auto card shadow p-4 mt-4">
            <h3 class="mb-4">Detail Pendaftaran</h3>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No. Pendaftaran</th>
                    <td>{{ $pendaftaran->no_pendaftaran }}</td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>{{ $pendaftaran->nisn }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pendaftaran->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>{{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</td>
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
                    <th>Penerima KIP</th>
                    <td>{{ $pendaftaran->penerima_kip }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pendaftaran->alamat }}</td>
                </tr>
                <tr>
                    <th>RT / RW</th>
                    <td>{{ $pendaftaran->rt }} / {{ $pendaftaran->rw }}</td>
                </tr>
                <tr>
                    <th>Desa</th>
                    <td>{{ $pendaftaran->desa }}</td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td>{{ $pendaftaran->kecamatan }}</td>
                </tr>
                <tr>
                    <th>Sekolah Asal</th>
                    <td>{{ $pendaftaran->sekolah_asal }}</td>
                </tr>
                <tr>
                    <th>Nilai Rapor Akhir</th>
                    <td>{{ $pendaftaran->nilai_raport_akhir }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $pendaftaran->status }}</td>
                </tr>

                {{-- Dokumen --}}
                <tr>
                    <th>Ijazah</th>
                    <td><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_ijazah) }}"
                            target="_blank">Lihat
                            Ijazah</a></td>
                </tr>
                <tr>
                    <th>Kartu Keluarga</th>
                    <td><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_kk) }}" target="_blank">Lihat
                            KK</a></td>
                </tr>
                <tr>
                    <th>Rapor</th>
                    <td><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_raport) }}"
                            target="_blank">Lihat
                            Rapor</a></td>
                </tr>

                @if ($pendaftaran->alasan)
                    <tr>
                        <th>Alasan Penolakan</th>
                        <td class="text-danger">{{ $pendaftaran->alasan }}</td>
                    </tr>
                @endif
            </table>

            <a href="{{ url('/pendaftaranInAdmin') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>

</x-app-layout>
