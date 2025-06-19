<x-guru-layout>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/showForm/CatatanPerkembangan') }}" class="btn btn-info"><i class="bi bi-person-bounding-box"></i>Tambah Data</a>
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
              <h1>Data Catatan Perkembangan Anak</h1>
            </div>
            <div class="col-sm-6">
              
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        @if ((Session::has('success')))

           <div class="alert-alert info">

            {{Session::get('success')}}
          </div> 
        @endif
        <div class="container-fluid">
        
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Catatan Perkembangan Siswa</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Catatan Guru</th>
                        <th>Tanggapan Orang TUa</th>
                        <th>Tanggal Dibuat</th>
                        <th>Jumlah Kehadiran</th>
                        <td>Lainnya</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $d)
                      <tr>
                        <td>{{ optional($d->siswa)->nama }}</td>
                        <td>{{ $d->catatan_khusus }}</td>
                        <td>{{ $d->tanggapan_orang_tua }}</td>
                        <td>{{ $d->tanggal_pencatatan }}</td>
                        <td>{{ $d->kehadiran }}</td>
                        <td><a href="#" class="btn btn-info">show More</a></td>
                        <td></td>
                      </tr>
                          
                      @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
         
          
        </div><!-- /.container-fluid -->
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
</x-guru-layout>