<x-guru-layout>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
        
      </ul>
  
    </nav>
    <!-- /.navbar -->
  
    <!-- Main Sidebar Container -->
   
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Data Guru</h1>
            </div>
            <div class="col-sm-6">
              <div class="row">
                  <!-- Form Pilih Tahun Ajaran -->
                  
      
                  <!-- Form Pilih Semester -->
                  <div class="col-md-6">
                      <form action="{{ url()->current() }}" method="GET">
                          <div class="form-group">
                              
                              <div class="form-group">
                                <label for="tanggal_absensi">Tanggal Absensi</label>
                                <input type="date" class="form-control" name="tanggal_absensi" id="tanggal_absensi" onchange="this.form.submit()" value="{{ request('tanggal_absensi') }}">

                              </div>
                              
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        @if ((Session::has('success')))

        <div class="alert alert-info">
          {{Session::get('success') }}
        </div>
        @endif
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
             
  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Kehadiran Siswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th rowspan="2" class="text-center">No</th>
                      <th rowspan="2" class="text-center">Nama</th>
                      <th colspan="3" class="text-center">Keterangan</th>
                     
                    </tr>
                    <tr>
                      <th>Hadir</th>
                      <th>Izin</th>
                      <th>Alfa</th>
                    </tr>
                    </thead>
                    <?php 
                    $no = 1;
                    ?>
                  <tbody>
                    @foreach ($data as $siswa)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $siswa->nama }}</td>
                      <td>{{ isset($kehadiran[$siswa->id]) ? $kehadiran[$siswa->id]->where('status', 'Hadir')->count() : 0 }}</td>
                      <td>{{ isset($kehadiran[$siswa->id]) ? $kehadiran[$siswa->id]->where('status', 'Izin')->count() : 0 }}</td>
                      <td>{{ isset($kehadiran[$siswa->id]) ? $kehadiran[$siswa->id]->where('status', 'Alfa')->count() : 0 }}</td>
                    </tr>
                        
                    @endforeach
                   
                  </tbody>
                    <tfoot>
                    <tr>
                      <th>Rendering engine</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                      <th>CSS grade</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>  
</x-guru-layout>>