<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        himafi: { blue: '#2563eb', cyan: '#06b6d4', dark: '#0f172a' }
                    },
                    animation: { 'fade-in-up': 'fadeInUp 0.6s ease-out forwards' },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-input {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .shake { animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both; }
    </style>
</head>
<body class="bg-white font-sans text-slate-800 antialiased h-screen overflow-hidden">

    <div class="flex h-full w-full">
        {{-- LEFT PANEL --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 items-center justify-center overflow-hidden">
            <img src="/img/homeimg.png" alt="HIMAFI UNUD" class="absolute inset-0 w-full h-full object-cover opacity-50 scale-105 transition-transform duration-[20s] hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-slate-900/50 to-slate-900/30 mix-blend-multiply"></div>

            <div class="relative z-10 p-16 w-full max-w-2xl text-white flex flex-col justify-between h-full py-20">
                <div>
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-8 border border-white/10 overflow-hidden shadow-lg">
                        <img src="/img/logo.jpg" alt="Logo HIMAFI" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold mb-4 leading-tight tracking-tight">Buat Kata Sandi<br>Baru Anda</h2>
                    <p class="text-slate-300 text-lg font-light leading-relaxed max-w-md">
                        Pilih kata sandi yang kuat dan mudah Anda ingat. Demi keamanan, hindari menggunakan kata sandi yang sama dengan akun lain.
                    </p>
                </div>
                <div class="flex gap-4 text-sm text-slate-400 font-medium">
                    <span>© 2026 HIMAFI UNUD</span>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 relative h-full">

            <a href="{{ route('login') }}" class="absolute top-8 left-8 flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-all group z-20">
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
                </div>
                <span class="font-medium text-sm">Kembali ke Login</span>
            </a>

            <div class="w-full h-full overflow-y-auto no-scrollbar pt-16 pb-10 px-2 flex justify-center items-center">
                <div class="w-full max-w-md animate-fade-in-up">

                    <div class="mb-8 text-center lg:text-left">
                        <div class="inline-block lg:hidden mb-6 w-16 h-16 bg-white rounded-2xl flex items-center justify-center border border-gray-100 shadow-sm overflow-hidden">
                            <img src="/img/logo.jpg" alt="Logo HIMAFI" class="w-full h-full object-cover">
                        </div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">Reset Password</h1>
                        <p class="text-slate-500">Buat kata sandi baru untuk akun Anda.</p>
                    </div>

                    {{-- ALERT ERROR --}}
                    @if ($errors->any())
                        <div class="flex items-start p-4 mb-5 text-sm text-red-800 rounded-lg bg-red-50 border border-red-100 shake" role="alert">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-3 flex-shrink-0"></i>
                            <div>
                                <span class="font-medium">Gagal Reset!</span>
                                <ul class="mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- EMAIL (READONLY) --}}
                        <div class="space-y-1">
                            <label for="email" class="text-sm font-semibold text-slate-700 ml-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="far fa-envelope text-slate-400"></i>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email', $email) }}"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl outline-none bg-slate-100 text-slate-500 border border-slate-200 cursor-not-allowed"
                                    readonly required>
                            </div>
                        </div>

                        {{-- PASSWORD BARU --}}
                        <div class="space-y-1">
                            <label for="password" class="text-sm font-semibold text-slate-700 ml-1">Kata Sandi Baru</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="glass-input w-full pl-11 pr-12 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('password') border-red-500 @enderror"
                                    placeholder="Minimal 8 karakter" required autocomplete="new-password" minlength="8">
                                <button type="button" onclick="togglePass('password', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            @error('password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-sm font-semibold text-slate-700 ml-1">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="glass-input w-full pl-11 pr-12 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium"
                                    placeholder="Ulangi kata sandi baru" required autocomplete="new-password" minlength="8">
                                <button type="button" onclick="togglePass('password_confirmation', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- HINT --}}
                        <div class="flex items-start gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                            <i class="fas fa-circle-info text-blue-500 mt-0.5"></i>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Minimal <span class="font-semibold text-slate-800">8 karakter</span>. Disarankan kombinasi huruf besar, huruf kecil, dan angka agar lebih aman.
                            </p>
                        </div>

                        <button type="submit"
                            class="w-full relative overflow-hidden bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition-all duration-300 transform active:scale-[0.98] shadow-lg shadow-slate-900/20 group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Simpan Kata Sandi Baru <i class="fas fa-check text-sm group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>

                    </form>

                    <div class="flex items-center gap-3 my-8">
                        <div class="flex-1 h-px bg-slate-200"></div>
                        <span class="text-xs text-slate-400 uppercase tracking-wider">atau</span>
                        <div class="flex-1 h-px bg-slate-200"></div>
                    </div>

                    <p class="text-center text-sm text-slate-500">
                        Sudah ingat kata sandi?
                        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">Masuk disini</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Visibility Password
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>