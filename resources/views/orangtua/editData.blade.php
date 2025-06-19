<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Data orangtua</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <style>
    html, body {
      height: 100%;
      background-color: #f8f9fa; /* Background abu-abu penuh */
    }
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%; /* Full height */
    }
    .card {
      max-width: 800px; /* Lebar maksimum form */
      width: 100%;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content form-container">
      <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Data Orang Tua</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/orangtua/update/'.$orangtua->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" value="{{ old('nik', $orangtua->nik) }}">
                      </div>
                      <div class="form-group">
                        <label for="nama">NAMA</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $orangtua->nama) }}">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $orangtua->email) }}">
                        @error('email')
                        <p style="color: red;">
                          {{ $message }}
                        </p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <div class="input-group-prepend">
                          
                        </div>
                        <input type="password" class="form-control mb-3" name="password">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                      </div>
                      
                      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nomertelepon">Nomer Telepon</label>
                        <input type="number" class="form-control" name="nomertelepon" id="nomertelepon" value="{{ old('nomertelepon', $orangtua->nomertelepon) }}">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputFile">Foto</label>
                        <img src="{{ asset('storage/orangtua/'.$orangtua->foto) }}" width="100" class="mb-3">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select name="jenkel" class="form-control" id="jenkel">
                          <option value="Laki-Laki" {{ old('jenkel', $orangtua->jenkel) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                          <option value="Perempuan" {{ old('jenkel', $orangtua->jenkel) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat">{{ old('alamat', $orangtua->alamat) }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleCheck1">Check me out</label>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                      </div>
                      <!-- Tambahkan form-group atau elemen lainnya di sini -->
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
