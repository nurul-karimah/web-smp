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
        
          <a href="{{ route('registerOrtu') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
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
              <h1>Simple Tables</h1>
            </div>
           
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        @if ((Session::has('success')))

        <div class="alert alert-danger">
          {{Session::get('success') }}
        </div>
        @endif
        <div class="container-fluid">
          
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Orangtua</h3>
  
                  <div class="card-tools">
                    <form action="{{ url('/orangtua/cari') }}" method="get">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="query" class="form-control float-right" placeholder="Search">
    
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
                  <table  class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Nik</th>
                        <th>email</th>
                        <th>nomertelepon</th>
                        <th>foto</th>
                        <th>jenkel</th>
                        <th>alamat</th>
                        <th>Lainnya</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($orangtua as $o)
                      
                      <tr>
                        <td>{{ $o->nama }}</td>
                        <td>{{ $o->nik }}</td>
                        <td>{{ $o->email }}</td>
                        <td><span class="tag tag-success">{{ $o->nomertelepon }}</span></td>
                        <td>@if ($o->foto)
                            <img src="{{ asset('/storage/orangtua/'.$o->foto) }}" alt="foto" width="100" >
                        @else
                            noPhoto
                        @endif</td>
                        <td>{{ $o->jenkel }}</td>
                        <td>{{ $o->alamat }}</td>
                        <td><a href="{{ url('/siswa/register/'. $o->id) }}" class="btn btn-primary mb-3">Register Siswa</a>
                        <a href="{{ url('/orangtua/view/'.$o->id) }}" class="btn btn-warning mb-3"><i class="fa-regular fa-eye"></i> View</a>
                        </td>
                      </tr>
                          
                      @endforeach

                     
                    </tbody>

                    @if ((Session::has('sukses')))
                    <p style="size: 15px; color:aqua; font-family:Arial, Helvetica, sans-serif;">
                      {{Session::get('sukses') }}

                    </p>
                        
                    @endif
                  
                  </table>

                 
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          
          <
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    
    
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  
  
  
</x-app-layout>