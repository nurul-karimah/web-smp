<x-app-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h4>Edit Data Pengguna</h4>

                @if (session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="w-50 mx-auto card shadow p-4">

                    <form action="{{ url('/editDataSiswa', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-control" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" required>{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label><br>
                            @if ($user->foto)
                                <img src="{{ asset('storage/users/' . $user->foto) }}" alt="Foto" width="100"
                                    class="mb-2 rounded">
                            @endif
                            <input type="file" name="foto" class="form-control">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ url('/getDataSiswa') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div> {{-- penutup div.w-50 --}}
            </div>
        </section>
    </div>
</x-app-layout>
