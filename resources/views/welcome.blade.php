<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi PAUD Plamboyan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   
    <header class="bg-primary text-white text-center py-4 fixed-top">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo PAUD" style="height: 100px; margin-right: 10px;" id="img-nav">
            <h1 class="header-title mb-0">PAUD Plamboyan</h1>
            @if (Route::has('login'))
            <nav class="navbar navbar-expand-sm navbar-dark ml-auto">
                <ul class="navbar-nav mx-auto">
                    @auth
                    <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></li>
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>
                    @if (Route::has('register'))

                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        
                    @endif
                    
                    @endauth
                   
                </ul>
            </nav>
                
            @endif
            
        </div>
    </header>

    <main style="padding-top: 100px;">
        @if ((Session::has('error')))
        <div class="alert alert-danger" id="error-alert" style="margin-top: 40px;">
            {{Session::get('error')}}
        </div>
        @endif
        @if ((Session::has('success')))
        <div class="alert alert-danger" id="error-alert" style="margin-top: 40px;">
            {{Session::get('success')}}
        </div>
        @endif
      
            
       
        <section id="awalan" class="bg-light py-5" data-aos="zoom-in-down">
           
            <div class="jumbotron jumbotron-fluid text-white text-center" style="background: url('{{ asset('img/doc2.jpg') }}') no-repeat center center/cover; position: relative;">
                <div class="overlay"></div>
                <div class="container animate__animated animate__backInUp">
                    <h2 class="display-4">Selamat Datang di Sistem Informasi PAUD Plamboyan</h2>
                    <p class="lead">Tempat terbaik untuk pendidikan anak usia dini.</p>
                    <a href="#about" class="btn btn-success btn-lg btn-transparent-bg">Pelajari Lebih Lanjut</a>
                </div>
            </div>

        </section>

        
       

        <section id="about" class="bg-light py-5 mt-3">
            <div class="container">
                <h3 class="text-center mb-4" data-aos="fade-up">Tentang Kami</h3>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-right">
                        <p>PAUD Plamboyan adalah lembaga pendidikan yang berfokus pada pengembangan anak usia dini dengan metode pembelajaran yang interaktif dan menyenangkan.</p>
                        <p>Kami percaya bahwa pendidikan anak usia dini adalah fondasi penting untuk masa depan anak-anak. Dengan pendekatan yang holistik, kami menyediakan lingkungan yang mendukung perkembangan kognitif, sosial, emosional, dan fisik anak-anak.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <img src="{{ asset('img/doc1.jpg') }}" class="img-fluid rounded" alt="Foto PAUD Plamboyan">
                    </div>
                </div>
                
            </div>
           
        </section>

        <section id="programs" class="bg-light py-5 mt-3">
            <div class="container">
                <h3 class="text-center mb-4" data-aos="fade-up">Program Kami</h3>
                <div class="row" data-aos="flip-down">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/rapat.jpg') }}" class="card-img-top" alt="Program 1" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Rapat Orangtua/Wali</h5>
                                <p class="card-text">Kegiatan Tahunan Mengadakan Rapat Bersama Orangtua/Wali</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/senam.jpg') }}" class="card-img-top" alt="Program 2" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Kegiatan Olahraga Mingguan</h5>
                                <p class="card-text">kegiatan senam ini dilakukan oleh siswa/siswi Paud setiap Seminggu sekali</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/istirahat.jpg') }}" class="card-img-top" alt="Program 3" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Istirahat Bersama</h5>
                                <p class="card-text">Waktu istirahat anak anak akan dibiarkan bermain bersama</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="users" class="bg-light py-5 mt-3" data-aos="zoom-out-down">
            <div class="container">

                <h3 class="text-center mb-3">
                    Bergabung Dengan Kami Dibawah Ini
                </h3>
                <div class="row" style="margin-left: 300px;">
                    <div class="col-md-3 me-2">
                        <a href="{{ url('/guru/login') }}"><img src="{{ asset('img/guru.png') }}" class="img-fluid rounded-circle" width="150"></a>
                    </div>
                    <div class="col-md-3 me-2">
                        <a href="{{ url('/loginOrangtua') }}"><img src="{{ asset('img/orang2.png') }}" class="img-fluid rounded-circle" width="150"></a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 PAUD Plamboyan. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
       

      AOS.init({
        duration: 1000,
        once: false,
        mirror: true,
      });


    </script>

    <script>
        // Menggunakan JavaScript murni
    setTimeout(function() {
        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 2000); // Waktu dalam milidetik, 2000ms = 2 detik

    // Atau, menggunakan jQuery (jika jQuery sudah di-include di dalam project)
    /*
    $(document).ready(function(){
        setTimeout(function() {
            $('#error-alert').fadeOut('slow');
        }, 2000); // 2000ms = 2 detik
    });
    */
    </script>
</body>
</html>
