<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah user role = admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->with('error', 'Hanya admin yang bisa login di sini.');
            }

            // Login berhasil, redirect ke dashboard admin
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('survei.index')->with('success', 'Anda berhasil logout.');
    }
}
