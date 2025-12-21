<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Aspirasi - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    <!-- Ikon untuk menu burger (dari Font Awesome via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan kelas gradient yang digunakan di kode asli */
        .bg-linear-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }
        .bg-linear-to-t {
            background-image: linear-gradient(to top, var(--tw-gradient-stops));
        }
        .bg-linear-to-br {
            background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
        }
        .bg-linear-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
        }
        
        #mainHeader {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        }
        
        #mainHeader.scrolled {
            backdrop-filter: blur(0);
            -webkit-backdrop-filter: blur(0);
        }
        
        /* Smooth transition untuk semua elemen header */
        #mainHeader * {
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }
        
        /* Custom styles untuk form */
        .form-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .form-card:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }
        
        .input-field {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .textarea-field {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            min-height: 150px;
            resize: vertical;
            transition: all 0.3s ease;
        }
        
        .textarea-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .select-field {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            background-color: white;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            transition: all 0.3s ease;
        }
        
        .select-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .radio-card {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1.25rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .radio-card:hover {
            border-color: #93c5fd;
            background-color: #f8fafc;
        }
        
        .radio-card.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .radio-input {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            margin-right: 0.75rem;
            position: relative;
            cursor: pointer;
        }
        
        .radio-input:checked {
            border-color: #3b82f6;
            background-color: #3b82f6;
        }
        
        .radio-input:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0.5rem;
            height: 0.5rem;
            background-color: white;
            border-radius: 50%;
        }
        
        .checkbox-input {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 0.375rem;
            margin-right: 0.75rem;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .checkbox-input:checked {
            border-color: #3b82f6;
            background-color: #3b82f6;
        }
        
        .checkbox-input:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.875rem;
            font-weight: bold;
        }
        
        .step-indicator {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.125rem;
            transition: all 0.3s ease;
        }
        
        .step-indicator.active {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
        }
        
        .step-indicator.completed {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }
        
        .step-indicator.inactive {
            background-color: #f3f4f6;
            color: #9ca3af;
        }
        
        /* Animasi untuk form steps */
        .form-step {
            transition: all 0.4s ease;
        }
        
        .form-step.hidden {
            display: none;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #0891b2, #2563eb);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #0e7490, #1d4ed8);
        }
        
        /* Animasi untuk success message */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('layout.header')

    <!-- Hero Section untuk Aspirasi -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-900 via-purple-800 to-indigo-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">RUANG ASPIRASI</span>
                <span class="block bg-gradient-to-r from-cyan-300 to-blue-200 bg-clip-text text-transparent mt-2">
                    HIMAFI UNUD
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Suara Anda berarti bagi kami. Sampaikan ide, kritik, dan saran untuk kemajuan HIMAFI dan jurusan Fisika. Setiap aspirasi akan didengar dan ditindaklanjuti.
            </p>
            <div class="flex items-center justify-center text-cyan-300">
                <i class="fas fa-comment-dots mr-2"></i>
                <span>Suara Mahasiswa, Langkah Perubahan</span>
            </div>
        </div>
    </section>

    <!-- Form Aspirasi Section -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                
                <!-- Progress Steps -->
                <div class="mb-12">
                    <div class="flex justify-between items-center relative mb-8">
                        <!-- Garis penghubung -->
                        <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
                        <div id="progressLine" class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-cyan-500 to-blue-500 -translate-y-1/2 z-0 transition-all duration-500" style="width: 0%"></div>
                        
                        <!-- Step 1 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step1Indicator" class="step-indicator active">
                                1
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-900">Identitas</span>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step2Indicator" class="step-indicator inactive">
                                2
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-600">Aspirasi</span>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step3Indicator" class="step-indicator inactive">
                                3
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-600">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="form-card p-6 md:p-10">
                    
                    <!-- Step 1: Identitas -->
                    <div id="step1" class="form-step">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Identitas Pengirim</h2>
                        <p class="text-gray-600 mb-8">Mohon lengkapi data diri Anda terlebih dahulu.</p>
                        
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="nama">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama" class="input-field" placeholder="Masukkan nama lengkap" required>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="nim">
                                        NIM <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nim" class="input-field" placeholder="Contoh: 2201234567" required>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="angkatan">
                                        Angkatan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="angkatan" class="select-field" required>
                                        <option value="" disabled selected>Pilih angkatan</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="email">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" class="input-field" placeholder="nama@email.com" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="noHp">
                                    Nomor WhatsApp <span class="text-blue-500">(Opsional)</span>
                                </label>
                                <input type="tel" id="noHp" class="input-field" placeholder="+62 812-3456-7890">
                                <p class="text-sm text-gray-500 mt-1">Berguna jika kami perlu menghubungi Anda untuk klarifikasi</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="status">
                                    Status di HIMAFI <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="radio-card" for="statusAnggota">
                                        <div class="flex items-center">
                                            <input type="radio" id="statusAnggota" name="status" class="radio-input" value="Anggota" checked>
                                            <div>
                                                <div class="font-medium text-gray-900">Anggota</div>
                                                <div class="text-sm text-gray-500">Mahasiswa Fisika biasa</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="statusPengurus">
                                        <div class="flex items-center">
                                            <input type="radio" id="statusPengurus" name="status" class="radio-input" value="Pengurus">
                                            <div>
                                                <div class="font-medium text-gray-900">Pengurus</div>
                                                <div class="text-sm text-gray-500">Aktif di kepengurusan</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="statusAlumni">
                                        <div class="flex items-center">
                                            <input type="radio" id="statusAlumni" name="status" class="radio-input" value="Alumni">
                                            <div>
                                                <div class="font-medium text-gray-900">Alumni</div>
                                                <div class="text-sm text-gray-500">Lulusan Fisika UNUD</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-10">
                            <button id="nextStep1" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Aspirasi -->
                    <div id="step2" class="form-step hidden">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Isi Aspirasi Anda</h2>
                        <p class="text-gray-600 mb-8">Silakan sampaikan aspirasi, kritik, saran, atau keluhan Anda.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="kategori">
                                    Kategori Aspirasi <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori" class="select-field" required>
                                    <option value="" disabled selected>Pilih kategori</option>
                                    <option value="akademik">Akademik & Kurikulum</option>
                                    <option value="fasilitas">Fasilitas & Sarana</option>
                                    <option value="organisasi">Organisasi & Kepengurusan</option>
                                    <option value="kegiatan">Kegiatan & Event</option>
                                    <option value="kesejahteraan">Kesejahteraan Mahasiswa</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="judul">
                                    Judul Aspirasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="judul" class="input-field" placeholder="Contoh: Usulan Penambahan Jam Praktikum" required>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="aspirasi">
                                    Isi Aspirasi <span class="text-red-500">*</span>
                                </label>
                                <textarea id="aspirasi" class="textarea-field" placeholder="Jelaskan aspirasi Anda secara detail... (Minimal 100 karakter)" required></textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-sm text-gray-500">Deskripsikan dengan jelas dan berikan solusi jika memungkinkan</p>
                                    <p id="charCount" class="text-sm text-gray-500">0/1000 karakter</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="prioritas">
                                    Tingkat Prioritas
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="radio-card" for="prioritasRendah">
                                        <div class="flex items-center">
                                            <input type="radio" id="prioritasRendah" name="prioritas" class="radio-input" value="rendah" checked>
                                            <div>
                                                <div class="font-medium text-gray-900">Rendah</div>
                                                <div class="text-sm text-gray-500">Saran perbaikan</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="prioritasSedang">
                                        <div class="flex items-center">
                                            <input type="radio" id="prioritasSedang" name="prioritas" class="radio-input" value="sedang">
                                            <div>
                                                <div class="font-medium text-gray-900">Sedang</div>
                                                <div class="text-sm text-gray-500">Kritik membangun</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="prioritasTinggi">
                                        <div class="flex items-center">
                                            <input type="radio" id="prioritasTinggi" name="prioritas" class="radio-input" value="tinggi">
                                            <div>
                                                <div class="font-medium text-gray-900">Tinggi</div>
                                                <div class="text-sm text-gray-500">Keluhan mendesak</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Lampiran (Opsional)
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-cyan-400 transition">
                                    <div class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-600 mb-2">Drag & drop file atau klik untuk mengunggah</p>
                                    <p class="text-sm text-gray-500 mb-4">Maksimal 5MB per file. Format: PDF, JPG, PNG, DOC</p>
                                    <button type="button" id="uploadBtn" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-full font-medium hover:bg-gray-200 transition">
                                        <i class="fas fa-plus mr-2"></i> Pilih File
                                    </button>
                                    <input type="file" id="fileInput" class="hidden" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <div id="fileList" class="mt-4 space-y-2"></div>
                                </div>
                            </div>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-blue-800 mb-1">Tips menulis aspirasi efektif:</h4>
                                        <ul class="text-blue-700 text-sm space-y-1">
                                            <li>• Gunakan bahasa yang sopan dan jelas</li>
                                            <li>• Jelaskan masalah secara spesifik dengan contoh</li>
                                            <li>• Berikan solusi atau alternatif jika memungkinkan</li>
                                            <li>• Fokus pada satu isu per aspirasi untuk memudahkan penanganan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-10">
                            <button id="prevStep2" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button id="nextStep2" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Konfirmasi -->
                    <div id="step3" class="form-step hidden">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Konfirmasi Aspirasi</h2>
                        <p class="text-gray-600 mb-8">Periksa kembali data yang telah Anda isi sebelum mengirim.</p>
                        
                        <div class="bg-gray-50 rounded-xl p-6 mb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">Ringkasan Aspirasi</h3>
                            
                            <div class="space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Nama Lengkap</h4>
                                        <p id="confirmNama" class="font-medium text-gray-900">-</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">NIM</h4>
                                        <p id="confirmNim" class="font-medium text-gray-900">-</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Angkatan & Status</h4>
                                        <p id="confirmAngkatanStatus" class="font-medium text-gray-900">-</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Email</h4>
                                        <p id="confirmEmail" class="font-medium text-gray-900">-</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm">Kategori & Judul</h4>
                                    <p id="confirmKategoriJudul" class="font-medium text-gray-900">-</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm">Isi Aspirasi</h4>
                                    <p id="confirmAspirasi" class="font-medium text-gray-900">-</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm">Tingkat Prioritas</h4>
                                    <p id="confirmPrioritas" class="font-medium text-gray-900">-</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 mb-8">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-0.5"></i>
                                <div>
                                    <h4 class="font-medium text-yellow-800 mb-1">Ketentuan Pengiriman Aspirasi</h4>
                                    <ul class="text-yellow-700 text-sm space-y-1">
                                        <li>• Aspirasi akan diproses maksimal 7 hari kerja setelah dikirim</li>
                                        <li>• Kami akan mengirimkan notifikasi via email tentang status aspirasi Anda</li>
                                        <li>• Setiap aspirasi akan ditindaklanjuti sesuai dengan tingkat prioritasnya</li>
                                        <li>• Aspirasi yang mengandung unsur SARA atau tidak etis tidak akan diproses</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-8">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" id="agreeTerms" class="checkbox-input mt-0.5">
                                <div>
                                    <span class="font-medium text-gray-900">Saya menyetujui ketentuan di atas</span>
                                    <p class="text-sm text-gray-500 mt-1">Dengan mencentang ini, saya menyatakan bahwa data yang saya berikan adalah benar dan siap bertanggung jawab atas isi aspirasi yang saya sampaikan.</p>
                                </div>
                            </label>
                        </div>
                        
                        <div class="flex justify-between mt-10">
                            <button id="prevStep3" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button id="submitAspirasi" class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Aspirasi
                            </button>
                        </div>
                    </div>
                    
                    <!-- Success Message -->
                    <div id="successMessage" class="hidden text-center py-10 fade-in-up">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-check text-white text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-3">Aspirasi Berhasil Dikirim!</h2>
                            <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                                Terima kasih atas partisipasi Anda. Aspirasi Anda telah tercatat dan akan segera diproses oleh tim HIMAFI UNUD.
                            </p>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 max-w-lg mx-auto mb-8">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-blue-800 mb-2">Informasi Penting:</h4>
                                        <ul class="text-blue-700 text-sm space-y-2">
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope mt-0.5 mr-2 text-xs"></i>
                                                <span>Anda akan menerima notifikasi via email dalam 1x24 jam tentang status aspirasi Anda.</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-clock mt-0.5 mr-2 text-xs"></i>
                                                <span>Proses penindaklanjutan akan dilakukan maksimal dalam 7 hari kerja.</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-history mt-0.5 mr-2 text-xs"></i>
                                                <span>Anda dapat melihat status aspirasi Anda di halaman "Lacak Aspirasi".</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button id="newAspirasi" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-plus mr-2"></i> Kirim Aspirasi Baru
                                </button>
                                <a href="index.html" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold text-center hover:bg-gray-300 transition-all duration-300">
                                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Tambahan -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Proses Cepat</h4>
                        <p class="text-gray-600 text-sm">Aspirasi akan diproses maksimal 7 hari kerja setelah dikirimkan.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Data Terjamin</h4>
                        <p class="text-gray-600 text-sm">Identitas pengirim dirahasiakan dan hanya digunakan untuk keperluan verifikasi.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-green-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Tindak Lanjut</h4>
                        <p class="text-gray-600 text-sm">Setiap aspirasi akan mendapatkan respon dan tindak lanjut sesuai prioritas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("layout.footer")

    <!-- Tombol Back to Top -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-blue-600 to-cyan-500 text-white rounded-full shadow-2xl hover:shadow-cyan-500/30 hover:scale-110 transition-all duration-300 z-40 hidden items-center justify-center text-2xl">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Skrip JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Header scroll effect
            const header = document.getElementById('mainHeader');
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const backToTopBtn = document.getElementById('backToTop');
            
            // Form elements
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step3 = document.getElementById('step3');
            const successMessage = document.getElementById('successMessage');
            
            // Step indicators
            const step1Indicator = document.getElementById('step1Indicator');
            const step2Indicator = document.getElementById('step2Indicator');
            const step3Indicator = document.getElementById('step3Indicator');
            const progressLine = document.getElementById('progressLine');
            
            // Navigation buttons
            const nextStep1Btn = document.getElementById('nextStep1');
            const prevStep2Btn = document.getElementById('prevStep2');
            const nextStep2Btn = document.getElementById('nextStep2');
            const prevStep3Btn = document.getElementById('prevStep3');
            const submitBtn = document.getElementById('submitAspirasi');
            const newAspirasiBtn = document.getElementById('newAspirasi');
            
            // Form input elements
            const namaInput = document.getElementById('nama');
            const nimInput = document.getElementById('nim');
            const angkatanSelect = document.getElementById('angkatan');
            const emailInput = document.getElementById('email');
            const statusRadios = document.querySelectorAll('input[name="status"]');
            const kategoriSelect = document.getElementById('kategori');
            const judulInput = document.getElementById('judul');
            const aspirasiTextarea = document.getElementById('aspirasi');
            const prioritasRadios = document.querySelectorAll('input[name="prioritas"]');
            const charCount = document.getElementById('charCount');
            const fileInput = document.getElementById('fileInput');
            const uploadBtn = document.getElementById('uploadBtn');
            const fileList = document.getElementById('fileList');
            const agreeTerms = document.getElementById('agreeTerms');
            
            // Confirmation elements
            const confirmNama = document.getElementById('confirmNama');
            const confirmNim = document.getElementById('confirmNim');
            const confirmAngkatanStatus = document.getElementById('confirmAngkatanStatus');
            const confirmEmail = document.getElementById('confirmEmail');
            const confirmKategoriJudul = document.getElementById('confirmKategoriJudul');
            const confirmAspirasi = document.getElementById('confirmAspirasi');
            const confirmPrioritas = document.getElementById('confirmPrioritas');
            
            let currentStep = 1;
            let selectedFiles = [];
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'aspirasi.html') {
                            link.classList.remove('text-white', 'border-cyan-300');
                            link.classList.add('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.remove('text-white/90', 'hover:text-white');
                            link.classList.add('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol masuk
                    const masukBtn = document.querySelector('nav.md\\:flex a:last-child');
                    if (masukBtn) {
                        masukBtn.classList.remove('from-cyan-500', 'to-blue-500', 'shadow-cyan-500/30');
                        masukBtn.classList.add('from-blue-600', 'to-cyan-500');
                    }
                    
                    // Update tombol mobile menu
                    if (menuBtn) {
                        menuBtn.classList.remove('text-white');
                        menuBtn.classList.add('text-gray-700');
                    }
                    
                } else {
                    // Saat di atas (posisi awal)
                    header.classList.add('bg-transparent');
                    header.classList.remove('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'aspirasi.html') {
                            link.classList.add('text-white', 'border-cyan-300');
                            link.classList.remove('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.add('text-white/90', 'hover:text-white');
                            link.classList.remove('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol masuk
                    const masukBtn = document.querySelector('nav.md\\:flex a:last-child');
                    if (masukBtn) {
                        masukBtn.classList.add('from-cyan-500', 'to-blue-500', 'shadow-cyan-500/30');
                        masukBtn.classList.remove('from-blue-600', 'to-cyan-500');
                    }
                    
                    // Update tombol mobile menu
                    if (menuBtn) {
                        menuBtn.classList.add('text-white');
                        menuBtn.classList.remove('text-gray-700');
                    }
                }
                
                // Back to Top Button visibility
                if (window.scrollY > 300) {
                    backToTopBtn.classList.remove('hidden');
                    backToTopBtn.classList.add('flex');
                } else {
                    backToTopBtn.classList.add('hidden');
                    backToTopBtn.classList.remove('flex');
                }
            }
            
            // Toggle Mobile Menu
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    const icon = menuBtn.querySelector('i');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.classList.contains('hidden') && 
                        !mobileMenu.contains(event.target) && 
                        !menuBtn.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        const icon = menuBtn.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }
            
            // Back to Top Button functionality
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            
            // Character counter for aspirasi textarea
            aspirasiTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = `${length}/1000 karakter`;
                
                if (length < 100) {
                    charCount.classList.add('text-red-500');
                    charCount.classList.remove('text-green-500');
                } else {
                    charCount.classList.remove('text-red-500');
                    charCount.classList.add('text-green-500');
                }
            });
            
            // Radio card selection
            document.querySelectorAll('.radio-card').forEach(card => {
                const radioInput = card.querySelector('.radio-input');
                
                card.addEventListener('click', function() {
                    const name = radioInput.getAttribute('name');
                    document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
                        input.closest('.radio-card').classList.remove('selected');
                    });
                    
                    radioInput.checked = true;
                    card.classList.add('selected');
                });
                
                if (radioInput.checked) {
                    card.classList.add('selected');
                }
            });
            
            // File upload functionality
            uploadBtn.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    
                    // Check file size (max 5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File terlalu besar. Maksimal ukuran file adalah 5MB.');
                        return;
                    }
                    
                    // Check file type
                    const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung. Gunakan PDF, JPG, PNG, atau DOC.');
                        return;
                    }
                    
                    selectedFiles.push(file);
                    updateFileList();
                    
                    // Reset file input
                    fileInput.value = '';
                }
            });
            
            function updateFileList() {
                fileList.innerHTML = '';
                
                selectedFiles.forEach((file, index) => {
                    const fileElement = document.createElement('div');
                    fileElement.className = 'flex items-center justify-between bg-gray-100 p-3 rounded-lg';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center';
                    
                    const fileIcon = document.createElement('i');
                    if (file.type.includes('image')) {
                        fileIcon.className = 'fas fa-image text-blue-500 mr-3';
                    } else if (file.type.includes('pdf')) {
                        fileIcon.className = 'fas fa-file-pdf text-red-500 mr-3';
                    } else {
                        fileIcon.className = 'fas fa-file-word text-blue-600 mr-3';
                    }
                    
                    const fileName = document.createElement('span');
                    fileName.className = 'text-sm text-gray-700 truncate max-w-xs';
                    fileName.textContent = file.name;
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'text-red-500 hover:text-red-700 ml-2';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.addEventListener('click', function() {
                        selectedFiles.splice(index, 1);
                        updateFileList();
                    });
                    
                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    fileElement.appendChild(fileInfo);
                    fileElement.appendChild(removeBtn);
                    fileList.appendChild(fileElement);
                });
            }
            
            // Form step navigation
            function goToStep(step) {
                // Hide all steps
                step1.classList.add('hidden');
                step2.classList.add('hidden');
                step3.classList.add('hidden');
                successMessage.classList.add('hidden');
                
                // Update current step
                currentStep = step;
                
                // Update progress line
                progressLine.style.width = `${(step - 1) * 50}%`;
                
                // Update step indicators
                step1Indicator.className = 'step-indicator';
                step2Indicator.className = 'step-indicator';
                step3Indicator.className = 'step-indicator';
                
                if (step === 1) {
                    step1.classList.remove('hidden');
                    step1Indicator.classList.add('active');
                    step2Indicator.classList.add('inactive');
                    step3Indicator.classList.add('inactive');
                } else if (step === 2) {
                    // Validate step 1 before proceeding
                    if (!validateStep1()) {
                        alert('Mohon lengkapi semua field yang wajib diisi pada langkah 1.');
                        return;
                    }
                    
                    step2.classList.remove('hidden');
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('active');
                    step3Indicator.classList.add('inactive');
                } else if (step === 3) {
                    // Validate step 2 before proceeding
                    if (!validateStep2()) {
                        alert('Mohon lengkapi semua field yang wajib diisi pada langkah 2.');
                        return;
                    }
                    
                    // Update confirmation data
                    updateConfirmationData();
                    
                    step3.classList.remove('hidden');
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('completed');
                    step3Indicator.classList.add('active');
                }
                
                // Scroll to top of form
                document.querySelector('.form-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            function validateStep1() {
                if (!namaInput.value.trim()) return false;
                if (!nimInput.value.trim()) return false;
                if (!angkatanSelect.value) return false;
                if (!emailInput.value.trim()) return false;
                if (!document.querySelector('input[name="status"]:checked')) return false;
                
                // Validate email format
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) return false;
                
                return true;
            }
            
            function validateStep2() {
                if (!kategoriSelect.value) return false;
                if (!judulInput.value.trim()) return false;
                if (!aspirasiTextarea.value.trim() || aspirasiTextarea.value.trim().length < 100) return false;
                if (!document.querySelector('input[name="prioritas"]:checked')) return false;
                
                return true;
            }
            
            function updateConfirmationData() {
                confirmNama.textContent = namaInput.value;
                confirmNim.textContent = nimInput.value;
                
                const angkatan = angkatanSelect.options[angkatanSelect.selectedIndex].text;
                const status = document.querySelector('input[name="status"]:checked').value;
                confirmAngkatanStatus.textContent = `${angkatan} - ${status}`;
                
                confirmEmail.textContent = emailInput.value;
                
                const kategori = kategoriSelect.options[kategoriSelect.selectedIndex].text;
                confirmKategoriJudul.textContent = `${kategori}: ${judulInput.value}`;
                
                // Truncate long aspirasi text
                const aspirasiText = aspirasiTextarea.value;
                confirmAspirasi.textContent = aspirasiText.length > 200 ? 
                    aspirasiText.substring(0, 200) + '...' : 
                    aspirasiText;
                
                const prioritas = document.querySelector('input[name="prioritas"]:checked').value;
                let prioritasText = '';
                switch(prioritas) {
                    case 'rendah': prioritasText = 'Rendah (Saran perbaikan)'; break;
                    case 'sedang': prioritasText = 'Sedang (Kritik membangun)'; break;
                    case 'tinggi': prioritasText = 'Tinggi (Keluhan mendesak)'; break;
                }
                confirmPrioritas.textContent = prioritasText;
            }
            
            // Step navigation event listeners
            nextStep1Btn.addEventListener('click', function() {
                goToStep(2);
            });
            
            prevStep2Btn.addEventListener('click', function() {
                goToStep(1);
            });
            
            nextStep2Btn.addEventListener('click', function() {
                goToStep(3);
            });
            
            prevStep3Btn.addEventListener('click', function() {
                goToStep(2);
            });
            
            // Terms agreement toggle
            agreeTerms.addEventListener('change', function() {
                submitBtn.disabled = !this.checked;
            });
            
            // Submit form
            submitBtn.addEventListener('click', function() {
                if (!agreeTerms.checked) {
                    alert('Anda harus menyetujui ketentuan sebelum mengirim aspirasi.');
                    return;
                }
                
                // Simulate form submission
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
                submitBtn.disabled = true;
                
                // Simulate API call delay
                setTimeout(function() {
                    // Hide step 3 and show success message
                    step3.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                    
                    // Reset form for new submission
                    resetForm();
                }, 1500);
            });
            
            // New aspirasi button
            newAspirasiBtn.addEventListener('click', function() {
                successMessage.classList.add('hidden');
                goToStep(1);
            });
            
            // Reset form function
            function resetForm() {
                // Reset all form inputs
                namaInput.value = '';
                nimInput.value = '';
                angkatanSelect.value = '';
                emailInput.value = '';
                
                // Reset radio buttons
                document.getElementById('statusAnggota').checked = true;
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.classList.remove('selected');
                });
                document.querySelector('.radio-card').classList.add('selected');
                
                kategoriSelect.value = '';
                judulInput.value = '';
                aspirasiTextarea.value = '';
                charCount.textContent = '0/1000 karakter';
                charCount.classList.remove('text-green-500', 'text-red-500');
                
                document.getElementById('prioritasRendah').checked = true;
                
                selectedFiles = [];
                updateFileList();
                
                agreeTerms.checked = false;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Aspirasi';
            }
            
            // Initialize radio card selections
            document.querySelectorAll('.radio-card').forEach(card => {
                const radioInput = card.querySelector('.radio-input');
                if (radioInput.checked) {
                    card.classList.add('selected');
                }
            });
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>