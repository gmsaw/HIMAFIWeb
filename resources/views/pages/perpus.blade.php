<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    <!-- Ikon untuk menu burger (dari Font Awesome via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- PDF.js untuk viewer PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
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
        
        /* Custom styles untuk perpustakaan */
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }
        
        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .book-cover {
            height: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
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
        
        /* Tag untuk kategori buku */
        .badge-textbook { background: #dbeafe; color: #1e40af; }
        .badge-research { background: #dcfce7; color: #166534; }
        .badge-journal { background: #fef3c7; color: #92400e; }
        .badge-module { background: #f3e8ff; color: #6b21a8; }
        .badge-thesis { background: #e0f2fe; color: #0c4a6e; }
        .badge-reference { background: #ffe4e6; color: #9f1239; }
        
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
        
        /* Featured book card */
        .featured-book {
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
        
        /* Modal PDF Viewer */
        .pdf-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            display: none;
            flex-direction: column;
        }
        
        .pdf-toolbar {
            background: rgba(0, 0, 0, 0.8);
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
        
        .pdf-container {
            flex: 1;
            overflow: auto;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }
        
        .pdf-viewer {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .featured-book {
                height: 300px;
            }
            
            .book-cover {
                height: 200px;
            }
            
            .pdf-container {
                padding: 0.5rem;
            }
        }
        
        /* Book status badges */
        .status-available {
            background: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-borrowed {
            background: #f59e0b;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-restricted {
            background: #ef4444;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Progress bar for reading */
        .reading-progress {
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .reading-progress-bar {
            height: 100%;
            background: linear-gradient(to right, #3b82f6, #06b6d4);
            border-radius: 3px;
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
                    <a href="artikel.html" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Artikel</a>
                    <a href="perpustakaan.html" class="font-semibold text-white hover:text-white border-b-2 border-cyan-300 pb-1 transition-colors duration-200">Perpustakaan</a>
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
                    <a href="artikel.html" class="font-medium text-white/90 hover:text-white py-2">Artikel</a>
                    <a href="perpustakaan.html" class="font-semibold text-white py-2">Perpustakaan</a>
                    <a href="login.html" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">Masuk</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section untuk Perpustakaan -->
    <section class="relative w-full min-h-[60vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative z-10 min-h-[60vh] flex flex-col justify-center items-center px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text text-transparent">Perpustakaan Digital</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto">
                    Akses ribuan buku, jurnal, dan materi pembelajaran fisika secara digital. Temukan pengetahuan tanpa batas.
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
                            placeholder="Cari buku berdasarkan judul, penulis, atau kata kunci..."
                            class="w-full py-4 px-12 search-input text-gray-900"
                        >
                        <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition duration-300">
                            Cari
                        </button>
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cyan-300 mb-2">1,250+</div>
                        <div class="text-gray-300">Buku Digital</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cyan-300 mb-2">350+</div>
                        <div class="text-gray-300">Jurnal Ilmiah</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cyan-300 mb-2">24/7</div>
                        <div class="text-gray-300">Akses Tersedia</div>
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
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Filter Buku</h3>
                        
                        <!-- Kategori -->
                        <div class="filter-section">
                            <h4 class="font-bold text-gray-700 mb-4">Kategori</h4>
                            <div class="space-y-2">
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="textbook" checked>
                                    <span class="text-gray-700">Buku Teks</span>
                                    <span class="ml-auto text-gray-500">(450)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="research" checked>
                                    <span class="text-gray-700">Penelitian</span>
                                    <span class="ml-auto text-gray-500">(320)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="journal">
                                    <span class="text-gray-700">Jurnal</span>
                                    <span class="ml-auto text-gray-500">(280)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="module">
                                    <span class="text-gray-700">Modul</span>
                                    <span class="ml-auto text-gray-500">(150)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="thesis">
                                    <span class="text-gray-700">Skripsi/Tesis</span>
                                    <span class="ml-auto text-gray-500">(120)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="category" value="reference">
                                    <span class="text-gray-700">Referensi</span>
                                    <span class="ml-auto text-gray-500">(130)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="filter-section">
                            <h4 class="font-bold text-gray-700 mb-4">Status</h4>
                            <div class="space-y-2">
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="status" value="available" checked>
                                    <span class="text-gray-700">Tersedia</span>
                                    <span class="ml-auto text-gray-500">(980)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="status" value="borrowed">
                                    <span class="text-gray-700">Dipinjam</span>
                                    <span class="ml-auto text-gray-500">(270)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="status" value="restricted">
                                    <span class="text-gray-700">Terbatas</span>
                                    <span class="ml-auto text-gray-500">(50)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Tahun -->
                        <div class="filter-section">
                            <h4 class="font-bold text-gray-700 mb-4">Tahun Terbit</h4>
                            <div class="space-y-2">
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2023-2025" checked>
                                    <span class="text-gray-700">2023-2025</span>
                                    <span class="ml-auto text-gray-500">(340)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2020-2022">
                                    <span class="text-gray-700">2020-2022</span>
                                    <span class="ml-auto text-gray-500">(420)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="2015-2019">
                                    <span class="text-gray-700">2015-2019</span>
                                    <span class="ml-auto text-gray-500">(380)</span>
                                </label>
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="year" value="before-2015">
                                    <span class="text-gray-700">Sebelum 2015</span>
                                    <span class="ml-auto text-gray-500">(110)</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Reset Filter -->
                        <button id="resetFilter" class="w-full py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition duration-300">
                            Reset Filter
                        </button>
                        
                        <!-- Buku Terbaru -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-700 mb-4">Buku Terbaru</h4>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded mr-3 flex items-center justify-center text-white">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-sm">Fisika Modern Edisi 5</h5>
                                        <p class="text-xs text-gray-500">2024</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-12 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded mr-3 flex items-center justify-center text-white">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-sm">Mekanika Kuantum</h5>
                                        <p class="text-xs text-gray-500">2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Buku Utama -->
                <div class="lg:col-span-3">
                    <!-- Featured Book -->
                    <div class="mb-12 fade-in">
                        <div class="featured-book" style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;">
                            <div class="featured-overlay">
                                <div class="mb-4">
                                    <span class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold">BUKU PILIHAN</span>
                                </div>
                                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                                    "Introduction to Electrodynamics" - Edisi Keempat
                                </h2>
                                <p class="text-gray-200 mb-4">
                                    Buku teks klasik oleh David J. Griffiths yang telah menjadi standar untuk mata kuliah elektrodinamika. Edisi ini telah direvisi dengan contoh soal tambahan dan penjelasan yang lebih mendalam.
                                </p>
                                <div class="flex items-center text-gray-300">
                                    <span class="mr-6"><i class="fas fa-user-edit mr-2"></i> David J. Griffiths</span>
                                    <span><i class="fas fa-calendar-alt mr-2"></i> 2023</span>
                                    <span><i class="fas fa-file-pdf mr-2 ml-6"></i> 450 halaman</span>
                                    <button id="openFeaturedBook" class="ml-auto inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                                        Baca Buku <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Buku Grid -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Koleksi Buku</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Urutkan:</span>
                                <select id="sortSelect" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="newest">Terbaru</option>
                                    <option value="popular">Populer</option>
                                    <option value="title">Judul (A-Z)</option>
                                    <option value="author">Penulis</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Buku List -->
                        <div id="booksContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Buku 1 -->
                            <div class="book-card fade-in">
                                <div class="book-cover">
                                    <i class="fas fa-atom"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-textbook">Buku Teks</span>
                                        <span class="status-available">Tersedia</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Quantum Mechanics: Concepts and Applications
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">Nouredine Zettili</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2022</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 650 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 85%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 85%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Quantum Mechanics: Concepts and Applications"
                                                data-author="Nouredine Zettili"
                                                data-year="2022"
                                                data-pages="650">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buku 2 -->
                            <div class="book-card fade-in">
                                <div class="book-cover" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-textbook">Buku Teks</span>
                                        <span class="status-borrowed">Dipinjam</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Classical Mechanics: A Computational Approach
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">Christopher K. R. T. Jones</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2023</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 420 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 92%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 92%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Classical Mechanics: A Computational Approach"
                                                data-author="Christopher K. R. T. Jones"
                                                data-year="2023"
                                                data-pages="420">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buku 3 -->
                            <div class="book-card fade-in">
                                <div class="book-cover" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                    <i class="fas fa-microscope"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-research">Penelitian</span>
                                        <span class="status-available">Tersedia</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Advanced Condensed Matter Physics
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">Michael P. Marder</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2021</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 780 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 68%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 68%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Advanced Condensed Matter Physics"
                                                data-author="Michael P. Marder"
                                                data-year="2021"
                                                data-pages="780">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buku 4 -->
                            <div class="book-card fade-in">
                                <div class="book-cover" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-reference">Referensi</span>
                                        <span class="status-available">Tersedia</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Mathematical Methods for Physics and Engineering
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">K. F. Riley, M. P. Hobson</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2020</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 1200 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 95%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 95%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Mathematical Methods for Physics and Engineering"
                                                data-author="K. F. Riley, M. P. Hobson"
                                                data-year="2020"
                                                data-pages="1200">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buku 5 -->
                            <div class="book-card fade-in">
                                <div class="book-cover" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                    <i class="fas fa-satellite"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-journal">Jurnal</span>
                                        <span class="status-restricted">Terbatas</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Journal of Modern Physics - Vol. 15
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">Berbagai Penulis</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2024</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 300 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 45%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 45%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Journal of Modern Physics - Vol. 15"
                                                data-author="Berbagai Penulis"
                                                data-year="2024"
                                                data-pages="300">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buku 6 -->
                            <div class="book-card fade-in">
                                <div class="book-cover" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="category-badge badge-thesis">Skripsi</span>
                                        <span class="status-available">Tersedia</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        Analisis Material Superkonduktor Suhu Tinggi
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">I Made Sukaryana</p>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <span class="mr-4"><i class="far fa-calendar mr-1"></i> 2023</span>
                                        <span><i class="far fa-file-alt mr-1"></i> 120 hal</span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="text-sm text-gray-600 mb-1">Tingkat peminjaman: 72%</div>
                                        <div class="reading-progress">
                                            <div class="reading-progress-bar" style="width: 72%"></div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="open-pdf-btn flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition duration-300" 
                                                data-title="Analisis Material Superkonduktor Suhu Tinggi"
                                                data-author="I Made Sukaryana"
                                                data-year="2023"
                                                data-pages="120">
                                            Baca
                                        </button>
                                        <button class="download-btn w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                                            <i class="fas fa-download text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                    
                    <!-- Stats Section -->
                    <div class="mt-12 p-8 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl fade-in">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Statistik Perpustakaan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                                <div class="text-3xl font-bold text-blue-600 mb-2">1,250+</div>
                                <div class="text-gray-700 font-medium">Total Buku</div>
                                <div class="text-sm text-gray-500 mt-2">Tersedia online</div>
                            </div>
                            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                                <div class="text-3xl font-bold text-green-600 mb-2">850+</div>
                                <div class="text-gray-700 font-medium">Peminjam Aktif</div>
                                <div class="text-sm text-gray-500 mt-2">Bulan ini</div>
                            </div>
                            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                                <div class="text-3xl font-bold text-purple-600 mb-2">4,200+</div>
                                <div class="text-gray-700 font-medium">Unduhan</div>
                                <div class="text-sm text-gray-500 mt-2">Tahun 2024</div>
                            </div>
                            <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                                <div class="text-3xl font-bold text-orange-600 mb-2">98%</div>
                                <div class="text-gray-700 font-medium">Kepuasan</div>
                                <div class="text-sm text-gray-500 mt-2">Pengguna</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal PDF Viewer -->
    <div id="pdfModal" class="pdf-modal">
        <div class="pdf-toolbar">
            <div class="flex items-center">
                <button id="closePdf" class="mr-4 text-white hover:text-gray-300">
                    <i class="fas fa-times text-2xl"></i>
                </button>
                <h3 id="pdfTitle" class="text-xl font-bold">PDF Viewer</h3>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <button id="prevPage" class="w-10 h-10 bg-white/20 rounded flex items-center justify-center text-white hover:bg-white/30">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span id="pageInfo" class="text-white font-medium">Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span></span>
                    <button id="nextPage" class="w-10 h-10 bg-white/20 rounded flex items-center justify-center text-white hover:bg-white/30">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <button id="zoomIn" class="w-10 h-10 bg-white/20 rounded flex items-center justify-center text-white hover:bg-white/30">
                        <i class="fas fa-search-plus"></i>
                    </button>
                    <button id="zoomOut" class="w-10 h-10 bg-white/20 rounded flex items-center justify-center text-white hover:bg-white/30">
                        <i class="fas fa-search-minus"></i>
                    </button>
                    <button id="fullscreen" class="w-10 h-10 bg-white/20 rounded flex items-center justify-center text-white hover:bg-white/30">
                        <i class="fas fa-expand"></i>
                    </button>
                    <button id="downloadPdf" class="w-10 h-10 bg-blue-600 rounded flex items-center justify-center text-white hover:bg-blue-700">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="pdf-container">
            <div id="pdfViewer" class="pdf-viewer">
                <canvas id="pdfCanvas"></canvas>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-cyan-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Ingin Donasi Buku?</h2>
                <p class="text-gray-300 mb-8">Bantu kami memperkaya koleksi perpustakaan digital dengan mendonasikan buku fisik atau digital</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-gradient-to-r from-cyan-400 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition duration-300">
                        Donasi Buku Fisik
                    </button>
                    <button class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                        Kirim Buku Digital
                    </button>
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
                        Perpustakaan Digital HIMAFI UNUD menyediakan akses ke ribuan buku, jurnal, dan materi pembelajaran fisika untuk mendukung akademik mahasiswa.
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
                    <h4 class="text-2xl font-bold mb-8 pb-3 border-b border-blue-800/50">Kontak Perpustakaan</h4>
                    <ul class="space-y-5">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-cyan-400 mt-1 mr-4 text-lg"></i>
                            <span class="text-gray-300">Gedung Perpustakaan Lt. 3, Fakultas MIPA<br>Universitas Udayana, Bukit Jimbaran, Bali</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">+62 812-3456-7891 (Perpustakaan)</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">library@himafi.unud.ac.id</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-cyan-400 mr-4 text-lg"></i>
                            <span class="text-gray-300">Buka Setiap Hari: 08.00 - 22.00 WITA</span>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Tautan Cepat -->
                <div>
                    <h4 class="text-2xl font-bold mb-8 pb-3 border-b border-blue-800/50">Tautan Cepat</h4>
                    <div class="grid grid-cols-2 gap-4 mb-10">
                        <a href="perpustakaan.html" class="text-cyan-300 font-medium transition py-2">Perpustakaan</a>
                        <a href="artikel.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Artikel</a>
                        <a href="fungsionaris.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Fungsionaris</a>
                        <a href="koperasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Koperasi</a>
                        <a href="aspirasi.html" class="text-gray-300 hover:text-cyan-300 transition py-2">Aspirasi</a>
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
            // Elemen DOM
            const header = document.getElementById('mainHeader');
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const backToTopBtn = document.getElementById('backToTop');
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const resetFilterBtn = document.getElementById('resetFilter');
            const sortSelect = document.getElementById('sortSelect');
            const openFeaturedBookBtn = document.getElementById('openFeaturedBook');
            
            // PDF Viewer Elements
            const pdfModal = document.getElementById('pdfModal');
            const closePdfBtn = document.getElementById('closePdf');
            const pdfTitle = document.getElementById('pdfTitle');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const zoomInBtn = document.getElementById('zoomIn');
            const zoomOutBtn = document.getElementById('zoomOut');
            const fullscreenBtn = document.getElementById('fullscreen');
            const downloadPdfBtn = document.getElementById('downloadPdf');
            const pdfCanvas = document.getElementById('pdfCanvas');
            const currentPageSpan = document.getElementById('currentPage');
            const totalPagesSpan = document.getElementById('totalPages');
            
            // PDF Viewer State
            let pdfDoc = null;
            let currentPage = 1;
            let pageRendering = false;
            let pageNumPending = null;
            let scale = 1.5;
            const ctx = pdfCanvas.getContext('2d');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'perpustakaan.html') {
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
                        if (link.getAttribute('href') === 'perpustakaan.html') {
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
            
            // Fungsi pencarian buku
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
                        // Simulasi pencarian
                        alert(`Mencari buku dengan kata kunci: "${searchTerm}"\n\n(Fitur pencarian akan diimplementasikan dengan backend)`);
                        searchInput.value = '';
                        
                        // Scroll ke bagian buku
                        document.querySelector('#booksContainer').scrollIntoView({
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
                    
                    // Centang default
                    document.querySelector('input[value="textbook"]').checked = true;
                    document.querySelector('input[value="research"]').checked = true;
                    document.querySelector('input[value="available"]').checked = true;
                    document.querySelector('input[value="2023-2025"]').checked = true;
                    
                    // Reset sort
                    sortSelect.value = 'newest';
                    
                    alert('Filter telah direset ke pengaturan default');
                });
            }
            
            // Sort buku
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const sortValue = this.value;
                    let message = '';
                    
                    switch(sortValue) {
                        case 'newest':
                            message = 'Buku diurutkan dari terbaru';
                            break;
                        case 'popular':
                            message = 'Buku diurutkan berdasarkan popularitas';
                            break;
                        case 'title':
                            message = 'Buku diurutkan berdasarkan judul (A-Z)';
                            break;
                        case 'author':
                            message = 'Buku diurutkan berdasarkan penulis';
                            break;
                    }
                    
                    console.log(message);
                });
            }
            
            // PDF Viewer Functions
            function renderPage(num) {
                pageRendering = true;
                
                pdfDoc.getPage(num).then(function(page) {
                    const viewport = page.getViewport({ scale: scale });
                    pdfCanvas.height = viewport.height;
                    pdfCanvas.width = viewport.width;
                    
                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    
                    const renderTask = page.render(renderContext);
                    
                    renderTask.promise.then(function() {
                        pageRendering = false;
                        if (pageNumPending !== null) {
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                        
                        // Update page info
                        currentPageSpan.textContent = num;
                    });
                });
            }
            
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
            }
            
            function onPrevPage() {
                if (currentPage <= 1) {
                    return;
                }
                currentPage--;
                queueRenderPage(currentPage);
            }
            
            function onNextPage() {
                if (currentPage >= pdfDoc.numPages) {
                    return;
                }
                currentPage++;
                queueRenderPage(currentPage);
            }
            
            function onZoomIn() {
                scale += 0.1;
                renderPage(currentPage);
            }
            
            function onZoomOut() {
                if (scale > 0.5) {
                    scale -= 0.1;
                    renderPage(currentPage);
                }
            }
            
            function onFullscreen() {
                if (!document.fullscreenElement) {
                    pdfCanvas.requestFullscreen().catch(err => {
                        alert(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
                    });
                } else {
                    document.exitFullscreen();
                }
            }
            
            function onDownloadPdf() {
                // Simulasi download
                alert(`Mendownload PDF: ${pdfTitle.textContent}\n\n(Dalam implementasi nyata, ini akan mengunduh file PDF)`);
            }
            
            // Open PDF Viewer
            function openPdfViewer(bookTitle, bookAuthor, bookYear, bookPages) {
                pdfTitle.textContent = `${bookTitle} - ${bookAuthor} (${bookYear})`;
                pdfModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                
                // Simulasi loading PDF
                // Dalam implementasi nyata, ini akan memuat file PDF dari server
                currentPage = 1;
                scale = 1.5;
                
                // Simulate PDF document (dummy data)
                pdfDoc = {
                    numPages: parseInt(bookPages) / 10 || 45, // Estimate pages
                    getPage: function(num) {
                        return Promise.resolve({
                            getViewport: function(options) {
                                return {
                                    height: 800 * options.scale,
                                    width: 600 * options.scale
                                };
                            },
                            render: function(context) {
                                // Simulate rendering
                                const ctx = context.canvasContext;
                                const canvas = ctx.canvas;
                                
                                // Clear canvas
                                ctx.fillStyle = 'white';
                                ctx.fillRect(0, 0, canvas.width, canvas.height);
                                
                                // Draw book info
                                ctx.fillStyle = '#333';
                                ctx.font = '20px Arial';
                                ctx.textAlign = 'center';
                                ctx.fillText(bookTitle, canvas.width / 2, 100);
                                
                                ctx.font = '16px Arial';
                                ctx.fillText(`Penulis: ${bookAuthor}`, canvas.width / 2, 140);
                                ctx.fillText(`Tahun: ${bookYear} | Halaman: ${bookPages}`, canvas.width / 2, 170);
                                
                                ctx.font = '14px Arial';
                                ctx.fillText(`Halaman ${num} dari ${pdfDoc.numPages}`, canvas.width / 2, 200);
                                
                                // Draw some sample content
                                ctx.font = '12px Arial';
                                ctx.textAlign = 'left';
                                ctx.fillText('Ini adalah preview dari PDF Viewer. Dalam implementasi', 50, 250);
                                ctx.fillText('nyata, ini akan menampilkan konten asli dari file PDF.', 50, 270);
                                
                                ctx.fillText('Fitur yang tersedia:', 50, 320);
                                ctx.fillText('• Navigasi halaman (sebelum/sesudah)', 70, 350);
                                ctx.fillText('• Zoom in/out', 70, 370);
                                ctx.fillText('• Mode fullscreen', 70, 390);
                                ctx.fillText('• Download PDF', 70, 410);
                                
                                ctx.fillText('Powered by PDF.js dan HIMAFI UNUD', canvas.width / 2, canvas.height - 50);
                                
                                return {
                                    promise: Promise.resolve()
                                };
                            }
                        });
                    }
                };
                
                // Update page info
                totalPagesSpan.textContent = pdfDoc.numPages;
                renderPage(currentPage);
            }
            
            // Event listeners for PDF viewer
            if (closePdfBtn) {
                closePdfBtn.addEventListener('click', function() {
                    pdfModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });
            }
            
            if (prevPageBtn) {
                prevPageBtn.addEventListener('click', onPrevPage);
            }
            
            if (nextPageBtn) {
                nextPageBtn.addEventListener('click', onNextPage);
            }
            
            if (zoomInBtn) {
                zoomInBtn.addEventListener('click', onZoomIn);
            }
            
            if (zoomOutBtn) {
                zoomOutBtn.addEventListener('click', onZoomOut);
            }
            
            if (fullscreenBtn) {
                fullscreenBtn.addEventListener('click', onFullscreen);
            }
            
            if (downloadPdfBtn) {
                downloadPdfBtn.addEventListener('click', onDownloadPdf);
            }
            
            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && pdfModal.style.display === 'flex') {
                    pdfModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Open PDF buttons
            const openPdfBtns = document.querySelectorAll('.open-pdf-btn');
            openPdfBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const title = this.getAttribute('data-title');
                    const author = this.getAttribute('data-author');
                    const year = this.getAttribute('data-year');
                    const pages = this.getAttribute('data-pages');
                    
                    openPdfViewer(title, author, year, pages);
                });
            });
            
            // Featured book button
            if (openFeaturedBookBtn) {
                openFeaturedBookBtn.addEventListener('click', function() {
                    openPdfViewer(
                        'Introduction to Electrodynamics - Edisi Keempat',
                        'David J. Griffiths',
                        '2023',
                        '450'
                    );
                });
            }
            
            // Download buttons
            const downloadBtns = document.querySelectorAll('.download-btn');
            downloadBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Find the book title from the card
                    const bookCard = this.closest('.book-card');
                    const bookTitle = bookCard.querySelector('h3').textContent;
                    
                    alert(`Mendownload buku: "${bookTitle}"\n\n(Dalam implementasi nyata, ini akan mengunduh file PDF)`);
                });
            });
            
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
                    }
                });
            });
        });
    </script>
</body>
</html>