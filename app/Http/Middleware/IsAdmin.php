<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (Auth::check()) {
            // 2. Cek apakah role user adalah 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request); // Silakan lewat
            }
            
            // Jika login tapi bukan admin (misal: mahasiswa biasa)
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika belum login, lempar ke halaman login
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }
}