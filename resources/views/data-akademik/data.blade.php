<x-guru-layout>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>

        <li class="nav-link mb-3"><a href="{{ url('dataakademik/create') }}" class="btn btn-ori"><i class="fa-solid fa-plus"></i>  Tambah Data</a></li>
       
      </ul>

   
    </nav>
    <!-- /.navbar -->

   
    <div class="content-wrapper">
      @if ((Session::has('success')))

      <div class="alert alert-info" id="error-alert">
        {{Session::get('success') }}
      </div>
      @endif
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
         
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Akademik Siswa</h1>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <!-- Form Pilih Tahun Ajaran -->
                    <div class="col-md-6">
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="form-group">
                                <label for="tahun_ajaran">Pilih Tahun Ajaran</label>
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" onchange="this.form.submit()">
                                    @foreach($tahunAjaranList as $tahun)
                                        <option value="{{ $tahun->tahun_ajaran }}" {{ request('tahun_ajaran') == $tahun->tahun_ajaran ? 'selected' : '' }}>
                                            {{ $tahun->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
        
                    <!-- Form Pilih Semester -->
                    <div class="col-md-6">
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="form-group">
                                <label for="semester">Pilih Semester:</label>
                                <select class="form-control" name="semester" id="semester" onchange="this.form.submit()">
                                    <option value="1" {{ request('semester') == 1 ? 'selected' : '' }}>Semester 1</option>
                                    <option value="2" {{ request('semester') == 2 ? 'selected' : '' }}>Semester 2</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Akademik Siswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @php
                      $no = 1;
                  @endphp
                  <table
                    id="example1"
                    class="table table-bordered table-striped"
                  >
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Nis</th>
                        <th>Nilai fisik</th>
                        <th>Nilai kognitif</th>
                        <th>Nilai sosial</th>
                        <th>Nilai bahasa</th>
                        <th>Nilai Belajar</th>
                        <th>Jumlah</th>
                       
                        <th colspan="2" class="text-center">Lainnya</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $d)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ optional($d->siswa)->nama }}</td>
                        <td>{{ optional($d->siswa)->nis }}</td>
                        <td>{{ $d->nilai_fisik }}</td>
                        <td>{{ $d->nilai_kognitif }}</td>
                        <td>{{ $d->nilai_sosial }}</td>
                        <td>{{ $d->nilai_bahasa }}</td>
                        <td>{{ $d->nilai_belajar }}</td>
                        <td>{{ $d->jumlah }}</td>

                        <td><a href={{ url('/data/keseluruhan/'.$d->id) }} class="btn btn-red">Keseluruhan</a></td>
                        <td><a href="{{ url('/data/edit/'.$d->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                      </tr>
                          
                      @endforeach
                     
                     
                    </tbody>
                  
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
</x-guru-layout>