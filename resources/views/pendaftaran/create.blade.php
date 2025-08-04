<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5dc;
            /* warna cream */
        }

        .navbar-top {
            background-color: #2e8b57;
            /* hijau */
            height: 40px;
        }

        .navbar-second {
            background-color: white;
            height: 60px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff9f0;
            /* cream */
            border-radius: 10px;
            padding: 20px;
        }

        .form-left,
        .form-right {
            padding: 15px;
        }

        .form-left {
            width: 60%;
        }

        .form-right {
            width: 40%;
            border-left: 1px solid #eee;
        }

        label {
            font-weight: bold;
        }

        .form-group,
        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="navbar-top"></div>
    <div class="navbar-second d-flex align-items-center px-4">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-3">
        <h5 class="mb-0">Formulir Pendaftaran Siswa</h5>
    </div>
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


    <div class="container form-container mt-4">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
            style="width: 100%; display: flex;">
            @csrf

            <!-- Kolom Kiri -->
            <div class="form-left">
                <div class="mb-3">
                    <label>No Pendaftaran</label>
                    <input type="text" name="no_pendaftaran" class="form-control"
                        value="{{ old('no_pendaftaran', $noPendaftaran ?? '') }}" readonly>
                </div>
                <div class="mb-3">
                    <label>NISN</label>
                    <input type="text" name="nisn" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tempat Tanggal Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Agama</label>
                    <input type="text" name="agama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Penerima KIP</label>
                    <select name="penerima_kip" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>
                <div class="mb-3 d-flex">
                    <div class="me-2 w-50">
                        <label>RT</label>
                        <input type="text" name="rt" class="form-control" required>
                    </div>
                    <div class="w-50">
                        <label>RW</label>
                        <input type="text" name="rw" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Desa</label>
                    <input type="text" name="desa" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nilai Akhir Raport</label>
                    <input type="number" name="nilai_raport_akhir" class="form-control" step="0.01" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="form-right">
                <div class="form-group">
                    <label>Dokumen Ijazah (PDF/JPG/PNG)</label>
                    <input type="file" name="dokumen_ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                        required>
                </div>
                <div class="form-group">
                    <label>Dokumen KK (PDF/JPG/PNG)</label>
                    <input type="file" name="dokumen_kk" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                        required>
                </div>
                <div class="form-group">
                    <label>Dokumen Raport (PDF/JPG/PNG)</label>
                    <input type="file" name="dokumen_raport" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                        required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('dataPendaftaranSiswa') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Kirim Pendaftaran</button>
                </div>
            </div>
        </form>
    </div>



</body>

</html>
