<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
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
        
        /* Custom styles untuk artikel */
        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        /* Tag untuk kategori */
        .badge-academic { background: #dbeafe; color: #1e40af; }
        .badge-event { background: #fef3c7; color: #92400e; }
        .badge-achievement { background: #dcfce7; color: #166534; }
        .badge-workshop { background: #f3e8ff; color: #6b21a8; }
        .badge-organization { background: #e0f2fe; color: #0c4a6e; }
        .badge-science { background: #ffe4e6; color: #9f1239; }
        
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
        
        /* Pagination styling */
        .pagination-btn {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            background: white;
            transition: all 0.3s ease;
        }
        
        .pagination-btn:hover:not(.active):not(.disabled) {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }
        
        .pagination-btn.active {
            background: linear-gradient(to right, #3b82f6, #06b6d4);
            color: white;
            border-color: transparent;
        }
        
        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Search bar styling */
        .search-input {
            padding-left: 3rem;
            padding-right: 1rem;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        /* Filter sidebar */
        .filter-section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .filter-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            cursor: pointer;
        }
        
        .filter-checkbox input {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 4px;
            border: 2px solid #d1d5db;
        }
        
        .filter-checkbox input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        
        /* Featured article card */
        .featured-article {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            height: 400px;
        }
        
        .featured-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 50%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .featured-article {
                height: 300px;
            }
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
                    <a href="fungsionaris.html" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Fungsionaris</a>
                    <a href="proker.html" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Program Kerja</a>
                    <a href="artikel.html" class="font-semibold text-white hover:text-white border-b-2 border-cyan-300 pb-1 transition-colors duration-200">Artikel</a>
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
                    <a href="fungsionaris.html" class="font-medium text-white/90 hover:text-white py-2">Fungsionaris</a>
                    <a href="proker.html" class="font-medium text-white/90 hover:text-white py-2">Program Kerja</a>
                    <a href="artikel.html" class="font-semibold text-white py-2">Artikel</a>
                    <a href="login.html" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">Masuk</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section untuk Kumpulan Artikel -->
    <section class="relative w-full min-h-[60vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative z-10 min-h-[60vh] flex flex-col justify-center items-center px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">Artikel & Berita</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto">
                    Temukan wawasan, berita, dan informasi terkini dari dunia fisika dan aktivitas HIMAFI UNUD
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mt-8">
                    <div class="relative">
                        <div class="search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Cari artikel berdasarkan judul, kategori, atau kata kunci..."
                            class="w-full py-4 px-12 search-input text-gray-900"
                        >
                        <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition duration-300">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Filter -->
                <div class="lg:col-span-1 fade-in">
                    <div class="bg-gray-50 rounded-xl p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Filter Artikel</h3>
                        
                        <!-- Kategori -->
                        <div class="filter-section">
                            <h4 class="font-bold text-gray-700 mb-4">Kategori</h4>
                            <div class="space-y-2">
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="academic" checked>
                                    <span class="text-gray-700">Akademik</span>
                                    <span class="ml-auto text-gray-500">(12)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="event" checked>
                                    <span class="text-gray-700">Event</span>
                                    <span class="ml-auto text-gray-500">(8)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="achievement">
                                    <span class="text-gray-700">Prestasi</span>
                                    <span class="ml-auto text-gray-500">(6)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="workshop">
                                    <span class="text-gray-700">Workshop</span>
                                    <span class="ml-auto text-gray-500">(4)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="organization">
                                    <span class="text-gray-700">Organisasi</span>
                                    <span class="ml-auto text-gray-500">(5)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="science">
                                    <span class="text-gray-700">Sains & Teknologi</span>
                                    <span class="ml-auto text-gray-500">(9)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Tahun -->
                        <div class="filter-section">
                            <h4 class="font-bold text-gray-700 mb-4">Tahun</h4>
                            <div class="space-y-2">
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2025" checked>
                                    <span class="text-gray-700">2025</span>
                                    <span class="ml-auto text-gray-500">(24)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2024">
                                    <span class="text-gray-700">2024</span>
                                    <span class="ml-auto text-gray-500">(18)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2023">
                                    <span class="text-gray-700">2023</span>
                                    <span class="ml-auto text-gray-500">(12)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Reset Filter -->
                        <button id="resetFilter" class="w-full py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition duration-300">
                            Reset Filter
                        </button>
                        
                        <!-- Statistik -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-700 mb-4">Statistik</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Artikel</span>
                                    <span class="font-bold text-blue-600">44</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Artikel Bulan Ini</span>
                                    <span class="font-bold text-blue-600">6</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pembaca Aktif</span>
                                    <span class="font-bold text-blue-600">1.2K</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Artikel Utama -->
                <div class="lg:col-span-3">
                    <!-- Featured Article -->
                    <div class="mb-12 fade-in">
                        <div class="featured-article" style="background-image: url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;">
                            <div class="featured-overlay">
                                <div class="mb-4">
                                    <span class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold">FEATURED</span>
                                </div>
                                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                                    Suksesnya Saraswati Fisika 2025: Merayakan Ilmu & Budaya
                                </h2>
                                <p class="text-gray-200 mb-4">
                                    Rangkaian acara penghormatan kepada Dewi Ilmu Pengetahuan berhasil digelar dengan meriah, mengolaborasikan presentasi ilmiah dengan pertunjukan seni budaya Bali.
                                </p>
                                <div class="flex items-center text-gray-300">
                                    <span class="mr-6"><i class="far fa-calendar mr-2"></i> 15 Maret 2025</span>
                                    <span><i class="far fa-clock mr-2"></i> 5 min read</span>
                                    <a href="/artikel/view" class="ml-auto inline-flex items-center text-cyan-300 font-semibold hover:text-white transition">
                                        Baca Artikel <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Artikel Grid -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Artikel Terbaru</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Sortir:</span>
                                <select id="sortSelect" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="newest">Terbaru</option>
                                    <option value="oldest">Terlama</option>
                                    <option value="popular">Populer</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Artikel List -->
                        <div id="articlesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Artikel 1 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Tim Olimpiade" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-achievement">Prestasi</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 28 Feb 2025</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Dua Mahasiswa Fisika Raih Medali di Olimpiade Sains Nasional
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Prestasi membanggakan ditorehkan oleh dua mahasiswa Fisika UNUD yang berhasil meraih medali perak dan perunggu dalam Olimpiade Sains Nasional 2025.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                T
                                            </div>
                                            <span class="text-sm font-medium">Tim Redaksi</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <!-- Artikel 2 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Workshop" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-workshop">Workshop</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 10 Feb 2025</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Workshop Python untuk Fisika Komputasi Diikuti 100+ Peserta
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Workshop intensif selama 3 hari ini mengajarkan penerapan Python dalam simulasi fisika dan analisis data penelitian. Peserta sangat antusias dengan materi yang diberikan.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                D
                                            </div>
                                            <span class="text-sm font-medium">Divisi Teknologi</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <!-- Artikel 3 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Pelantikan" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-organization">Organisasi</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 5 Jan 2025</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Pelantikan Pengurus HIMAFI 2026: Semangat Baru Kabinet Arunika Swakarsa
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Upacara pelantikan resmi pengurus baru HIMAFI UNUD periode 2026 berlangsung khidmat. Kabinet Arunika Swakarsa siap melanjutkan perjuangan mengabdi untuk keluarga besar Fisika UNUD.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                S
                                            </div>
                                            <span class="text-sm font-medium">Sekretariat</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <!-- Artikel 4 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1554475900-469fdb8c2c08?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Penelitian" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-science">Sains & Teknologi</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 20 Des 2024</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Penelitian Material Baru untuk Panel Surya Efisiensi Tinggi
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Tim peneliti Fisika UNUD berhasil mengembangkan material perovskite hibrida yang dapat meningkatkan efisiensi panel surya hingga 25%. Inovasi ini dipublikasikan di jurnal internasional.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                R
                                            </div>
                                            <span class="text-sm font-medium">Tim Riset</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <!-- Artikel 5 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Seminar" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-academic">Akademik</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 15 Des 2024</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Seminar Nasional Fisika 2024: Tantangan dan Peluang di Era Digital
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Seminar nasional yang menghadirkan 5 pembicara ahli dari berbagai universitas ternama di Indonesia. Membahas perkembangan terkini fisika dan aplikasinya dalam industri 4.0.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                A
                                            </div>
                                            <span class="text-sm font-medium">Akademik</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            
                            <!-- Artikel 6 -->
                            <article class="article-card bg-white rounded-2xl overflow-hidden border border-gray-200 fade-in">
                                <div class="h-48 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1563089145-599997674d42?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                         alt="Pengabdian" 
                                         class="w-full h-full object-cover hover:scale-110 transition duration-700">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="category-badge badge-event">Event</span>
                                        <span class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> 1 Des 2024</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                        Pengabdian Masyarakat: Mengajar Fisika Dasar ke Sekolah Pedesaan
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        Sebanyak 30 mahasiswa Fisika UNUD melakukan pengabdian masyarakat dengan mengajar fisika dasar ke 5 sekolah menengah di daerah terpencil Bali selama 2 minggu.
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                                P
                                            </div>
                                            <span class="text-sm font-medium">Pengabdian</span>
                                        </div>
                                        <a href="detail-artikel.html" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-12 flex justify-center">
                            <nav class="flex items-center space-x-2">
                                <button class="pagination-btn disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="pagination-btn active">1</button>
                                <button class="pagination-btn">2</button>
                                <button class="pagination-btn">3</button>
                                <button class="pagination-btn">4</button>
                                <span class="px-2">...</span>
                                <button class="pagination-btn">8</button>
                                <button class="pagination-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                    
                    <!-- Popular Tags -->
                    <div class="mt-12 p-8 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl fade-in">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Tag Populer</h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="px-4 py-2 bg-white border border-blue-200 text-blue-700 rounded-full hover:bg-blue-50 hover:border-blue-300 transition duration-300">
                                #Saraswati2025
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-green-200 text-green-700 rounded-full hover:bg-green-50 hover:border-green-300 transition duration-300">
                                #FisikaKomputasi
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-purple-200 text-purple-700 rounded-full hover:bg-purple-50 hover:border-purple-300 transition duration-300">
                                #OlimpiadeSains
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-red-200 text-red-700 rounded-full hover:bg-red-50 hover:border-red-300 transition duration-300">
                                #Penelitian
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-yellow-200 text-yellow-700 rounded-full hover:bg-yellow-50 hover:border-yellow-300 transition duration-300">
                                #Workshop
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-indigo-200 text-indigo-700 rounded-full hover:bg-indigo-50 hover:border-indigo-300 transition duration-300">
                                #HIMAFI2026
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-pink-200 text-pink-700 rounded-full hover:bg-pink-50 hover:border-pink-300 transition duration-300">
                                #FisikaUNUD
                            </a>
                            <a href="#" class="px-4 py-2 bg-white border border-cyan-200 text-cyan-700 rounded-full hover:bg-cyan-50 hover:border-cyan-300 transition duration-300">
                                #SeminarNasional
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-cyan-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Tetap Terhubung dengan HIMAFI</h2>
                <p class="text-gray-300 mb-8">Dapatkan artikel terbaru dan informasi kegiatan langsung ke email Anda</p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Email Anda" class="flex-grow px-6 py-3 border border-gray-400 rounded-full text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button class="bg-gradient-to-r from-cyan-400 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition duration-300">
                        Berlangganan
                    </button>
                </div>
                
                <p class="text-sm text-gray-300 mt-4">Dengan berlangganan, Anda menyetujui kebijakan privasi kami</p>
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
                        <a href="artikel.html" class="text-cyan-300 font-medium transition py-2">Artikel</a>
                        <a href="fungsionaris.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Fungsionaris</a>
                        <a href="koperasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Koperasi</a>
                        <a href="aspirasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Aspirasi</a>
                        <a href="verifikasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Verifikasi</a>
                        <a href="login.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Login</a>
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
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const resetFilterBtn = document.getElementById('resetFilter');
            const sortSelect = document.getElementById('sortSelect');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'artikel.html') {
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
                        if (link.getAttribute('href') === 'artikel.html') {
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
            }
            
            // Jalankan fungsi saat load dan scroll
            updateHeaderOnScroll();
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Toggle mobile menu
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    // Toggle icon menu
                    const icon = menuBtn.querySelector('i');
                    if (icon.classList.contains('fa-bars')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
                
                // Tutup mobile menu saat klik link
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        menuBtn.querySelector('i').classList.remove('fa-times');
                        menuBtn.querySelector('i').classList.add('fa-bars');
                    });
                });
            }
            
            // Back to top button
            if (backToTopBtn) {
                // Tampilkan/tampilkan tombol berdasarkan scroll
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('hidden');
                        backToTopBtn.classList.add('flex');
                    } else {
                        backToTopBtn.classList.remove('flex');
                        backToTopBtn.classList.add('hidden');
                    }
                });
                
                // Klik untuk scroll ke atas
                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
            
            // Fungsi pencarian artikel
            if (searchInput && searchBtn) {
                searchBtn.addEventListener('click', performSearch);
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });
                
                function performSearch() {
                    const searchTerm = searchInput.value.trim().toLowerCase();
                    if (searchTerm) {
                        // Simulasi pencarian - dalam implementasi nyata, ini akan menghubungi backend
                        alert(`Mencari artikel dengan kata kunci: "${searchTerm}"\n\n(Fitur pencarian akan diimplementasikan dengan backend)`);
                        searchInput.value = '';
                        
                        // Scroll ke bagian artikel
                        document.querySelector('#articlesContainer').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            }
            
            // Reset filter
            if (resetFilterBtn) {
                resetFilterBtn.addEventListener('click', function() {
                    // Reset semua checkbox
                    const checkboxes = document.querySelectorAll('.filter-section input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    // Centang default (akademik, event, 2025)
                    document.querySelector('input[value="academic"]').checked = true;
                    document.querySelector('input[value="event"]').checked = true;
                    document.querySelector('input[value="2025"]').checked = true;
                    
                    // Reset sort
                    sortSelect.value = 'newest';
                    
                    alert('Filter telah direset ke pengaturan default');
                });
            }
            
            // Sort artikel
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const sortValue = this.value;
                    let message = '';
                    
                    switch(sortValue) {
                        case 'newest':
                            message = 'Artikel diurutkan dari terbaru';
                            break;
                        case 'oldest':
                            message = 'Artikel diurutkan dari terlama';
                            break;
                        case 'popular':
                            message = 'Artikel diurutkan berdasarkan popularitas';
                            break;
                    }
                    
                    // Simulasi sorting - dalam implementasi nyata, ini akan menghubungi backend
                    console.log(message);
                });
            }
            
            // Animasi fade-in untuk konten
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);
            
            // Observ elemen yang ingin dianimasikan
            const elementsToAnimate = document.querySelectorAll('.fade-in');
            elementsToAnimate.forEach(el => observer.observe(el));
            
            // Pagination
            const paginationBtns = document.querySelectorAll('.pagination-btn:not(.disabled)');
            paginationBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Hapus class active dari semua tombol
                    paginationBtns.forEach(b => b.classList.remove('active'));
                    
                    // Tambah class active ke tombol yang diklik (kecuali tombol panah)
                    if (!this.querySelector('i')) {
                        this.classList.add('active');
                    }
                    
                    // Simulasi pindah halaman
                    const pageNum = this.textContent;
                    if (!isNaN(pageNum)) {
                        console.log(`Pindah ke halaman ${pageNum}`);
                        // Dalam implementasi nyata, ini akan memuat data halaman baru
                    }
                });
            });
            
            // Newsletter form
            const newsletterForm = document.querySelector('.bg-gradient-to-r.from-blue-900.to-cyan-800');
            if (newsletterForm) {
                const newsletterBtn = newsletterForm.querySelector('button');
                const newsletterInput = newsletterForm.querySelector('input[type="email"]');
                
                newsletterBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (newsletterInput.value && newsletterInput.value.includes('@')) {
                        // Simpan state asli
                        const originalBtnText = newsletterBtn.textContent;
                        
                        // Tampilkan loading
                        newsletterBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                        newsletterBtn.disabled = true;
                        
                        // Simulasi pengiriman
                        setTimeout(() => {
                            // Tampilkan sukses
                            newsletterBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Berhasil!';
                            newsletterBtn.classList.remove('from-cyan-400', 'to-blue-500');
                            newsletterBtn.classList.add('from-green-500', 'to-green-600');
                            
                            // Reset form
                            newsletterInput.value = '';
                            
                            // Kembali ke state asli setelah 3 detik
                            setTimeout(() => {
                                newsletterBtn.innerHTML = originalBtnText;
                                newsletterBtn.classList.remove('from-green-500', 'to-green-600');
                                newsletterBtn.classList.add('from-cyan-400', 'to-blue-500');
                                newsletterBtn.disabled = false;
                            }, 3000);
                        }, 1500);
                    } else {
                        alert('Masukkan alamat email yang valid');
                    }
                });
            }
            
            // Tag klik handler
            const tags = document.querySelectorAll('.bg-gradient-to-r.from-blue-50.to-cyan-50 a');
            tags.forEach(tag => {
                tag.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tagText = this.textContent.replace('#', '');
                    searchInput.value = tagText;
                    performSearch();
                });
            });
        });
    </script>
</body>
</html>