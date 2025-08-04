@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <h3>Edit Data Pendaftaran</h3>

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

        <form action="{{ url('/updatePendaftaran', $pendaftaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Contoh input -->
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" class="form-control" name="nisn" value="{{ old('nisn', $pendaftaran->nisn) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" required>
            </div>

            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir"
                    value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <input type="text" class="form-control" name="agama" value="{{ old('agama', $pendaftaran->agama) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Penerima KIP</label><br>
                <label><input type="radio" name="penerima_kip" value="Ya"
                        {{ old('penerima_kip', $pendaftaran->penerima_kip) == 'Ya' ? 'checked' : '' }}> Ya</label>
                <label><input type="radio" name="penerima_kip" value="Tidak"
                        {{ old('penerima_kip', $pendaftaran->penerima_kip) == 'Tidak' ? 'checked' : '' }}> Tidak</label>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" required>{{ old('alamat', $pendaftaran->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="sekolah_asal" class="form-label">Sekolah Asal</label>
                <input type="text" class="form-control" name="sekolah_asal"
                    value="{{ old('sekolah_asal', $pendaftaran->sekolah_asal) }}" required>
            </div>

            <div class="mb-3 row">
                <div class="col">
                    <label for="rt" class="form-label">RT</label>
                    <input type="text" class="form-control" name="rt" value="{{ old('rt', $pendaftaran->rt) }}"
                        required>
                </div>
                <div class="col">
                    <label for="rw" class="form-label">RW</label>
                    <input type="text" class="form-control" name="rw" value="{{ old('rw', $pendaftaran->rw) }}"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label for="desa" class="form-label">Desa</label>
                <input type="text" class="form-control" name="desa" value="{{ old('desa', $pendaftaran->desa) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" name="kecamatan"
                    value="{{ old('kecamatan', $pendaftaran->kecamatan) }}" required>
            </div>

            <div class="mb-3">
                <label for="nilai_raport_akhir" class="form-label">Nilai Raport Akhir</label>
                <input type="number" step="0.01" class="form-control" name="nilai_raport_akhir"
                    value="{{ old('nilai_raport_akhir', $pendaftaran->nilai_raport_akhir) }}" required>
            </div>

            <div class="mb-3">
                <label for="dokumen_ijazah" class="form-label">Dokumen Ijazah</label>
                @if ($pendaftaran->dokumen_ijazah)
                    <p><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_ijazah) }}"
                            target="_blank">Lihat File Saat Ini</a></p>
                @endif
                <input type="file" class="form-control" name="dokumen_ijazah">
            </div>

            <div class="mb-3">
                <label for="dokumen_kk" class="form-label">Dokumen KK</label>
                @if ($pendaftaran->dokumen_kk)
                    <p><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_kk) }}" target="_blank">Lihat
                            File Saat Ini</a></p>
                @endif
                <input type="file" class="form-control" name="dokumen_kk">
            </div>

            <div class="mb-3">
                <label for="dokumen_raport" class="form-label">Dokumen Raport</label>
                @if ($pendaftaran->dokumen_raport)
                    <p><a href="{{ asset('storage/img/document/' . $pendaftaran->dokumen_raport) }}"
                            target="_blank">Lihat File Saat Ini</a></p>
                @endif
                <input type="file" class="form-control" name="dokumen_raport">
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="{{ route('dataPendaftaranSiswa') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
