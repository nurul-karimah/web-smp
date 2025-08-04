@extends('layouts.sidebar')

@section('content')
    <style>
        .profile-header {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            padding: 40px 0;
            text-align: center;
            color: white;
        }

        .profile-img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            margin-top: -65px;
            background-color: white;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .profile-stats div {
            text-align: center;
        }

        .profile-info {
            padding: 20px;
        }

        .btn-edit {
            display: block;
            margin: 0 auto;
            width: fit-content;
        }
    </style>

    <div class="profile-header">
        <h2>Profil Kamu</h2>
    </div>

    <div class="container mt-3">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('storage/users/' . $user->foto) }}" class="profile-img shadow" alt="Foto Profil">

                <h4 class="mt-3">{{ $user->name }}</h4>
                <p class="text-muted">Siswa</p>

                <div class="profile-stats">
                    <div>
                        <h6>Email</h6>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div>
                        <h6>Alamat</h6>
                        <p>{{ $user->alamat }}</p>
                    </div>
                    <div>
                        <h6>No HP</h6>
                        <p>{{ $user->no_hp ?? '-' }}</p>
                    </div>
                </div>

                <a href="{{ route('siswa.password.update') }}" class="btn btn-warning btn-edit mt-3">
                    Ubah Password
                </a>
            </div>
        </div>
    </div>
@endsection
