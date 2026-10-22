<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    // =====================================================
    // LOGIN
    // =====================================================

    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {

            // --- LOGIKA CEK APPROVAL ---
            if (Auth::user()->is_approved == 0) {
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

            if (in_array($role, ['admin', 'sekretaris', 'bendahara', 'eksternal'])) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('bukubiru.index'));
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // =====================================================
    // REGISTER
    // =====================================================

    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp' => 'required|string|min:10|max:15',
            'birth_date' => 'required|date',
            'angkatan' => 'required|numeric|digits:4',
            'role_register' => 'required|in:mahasiswa,eksternal',
            'nim' => [
                'nullable',
                'required_if:role_register,mahasiswa',
                'unique:users,nim'
            ],
            'ktm' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ktmPath = null;
        if ($request->hasFile('ktm')) {
            $ktmPath = $request->file('ktm')->store('ktm_uploads', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'whatsapp' => $request->whatsapp,
            'birth_date' => $request->birth_date,
            'angkatan' => $request->angkatan,
            'role' => $request->role_register,
            'nim' => $request->role_register == 'mahasiswa' ? $request->nim : null,
            'ktm_path' => $ktmPath,
            'is_approved' => false,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan tunggu verifikasi admin untuk login.');
    }

    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // =====================================================
    // FORGOT PASSWORD — LANGKAH 1: FORM INPUT EMAIL
    // =====================================================

    /**
     * Tampilkan form lupa password.
     * URL: GET /forgot-password
     * Route name: password.request
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // =====================================================
    // FORGOT PASSWORD — LANGKAH 2: KIRIM LINK RESET
    // =====================================================

    /**
     * Kirim link reset password ke email user.
     * URL: POST /forgot-password
     * Route name: password.email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        // Kirim link reset (Laravel otomatis hash token & simpan ke DB)
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        }

        // Jika email tidak terdaftar / throttled, Laravel mengembalikan pesan error
        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }

    // =====================================================
    // FORGOT PASSWORD — LANGKAH 3: FORM RESET PASSWORD
    // =====================================================

    /**
     * Tampilkan form reset password dari link email.
     * URL: GET /reset-password/{token}?email=...
     * Route name: password.reset
     */
    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // =====================================================
    // FORGOT PASSWORD — LANGKAH 4: PROSES RESET PASSWORD
    // =====================================================

    /**
     * Proses update password baru.
     * URL: POST /reset-password
     * Route name: password.update
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'token.required'     => 'Token reset tidak valid.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'password.required'  => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Catatan penting:
                // - is_approved TIDAK diubah (user tetap harus approved admin)
                // - role TIDAK diubah
                // - remember_token direset → semua sesi login lama otomatis logout

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}