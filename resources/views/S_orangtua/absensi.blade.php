<x-orangtua-layout :orangtua="$orangtua">
  <!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
        <a href="{{ url('/absensi/showForm') }}" class="nav-link"><i class="bi bi-person-bounding-box"></i> Absen</a>
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
            <h1>Riwayat Absensi</h1>
          </div>

          <div class="col-sm-6">
            @if ((Session::has('success')))

            <div class="alert alert-info" id="error-alert">
              {{Session::get('success') }}
            </div>
            @endif

            @if ((Session::has('error')))
            <div class="alert alert-danger" id="error-alert">
              {{ Session::get('error') }}
            </div>
                
            @endif
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Fixed Layout</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            @foreach ($absensi as $ab)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tanggal Absensi : {{ $ab->tanggal }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <img src="{{ asset('storage/absensi/'.$ab->gambar) }}" class="img-fluid">

                @if ($ab->maps_url)
                lokasi Absen siswa: <a href="{{ $ab->maps_url }}" target="_blank">Lihat Lokasi</a>

                    
                @else
                    lokasi tidak ditemukan
                @endif
                 
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Status Kehadiran : <b>{{ $ab->status }}</b>
              </div>
              <!-- /.card-footer-->
            </div
                
            @endforeach
           >
            
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</x-orangtua-layout>