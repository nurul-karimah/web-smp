<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string', 'max:255'],
            'foto' => 'required|mimes:jpeg,jpg,png|max:2048',
            'role' => ['required', 'string'],
        ]);

        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/users', $foto->hashName());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'foto' => $foto->hashName(),
            'role' => $request->role,
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'siswa') {
            return redirect('/dashboardSiswa');
        } elseif ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        // Default fallback
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string', 'max:255'],
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;

        // Ganti password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Jika ada foto baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($user->foto && Storage::exists('public/users/' . $user->foto)) {
                Storage::delete('public/users/' . $user->foto);
            }

            // Simpan foto baru dengan nama acak
            $fotoBaru = $request->file('foto');
            $namaFotoBaru = Str::random(40) . '.' . $fotoBaru->getClientOriginalExtension();
            $fotoBaru->storeAs('public/users', $namaFotoBaru);
            $user->foto = $namaFotoBaru;
        }

        $user->save();

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }
}
