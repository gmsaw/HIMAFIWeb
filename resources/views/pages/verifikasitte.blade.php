<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Tanda Tangan Digital - HIMAFI UNUD</title>
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
        
        /* Custom styles untuk verification page */
        .verification-badge {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem 0.5rem 0.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .verification-badge::before {
            content: '';
            display: inline-block;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        
        .verification-badge.valid::before {
            background-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .verification-badge.invalid::before {
            background-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }
        
        .verification-badge.pending::before {
            background-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
        }
        
        .signature-canvas {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .document-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .document-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .info-card {
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
        }
        
        .qr-code {
            background: white;
            border-radius: 0.75rem;
            padding: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 2rem;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }
        
        .timeline-item:first-child::before {
            top: 50%;
        }
        
        .timeline-item:last-child::before {
            bottom: 50%;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            left: -0.25rem;
            top: 0.5rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background: white;
            border: 2px solid #3b82f6;
        }
        
        .timeline-item.completed::after {
            background: #3b82f6;
        }
        
        /* Animasi untuk verification success */
        @keyframes pulseSuccess {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }
            50% {
                box-shadow: 0 0 0 20px rgba(16, 185, 129, 0);
            }
        }
        
        .pulse-success {
            animation: pulseSuccess 2s infinite;
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
        
        /* Animasi untuk loading */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('layout.header')

    <!-- Hero Section untuk Verifikasi -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900 via-emerald-800 to-green-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1635070041078-e363dbe005cb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">VERIFIKASI</span>
                <span class="block bg-gradient-to-r from-emerald-300 to-green-200 bg-clip-text text-transparent mt-2">
                    TANDA TANGAN DIGITAL
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Validasi keaslian dan integritas dokumen digital dengan teknologi tanda tangan elektronik yang terenkripsi.
            </p>
            <div class="flex items-center justify-center text-emerald-300">
                <i class="fas fa-shield-alt mr-2"></i>
                <span>Terjamin • Terenkripsi • Terverifikasi</span>
            </div>
        </div>
    </section>

    <!-- Main Verification Content -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                
                <!-- Verification Status Card -->
                <div class="mb-10">
                    <div class="bg-gradient-to-r from-emerald-500 to-green-500 rounded-2xl p-8 text-white shadow-2xl">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="mb-6 md:mb-0">
                                <div class="flex items-center mb-4">
                                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4 pulse-success">
                                        <i class="fas fa-check-circle text-3xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl md:text-3xl font-bold">Tanda Tangan Digital Terverifikasi</h2>
                                        <p class="text-emerald-100">Status: Valid dan Sah</p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-4">
                                    <div class="bg-white/20 px-4 py-2 rounded-full">
                                        <span class="font-medium">ID Dokumen:</span>
                                        <span class="font-mono ml-2">HMF-2025-03-1567</span>
                                    </div>
                                    <div class="bg-white/20 px-4 py-2 rounded-full">
                                        <span class="font-medium">Hash:</span>
                                        <span class="font-mono ml-2">a1b2c3d4...z9</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center md:text-right">
                                <div class="inline-flex flex-col items-center">
                                    <div class="qr-code mb-3">
                                        <!-- QR Code Placeholder -->
                                        <div class="w-32 h-32 bg-gradient-to-br from-emerald-100 to-green-100 rounded flex items-center justify-center">
                                            <i class="fas fa-qrcode text-5xl text-emerald-600"></i>
                                        </div>
                                    </div>
                                    <p class="text-sm text-emerald-100">Scan untuk verifikasi cepat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Document Info -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Document Details Card -->
                        <div class="document-card p-6 md:p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Detail Dokumen</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm mb-1">Judul Permohonan</h4>
                                    <p class="text-xl font-bold text-gray-900">Permohonan Penggunaan Laboratorium Fisika Dasar untuk Penelitian Skripsi</p>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm mb-1">Jenis Dokumen</h4>
                                        <p class="font-medium text-gray-900">Surat Permohonan Penggunaan Fasilitas</p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm mb-1">Nomor Dokumen</h4>
                                        <p class="font-medium text-gray-900">SP/HMF/03/2025/156</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm mb-1">Tanggal Pembuatan</h4>
                                        <p class="font-medium text-gray-900">15 Maret 2025, 10:30 WITA</p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-500 text-sm mb-1">Tanggal Penandatanganan</h4>
                                        <p class="font-medium text-gray-900">16 Maret 2025, 14:45 WITA</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm mb-1">Deskripsi Dokumen</h4>
                                    <p class="text-gray-700">
                                        Surat permohonan resmi dari mahasiswa Fisika UNUD untuk menggunakan Laboratorium Fisika Dasar guna keperluan penelitian skripsi dengan judul "Analisis Sifat Optik Material Semikonduktor Berbasis Perovskite". Penggunaan laboratorium diajukan untuk periode 1-30 April 2025 dengan jadwal yang telah ditentukan.
                                    </p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-500 text-sm mb-3">File Terkait</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                                <div>
                                                    <p class="font-medium text-gray-900">Surat_Permohonan_Lab_Fisika.pdf</p>
                                                    <p class="text-sm text-gray-500">2.4 MB • Diunggah 15 Maret 2025</p>
                                                </div>
                                            </div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                                <i class="fas fa-download mr-1"></i> Unduh
                                            </a>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-word text-blue-600 text-xl mr-3"></i>
                                                <div>
                                                    <p class="font-medium text-gray-900">Proposal_Penelitian_Skripsi.docx</p>
                                                    <p class="text-sm text-gray-500">1.8 MB • Diunggah 15 Maret 2025</p>
                                                </div>
                                            </div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                                <i class="fas fa-download mr-1"></i> Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Signatures Card -->
                        <div class="document-card p-6 md:p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Informasi Penandatanganan</h3>
                            
                            <div class="space-y-8">
                                <!-- Signer 1 -->
                                <div class="border border-gray-200 rounded-xl p-6">
                                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                                        <div class="flex-shrink-0">
                                            <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-signature text-3xl text-blue-600"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="flex-grow">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                                <div>
                                                    <h4 class="text-xl font-bold text-gray-900">Ditandatangani Oleh</h4>
                                                    <p class="text-gray-600">Penanda tangan utama</p>
                                                </div>
                                                <span class="verification-badge valid mt-2 md:mt-0">
                                                    <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                                </span>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Nama Lengkap</h5>
                                                    <p class="font-medium text-gray-900">Dr. I Made Sukaryana, M.Si.</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Jabatan</h5>
                                                    <p class="font-medium text-gray-900">Ketua HIMAFI UNUD 2026</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">ID Digital</h5>
                                                    <p class="font-medium text-gray-900 font-mono">HMF-KETUA-2026-001</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Waktu TTD</h5>
                                                    <p class="font-medium text-gray-900">16 Maret 2025, 14:45 WITA</p>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h5 class="font-medium text-gray-500 text-sm mb-2">Sertifikat Digital</h5>
                                                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                                                    <i class="fas fa-certificate text-blue-500 text-xl mr-3"></i>
                                                    <div class="flex-grow">
                                                        <p class="font-medium text-gray-900">Sertifikat Elektronik Terenkripsi</p>
                                                        <p class="text-sm text-gray-600">Diterbitkan oleh: HIMAFI CA • Berlaku hingga: 31 Des 2025</p>
                                                    </div>
                                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <h5 class="font-medium text-gray-500 text-sm mb-2">Tanda Tangan Digital</h5>
                                                <div class="signature-canvas p-6">
                                                    <div class="text-center">
                                                        <div class="font-signature text-4xl text-gray-800 mb-2" style="font-family: 'Brush Script MT', cursive;">
                                                            Dr. I Made Sukaryana, M.Si.
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            Digital Signature • Hash: e5f8a9b3c7...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Signer 2 -->
                                <div class="border border-gray-200 rounded-xl p-6">
                                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                                        <div class="flex-shrink-0">
                                            <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user-check text-3xl text-purple-600"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="flex-grow">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                                <div>
                                                    <h4 class="text-xl font-bold text-gray-900">Diverifikasi Oleh</h4>
                                                    <p class="text-gray-600">Verifikator dokumen</p>
                                                </div>
                                                <span class="verification-badge valid mt-2 md:mt-0">
                                                    <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                                </span>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Nama Lengkap</h5>
                                                    <p class="font-medium text-gray-900">Ni Putu Ayu Sri Wulandari, S.Kom.</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Jabatan</h5>
                                                    <p class="font-medium text-gray-900">Koordinator Divisi TI HIMAFI</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Waktu Verifikasi</h5>
                                                    <p class="font-medium text-gray-900">16 Maret 2025, 15:20 WITA</p>
                                                </div>
                                                
                                                <div>
                                                    <h5 class="font-medium text-gray-500 text-sm mb-1">Metode Verifikasi</h5>
                                                    <p class="font-medium text-gray-900">Two-Factor Authentication</p>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <h5 class="font-medium text-gray-500 text-sm mb-2">Catatan Verifikasi</h5>
                                                <div class="info-card p-4">
                                                    <p class="text-gray-700">
                                                        Dokumen telah diverifikasi melalui sistem keamanan dua faktor. 
                                                        Integritas dokumen terjaga tanpa perubahan sejak ditandatangani. 
                                                        Hash dokumen cocok dengan database terenkripsi.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Timeline -->
                        <div class="document-card p-6 md:p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Riwayat Dokumen</h3>
                            
                            <div class="space-y-6">
                                <div class="timeline-item completed">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-gray-900">Dokumen Dibuat</h4>
                                        <p class="text-gray-600 text-sm">15 Maret 2025, 10:30 WITA</p>
                                    </div>
                                    <p class="text-gray-700">Surat permohonan dibuat oleh pemohon melalui sistem online HIMAFI.</p>
                                </div>
                                
                                <div class="timeline-item completed">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-gray-900">Dokumen Diunggah</h4>
                                        <p class="text-gray-600 text-sm">15 Maret 2025, 11:15 WITA</p>
                                    </div>
                                    <p class="text-gray-700">File PDF dan proposal penelitian diunggah ke sistem.</p>
                                </div>
                                
                                <div class="timeline-item completed">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-gray-900">Dokumen Ditandatangani</h4>
                                        <p class="text-gray-600 text-sm">16 Maret 2025, 14:45 WITA</p>
                                    </div>
                                    <p class="text-gray-700">Dokumen ditandatangani secara digital oleh Ketua HIMAFI.</p>
                                </div>
                                
                                <div class="timeline-item completed">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-gray-900">Dokumen Diverifikasi</h4>
                                        <p class="text-gray-600 text-sm">16 Maret 2025, 15:20 WITA</p>
                                    </div>
                                    <p class="text-gray-700">Verifikasi sistem dan manual dilakukan oleh Divisi TI.</p>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-gray-900">Dokumen Diproses</h4>
                                        <p class="text-gray-600 text-sm">Estimasi: 17 Maret 2025</p>
                                    </div>
                                    <p class="text-gray-700">Dokumen akan diproses oleh pihak laboratorium.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Verification Tools & Info -->
                    <div class="space-y-8">
                        <!-- Verification Summary -->
                        <div class="document-card p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Verifikasi</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Status Tanda Tangan</span>
                                    <span class="verification-badge valid">
                                        <i class="fas fa-check-circle mr-1"></i> Valid
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Integritas Dokumen</span>
                                    <span class="verification-badge valid">
                                        <i class="fas fa-shield-alt mr-1"></i> Terjaga
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Keaslian Penanda Tangan</span>
                                    <span class="verification-badge valid">
                                        <i class="fas fa-user-check mr-1"></i> Terkonfirmasi
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Timestamp</span>
                                    <span class="verification-badge valid">
                                        <i class="fas fa-clock mr-1"></i> Tersegel
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Sertifikat Digital</span>
                                    <span class="verification-badge valid">
                                        <i class="fas fa-certificate mr-1"></i> Aktif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-2">Hash Dokumen</h4>
                                <div class="bg-gray-900 text-gray-100 p-3 rounded-lg font-mono text-sm overflow-x-auto">
                                    a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2
                                </div>
                                <p class="text-xs text-gray-500 mt-2">SHA-256 Digital Signature</p>
                            </div>
                        </div>

                        <!-- Verification Tools -->
                        <div class="document-card p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Alat Verifikasi</h3>
                            
                            <div class="space-y-4">
                                <button id="verifyAgainBtn" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-redo mr-2"></i> Verifikasi Ulang
                                </button>
                                
                                <button id="shareVerifyBtn" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-share-alt mr-2"></i> Bagikan Hasil
                                </button>
                                
                                <button id="printVerifyBtn" class="w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-print mr-2"></i> Cetak Laporan
                                </button>
                                
                                <button id="downloadCertBtn" class="w-full border-2 border-blue-500 text-blue-600 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-300">
                                    <i class="fas fa-download mr-2"></i> Unduh Sertifikat
                                </button>
                            </div>
                        </div>

                        <!-- Quick Info -->
                        <div class="info-card p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Penting</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Dokumen Sah</h4>
                                        <p class="text-sm text-gray-600">Dokumen ini memiliki kekuatan hukum yang sama dengan dokumen fisik.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-lock text-green-500 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Terenkripsi</h4>
                                        <p class="text-sm text-gray-600">Dokumen dilindungi dengan enkripsi AES-256 bit.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-history text-amber-500 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Masa Berlaku</h4>
                                        <p class="text-sm text-gray-600">Verifikasi ini berlaku hingga 16 Juni 2025.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <i class="fas fa-question-circle text-purple-500 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Butuh Bantuan?</h4>
                                        <p class="text-sm text-gray-600">Hubungi Divisi TI HIMAFI untuk pertanyaan lebih lanjut.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <a href="#" class="block text-center bg-gradient-to-r from-emerald-500 to-green-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-headset mr-2"></i> Hubungi Support
                                </a>
                            </div>
                        </div>

                        <!-- Verification Statistics -->
                        <div class="document-card p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Statistik</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm text-gray-600">Jumlah Verifikasi</span>
                                        <span class="text-sm font-bold text-gray-900">47x</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm text-gray-600">Kecepatan Verifikasi</span>
                                        <span class="text-sm font-bold text-gray-900">2.3s</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm text-gray-600">Tingkat Kepercayaan</span>
                                        <span class="text-sm font-bold text-gray-900">99.8%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-emerald-500 h-2 rounded-full" style="width: 99%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Verification Info -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-fingerprint text-blue-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Identitas Digital</h4>
                        <p class="text-gray-600 text-sm">Setiap penanda tangan memiliki sertifikat digital unik yang diverifikasi oleh HIMAFI CA.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-emerald-50 to-green-50 border border-emerald-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-clock text-emerald-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Timestamp Tersegel</h4>
                        <p class="text-gray-600 text-sm">Waktu penandatanganan dicatat dan disegel secara kriptografis untuk mencegah perubahan.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 rounded-xl p-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl mb-4 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Keamanan Blockchain</h4>
                        <p class="text-gray-600 text-sm">Hash dokumen disimpan di blockchain private untuk audit trail yang permanen.</p>
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
            
            // Verification buttons
            const verifyAgainBtn = document.getElementById('verifyAgainBtn');
            const shareVerifyBtn = document.getElementById('shareVerifyBtn');
            const printVerifyBtn = document.getElementById('printVerifyBtn');
            const downloadCertBtn = document.getElementById('downloadCertBtn');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'verifikasi.html') {
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
                        if (link.getAttribute('href') === 'verifikasi.html') {
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
            
            // Verification buttons functionality
            verifyAgainBtn.addEventListener('click', function() {
                // Simulate verification process
                const originalText = verifyAgainBtn.innerHTML;
                verifyAgainBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memverifikasi...';
                verifyAgainBtn.disabled = true;
                
                setTimeout(function() {
                    verifyAgainBtn.innerHTML = originalText;
                    verifyAgainBtn.disabled = false;
                    
                    // Show success notification
                    showNotification('Verifikasi ulang berhasil! Tanda tangan masih valid.', 'success');
                }, 2000);
            });
            
            shareVerifyBtn.addEventListener('click', function() {
                if (navigator.share) {
                    navigator.share({
                        title: 'Hasil Verifikasi Tanda Tangan Digital - HIMAFI UNUD',
                        text: 'Tanda tangan digital terverifikasi valid. Dokumen: Permohonan Penggunaan Laboratorium Fisika Dasar.',
                        url: window.location.href
                    });
                } else {
                    // Fallback for browsers that don't support Web Share API
                    navigator.clipboard.writeText(window.location.href).then(function() {
                        showNotification('Link verifikasi telah disalin ke clipboard!', 'info');
                    });
                }
            });
            
            printVerifyBtn.addEventListener('click', function() {
                // Create printable content
                const printContent = `
                    <div style="font-family: Arial, sans-serif; padding: 20px;">
                        <h1 style="color: #065f46; border-bottom: 2px solid #10b981; padding-bottom: 10px;">
                            LAPORAN VERIFIKASI TANDA TANGAN DIGITAL
                        </h1>
                        <div style="margin: 20px 0; padding: 15px; background: #f0fdf4; border-radius: 8px; border-left: 4px solid #10b981;">
                            <h2 style="color: #065f46; margin: 0;">STATUS: <span style="color: #059669;">TERVERIFIKASI VALID</span></h2>
                            <p style="margin: 5px 0 0 0; color: #374151;">Tanggal cetak: ${new Date().toLocaleDateString('id-ID')}</p>
                        </div>
                        
                        <h3 style="color: #1f2937;">Detail Dokumen</h3>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><strong>Judul Permohonan:</strong></td>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">Permohonan Penggunaan Laboratorium Fisika Dasar untuk Penelitian Skripsi</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><strong>Nomor Dokumen:</strong></td>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">SP/HMF/03/2025/156</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><strong>Ditandatangani Oleh:</strong></td>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">Dr. I Made Sukaryana, M.Si. (Ketua HIMAFI UNUD 2026)</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;"><strong>Diverifikasi Pada:</strong></td>
                                <td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">16 Maret 2025, 15:20 WITA</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px;"><strong>Hash Dokumen:</strong></td>
                                <td style="padding: 8px; font-family: monospace;">a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9b0c1d2e3f4a5b6c7d8e9f0a1b2</td>
                            </tr>
                        </table>
                        
                        <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #e5e7eb; text-align: center; color: #6b7280;">
                            <p>Dokumen ini dicetak dari Sistem Verifikasi Tanda Tangan Digital HIMAFI UNUD</p>
                            <p>https://himafi.unud.ac.id/verifikasi</p>
                        </div>
                    </div>
                `;
                
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Laporan Verifikasi - HIMAFI UNUD</title>
                            <style>
                                @media print {
                                    body { margin: 0; }
                                }
                            </style>
                        </head>
                        <body>${printContent}</body>
                    </html>
                `);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
            });
            
            downloadCertBtn.addEventListener('click', function() {
                // Simulate certificate download
                const originalText = downloadCertBtn.innerHTML;
                downloadCertBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyiapkan...';
                
                setTimeout(function() {
                    downloadCertBtn.innerHTML = originalText;
                    
                    // Create a fake download link
                    const link = document.createElement('a');
                    link.href = 'data:text/plain;charset=utf-8,' + encodeURIComponent('=== Sertifikat Verifikasi Digital ===\n\nID: HMF-2025-03-1567\nStatus: TERVERIFIKASI\nTanggal: ' + new Date().toLocaleDateString('id-ID') + '\nHash: a1b2c3d4e5f6...\n\nTanda tangan digital ini telah diverifikasi oleh sistem HIMAFI UNUD.\n===');
                    link.download = 'sertifikat-verifikasi-hmf-2025-03-1567.txt';
                    link.click();
                    
                    showNotification('Sertifikat verifikasi berhasil diunduh!', 'success');
                }, 1500);
            });
            
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
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>