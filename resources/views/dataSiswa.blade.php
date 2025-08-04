<x-app-layout>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block me-5">


                </li>

            </ul>


        </nav>
        <!-- /.navbar -->



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    {{-- <form action="{{ url('/pendaftaranInAdmin') }}" method="GET" class="mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <label for="tahun" class="form-label mb-0">Filter Tahun:</label>
                            <select name="tahun" id="tahun" class="form-select w-auto">
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}"
                                        {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </form> --}}

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Siswa</h3>

                                    <div class="card-tools">
                                        <form action="{{ url('/getDataSiswa') }}" method="GET">
                                            <div class="input-group input-group-sm" style="width: 200px;">
                                                <input type="text" name="query" class="form-control float-right"
                                                    placeholder="Cari berdasarkan nama" value="{{ request('query') }}">


                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <table class="table table-bordered table-striped table-hover text-nowrap">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Foto Siswa</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($siswaUsers as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->alamat }}</td>
                                                    <td>
                                                        @if ($user->foto)
                                                            <a href="{{ asset('storage/users/' . $user->foto) }}"
                                                                target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success"> calon
                                                            {{ ucfirst($user->role) }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/editDataSiswa/' . $user->id) }}"
                                                            class="btn btn-warning">Update Data</a>
                                                    </td>
                                                </tr>
                                            @empty

                                                <tr>
                                                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>


                                    <!-- Modal Alasan Penolakan -->
                                    <div class="modal fade" id="alasanModal" tabindex="-1"
                                        aria-labelledby="alasanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form id="alasanForm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Masukkan Alasan Penolakan</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id_ditolak">
                                                        <div class="mb-3">
                                                            <label for="alasan" class="form-label">Alasan</label>
                                                            <textarea class="form-control" id="alasan" name="alasan" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>



                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    < </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                const status = this.value;
                const id = this.getAttribute('data-id');

                if (status === 'ditolak') {
                    // Tampilkan modal alasan
                    document.getElementById('id_ditolak').value = id;
                    document.getElementById('alasan').value = '';
                    const modal = new bootstrap.Modal(document.getElementById('alasanModal'));
                    modal.show();
                } else {
                    // Kirim langsung via fetch
                    fetch('{{ route('pendaftaran.updateStatus') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id: id,
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.success || data.error);
                            location.reload(); // Reload untuk update tampilan
                        });
                }
            });
        });

        // Submit alasan penolakan
        document.getElementById('alasanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('id_ditolak').value;
            const alasan = document.getElementById('alasan').value;

            fetch('{{ route('pendaftaran.updateStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id,
                        status: 'ditolak',
                        alasan: alasan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('alasanModal'));
                    modal.hide();
                    alert(data.success || data.error);
                    location.reload();
                });
        });
    </script>

    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.remove();
            });
        }, 4000); // hilang dalam 4 detik
    </script>







</x-app-layout>
