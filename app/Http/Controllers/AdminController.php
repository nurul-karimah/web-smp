<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Buat view login admin
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Logout berhasil');
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // Buat view ini
    }
}
