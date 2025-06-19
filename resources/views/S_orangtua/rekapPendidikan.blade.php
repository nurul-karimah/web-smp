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
  
   
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
           
           
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="col-sm-6">
            <h1>Filter Data</h1>
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
          
         
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <img src="{{ asset('img/logo.png') }}" alt="" style="width: 100px;" class="float-left">
  
                 
                  <h2 class="text-center" style="font-size: 20px; font-weight: bold;">Rekap Pendidikan Siswa</h2>
                  <h2 class="text-center" style="font-size: 20px; font-weight: bold;">Paud Plamboyan</h2>
                
                 
                  
                </div>
                @foreach ($data as $d)
                <!-- /.card-header -->
                <div class="card-body">

                  <img src="{{ asset('storage/siswa/'.$d->siswa->foto) }}" style="width: 100px; height: 100px;">
                        
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    
                    <thead>
                      <tr>
                        <th>Nama Siswa : </th>
                        <th>{{ $d->siswa->nama }} </th>
                        
                      </tr>
                      <tr>
                        <th>Nis : </th>
                        <th>{{ $d->siswa->nis}} </th>
                        
                      </tr>
                      <tr>
                        <th>Jenis Kelamin :</th>
                        <th>{{ $d->siswa->jenis_kelamin }}</th>
                      </tr>
                      <tr>
                        <th>semester :</th>
                        <th>{{ $d->semester }}</th>
                      </tr>
                      <tr>
                        <th>Tahun Ajaran :</th>
                        <th>{{ $d->tahun_ajaran }}</th>
                      </tr>

                      <tr>
                        <th>Nama orangtua/wali : </th>
                        <th>{{ $orangtua->nama}} </th>
                        
                      </tr>
                      <tr>
                        <th></th>
                      </tr>
                     
                      <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Nilai</th>
                        <th>Grade</th>
                        <th>Keterangan</th>
                      </tr>
                     
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Perkembangan Fisik</td>
                        <td>{{ $d->nilai_fisik }}</td>
                        <td>
                          @if ($d->nilai_fisik > 80)
                          A
                          @elseif($d->nilai_fisik > 70)
                          B
                          @elseif($d->nilai_fisik > 60)
                          C
                          @elseif($d->nilai_fisik > 50)
                          D 
                          @else
                          E
                              
                          @endif

                        </td>
                        <td>{{ $d->perkembangan_fisik }}</td>

                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Perkembangan Kognitif</td>
                        <td>{{ $d->nilai_kognitif}}</td>
                        <td>
                          @if ($d->nilai_kognitif> 80)
                          A
                          @elseif($d->nilai_kognitif> 70)
                          B
                          @elseif($d->nilai_kognitif> 60)
                          C
                          @elseif($d->nilai_kognitif> 50)
                          D 
                          @else
                          E
                              
                          @endif

                        </td>
                        <td>{{ $d->perkembangan_kognitif }}</td>

                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Perkembangan Sosial Dan Emosional</td>
                        <td>{{ $d->nilai_sosial}}</td>
                        <td>
                          @if ($d->nilai_sosial > 80)
                          A
                          @elseif($d->nilai_sosial > 70)
                          B
                          @elseif($d->nilai_sosial > 60)
                          C
                          @elseif($d->nilai_sosial > 50)
                          D 
                          @else
                          E
                              
                          @endif

                        </td>
                        <td>{{ $d->perkembangan_sosial_emosional }}</td>

                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Perkembangan Bahasa</td>
                        <td>{{ $d->nilai_bahasa}}</td>
                        <td>
                          @if ($d->nilai_bahasa > 80)
                          A
                          @elseif($d->nilai_bahasa > 70)
                          B
                          @elseif($d->nilai_bahasa > 60)
                          C
                          @elseif($d->nilai_bahasa > 50)
                          D 
                          @else
                          E
                              
                          @endif

                        </td>
                        <td>{{ $d->perkembangan_bahasa }}</td>

                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Kegiatan Belajar</td>
                        <td>{{ $d->nilai_belajar}}</td>
                        <td>
                          @if ($d->nilai_belajar > 80)
                          A
                          @elseif($d->nilai_belajar > 70)
                          B
                          @elseif($d->nilai_belajar > 60)
                          C
                          @elseif($d->nilai_belajar > 50)
                          D 
                          @else
                          E
                              
                          @endif

                        </td>
                        <td>{{ $d->kegiatan_belajar }}</td>

                      </tr>
                      <tr>
                        <td colspan="2"><b>Total Nilai</b></td>
                        <td colspan="2"><b>{{ $d->jumlah }}</b></td>
                      </tr>

                      <tr>
                        <td colspan="3"><b>Grade Keseluruhan</b></td>
                        <td colspan="3"><b>{{ $d->grade }}</b></td>
                      </tr>
                    
                    </tbody>
                        
                    @endforeach
                  
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
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>no</b> 98
      </div>
      <strong>PAUD PLAMBOYAN. JL.RAYA MOH TOHA</strong> All rights reserved.
    </footer>
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  
</x-orangtua-layout>