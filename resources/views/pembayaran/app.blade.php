<!DOCTYPE html>
<html>
<head>
    <title>Web SMP - Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Aplikasi Pembayaran Siswa</h1>
        <hr>
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
