<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsionaris - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
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
        
        /* Custom styles untuk fungsionaris page */
        .section-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .section-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }
        
        .member-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .member-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }
        
        .member-photo {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .member-card:hover .member-photo {
            transform: scale(1.05);
        }
        
        .position-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .position-ketua {
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            color: white;
        }
        
        .position-wakil {
            background: linear-gradient(to right, #06b6d4, #0891b2);
            color: white;
        }
        
        .position-sekretaris {
            background: linear-gradient(to right, #8b5cf6, #7c3aed);
            color: white;
        }
        
        .position-bendahara {
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
        }
        
        .position-koordinator {
            background: linear-gradient(to right, #f59e0b, #d97706);
            color: white;
        }
        
        .position-staff {
            background: linear-gradient(to right, #6b7280, #4b5563);
            color: white;
        }
        
        .category-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #f3f4f6;
            color: #4b5563;
        }
        
        .sosmed-btn {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .sosmed-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Tab navigation */
        .tab-btn {
            padding: 1rem 2rem;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .tab-btn:hover {
            color: #3b82f6;
        }
        
        .tab-btn.active {
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            background: #eff6ff;
        }
        
        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header & Navigation dengan efek scroll -->
    <header id="mainHeader" class="sticky top-0 z-50 transition-all duration-300 bg-transparent">
        <div class="container mx-auto px-4 py-3 md:py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="index.html" class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center overflow-hidden bg-white/20 backdrop-blur-sm">
                        <img 
                            src="/img/logo.jpg" 
                            alt="logohimafi" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <strong class="text-xl md:text-2xl font-bold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">HIMAFI UNUD</strong>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-6 lg:space-x-8">
                    <a href="index.html" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Beranda</a>
                    <a href="fungsionaris.html" class="font-semibold text-white hover:text-white border-b-2 border-cyan-300 pb-1 transition-colors duration-200">Fungsionaris</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Program Kerja</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Artikel</a>
                    <a href="login.html" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 text-sm lg:text-base">Masuk</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button id="menuBtn" class="md:hidden text-white text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-white/20 pt-4">
                <div class="flex flex-col space-y-4">
                    <a href="index.html" class="font-medium text-white/90 hover:text-white py-2">Beranda</a>
                    <a href="fungsionaris.html" class="font-semibold text-white py-2">Fungsionaris</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Program Kerja</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Artikel</a>
                    <a href="login.html" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">Masuk</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section untuk Fungsionaris -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">STRUKTUR</span>
                <span class="block bg-gradient-to-r from-cyan-300 to-blue-200 bg-clip-text text-transparent mt-2">
                    KEPENGURUSAN
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Kabinet Arunika Swakarsa - HIMAFI UNUD 2026. Satu detak, enam nadi, visi adalah jantung organisasi kami.
            </p>
            <div class="flex items-center justify-center text-cyan-300">
                <i class="fas fa-users mr-2"></i>
                <span>6 Bidang 1 Visi • Sinergi Menuju Keunggulan</span>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <section class="sticky top-16 md:top-20 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="overflow-x-auto">
                <div class="flex space-x-1 min-w-max py-4">
                    <button class="tab-btn active" data-tab="inti">
                        <i class="fas fa-crown mr-2"></i> Pengurus Inti
                    </button>
                    <button class="tab-btn" data-tab="kerohanian">
                        <i class="fas fa-pray mr-2"></i> Bidang Kerohanian
                    </button>
                    <button class="tab-btn" data-tab="pendidikan">
                        <i class="fas fa-graduation-cap mr-2"></i> Pendidikan & Inovasi
                    </button>
                    <button class="tab-btn" data-tab="minat-bakat">
                        <i class="fas fa-star mr-2"></i> Minat & Bakat
                    </button>
                    <button class="tab-btn" data-tab="advokasi">
                        <i class="fas fa-hands-helping mr-2"></i> Advokasi & PSDM
                    </button>
                    <button class="tab-btn" data-tab="pengabdian">
                        <i class="fas fa-hands mr-2"></i> Pengabdian Masyarakat
                    </button>
                    <button class="tab-btn" data-tab="ekonomi">
                        <i class="fas fa-chart-line mr-2"></i> Ekonomi Kreatif
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            
            <!-- Pengurus Inti Section -->
            <div id="tab-inti" class="tab-content fade-in">
                <div class="section-card p-6 md:p-8 mb-12">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Pengurus Inti HIMAFI</h2>
                        <p class="text-gray-600 max-w-3xl mx-auto">
                            Lebih dari sekadar pemimpin, Pengurus Inti adalah rumah bagi setiap aspirasi mahasiswa Fisika. Kami hadir untuk mendengar, merangkul, dan menggali setiap potensi yang ada.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <!-- Ketua -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-48 h-56 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/3b82f6/FFFFFF?text=Mahendra" alt="Mahendra" class="member-photo">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">I Kadek Mahendra Putra</h3>
                                <div class="position-badge position-ketua mb-4">Ketua Umum</div>
                                <p class="text-gray-600 mb-4">Mahasiswa Fisika Angkatan 2022</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="sosmed-btn bg-blue-100 text-blue-600">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="sosmed-btn bg-blue-100 text-blue-600">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="sosmed-btn bg-blue-100 text-blue-600">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Wakil Ketua -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-48 h-56 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/06b6d4/FFFFFF?text=Fadhil" alt="Fadhil" class="member-photo">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Fadhil Muhammad Raihan</h3>
                                <div class="position-badge position-wakil mb-4">Wakil Ketua</div>
                                <p class="text-gray-600 mb-4">Mahasiswa Fisika Angkatan 2023</p>
                                <div class="flex justify-center space-x-4">
                                    <a href="#" class="sosmed-btn bg-cyan-100 text-cyan-600">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="sosmed-btn bg-cyan-100 text-cyan-600">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="sosmed-btn bg-cyan-100 text-cyan-600">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sekretaris dan Bendahara -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Sekretaris 1 -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/8b5cf6/FFFFFF?text=Ana" alt="Ana" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Ananda Putri Septyani</h3>
                                <div class="position-badge position-sekretaris mb-3">Sekretaris I</div>
                                <p class="text-gray-600 text-sm">Mahasiswi Fisika Angkatan 2023</p>
                            </div>
                        </div>
                        
                        <!-- Sekretaris 2 -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/7c3aed/FFFFFF?text=Resti" alt="Resti" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Resti Ayu Pratiwi</h3>
                                <div class="position-badge position-sekretaris mb-3">Sekretaris II</div>
                                <p class="text-gray-600 text-sm">Mahasiswi Fisika Angkatan 2023</p>
                            </div>
                        </div>
                        
                        <!-- Bendahara 1 -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/10b981/FFFFFF?text=Dion" alt="Dion" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Dionisius Aditya</h3>
                                <div class="position-badge position-bendahara mb-3">Bendahara I</div>
                                <p class="text-gray-600 text-sm">Mahasiswa Fisika Angkatan 2023</p>
                            </div>
                        </div>
                        
                        <!-- Bendahara 2 -->
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/059669/FFFFFF?text=Sasa" alt="Sasa" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Sasanti Dewi</h3>
                                <div class="position-badge position-bendahara mb-3">Bendahara II</div>
                                <p class="text-gray-600 text-sm">Mahasiswi Fisika Angkatan 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Kerohanian Section -->
            <div id="tab-kerohanian" class="tab-content hidden fade-in">
                <div class="section-card p-6 md:p-8 mb-12">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Bidang Kerohanian</h2>
                        <span class="category-tag mb-4">Benteng Moral HIMAFI</span>
                        <p class="text-gray-600 max-w-3xl mx-auto">
                            Bidang ini bertanggung jawab membangun karakter mahasiswa yang tidak hanya unggul dalam akademis, tetapi juga luhur dalam budi pekerti.
                        </p>
                    </div>
                    
                    <!-- Koordinator -->
                    <div class="flex flex-col md:flex-row justify-center gap-8 mb-10">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-48 h-56 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/6366f1/FFFFFF?text=Koordinator" alt="Koordinator" class="member-photo">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Budi Santoso</h3>
                                <div class="position-badge position-koordinator mb-4">Koordinator</div>
                                <p class="text-gray-600 mb-4">Mahasiswa Fisika Angkatan 2023</p>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-48 h-56 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/8b5cf6/FFFFFF?text=Wakil" alt="Wakil" class="member-photo">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Siti Aisyah</h3>
                                <div class="position-badge position-koordinator mb-4">Wakil Koordinator</div>
                                <p class="text-gray-600 mb-4">Mahasiswi Fisika Angkatan 2023</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Staff -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/a5b4fc/FFFFFF?text=Staff+1" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Ahmad Fauzi</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/a5b4fc/FFFFFF?text=Staff+2" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Rina Marlina</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/a5b4fc/FFFFFF?text=Staff+3" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Dewi Sartika</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/a5b4fc/FFFFFF?text=Staff+4" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Eko Prasetyo</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Pendidikan dan Inovasi Section -->
            <div id="tab-pendidikan" class="tab-content hidden fade-in">
                <div class="section-card p-6 md:p-8 mb-12">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Bidang Pendidikan dan Inovasi</h2>
                        <span class="category-tag mb-4">Eskalasi Potensi Akademik</span>
                        <p class="text-gray-600 max-w-3xl mx-auto">
                            Bertanggung jawab dalam eskalasi potensi akademik dan budaya ilmiah di lingkungan Fisika.
                        </p>
                    </div>
                    
                    <!-- Koordinator -->
                    <div class="flex flex-col md:flex-row justify-center gap-8 mb-10">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-48 h-56 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/0ea5e9/FFFFFF?text=Koordinator" alt="Koordinator" class="member-photo">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Rizki Pratama</h3>
                                <div class="position-badge position-koordinator mb-4">Koordinator</div>
                                <p class="text-gray-600 mb-4">Mahasiswa Fisika Angkatan 2022</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Staff -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/7dd3fc/FFFFFF?text=Staff+1" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Nina Wijaya</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/7dd3fc/FFFFFF?text=Staff+2" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Arif Hidayat</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/7dd3fc/FFFFFF?text=Staff+3" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Sari Dewi</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/7dd3fc/FFFFFF?text=Staff+4" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Toni Gunawan</h3>
                                <div class="position-badge position-staff mb-3">Staff</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bidang Minat dan Bakat Section -->
            <div id="tab-minat-bakat" class="tab-content hidden fade-in">
                <div class="section-card p-6 md:p-8 mb-12">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Bidang Minat dan Bakat</h2>
                        <span class="category-tag mb-4">Pengembangan Potensi Non-Akademik</span>
                        <p class="text-gray-600 max-w-3xl mx-auto">
                            Berdedikasi untuk menggali dan memfasilitasi potensi mahasiswa di luar ruang kuliah.
                        </p>
                    </div>
                    
                    <!-- Koordinator -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/f59e0b/FFFFFF?text=Koordinator" alt="Koordinator" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Aldi Muhammad</h3>
                                <div class="position-badge position-koordinator mb-4">Koordinator</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-40 h-48 mx-auto rounded-xl overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/400x500/d97706/FFFFFF?text=Wakil" alt="Wakil" class="member-photo">
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Maya Indah</h3>
                                <div class="position-badge position-koordinator mb-4">Wakil Koordinator</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Staff -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/fde68a/FFFFFF?text=Staff+1" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Rudi Hartono</h3>
                                <div class="position-badge position-staff mb-3">Staff Olahraga</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/fde68a/FFFFFF?text=Staff+2" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Lina Marlina</h3>
                                <div class="position-badge position-staff mb-3">Staff Seni</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/fde68a/FFFFFF?text=Staff+3" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Bagus Setiawan</h3>
                                <div class="position-badge position-staff mb-3">Staff Musik</div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <div class="member-card p-6">
                                <div class="w-32 h-40 mx-auto rounded-xl overflow-hidden mb-4 border-4 border-white shadow-lg">
                                    <img src="https://placehold.co/300x400/fde68a/FFFFFF?text=Staff+4" alt="Staff" class="member-photo">
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2">Putri Ayu</h3>
                                <div class="position-badge position-staff mb-3">Staff Teater</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Note for remaining sections -->
            <div class="text-center py-12">
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 rounded-2xl p-8 max-w-2xl mx-auto">
                    <i class="fas fa-info-circle text-blue-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Struktur Lengkap Tersedia</h3>
                    <p class="text-gray-600 mb-4">
                        Informasi lengkap untuk Bidang Advokasi & PSDM, Pengabdian Masyarakat, dan Ekonomi Kreatif tersedia dengan struktur yang serupa.
                    </p>
                    <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i> Unduh Struktur Lengkap (PDF)
                    </button>
                </div>
            </div>
            
            <!-- Organizational Chart -->
            <div class="section-card p-6 md:p-8 mt-12">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Struktur Organisasi</h2>
                    <p class="text-gray-600 max-w-3xl mx-auto">Visualisasi struktur kepengurusan HIMAFI UNUD 2026</p>
                </div>
                
                <div class="bg-gradient-to-br from-gray-50 to-blue-50 border border-gray-200 rounded-xl p-8">
                    <div class="flex flex-col items-center">
                        <!-- Top Level: Ketua -->
                        <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white p-6 rounded-2xl shadow-lg mb-8 text-center max-w-md">
                            <h3 class="text-xl font-bold">Ketua Umum</h3>
                            <p class="text-blue-100">I Kadek Mahendra Putra</p>
                        </div>
                        
                        <!-- Second Level: Wakil, Sekretaris, Bendahara -->
                        <div class="flex flex-col md:flex-row gap-6 mb-8">
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-400 text-white p-4 rounded-xl shadow-md text-center">
                                <h4 class="font-bold">Wakil Ketua</h4>
                                <p class="text-sm">Fadhil Muhammad Raihan</p>
                            </div>
                            
                            <div class="bg-gradient-to-r from-purple-500 to-violet-400 text-white p-4 rounded-xl shadow-md text-center">
                                <h4 class="font-bold">Sekretaris</h4>
                                <p class="text-sm">Ananda & Resti</p>
                            </div>
                            
                            <div class="bg-gradient-to-r from-emerald-500 to-green-400 text-white p-4 rounded-xl shadow-md text-center">
                                <h4 class="font-bold">Bendahara</h4>
                                <p class="text-sm">Dionisius & Sasanti</p>
                            </div>
                        </div>
                        
                        <!-- Third Level: 6 Bidang -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white border border-blue-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-blue-700">Bidang Kerohanian</h4>
                            </div>
                            
                            <div class="bg-white border border-cyan-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-cyan-700">Pendidikan & Inovasi</h4>
                            </div>
                            
                            <div class="bg-white border border-amber-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-amber-700">Minat & Bakat</h4>
                            </div>
                            
                            <div class="bg-white border border-red-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-red-700">Advokasi & PSDM</h4>
                            </div>
                            
                            <div class="bg-white border border-green-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-green-700">Pengabdian Masyarakat</h4>
                            </div>
                            
                            <div class="bg-white border border-purple-200 p-4 rounded-xl shadow-sm text-center">
                                <h4 class="font-bold text-purple-700">Ekonomi Kreatif</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gray-900 to-blue-950 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-12">
                <!-- Kolom 1: Tentang -->
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center overflow-hidden bg-white/20 backdrop-blur-sm">
                            <img 
                                src="/img/logo.jpg" 
                                alt="logohimafi" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <strong class="text-2xl font-bold ml-3">HIMAFI UNUD</strong>
                    </div>
                    <p class="text-gray-300 mb-6 text-lg">
                        Wadah pengembangan diri, kreativitas, dan aspirasi mahasiswa Fisika Universitas Udayana untuk mencapai keunggulan akademik dan non-akademik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-blue-800/50 hover:bg-blue-700 rounded-full flex items-center justify-center text-xl transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-800/50 hover:bg-blue-700 rounded-full flex items-center justify-center text-xl transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-800/50 hover:bg-blue-700 rounded-full flex items-center justify-center text-xl transition">
                            <i class="fab fa-line"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-800/50 hover:bg-blue-700 rounded-full flex items-center justify-center text-xl transition">
                            <i class="fab fa-spotify"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Kontak -->
                <div>
                    <h4 class="text-2xl font-bold mb-8 pb-3 border-b border-blue-800/50">Hubungi Kami</h4>
                    <ul class="space-y-5">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-cyan-400 mt-1 mr-4 text-lg"></i>
                            <span class="text-gray-300">Gedung Student Center Lt. 2, Fakultas MIPA<br>Universitas Udayana, Bukit Jimbaran, Bali</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">+62 812-3456-7890 (Sekretariat)</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">sekretariat@himafi.unud.ac.id</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">Senin - Jumat: 09.00 - 16.00 WITA</span>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Tautan Cepat & Newsletter -->
                <div>
                    <h4 class="text-2xl font-bold mb-8 pb-3 border-b border-blue-800/50">Tautan Cepat</h4>
                    <div class="grid grid-cols-2 gap-4 mb-10">
                        <a href="fungsionaris.html" class="text-cyan-300 font-medium transition py-2">Fungsionaris</a>
                        <a href="koperasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Koperasi</a>
                        <a href="ttd-request.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Permintaan TTD</a>
                        <a href="aspirasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Aspirasi</a>
                        <a href="verifikasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Verifikasi</a>
                        <a href="login.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Login</a>
                    </div>

                    <div class="bg-blue-900/30 p-6 rounded-2xl border border-blue-800/50">
                        <h5 class="font-bold text-lg mb-3">Berlangganan Newsletter</h5>
                        <p class="text-sm text-gray-300 mb-4">Dapatkan info kegiatan dan beasiswa langsung ke email Anda.</p>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda" class="flex-grow bg-blue-800/50 border border-blue-700 text-white px-4 py-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <button class="bg-gradient-to-r from-cyan-500 to-blue-500 px-5 rounded-r-lg font-semibold hover:opacity-90 transition">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 mt-8 border-t border-blue-900 text-center text-gray-400 text-sm">
                <p>Copyright © 2025 - 2026 <strong class="text-cyan-300">Himpunan Mahasiswa Fisika Universitas Udayana</strong>. Seluruh hak cipta dilindungi undang-undang.</p>
                <p class="mt-2">Dikembangkan dengan <i class="fas fa-heart text-red-400 mx-1"></i> oleh Divisi Teknologi Informasi Kabinet Arunika Swakarsa.</p>
            </div>
        </div>
    </footer>

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
            
            // Tab navigation
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'fungsionaris.html') {
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
                        if (link.getAttribute('href') === 'fungsionaris.html') {
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
            
            // Tab navigation functionality
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Hide all tab contents
                    tabContents.forEach(content => content.classList.add('hidden'));
                    
                    // Show selected tab content
                    const selectedTab = document.getElementById(`tab-${tabId}`);
                    if (selectedTab) {
                        selectedTab.classList.remove('hidden');
                        selectedTab.classList.add('fade-in');
                        
                        // Scroll to tab content
                        selectedTab.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>