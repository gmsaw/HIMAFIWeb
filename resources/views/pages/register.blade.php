<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - HIMAFI UNUD</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { himafi: { blue: '#2563eb', cyan: '#06b6d4', dark: '#0f172a' } },
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
        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            padding: 12px 16px;
            background: #f9fafb;
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .file-input-label:hover {
            background: #f3f4f6;
            border-color: #2563eb;
        }
        .file-input-label.has-file {
            background: #f0f9ff;
            border-color: #0ea5e9;
            border-style: solid;
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-white font-sans text-slate-800 antialiased h-screen overflow-hidden">

    <div class="flex h-full w-full">
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 items-center justify-center overflow-hidden">
            <img src="{{ asset('img/homeimg.png') }}" alt="HIMAFI UNUD" class="absolute inset-0 w-full h-full object-cover opacity-50 scale-105 transition-transform duration-[20s] hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-slate-900/50 to-slate-900/30 mix-blend-multiply"></div>
            
            <div class="relative z-10 p-16 w-full max-w-2xl text-white flex flex-col justify-between h-full py-20">
                <div>
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-8 border border-white/10 overflow-hidden shadow-lg">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo HIMAFI" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold mb-4 leading-tight tracking-tight">Bergabung Bersama <br>Keluarga HIMAFI</h2>
                    <p class="text-slate-300 text-lg font-light leading-relaxed max-w-md">
                        Daftarkan diri Anda untuk mengakses layanan akademik dan kemahasiswaan Kabinet <span class="text-cyan-400 font-semibold">Arunika Swakarsa</span>.
                    </p>
                </div>
                <div class="flex gap-4 text-sm text-slate-400 font-medium">
                    <span>© 2026 HIMAFI UNUD</span>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-6 md:p-8 relative h-full">
            
            <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-all group z-20">
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
                </div>
                <span class="font-medium text-sm">Kembali</span>
            </a>

            <div class="w-full h-full overflow-y-auto no-scrollbar pt-16 pb-10 px-2 flex justify-center">
                <div class="w-full max-w-md animate-fade-in-up">
                    
                    <div class="mb-8 text-center lg:text-left">
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">Buat Akun Baru</h1>
                        <p class="text-slate-500">Lengkapi data di bawah ini untuk mendaftar.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf 
                        
                        <div class="p-1 bg-slate-100 rounded-xl flex">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="role_register" value="mahasiswa" class="peer sr-only" checked onclick="toggleRole(true)">
                                <div class="text-center py-2.5 rounded-lg text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-blue-600 peer-checked:shadow-sm transition-all">
                                    Mahasiswa UNUD
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="role_register" value="eksternal" class="peer sr-only" onclick="toggleRole(false)">
                                <div class="text-center py-2.5 rounded-lg text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-blue-600 peer-checked:shadow-sm transition-all">
                                    Umum / Eksternal
                                </div>
                            </label>
                        </div>

                        <div class="space-y-1">
                            <label for="name" class="text-sm font-semibold text-slate-700 ml-1">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="far fa-user text-slate-400"></i>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('name') border-red-500 @enderror"
                                    placeholder="Nama Lengkap" required autofocus>
                            </div>
                            @error('name') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="text-sm font-semibold text-slate-700 ml-1">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="far fa-envelope text-slate-400"></i>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('email') border-red-500 @enderror"
                                    placeholder="email@contoh.com" required>
                            </div>
                            @error('email') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div id="student-fields" class="space-y-5 transition-all duration-300">
                            <div class="space-y-1">
                                <label for="nim" class="text-sm font-semibold text-slate-700 ml-1">NIM</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-slate-400"></i>
                                    </div>
                                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}"
                                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('nim') border-red-500 @enderror"
                                        placeholder="Nomor Induk Mahasiswa">
                                </div>
                                @error('nim') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="angkatan" class="text-sm font-semibold text-slate-700 ml-1">Angkatan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-graduation-cap text-slate-400"></i>
                                    </div>
                                    <select id="angkatan" name="angkatan" 
                                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('angkatan') border-red-500 @enderror">
                                        <option value="" disabled selected>Pilih angkatan</option>
                                        @for($year = date('Y'); $year >= 2015; $year--)
                                            <option value="{{ $year }}" {{ old('angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('angkatan') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Bukti Kartu Tanda Mahasiswa (KTM)</label>
                                <div class="relative">
                                    <input type="file" id="ktm" name="ktm" 
                                        accept=".jpg,.jpeg,.png,.pdf"
                                        class="hidden"
                                        onchange="handleFileSelect(this)">
                                    <label for="ktm" id="file-input-label" class="file-input-label">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                                <i class="fas fa-cloud-upload-alt text-blue-500"></i>
                                            </div>
                                            <div class="text-left w-full overflow-hidden">
                                                <span class="text-sm font-medium text-slate-700 truncate block max-w-[200px]" id="file-name">Klik untuk upload file</span>
                                                <span class="text-xs text-slate-500">Max 2MB (JPG/PNG/PDF)</span>
                                            </div>
                                        </div>
                                        <div class="text-slate-400">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </label>
                                </div>
                                @error('ktm') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label for="birth_date" class="text-sm font-semibold text-slate-700 ml-1">Tanggal Lahir</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-birthday-cake text-slate-400"></i>
                                </div>
                                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                                    class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('birth_date') border-red-500 @enderror"
                                    required>
                            </div>
                            @error('birth_date') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="whatsapp" class="text-sm font-semibold text-slate-700 ml-1">Nomor WhatsApp</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fab fa-whatsapp text-slate-400"></i>
                                </div>
                                <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                                    class="glass-input w-full pl-11 pr-4 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('whatsapp') border-red-500 @enderror"
                                    placeholder="Contoh: 081234567890" required>
                            </div>
                            @error('whatsapp') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="password" class="text-sm font-semibold text-slate-700 ml-1">Kata Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="glass-input w-full pl-11 pr-12 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium @error('password') border-red-500 @enderror"
                                    placeholder="Minimal 8 karakter" required>
                                <button type="button" onclick="togglePass('password', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            @error('password') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-sm font-semibold text-slate-700 ml-1">Konfirmasi Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="glass-input w-full pl-11 pr-12 py-3 rounded-xl outline-none text-slate-800 placeholder-slate-400 font-medium"
                                    placeholder="Ulangi kata sandi" required>
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full mt-2 relative overflow-hidden bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition-all duration-300 transform active:scale-[0.98] shadow-lg shadow-slate-900/20 group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Daftar Sekarang <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>

                    </form>

                    <p class="mt-8 text-center text-sm text-slate-500">
                        Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">Masuk disini</a>
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

        // Custom File Input Handler
        function handleFileSelect(input) {
            const label = document.getElementById('file-input-label');
            const fileName = document.getElementById('file-name');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileName.textContent = file.name;
                label.classList.add('has-file');
            } else {
                fileName.textContent = 'Klik untuk upload file';
                label.classList.remove('has-file');
            }
        }

        // Toggle Role Logic (Mahasiswa vs Eksternal)
        function toggleRole(isMahasiswa) {
            const container = document.getElementById('student-fields');
            const nim = document.getElementById('nim');
            const angkatan = document.getElementById('angkatan');
            const ktm = document.getElementById('ktm');

            if (isMahasiswa) {
                // Show Fields
                container.classList.remove('hidden');
                container.classList.remove('opacity-0');
                container.classList.add('opacity-100');
                
                // Add Required
                nim.required = true;
                angkatan.required = true;
                ktm.required = true;
            } else {
                // Hide Fields
                container.classList.add('hidden');
                container.classList.remove('opacity-100');
                container.classList.add('opacity-0');

                // Remove Required
                nim.required = false;
                angkatan.required = false;
                ktm.required = false;
                
                // Clear Values if switched
                nim.value = '';
                angkatan.selectedIndex = 0;
            }
        }

        // Initialize Role State on Load (in case of old input or default)
        document.addEventListener('DOMContentLoaded', function() {
            const isStudent = document.querySelector('input[name="role_register"][value="mahasiswa"]').checked;
            toggleRole(isStudent);
        });
    </script>
</body>
</html>