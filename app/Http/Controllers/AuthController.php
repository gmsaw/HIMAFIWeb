<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login'); // Pastikan nama file blade Anda login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // Coba login dengan kredensial
        if (Auth::attempt($credentials, $remember)) {
            
            // --- LOGIKA CEK APPROVAL ---
            if (Auth::user()->is_approved == 0) {
                // Jika belum disetujui, tendang keluar
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akun Anda belum disetujui oleh Admin.',
                ])->onlyInput('email');
            }
            // ---------------------------

            $request->session()->regenerate();

            // --- LOGIKA REDIRECT BERDASARKAN ROLE ---
            $role = Auth::user()->role;

            // PERBAIKAN: Masukkan 'eksternal' agar diarahkan ke Admin Dashboard
            if (in_array($role, ['admin', 'sekretaris', 'bendahara', 'eksternal'])) {
                return redirect()->intended(route('admin.dashboard'));
            } 
            
            // Jika member biasa (mahasiswa) -> Buku Biru User
            return redirect()->intended(route('bukubiru.index'));
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp' => 'required|string|min:10|max:15',
            'birth_date' => 'required|date',
            'angkatan' => 'required|numeric|digits:4',
            
            // NIM wajib jika role Mahasiswa, tapi opsional jika Eksternal
            'role_register' => 'required|in:mahasiswa,eksternal',
            'nim' => [
                'nullable', 
                'required_if:role_register,mahasiswa', 
                'unique:users,nim'
            ],
            
            // File KTM Wajib (Gambar/PDF, Max 2MB)
            'ktm' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // 2. Upload File KTM
        $ktmPath = null;
        if ($request->hasFile('ktm')) {
            $ktmPath = $request->file('ktm')->store('ktm_uploads', 'public');
        }

        // 3. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'whatsapp' => $request->whatsapp,
            'birth_date' => $request->birth_date,
            'angkatan' => $request->angkatan,
            'role' => $request->role_register, // Hanya bisa pilih Mahasiswa/Eksternal
            'nim' => $request->role_register == 'mahasiswa' ? $request->nim : null,
            'ktm_path' => $ktmPath,
            'is_approved' => false, // Default: Belum disetujui Admin
        ]);
        
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan tunggu verifikasi admin untuk login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}