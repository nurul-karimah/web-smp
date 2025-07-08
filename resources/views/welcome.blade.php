<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Yayasan Al-Inganah (SMP PLUS AL-HILAL)</title>
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
   
    <header class="bg-green text-white text-center py-4 fixed-top">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo SMP" style="height: 100px; margin-right: 10px;" id="img-nav">
            <h6 class="header-title mb-0">Yayasan Al-Inganah <br> (SMP Plus Al-Hilal)</h6>
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
           
            <div class="jumbotron jumbotron-fluid text-white text-center" style="background: url('{{ asset('img/Hero.jpg') }}') no-repeat center center/cover; position: relative;">
                <div class="overlay"></div>
                <div class="container animate__animated animate__backInUp">
                    <h1 class="display-4">Selamat Datang di Sistem Informasi Pendaftaran Siswa Baru <br> Yayasan Al-Inganah (SMP Plus Al-Hilal)</h1>
                    <p class="lead">Tempat yang amanah untuk pendidikan anak menengah pertama.</p>
                    <a href="#about" class="btn btn-success btn-lg btn-transparent-bg">Pelajari Lebih Lanjut</a>
                </div>
            </div>

        </section>

        
       

        <section id="about" class="bg-light py-5 mt-3">
            <div class="container">
                <h3 class="text-center mb-4" data-aos="fade-up">Tentang Kami</h3>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-right">
                        <p>Yayasan Al Inganah sebuah lembaga pendidikan Islam yang berdiri sejak tahun 2007, berlokasi di Dusun Sampih, Desa Rejasari, Kecamatan Langensari, Kota Banjar, Jawa Barat. Didirikan oleh Abah Kyai M. Kholid Bawakir, yayasan ini bertujuan mencetak generasi muslim yang berakhlakul karimah, berilmu, dan mandiri dalam bingkai nilai-nilai Islam dan kebangsaan.</p>
                        <p>Dengan memadukan nilai keislaman dan nasionalisme, Yayasan Al- Inganah (SMP Plus Al-Hilal) menjadi lembaga pendidikan yang tidak hanya fokus pada aspek spiritual dan intelektual, tetapi juga pada kemandirian, keterampilan hidup, dan kepedulian terhadap lingkungan.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <img src="{{ asset('img/hero2.jpg') }}" class="img-fluid rounded" alt="Foto SMP Plus Al-Hilal">
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
                            <img src="{{ asset('img/quran.jpg') }}" class="card-img-top" alt="Program 1" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Tahfidzul Al-Qur'an</h5>
                                <p class="card-text">Program ini berfokus pada pembinaan siswa dalam menghafal Al-Qur’an secara bertahap dan terstruktur, dengan target hafalan tertentu setiap jenjangnya serta dibimbing oleh guru yang kompeten di bidang tahfidz.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/digital.jpg') }}" class="card-img-top" alt="Program 2" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Media Digital</h5>
                                <p class="card-text">Siswa dibekali keterampilan dalam bidang teknologi informasi dan komunikasi, seperti desain grafis, editing video, serta pemanfaatan media digital untuk pembelajaran dan dakwah.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/bahasa.jpg') }}" class="card-img-top" alt="Program 3" width="200px" height="150px">
                            <div class="card-body">
                                <h5 class="card-title">Bahasa Asing (Arab, Inggris, dan Jepang) </h5>
                                <p class="card-text">Program ini bertujuan meningkatkan kemampuan siswa dalam berkomunikasi menggunakan tiga bahasa asing untuk mendukung wawasan global dan memperluas peluang akademik maupun karier di masa depan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br> <br> <br> <h4 class="text-center mb-4">Kontak Kami</h4>
                <h4 class="text-center mb-4" data-aos=>Syifa Mutmainah, S.Pd. (0858-6275-5124)</h4>
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
            <p>&copy; 2025 Yayasan Al-Inganah SMP Plus Al-Hilal. All rights reserved.</p>
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
