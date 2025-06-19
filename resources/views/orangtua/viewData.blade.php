<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  
  <style>
    .img-circle{
      border-radius: 50%;
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin-left: 280px;
    }
    .btn-red{
      background-color: rgb(204, 74, 107);
    }
  </style>

</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <a href="{{ url('/orangtua') }}" class="btn btn-primary mt-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
        
        <div class="card mb-4 shadow-sm mt-5">
          
          <img src="{{ asset('storage/orangtua/'. $orangtua->foto) }}" alt="{{ $orangtua->nama }}" class="card-img-top img-circle mt-3">
          <div class="card-body text-center">
            <h5 class="card-title">{{ $orangtua->nama }}</h5>
            <p class="card-text">{{ $orangtua->nik }}</p>
            <p class="card-text">Alamat :{{ $orangtua->alamat }}</p>

            @foreach ($siswa as $s)
            <p class="card-text" style="font-weight: bold;">Mempunyai siswa: {{ $s->nama }} {{ $s->nis }}</p> <br>
           
                
            @endforeach
            <a href="{{ url('/orangtua/edit/'. $orangtua->id) }}" class="btn btn-warning" style="margin: 20px;"><i class="fa-solid fa-pen"></i> edit</a>
            <a href="{{ url('/orangtua/hapus/'.$orangtua->id) }}" class="btn btn-red"><i class="fa-solid fa-trash"></i> Hapus</a>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>