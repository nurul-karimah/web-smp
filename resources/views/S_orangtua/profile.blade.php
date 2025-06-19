<x-orangtua-layout :orangtua="$orangtua">
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
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile Siswa Dan Orangtua</h1>
            </div>
          
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 mb-4"> <!-- Ukuran card diperbesar dengan col-md-6 dan menambah margin bawah -->
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('/storage/siswa/'.$siswa->foto) }}"
                         alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ $siswa->nama }}</h3>
                  <p class="text-muted text-center">Siswa</p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Kegiatan Belajar</b> <a class="float-right">{{ $data->kegiatan_belajar }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Absensi</b> <a class="float-right">100%</a>
                    </li>
                    <li class="list-group-item">
                      <b>Nilai Pembelajaran</b> <a class="float-right">100%</a>
                    </li>
                  </ul>
                  <a href="#" class="btn btn-primary btn-block"><b>Update Profile</b></a>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4"> <!-- Ukuran card diperbesar dengan col-md-6 dan menambah margin bawah -->
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('/storage/orangtua/'.$siswa->orantua->foto) }}"
                         alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ $siswa->nama }}</h3>
                  <p class="text-muted text-center">Orangtua Siswa</p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Nik </b> <a class="float-right">{{ $siswa->orantua->nik }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Email </b> <a class="float-right">{{ $siswa->orantua->email }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Alamat </b> <a class="float-right">{{ $siswa->orantua->alamat }}</a>
                    </li>
                  </ul>
                  <a href="#" class="btn btn-primary btn-block"><b>Update Profile</b></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
    </div>
  
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
</x-orangtua-layout>
