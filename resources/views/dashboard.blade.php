<x-app-layout>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="AdminLTELogo" height="100" width="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->

        </nav>
        <!-- /.navbar -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard Yayasan Al-Inganah</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jumlahDisetujui }}</h3>
                                    <p>Pendaftar Disetujui</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="{{ url('/pendaftaranInAdmin') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $jumlahDitolak }}</h3>
                                    <p>Pendaftar Ditolak</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-close-circled"></i>
                                </div>
                                <a href="{{ url('/pendaftaranInAdmin') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $jumlahSudahBayar }}</h3>
                                    <p>Siswa Sudah Bayar</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cash"></i>
                                </div>
                                <a href="{{ url('/getPendaftaranAdmin') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $jumlahRegister }}</h3>
                                    <p>Jumlah Yang Register</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cash"></i>
                                </div>
                                <a href="{{ url('/getPendaftaranAdmin') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Gender Pie Chart -->
                        <div class="col-md-6">
                            <div class="card bg-gradient-light">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="fas fa-venus-mars"></i> Pendaftar Berdasarkan Jenis Kelamin
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="genderChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Trafik Pendaftaran Chart -->
                        <div class="col-md-6">
                            <div class="card bg-gradient-light">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-chart-line"></i> Trafik Pendaftaran per Hari
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="trafikChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const genderCtx = document.getElementById('genderChart').getContext('2d');
            new Chart(genderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $jumlahLaki }}, {{ $jumlahPerempuan }}],
                        backgroundColor: ['#007bff', '#e83e8c'],
                        borderColor: ['#ffffff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#333'
                            }
                        }
                    }
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('trafikChart').getContext('2d');
            const trafikChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Jumlah Pendaftaran',
                        data: {!! json_encode($data) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        </script>

        <!-- /.control-sidebar -->
    </div>
</x-app-layout>
