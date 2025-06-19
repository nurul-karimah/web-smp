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
        
          <a href="{{ route('regisGuru') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Registrasi Guru</a>
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
                  <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1"
                  class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama Guru</th>
                      <th>Nip</th>
                      <th>email</th>
                      <th>Tanggal Lahir</th>
                      <th>Foto</th>
                      <th>jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Lainnya</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($guru as $g)
                      <tr>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->nip }}
                        </td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->tgl_lahir }}</td>
                        <td>@if ($g->foto)
                          <img src="{{ asset('storage/guru/'.$g->foto) }}" alt="foto" width="100">
                            
                        @else
                            No Photo
                        @endif
                        </td>
                        <td>{{ $g->jenkel }}</td>
                        <td>{{ $g->alamat }}</td>
                        <td><a href="{{ url('/guru/'.$g->id.'/edit') }}" class="btn btn-warning mb-3"><i class="fa-solid fa-pen"></i></a></td>
                        <td><a href="{{ url('/guru/'.$g->id.'/hapus') }}" class="btn btn-danger mb-3"><i class="fa-solid fa-trash"></i></a></td>
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

</x-app-layout>