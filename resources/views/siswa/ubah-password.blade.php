@extends('layouts.sidebar')

@section('content')
    <div class="container mt-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('siswa.password.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                        @error('password_lama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                        @error('password_baru')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
