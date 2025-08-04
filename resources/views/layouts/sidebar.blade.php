<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Halaman Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Bootstrap CSS via CDN -->


    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: white;
            position: fixed;
            left: 0;
            top: 0;
            transition: left 0.3s;
            z-index: 1000;
        }

        .sidebar.hidden {
            left: -220px;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: black;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
        }

        .navbar {
            margin-left: 220px;
            transition: margin-left 0.3s;
            background-color: #007bff;
            color: white;
            padding: 12.5px;
        }

        .navbar.collapsed {
            margin-left: 0;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .content.collapsed {
            margin-left: 0;
        }

        .logo-img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="bg-primary text-white text-center py-3">
            <h4 class="m-0">Menu</h4>
        </div>
        <a href="{{ route('dashboardSiswa') }}">Dashboard</a>
        <a href="{{ route('dataPendaftaranSiswa') }}">Data Pendaftaranmu</a>
        <a href="{{ url('/status-pendaftaran') }}"> Status Pendaftaran</a>
        <a href="{{ url('/getPembayaran') }}">Informasi Pembayaran</a>
        <a href="{{ url('/siswa/profile') }}">Profile</a>

        <form action="{{ route('logout') }}" method="POST" class="mt-4 px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark px-3 d-flex align-items-center" id="navbar">
        <span class="me-3" onclick="toggleSidebar()" style="cursor: pointer; font-size: 1.5rem;">☰</span>
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img">
        <span class="navbar-brand mb-0 h1">Sistem Pendaftaran Siswa Baru SMP Plus Al-Hilal</span>
    </nav>

    <div class="d-flex justify-content-end mb-3 mt-2" style="margin-right: 5px;">
        <a href="{{ url('/pendaftaran') }}" class="btn btn-primary">Daftar</a>
    </div>


    <div class="content" id="content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('hidden');
            document.getElementById('navbar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('collapsed');
        }
    </script>
</body>

</html>
