<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Tanda Tangan Digital - HIMAFI UNUD</title>
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
        
        /* Custom styles untuk form permintaan TTD */
        .form-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .form-container:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
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
            min-height: 120px;
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
        
        .file-drop-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        }
        
        .file-drop-area.dragover {
            border-color: #3b82f6;
            background: linear-gradient(to bottom right, #eff6ff, #dbeafe);
        }
        
        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            margin-top: 0.75rem;
            transition: all 0.3s ease;
        }
        
        .file-item:hover {
            background: #f9fafb;
        }
        
        .file-item.error {
            border-color: #ef4444;
            background: #fef2f2;
        }
        
        .progress-bar {
            width: 100%;
            height: 0.5rem;
            background: #e5e7eb;
            border-radius: 9999px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #3b82f6, #06b6d4);
            border-radius: 9999px;
            transition: width 0.3s ease;
        }
        
        .signer-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(to bottom right, #f0f9ff, #e0f2fe);
            border: 1px solid #bae6fd;
            color: #0369a1;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.875rem;
        }
        
        .signer-badge.pending {
            background: linear-gradient(to bottom right, #fef3c7, #fef9c3);
            border-color: #fde68a;
            color: #92400e;
        }
        
        .signer-badge.completed {
            background: linear-gradient(to bottom right, #d1fae5, #bbf7d0);
            border-color: #86efac;
            color: #065f46;
        }
        
        /* Animasi untuk steps */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease-out;
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
        
        /* Animasi untuk success */
        @keyframes successPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .success-pulse {
            animation: successPulse 0.6s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('layout.header')  

    <!-- Hero Section untuk Permintaan TTD -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">PERMINTAAN</span>
                <span class="block bg-gradient-to-r from-cyan-300 to-blue-200 bg-clip-text text-transparent mt-2">
                    TANDA TANGAN DIGITAL
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Ajukan permintaan tanda tangan digital untuk dokumen resmi HIMAFI UNUD dengan proses yang cepat, aman, dan terintegrasi.
            </p>
            <div class="flex items-center justify-center text-cyan-300">
                <i class="fas fa-pen-fancy mr-2"></i>
                <span>Cepat • Aman • Terverifikasi</span>
            </div>
        </div>
    </section>

    <!-- Main Form Content -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                
                <!-- Progress Steps -->
                <div class="mb-10">
                    <div class="flex justify-between items-center relative mb-8">
                        <!-- Garis penghubung -->
                        <div class="absolute top-1/2 left-0 right-0 h-1.5 bg-gray-200 -translate-y-1/2 z-0"></div>
                        <div id="progressLine" class="absolute top-1/2 left-0 h-1.5 bg-gradient-to-r from-cyan-500 to-blue-500 -translate-y-1/2 z-0 transition-all duration-500" style="width: 0%"></div>
                        
                        <!-- Step Indicators -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step1Indicator" class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white flex items-center justify-center font-bold text-lg">
                                1
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-900">Detail Dokumen</span>
                        </div>
                        
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step2Indicator" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg">
                                2
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-600">Unggah Dokumen</span>
                        </div>
                        
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step3Indicator" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg">
                                3
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-600">Penandatangan</span>
                        </div>
                        
                        <div class="relative z-10 flex flex-col items-center">
                            <div id="step4Indicator" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg">
                                4
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-600">Konfirmasi</span>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="form-container p-6 md:p-8">
                    
                    <!-- Step 1: Detail Dokumen -->
                    <div id="step1" class="form-step fade-in">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Detail Dokumen</h2>
                        <p class="text-gray-600 mb-8">Lengkapi informasi dasar tentang dokumen yang akan ditandatangani.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="documentTitle">
                                    Judul Dokumen <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="documentTitle" class="input-field" placeholder="Contoh: Surat Permohonan Penggunaan Laboratorium" required>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="documentType">
                                    Jenis Dokumen <span class="text-red-500">*</span>
                                </label>
                                <select id="documentType" class="select-field" required>
                                    <option value="" disabled selected>Pilih jenis dokumen</option>
                                    <option value="surat">Surat Resmi</option>
                                    <option value="proposal">Proposal Kegiatan</option>
                                    <option value="laporan">Laporan Kegiatan</option>
                                    <option value="permohonan">Surat Permohonan</option>
                                    <option value="pengantar">Surat Pengantar</option>
                                    <option value="sertifikat">Sertifikat</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="priorityLevel">
                                    Tingkat Prioritas <span class="text-blue-500">(Opsional)</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="radio-card" for="priorityLow">
                                        <div class="flex items-center">
                                            <input type="radio" id="priorityLow" name="priority" class="radio-input" value="low" checked>
                                            <div>
                                                <div class="font-medium text-gray-900">Rendah</div>
                                                <div class="text-sm text-gray-500">3-5 hari kerja</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="priorityMedium">
                                        <div class="flex items-center">
                                            <input type="radio" id="priorityMedium" name="priority" class="radio-input" value="medium">
                                            <div>
                                                <div class="font-medium text-gray-900">Sedang</div>
                                                <div class="text-sm text-gray-500">1-3 hari kerja</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="priorityHigh">
                                        <div class="flex items-center">
                                            <input type="radio" id="priorityHigh" name="priority" class="radio-input" value="high">
                                            <div>
                                                <div class="font-medium text-gray-900">Tinggi</div>
                                                <div class="text-sm text-gray-500">24 jam</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="description">
                                    Deskripsi Dokumen <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description" class="textarea-field" placeholder="Jelaskan tujuan dan isi dokumen secara singkat..." required></textarea>
                                <p class="text-sm text-gray-500 mt-1">Deskripsi akan membantu penanda tangan memahami konteks dokumen</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="deadline">
                                    Batas Waktu Penandatanganan <span class="text-blue-500">(Opsional)</span>
                                </label>
                                <input type="date" id="deadline" class="input-field" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ada batas waktu khusus</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-10">
                            <button id="nextStep1" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Unggah Dokumen -->
                    <div id="step2" class="form-step hidden fade-in">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Unggah Dokumen</h2>
                        <p class="text-gray-600 mb-8">Unggah file dokumen yang akan ditandatangani secara digital.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    File Dokumen <span class="text-red-500">*</span>
                                </label>
                                
                                <div id="fileDropArea" class="file-drop-area">
                                    <div class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-600 mb-2">Drag & drop file atau klik untuk memilih</p>
                                    <p class="text-sm text-gray-500 mb-4">Format yang didukung: PDF, DOC, DOCX, JPG, PNG</p>
                                    <p class="text-sm text-gray-500 mb-4">Ukuran maksimal: 10MB per file</p>
                                    <button type="button" id="selectFileBtn" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                                        <i class="fas fa-file-upload mr-2"></i> Pilih File
                                    </button>
                                    <input type="file" id="fileInput" class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                </div>
                                
                                <div id="fileList" class="mt-4"></div>
                            </div>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <i class="fas fa-lightbulb text-blue-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-blue-800 mb-1">Tips untuk dokumen terbaik:</h4>
                                        <ul class="text-blue-700 text-sm space-y-1">
                                            <li>• Gunakan format PDF untuk hasil terbaik</li>
                                            <li>• Pastikan dokumen sudah dalam bentuk final</li>
                                            <li>• Sertakan area kosong untuk tanda tangan dan stempel</li>
                                            <li>• Periksa kembali isi dokumen sebelum mengunggah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="additionalFiles">
                                    File Tambahan <span class="text-blue-500">(Opsional)</span>
                                </label>
                                <p class="text-sm text-gray-500 mb-4">Unggah file pendukung seperti lampiran, foto, atau dokumen referensi</p>
                                <input type="file" id="additionalFiles" class="input-field" multiple>
                                <div id="additionalFilesList" class="mt-3 space-y-2"></div>
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
                    
                    <!-- Step 3: Penandatangan -->
                    <div id="step3" class="form-step hidden fade-in">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Penandatangan</h2>
                        <p class="text-gray-600 mb-8">Tentukan siapa yang akan menandatangani dokumen Anda.</p>
                        
                        <div class="space-y-6">
                            <div id="signersContainer">
                                <!-- Signer 1 (Default) -->
                                <div class="border border-gray-200 rounded-xl p-6 mb-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="font-bold text-gray-900 text-lg">Penanda Tangan #1</h3>
                                        <span class="signer-badge">Utama</span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2" for="signer1Name">
                                                Nama Lengkap <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="signer1Name" class="input-field" placeholder="Nama penanda tangan" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2" for="signer1Position">
                                                Jabatan <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="signer1Position" class="input-field" placeholder="Contoh: Ketua HIMAFI" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2" for="signer1Email">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" id="signer1Email" class="input-field" placeholder="email@example.com" required>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-2" for="signer1Phone">
                                                Nomor WhatsApp <span class="text-blue-500">(Opsional)</span>
                                            </label>
                                            <input type="tel" id="signer1Phone" class="input-field" placeholder="+62 812-3456-7890">
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="block text-gray-700 font-medium mb-2" for="signer1Notes">
                                            Catatan untuk Penanda Tangan <span class="text-blue-500">(Opsional)</span>
                                        </label>
                                        <textarea id="signer1Notes" class="textarea-field" placeholder="Tulis pesan khusus untuk penanda tangan..."></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="button" id="addSignerBtn" class="border-2 border-dashed border-gray-300 text-gray-600 px-6 py-4 rounded-xl font-medium hover:border-blue-400 hover:text-blue-600 transition w-full">
                                    <i class="fas fa-user-plus mr-2"></i> Tambah Penanda Tangan Lain
                                </button>
                                <p class="text-sm text-gray-500 mt-2">Maksimal 5 penanda tangan per dokumen</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="signingOrder">
                                    Urutan Penandatanganan
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="radio-card" for="orderParallel">
                                        <div class="flex items-center">
                                            <input type="radio" id="orderParallel" name="signingOrder" class="radio-input" value="parallel" checked>
                                            <div>
                                                <div class="font-medium text-gray-900">Paralel (Serentak)</div>
                                                <div class="text-sm text-gray-500">Semua penanda tangan dapat menandatangani bersamaan</div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-card" for="orderSequential">
                                        <div class="flex items-center">
                                            <input type="radio" id="orderSequential" name="signingOrder" class="radio-input" value="sequential">
                                            <div>
                                                <div class="font-medium text-gray-900">Berurutan</div>
                                                <div class="text-sm text-gray-500">Penanda tangan berikutnya menunggu yang sebelumnya</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="bg-purple-50 border border-purple-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-purple-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-purple-800 mb-1">Informasi Penting:</h4>
                                        <ul class="text-purple-700 text-sm space-y-1">
                                            <li>• Setiap penanda tangan akan menerima email pemberitahuan</li>
                                            <li>• Penanda tangan dapat menolak atau menerima permintaan</li>
                                            <li>• Anda akan menerima notifikasi saat dokumen sudah ditandatangani</li>
                                            <li>• Dokumen yang sudah ditandatangani akan tersedia di dashboard Anda</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-10">
                            <button id="prevStep3" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button id="nextStep3" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Lanjut <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Konfirmasi -->
                    <div id="step4" class="form-step hidden fade-in">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Konfirmasi Permintaan</h2>
                        <p class="text-gray-600 mb-8">Periksa kembali semua informasi sebelum mengirim permintaan.</p>
                        
                        <div class="space-y-8">
                            <!-- Summary Card -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">Ringkasan Permintaan</h3>
                                
                                <div class="space-y-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <h4 class="font-medium text-gray-500 text-sm">Judul Dokumen</h4>
                                            <p id="confirmTitle" class="font-medium text-gray-900">-</p>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-500 text-sm">Jenis Dokumen</h4>
                                            <p id="confirmType" class="font-medium text-gray-900">-</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Deskripsi</h4>
                                        <p id="confirmDescription" class="font-medium text-gray-900">-</p>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <h4 class="font-medium text-gray-500 text-sm">Prioritas</h4>
                                            <p id="confirmPriority" class="font-medium text-gray-900">-</p>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-500 text-sm">File Dokumen</h4>
                                            <p id="confirmFile" class="font-medium text-gray-900">-</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Penanda Tangan</h4>
                                        <div id="confirmSigners" class="space-y-3 mt-2">
                                            <!-- Signers will be added here dynamically -->
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm">Urutan Penandatanganan</h4>
                                        <p id="confirmOrder" class="font-medium text-gray-900">-</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Notifications Settings -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Pengaturan Notifikasi</h3>
                                
                                <div class="space-y-4">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" id="notifyEmail" class="checkbox-input mt-0.5" checked>
                                        <div>
                                            <span class="font-medium text-gray-900">Email Notifikasi</span>
                                            <p class="text-sm text-gray-500 mt-1">Kirim notifikasi via email saat dokumen ditandatangani atau ada pembaruan status.</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" id="notifyWhatsApp" class="checkbox-input mt-0.5">
                                        <div>
                                            <span class="font-medium text-gray-900">WhatsApp Notifikasi</span>
                                            <p class="text-sm text-gray-500 mt-1">Kirim notifikasi via WhatsApp untuk informasi penting.</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" id="reminderSigners" class="checkbox-input mt-0.5" checked>
                                        <div>
                                            <span class="font-medium text-gray-900">Pengingat Otomatis</span>
                                            <p class="text-sm text-gray-500 mt-1">Kirim pengingat otomatis kepada penanda tangan yang belum merespon setelah 24 jam.</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Terms and Conditions -->
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-yellow-800 mb-1">Ketentuan Penggunaan</h4>
                                        <ul class="text-yellow-700 text-sm space-y-1">
                                            <li>• Dokumen yang dikirim harus sesuai dengan aturan dan kebijakan HIMAFI UNUD</li>
                                            <li>• Tanda tangan digital memiliki kekuatan hukum yang sama dengan tanda tangan manual</li>
                                            <li>• Proses penandatanganan dapat memakan waktu 1-5 hari kerja tergantung prioritas</li>
                                            <li>• Anda bertanggung jawab penuh atas isi dokumen yang dikirimkan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-8">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox" id="agreeTerms" class="checkbox-input mt-0.5">
                                    <div>
                                        <span class="font-medium text-gray-900">Saya menyetujui ketentuan di atas</span>
                                        <p class="text-sm text-gray-500 mt-1">Dengan mencentang ini, saya menyatakan bahwa semua informasi yang saya berikan adalah benar dan saya bertanggung jawab penuh atas dokumen yang saya kirimkan.</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-10">
                            <button id="prevStep4" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button id="submitRequest" class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Permintaan
                            </button>
                        </div>
                    </div>
                    
                    <!-- Success Message -->
                    <div id="successMessage" class="hidden text-center py-10 fade-in">
                        <div class="mb-6">
                            <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 success-pulse">
                                <i class="fas fa-check text-white text-4xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-3">Permintaan Berhasil Dikirim!</h2>
                            <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                                Permintaan tanda tangan digital Anda telah tercatat dan sedang diproses. Anda akan menerima notifikasi via email dalam beberapa menit.
                            </p>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 max-w-lg mx-auto mb-8">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-medium text-blue-800 mb-2">Informasi Penting:</h4>
                                        <ul class="text-blue-700 text-sm space-y-2">
                                            <li class="flex items-start">
                                                <i class="fas fa-clock mt-0.5 mr-2 text-xs"></i>
                                                <span>Nomor Permintaan: <strong id="requestNumber" class="font-mono">HMF-TTD-2025-001567</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope mt-0.5 mr-2 text-xs"></i>
                                                <span>Email konfirmasi telah dikirim ke alamat email Anda.</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-history mt-0.5 mr-2 text-xs"></i>
                                                <span>Anda dapat melacak status permintaan di halaman <a href="dashboard.html" class="text-blue-600 hover:underline font-medium">Dashboard</a>.</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-bell mt-0.5 mr-2 text-xs"></i>
                                                <span>Notifikasi akan dikirim saat dokumen sudah ditandatangani.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button id="newRequestBtn" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-plus mr-2"></i> Permintaan Baru
                                </button>
                                <a href="dashboard.html" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold text-center hover:bg-gray-300 transition-all duration-300">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Ke Dashboard
                                </a>
                                <a href="verifikasi.html" class="border-2 border-blue-500 text-blue-600 px-8 py-3 rounded-full font-semibold text-center hover:bg-blue-50 transition-all duration-300">
                                    <i class="fas fa-search mr-2"></i> Verifikasi TTD
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Proses Cepat</h4>
                        <p class="text-gray-600 text-sm">Permintaan tanda tangan digital diproses dalam 1-5 hari kerja tergantung prioritas.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-emerald-50 to-green-50 border border-emerald-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-emerald-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Keamanan Terjamin</h4>
                        <p class="text-gray-600 text-sm">Dokumen dilindungi dengan enkripsi end-to-end dan sertifikat digital resmi.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-history text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Pelacakan Real-time</h4>
                        <p class="text-gray-600 text-sm">Pantau status permintaan Anda secara real-time melalui dashboard online.</p>
                    </div>
                </div>
                
                <!-- FAQ Section -->
                <div class="mt-12 document-container p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Pertanyaan yang Sering Diajukan</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Berapa lama proses penandatanganan digital?</h4>
                            <p class="text-gray-600">Proses biasanya memakan waktu 1-5 hari kerja, tergantung pada prioritas permintaan dan ketersediaan penanda tangan.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Apakah tanda tangan digital sah secara hukum?</h4>
                            <p class="text-gray-600">Ya, tanda tangan digital dari HIMAFI UNUD memiliki kekuatan hukum yang sama dengan tanda tangan basah sesuai dengan peraturan perundang-undangan yang berlaku.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Dokumen apa saja yang bisa ditandatangani?</h4>
                            <p class="text-gray-600">Semua dokumen resmi HIMAFI UNUD seperti surat, proposal, laporan, sertifikat, dan dokumen administratif lainnya.</p>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Bagaimana jika penanda tangan menolak permintaan?</h4>
                            <p class="text-gray-600">Anda akan menerima notifikasi penolakan beserta alasannya. Anda dapat mengajukan permintaan ulang dengan dokumen yang sudah diperbaiki.</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                            <i class="fas fa-question-circle mr-2"></i> Lihat FAQ Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layout.footer')

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
            const step4 = document.getElementById('step4');
            const successMessage = document.getElementById('successMessage');
            
            // Step indicators
            const step1Indicator = document.getElementById('step1Indicator');
            const step2Indicator = document.getElementById('step2Indicator');
            const step3Indicator = document.getElementById('step3Indicator');
            const step4Indicator = document.getElementById('step4Indicator');
            const progressLine = document.getElementById('progressLine');
            
            // Navigation buttons
            const nextStep1Btn = document.getElementById('nextStep1');
            const prevStep2Btn = document.getElementById('prevStep2');
            const nextStep2Btn = document.getElementById('nextStep2');
            const prevStep3Btn = document.getElementById('prevStep3');
            const nextStep3Btn = document.getElementById('nextStep3');
            const prevStep4Btn = document.getElementById('prevStep4');
            const submitBtn = document.getElementById('submitRequest');
            const newRequestBtn = document.getElementById('newRequestBtn');
            
            // Form input elements
            const documentTitle = document.getElementById('documentTitle');
            const documentType = document.getElementById('documentType');
            const description = document.getElementById('description');
            const deadline = document.getElementById('deadline');
            const priorityRadios = document.querySelectorAll('input[name="priority"]');
            const fileInput = document.getElementById('fileInput');
            const fileDropArea = document.getElementById('fileDropArea');
            const selectFileBtn = document.getElementById('selectFileBtn');
            const fileList = document.getElementById('fileList');
            const addSignerBtn = document.getElementById('addSignerBtn');
            const signersContainer = document.getElementById('signersContainer');
            const orderRadios = document.querySelectorAll('input[name="signingOrder"]');
            const agreeTerms = document.getElementById('agreeTerms');
            
            // Confirmation elements
            const confirmTitle = document.getElementById('confirmTitle');
            const confirmType = document.getElementById('confirmType');
            const confirmDescription = document.getElementById('confirmDescription');
            const confirmPriority = document.getElementById('confirmPriority');
            const confirmFile = document.getElementById('confirmFile');
            const confirmSigners = document.getElementById('confirmSigners');
            const confirmOrder = document.getElementById('confirmOrder');
            const requestNumber = document.getElementById('requestNumber');
            
            let currentStep = 1;
            let signerCount = 1;
            let uploadedFile = null;
            let uploadedAdditionalFiles = [];
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'ttd-request.html') {
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
                        if (link.getAttribute('href') === 'ttd-request.html') {
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
            
            // File upload functionality
            selectFileBtn.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', handleFileSelect);
            
            // Drag and drop functionality
            fileDropArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                fileDropArea.classList.add('dragover');
            });
            
            fileDropArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                fileDropArea.classList.remove('dragover');
            });
            
            fileDropArea.addEventListener('drop', function(e) {
                e.preventDefault();
                fileDropArea.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileSelect();
                }
            });
            
            function handleFileSelect() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    
                    // Check file size (max 10MB)
                    if (file.size > 10 * 1024 * 1024) {
                        showNotification('File terlalu besar. Maksimal ukuran file adalah 10MB.', 'error');
                        return;
                    }
                    
                    // Check file type
                    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
                    if (!allowedTypes.includes(file.type)) {
                        showNotification('Format file tidak didukung. Gunakan PDF, DOC, DOCX, JPG, atau PNG.', 'error');
                        return;
                    }
                    
                    uploadedFile = file;
                    displayFileInfo(file);
                    
                    showNotification('File berhasil diunggah!', 'success');
                }
            }
            
            function displayFileInfo(file) {
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                const fileType = getFileType(file.type);
                
                fileList.innerHTML = `
                    <div class="file-item">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center mr-4">
                                <i class="fas fa-file-${fileType.icon} text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 truncate max-w-xs">${file.name}</p>
                                <p class="text-sm text-gray-500">${fileType.name} • ${fileSize} MB</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                Siap
                            </span>
                            <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
            }
            
            function getFileType(mimeType) {
                const types = {
                    'application/pdf': { name: 'PDF', icon: 'pdf' },
                    'application/msword': { name: 'DOC', icon: 'word' },
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': { name: 'DOCX', icon: 'word' },
                    'image/jpeg': { name: 'JPG', icon: 'image' },
                    'image/png': { name: 'PNG', icon: 'image' }
                };
                return types[mimeType] || { name: 'File', icon: 'alt' };
            }
            
            window.removeFile = function() {
                uploadedFile = null;
                fileList.innerHTML = '';
                fileInput.value = '';
            };
            
            // Add signer functionality
            addSignerBtn.addEventListener('click', function() {
                if (signerCount >= 5) {
                    showNotification('Maksimal 5 penanda tangan per dokumen.', 'info');
                    return;
                }
                
                signerCount++;
                
                const signerDiv = document.createElement('div');
                signerDiv.className = 'border border-gray-200 rounded-xl p-6 mb-4 relative';
                signerDiv.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-gray-900 text-lg">Penanda Tangan #${signerCount}</h3>
                        <span class="signer-badge pending">Tambahan</span>
                        ${signerCount > 1 ? '<button type="button" class="text-red-500 hover:text-red-700 remove-signer"><i class="fas fa-times"></i></button>' : ''}
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="signer${signerCount}Name">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="signer${signerCount}Name" class="input-field signer-input" placeholder="Nama penanda tangan" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="signer${signerCount}Position">
                                Jabatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="signer${signerCount}Position" class="input-field signer-input" placeholder="Contoh: Sekretaris HIMAFI" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="signer${signerCount}Email">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="signer${signerCount}Email" class="input-field signer-input" placeholder="email@example.com" required>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="signer${signerCount}Phone">
                                Nomor WhatsApp <span class="text-blue-500">(Opsional)</span>
                            </label>
                            <input type="tel" id="signer${signerCount}Phone" class="input-field signer-input" placeholder="+62 812-3456-7890">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-gray-700 font-medium mb-2" for="signer${signerCount}Notes">
                            Catatan untuk Penanda Tangan <span class="text-blue-500">(Opsional)</span>
                        </label>
                        <textarea id="signer${signerCount}Notes" class="textarea-field signer-input" placeholder="Tulis pesan khusus untuk penanda tangan..."></textarea>
                    </div>
                `;
                
                signersContainer.appendChild(signerDiv);
                
                // Add event listener to remove button
                const removeBtn = signerDiv.querySelector('.remove-signer');
                if (removeBtn) {
                    removeBtn.addEventListener('click', function() {
                        signerDiv.remove();
                        signerCount--;
                        updateSignerNumbers();
                    });
                }
                
                // Update signer count display
                if (signerCount >= 5) {
                    addSignerBtn.disabled = true;
                    addSignerBtn.innerHTML = '<i class="fas fa-ban mr-2"></i> Maksimal 5 Penanda Tangan';
                }
            });
            
            function updateSignerNumbers() {
                const signerDivs = document.querySelectorAll('#signersContainer > div');
                signerCount = signerDivs.length;
                
                signerDivs.forEach((div, index) => {
                    const title = div.querySelector('h3');
                    title.textContent = `Penanda Tangan #${index + 1}`;
                    
                    // Update input IDs
                    const inputs = div.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        const oldId = input.id;
                        const newId = oldId.replace(/signer\d+/, `signer${index + 1}`);
                        input.id = newId;
                    });
                    
                    // Update labels
                    const labels = div.querySelectorAll('label');
                    labels.forEach(label => {
                        const oldFor = label.getAttribute('for');
                        if (oldFor) {
                            const newFor = oldFor.replace(/signer\d+/, `signer${index + 1}`);
                            label.setAttribute('for', newFor);
                        }
                    });
                });
                
                // Re-enable add button if needed
                if (signerCount < 5) {
                    addSignerBtn.disabled = false;
                    addSignerBtn.innerHTML = '<i class="fas fa-user-plus mr-2"></i> Tambah Penanda Tangan Lain';
                }
            }
            
            // Radio card selection
            document.querySelectorAll('.radio-card').forEach(card => {
                card.addEventListener('click', function() {
                    const radioInput = this.querySelector('.radio-input');
                    const name = radioInput.getAttribute('name');
                    
                    // Remove selected class from all cards with same name
                    document.querySelectorAll(`.radio-card input[name="${name}"]`).forEach(input => {
                        input.closest('.radio-card').classList.remove('selected');
                    });
                    
                    // Add selected class to clicked card
                    radioInput.checked = true;
                    this.classList.add('selected');
                });
            });
            
            // Initialize radio card selections
            document.querySelectorAll('.radio-card input:checked').forEach(input => {
                input.closest('.radio-card').classList.add('selected');
            });
            
            // Terms agreement toggle
            agreeTerms.addEventListener('change', function() {
                submitBtn.disabled = !this.checked;
            });
            
            // Form step navigation
            function goToStep(step) {
                // Hide all steps
                step1.classList.add('hidden');
                step2.classList.add('hidden');
                step3.classList.add('hidden');
                step4.classList.add('hidden');
                successMessage.classList.add('hidden');
                
                // Update current step
                currentStep = step;
                
                // Update progress line
                progressLine.style.width = `${(step - 1) * 33.33}%`;
                
                // Update step indicators
                step1Indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg';
                step2Indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg';
                step3Indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg';
                step4Indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg';
                
                if (step === 1) {
                    step1.classList.remove('hidden');
                    step1Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step2Indicator.classList.add('bg-gray-200', 'text-gray-500');
                    step3Indicator.classList.add('bg-gray-200', 'text-gray-500');
                    step4Indicator.classList.add('bg-gray-200', 'text-gray-500');
                } else if (step === 2) {
                    // Validate step 1 before proceeding
                    if (!validateStep1()) {
                        alert('Mohon lengkapi semua field yang wajib diisi pada langkah 1.');
                        return;
                    }
                    
                    step2.classList.remove('hidden');
                    step1Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step2Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step3Indicator.classList.add('bg-gray-200', 'text-gray-500');
                    step4Indicator.classList.add('bg-gray-200', 'text-gray-500');
                } else if (step === 3) {
                    // Validate step 2 before proceeding
                    if (!validateStep2()) {
                        alert('Mohon unggah file dokumen terlebih dahulu.');
                        return;
                    }
                    
                    step3.classList.remove('hidden');
                    step1Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step2Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step3Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step4Indicator.classList.add('bg-gray-200', 'text-gray-500');
                } else if (step === 4) {
                    // Validate step 3 before proceeding
                    if (!validateStep3()) {
                        alert('Mohon lengkapi informasi penanda tangan.');
                        return;
                    }
                    
                    // Update confirmation data
                    updateConfirmationData();
                    
                    step4.classList.remove('hidden');
                    step1Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step2Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step3Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                    step4Indicator.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white');
                }
                
                // Scroll to top of form
                document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            function validateStep1() {
                if (!documentTitle.value.trim()) return false;
                if (!documentType.value) return false;
                if (!description.value.trim()) return false;
                
                return true;
            }
            
            function validateStep2() {
                if (!uploadedFile) return false;
                return true;
            }
            
            function validateStep3() {
                // Check all signers have required fields
                const signerInputs = document.querySelectorAll('.signer-input[required]');
                for (let input of signerInputs) {
                    if (!input.value.trim()) return false;
                    
                    // Validate email format
                    if (input.type === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value.trim())) return false;
                    }
                }
                
                return true;
            }
            
            function updateConfirmationData() {
                confirmTitle.textContent = documentTitle.value;
                
                const typeOption = documentType.options[documentType.selectedIndex];
                confirmType.textContent = typeOption ? typeOption.text : '-';
                
                confirmDescription.textContent = description.value;
                
                const priority = document.querySelector('input[name="priority"]:checked');
                confirmPriority.textContent = priority ? getPriorityText(priority.value) : '-';
                
                confirmFile.textContent = uploadedFile ? uploadedFile.name : '-';
                
                // Update signers list
                confirmSigners.innerHTML = '';
                for (let i = 1; i <= signerCount; i++) {
                    const name = document.getElementById(`signer${i}Name`)?.value || '';
                    const position = document.getElementById(`signer${i}Position`)?.value || '';
                    
                    if (name && position) {
                        const signerDiv = document.createElement('div');
                        signerDiv.className = 'flex items-center justify-between p-3 bg-gray-100 rounded-lg';
                        signerDiv.innerHTML = `
                            <div>
                                <p class="font-medium text-gray-900">${name}</p>
                                <p class="text-sm text-gray-500">${position}</p>
                            </div>
                            <span class="signer-badge ${i === 1 ? '' : 'pending'}">
                                ${i === 1 ? 'Utama' : 'Tambahan'}
                            </span>
                        `;
                        confirmSigners.appendChild(signerDiv);
                    }
                }
                
                const order = document.querySelector('input[name="signingOrder"]:checked');
                confirmOrder.textContent = order ? getOrderText(order.value) : '-';
                
                // Generate random request number
                const randomNum = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
                requestNumber.textContent = `HMF-TTD-2025-${randomNum}`;
            }
            
            function getPriorityText(value) {
                switch(value) {
                    case 'low': return 'Rendah (3-5 hari kerja)';
                    case 'medium': return 'Sedang (1-3 hari kerja)';
                    case 'high': return 'Tinggi (24 jam)';
                    default: return '-';
                }
            }
            
            function getOrderText(value) {
                switch(value) {
                    case 'parallel': return 'Paralel (Serentak)';
                    case 'sequential': return 'Berurutan';
                    default: return '-';
                }
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
            
            nextStep3Btn.addEventListener('click', function() {
                goToStep(4);
            });
            
            prevStep4Btn.addEventListener('click', function() {
                goToStep(3);
            });
            
            // Submit form
            submitBtn.addEventListener('click', function() {
                if (!agreeTerms.checked) {
                    showNotification('Anda harus menyetujui ketentuan sebelum mengirim permintaan.', 'error');
                    return;
                }
                
                // Simulate form submission
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
                submitBtn.disabled = true;
                
                // Simulate API call delay
                setTimeout(function() {
                    // Hide step 4 and show success message
                    step4.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                    
                    // Scroll to success message
                    successMessage.scrollIntoView({ behavior: 'smooth' });
                    
                    showNotification('Permintaan tanda tangan digital berhasil dikirim!', 'success');
                }, 2000);
            });
            
            // New request button
            newRequestBtn.addEventListener('click', function() {
                // Reset form
                resetForm();
                
                // Go back to step 1
                successMessage.classList.add('hidden');
                goToStep(1);
            });
            
            function resetForm() {
                // Reset all form inputs
                documentTitle.value = '';
                documentType.value = '';
                description.value = '';
                deadline.value = '';
                
                // Reset radio buttons
                document.getElementById('priorityLow').checked = true;
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.classList.remove('selected');
                });
                document.querySelector('.radio-card').classList.add('selected');
                
                // Reset file upload
                uploadedFile = null;
                fileList.innerHTML = '';
                fileInput.value = '';
                
                // Reset signers (keep only first one)
                const signerDivs = document.querySelectorAll('#signersContainer > div');
                for (let i = 1; i < signerDivs.length; i++) {
                    signerDivs[i].remove();
                }
                signerCount = 1;
                
                // Reset signer inputs
                document.getElementById('signer1Name').value = '';
                document.getElementById('signer1Position').value = '';
                document.getElementById('signer1Email').value = '';
                document.getElementById('signer1Phone').value = '';
                document.getElementById('signer1Notes').value = '';
                
                // Reset order radio
                document.getElementById('orderParallel').checked = true;
                
                // Reset checkboxes
                document.getElementById('notifyEmail').checked = true;
                document.getElementById('notifyWhatsApp').checked = false;
                document.getElementById('reminderSigners').checked = true;
                agreeTerms.checked = false;
                submitBtn.disabled = true;
                
                // Reset progress
                progressLine.style.width = '0%';
                step1Indicator.className = 'w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white flex items-center justify-center font-bold text-lg';
                step2Indicator.className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg';
                step3Indicator.className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg';
                step4Indicator.className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg';
            }
            
            // Notification function
            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
                
                // Set styles based on type
                if (type === 'success') {
                    notification.className += ' bg-gradient-to-r from-emerald-500 to-green-500 text-white';
                } else if (type === 'info') {
                    notification.className += ' bg-gradient-to-r from-blue-500 to-cyan-500 text-white';
                } else if (type === 'error') {
                    notification.className += ' bg-gradient-to-r from-red-500 to-pink-500 text-white';
                }
                
                // Add icon based on type
                let icon = 'info-circle';
                if (type === 'success') icon = 'check-circle';
                if (type === 'error') icon = 'exclamation-circle';
                
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${icon} mr-3"></i>
                        <span>${message}</span>
                        <button class="ml-4 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                // Add to document
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                    notification.classList.add('translate-x-0');
                }, 10);
                
                // Remove after 5 seconds
                setTimeout(() => {
                    notification.classList.remove('translate-x-0');
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 5000);
            }
            
            // Set minimum date for deadline (tomorrow)
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            deadline.min = tomorrow.toISOString().split('T')[0];
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>