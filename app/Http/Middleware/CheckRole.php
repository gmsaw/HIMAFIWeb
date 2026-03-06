<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed ...$roles  (List role yang diizinkan, dipisahkan koma)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Jika user adalah 'admin', bypass semua pengecekan (Super User)
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Cek apakah role user ada di daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, tampilkan error 403
        abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}