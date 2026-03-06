<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
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
                    <h2 class="text-4xl font-bold mb-4 leading-tight tracking-tight">Selamat Datang di <br>Sistem Informasi HIMAFI</h2>
                    <p class="text-slate-300 text-lg font-light leading-relaxed max-w-md">
                        Kelola kegiatan, administrasi, dan aspirasi dalam satu pintu. Bersama Kabinet <span class="text-cyan-400 font-semibold">Arunika Swakarsa</span>.
                    </p>
                </div>
                <div class="flex gap-4 text-sm text-slate-400 font-medium">
                    <span>© 2026 HIMAFI UNUD</span>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 relative">
            
            <a href="/" class="absolute top-8 left-8 flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-all group z-20">
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
                </div>
                <span class="font-medium text-sm">Kembali ke Beranda</span>
            </a>

            <div class="w-full max-w-md animate-fade-in-up mt-10 lg:mt-0">
                
                <div class="mb-10 text-center lg:text-left">
                    <div class="inline-block lg:hidden mb-6 w-16 h-16 bg-white rounded-2xl flex items-center justify-center border border-gray-100 shadow-sm overflow-hidden">
                         <img src="/img/logo.jpg" alt="Logo HIMAFI" class="w-full h-full object-cover">
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Login Akun</h1>
                    <p class="text-slate-500">Masukan email dan kata sandi untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf 
                    
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-slate-700 ml-1">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="far fa-envelope text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="glass-input w-full pl-11 pr-4 py-3.5 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('email') border-red-500 @enderror"
                                placeholder="contoh@unud.ac.id" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label for="password" class="text-sm font-semibold text-slate-700">Kata Sandi</label>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">Lupa sandi?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                class="glass-input w-full pl-11 pr-12 py-3.5 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('password') border-red-500 @enderror"
                                placeholder="••••••••" required autocomplete="current-password">
                            
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer focus:outline-none">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center ml-1">
                        <input id="rememberMe" name="remember" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                        <label for="rememberMe" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                    </div>

                    @if ($errors->any())
                    <div class="flex items-start p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-100 shake" role="alert">
                        <i class="fas fa-exclamation-circle mt-0.5 mr-3 flex-shrink-0"></i>
                        <div>
                            <span class="font-medium">Gagal Masuk!</span>
                            <ul class="mt-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <button type="submit" id="loginButton" 
                        class="w-full relative overflow-hidden bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition-all duration-300 transform active:scale-[0.98] shadow-lg shadow-slate-900/20 group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Masuk Sekarang <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>

                </form>

                <p class="mt-8 text-center text-sm text-slate-500">
                Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">Daftar Sekarang</a>
                </p>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');

            // Toggle Password Visibility
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                icon.className = type === 'password' ? 'far fa-eye' : 'far fa-eye-slash';
            });
        });
    </script>
</body>
</html>