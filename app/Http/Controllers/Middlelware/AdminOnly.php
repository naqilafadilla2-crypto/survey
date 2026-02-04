<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan role = admin
        // Misal field 'is_admin' di table users (1=admin, 0=pegawai)
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}
