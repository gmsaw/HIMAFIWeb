<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Mahasiswa - HIMAFI UNUD</title>
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
        
        /* Custom styles untuk katalog */
        .product-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .product-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .price-tag {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(to right, #10b981, #34d399);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: bold;
        }
        
        .stock-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .stock-in {
            background: #d1fae5;
            color: #065f46;
        }
        
        .stock-low {
            background: #fef3c7;
            color: #92400e;
        }
        
        .stock-out {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .cart-btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(to right, #3b82f6, #06b6d4);
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .cart-btn:hover {
            background: linear-gradient(to right, #2563eb, #0891b2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        
        .cart-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .quantity-input {
            width: 4rem;
            padding: 0.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.375rem;
            text-align: center;
            font-weight: 600;
        }
        
        .quantity-btn {
            width: 2.5rem;
            height: 2.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.375rem;
            background: white;
            font-weight: bold;
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            background: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover, .filter-btn.active {
            border-color: #3b82f6;
            background: #eff6ff;
            color: #1d4ed8;
        }
        
        /* Cart sidebar */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }
        
        .cart-sidebar.open {
            right: 0;
        }
        
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .cart-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        
        /* Animasi */
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
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Fungsionaris</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Program Kerja</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Artikel</a>
                    <a href="koperasi.html" class="font-semibold text-white hover:text-white border-b-2 border-cyan-300 pb-1 transition-colors duration-200">Koperasi</a>
                    <button id="cartButton" class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-300 text-sm lg:text-base relative">
                        <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                        <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center">0</span>
                    </button>
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
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Fungsionaris</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Program Kerja</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Artikel</a>
                    <a href="koperasi.html" class="font-semibold text-white py-2">Koperasi</a>
                    <button id="cartButtonMobile" class="bg-gradient-to-r from-amber-500 to-orange-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">
                        <i class="fas fa-shopping-cart mr-2"></i> Keranjang (0)
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section untuk Koperasi -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-900 via-amber-800 to-yellow-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">KOPERASI MAHASISWA</span>
                <span class="block bg-gradient-to-r from-amber-300 to-yellow-200 bg-clip-text text-transparent mt-2">
                    HIMAFI UNUD
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Temukan kebutuhan kampus dengan harga terjangkau. Dari alat tulis, merchandise HIMAFI, hingga snack tersedia untuk mendukung aktivitas akademik Anda.
            </p>
            <div class="flex items-center justify-center text-amber-300">
                <i class="fas fa-store mr-2"></i>
                <span>Harga Terjangkau • Kualitas Terjamin • Untuk Mahasiswa</span>
            </div>
        </div>
    </section>

    <!-- Main Katalog Content -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            
            <!-- Stats & Info -->
            <div class="mb-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">50+</div>
                    <div class="text-gray-700 font-medium">Produk Tersedia</div>
                </div>
                
                <div class="bg-gradient-to-br from-emerald-50 to-green-50 border border-emerald-100 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-emerald-600 mb-2">Rp 5K-100K</div>
                    <div class="text-gray-700 font-medium">Range Harga</div>
                </div>
                
                <div class="bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-100 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-amber-600 mb-2">24 Jam</div>
                    <div class="text-gray-700 font-medium">Pengiriman Kampus</div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-100 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">COD</div>
                    <div class="text-gray-700 font-medium">Bayar di Tempat</div>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Cari produk (nama, kategori, merk)" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button id="sortButton" class="flex items-center bg-white border border-gray-300 px-4 py-3 rounded-full hover:bg-gray-50">
                            <i class="fas fa-sort-amount-down mr-2"></i>
                            <span>Urutkan</span>
                        </button>
                        
                        <button id="filterButton" class="flex items-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-3 rounded-full hover:shadow-lg">
                            <i class="fas fa-filter mr-2"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>
                
                <!-- Filter Categories -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <button class="filter-btn active" data-category="all">Semua Produk</button>
                    <button class="filter-btn" data-category="alat-tulis">Alat Tulis</button>
                    <button class="filter-btn" data-category="merchandise">Merchandise</button>
                    <button class="filter-btn" data-category="makanan">Makanan & Minuman</button>
                    <button class="filter-btn" data-category="elektronik">Elektronik</button>
                    <button class="filter-btn" data-category="buku">Buku & Modul</button>
                    <button class="filter-btn" data-category="lainnya">Lainnya</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Produk Terbaru</h2>
                
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Product cards will be generated by JavaScript -->
                </div>
                
                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                    <p class="mt-4 text-gray-600">Memuat produk...</p>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-box-open text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba kata kunci pencarian lain atau filter yang berbeda.</p>
                    <button id="resetFilters" class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg">
                        Reset Filter
                    </button>
                </div>
            </div>

            <!-- How to Order -->
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 rounded-2xl p-8 mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 text-center">Cara Memesan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl font-bold">1</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Pilih Produk</h3>
                        <p class="text-gray-600">Tambahkan produk ke keranjang belanja</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl font-bold">2</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Checkout</h3>
                        <p class="text-gray-600">Isi data pengiriman dan pilih metode pembayaran</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl font-bold">3</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Terima Produk</h3>
                        <p class="text-gray-600">Produk dikirim ke lokasi kampus atau diambil di sekretariat</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Pertanyaan Umum</h2>
                
                <div class="space-y-4">
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="font-bold text-gray-900 mb-2">Bagaimana cara mengambil pesanan?</h3>
                        <p class="text-gray-600">Pesanan dapat diambil di sekretariat HIMAFI UNUD setiap hari kerja jam 09.00-16.00 WITA. Untuk pengiriman dalam kampus, tersedia layanan antar dengan biaya tambahan Rp 5.000.</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="font-bold text-gray-900 mb-2">Metode pembayaran apa saja yang tersedia?</h3>
                        <p class="text-gray-600">Kami menerima pembayaran via transfer bank (BCA, Mandiri, BRI), e-wallet (GoPay, OVO, Dana), dan Cash On Delivery (COD) untuk pengambilan di tempat.</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="font-bold text-gray-900 mb-2">Apakah ada diskon untuk anggota HIMAFI?</h3>
                        <p class="text-gray-600">Ya! Anggota aktif HIMAFI mendapatkan diskon 10% untuk semua produk merchandise HIMAFI dan 5% untuk produk lainnya. Tunjukan kartu anggota saat pengambilan.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100 rounded-2xl p-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-4">Hubungi kami untuk informasi lebih lanjut</p>
                        <div class="flex items-center space-x-4">
                            <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg">
                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                            </a>
                            <a href="mailto:koperasi@himafi.unud.ac.id" class="flex items-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg">
                                <i class="fas fa-envelope mr-2"></i> Email
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center md:text-right">
                        <div class="text-sm text-gray-600 mb-2">Jam Operasional</div>
                        <div class="text-lg font-bold text-gray-900">Senin - Jumat</div>
                        <div class="text-lg font-bold text-gray-900">09.00 - 16.00 WITA</div>
                        <div class="text-sm text-gray-600 mt-2">Gedung Student Center Lt. 2</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Sidebar -->
    <div id="cartOverlay" class="cart-overlay"></div>
    
    <div id="cartSidebar" class="cart-sidebar">
        <div class="p-6">
            <!-- Cart Header -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Keranjang Belanja</h2>
                <button id="closeCart" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Cart Items -->
            <div id="cartItems" class="mb-6 space-y-4 max-h-96 overflow-y-auto">
                <!-- Cart items will be generated by JavaScript -->
                <div id="emptyCart" class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-cart text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-600">Keranjang belanja kosong</p>
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span id="cartSubtotal" class="font-bold text-gray-900">Rp 0</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Diskon Anggota (10%)</span>
                    <span id="cartDiscount" class="font-bold text-green-600">-Rp 0</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Biaya Antar*</span>
                    <span id="cartShipping" class="font-bold text-gray-900">Rp 0</span>
                </div>
                <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-4 mb-6">
                    <span>Total</span>
                    <span id="cartTotal" class="text-blue-600">Rp 0</span>
                </div>
                
                <!-- Member Check -->
                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="memberCheck" class="checkbox-input">
                        <span class="text-gray-700">Saya anggota HIMAFI (dapatkan diskon 10%)</span>
                    </label>
                </div>
                
                <!-- Checkout Button -->
                <button id="checkoutButton" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white py-4 rounded-full font-bold text-lg hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <i class="fas fa-shopping-bag mr-2"></i> Lanjutkan Pembayaran
                </button>
                
                <p class="text-xs text-gray-500 text-center mt-4">*Biaya antar Rp 5.000 untuk wilayah kampus</p>
            </div>
        </div>
    </div>

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
            
            // Cart elements
            const cartButton = document.getElementById('cartButton');
            const cartButtonMobile = document.getElementById('cartButtonMobile');
            const cartSidebar = document.getElementById('cartSidebar');
            const cartOverlay = document.getElementById('cartOverlay');
            const closeCart = document.getElementById('closeCart');
            const cartCount = document.getElementById('cartCount');
            const cartItems = document.getElementById('cartItems');
            const emptyCart = document.getElementById('emptyCart');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartDiscount = document.getElementById('cartDiscount');
            const cartShipping = document.getElementById('cartShipping');
            const cartTotal = document.getElementById('cartTotal');
            const memberCheck = document.getElementById('memberCheck');
            const checkoutButton = document.getElementById('checkoutButton');
            
            // Filter elements
            const searchInput = document.getElementById('searchInput');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const resetFilters = document.getElementById('resetFilters');
            const productsGrid = document.getElementById('productsGrid');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const emptyState = document.getElementById('emptyState');
            
            // Product data
            const products = [
                {
                    id: 1,
                    name: "Buku Tulis HIMAFI",
                    description: "Buku tulis bergambar logo HIMAFI UNUD, 58 lembar",
                    price: 15000,
                    category: "alat-tulis",
                    stock: 25,
                    image: "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 2,
                    name: "Kaos HIMAFI 2026",
                    description: "Kaos cotton combed premium dengan desain eksklusif",
                    price: 85000,
                    category: "merchandise",
                    stock: 12,
                    image: "https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 3,
                    name: "Pulpen Fisika",
                    description: "Paket 5 pulpen dengan rumus fisika dasar",
                    price: 25000,
                    category: "alat-tulis",
                    stock: 40,
                    image: "https://images.unsplash.com/photo-1583484963886-cfe2bff2945f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 4,
                    name: "Stiker HIMAFI",
                    description: "Paket stiker berbagai ukuran dan desain",
                    price: 10000,
                    category: "merchandise",
                    stock: 8,
                    image: "https://images.unsplash.com/photo-1565688534245-05d6b5be184a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 5,
                    name: "Snack Box Mahasiswa",
                    description: "Paket snack lengkap untuk belajar",
                    price: 30000,
                    category: "makanan",
                    stock: 15,
                    image: "https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 6,
                    name: "Kalkulator Scientific",
                    description: "Kalkulator scientific untuk praktikum fisika",
                    price: 120000,
                    category: "elektronik",
                    stock: 5,
                    image: "https://images.unsplash.com/photo-1587145820266-a5951ee6f620?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 7,
                    name: "Modul Fisika Dasar",
                    description: "Modul pembelajaran fisika dasar semester 1",
                    price: 35000,
                    category: "buku",
                    stock: 20,
                    image: "https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 8,
                    name: "Tote Bag HIMAFI",
                    description: "Tote bag kain dengan desain minimalist",
                    price: 45000,
                    category: "merchandise",
                    stock: 18,
                    image: "https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 9,
                    name: "Power Bank 10000mAh",
                    description: "Power bank portable dengan logo HIMAFI",
                    price: 95000,
                    category: "elektronik",
                    stock: 3,
                    image: "https://images.unsplash.com/photo-1585776464359-bb9c4255c605?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 10,
                    name: "Minuman Energi",
                    description: "Paket 6 botol minuman energi",
                    price: 36000,
                    category: "makanan",
                    stock: 30,
                    image: "https://images.unsplash.com/photo-1622483767028-3f66f32aef97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 11,
                    name: "Notebook Premium",
                    description: "Notebook hardcover untuk catatan kuliah",
                    price: 55000,
                    category: "alat-tulis",
                    stock: 10,
                    image: "https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                },
                {
                    id: 12,
                    name: "USB Flash Drive 32GB",
                    description: "Flash drive dengan casing logo HIMAFI",
                    price: 65000,
                    category: "elektronik",
                    stock: 7,
                    image: "https://images.unsplash.com/photo-1591498242821-6d4d7e1f3c2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                }
            ];
            
            // Cart state
            let cart = JSON.parse(localStorage.getItem('himafi_cart')) || [];
            let activeCategory = 'all';
            let searchQuery = '';
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'koperasi.html') {
                            link.classList.remove('text-white', 'border-cyan-300');
                            link.classList.add('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.remove('text-white/90', 'hover:text-white');
                            link.classList.add('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol cart
                    if (cartButton) {
                        cartButton.classList.remove('from-amber-500', 'to-orange-500', 'shadow-amber-500/30');
                        cartButton.classList.add('from-amber-600', 'to-orange-600');
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
                        if (link.getAttribute('href') === 'koperasi.html') {
                            link.classList.add('text-white', 'border-cyan-300');
                            link.classList.remove('text-blue-600', 'border-blue-600');
                        } else {
                            link.classList.add('text-white/90', 'hover:text-white');
                            link.classList.remove('text-gray-600', 'hover:text-blue-600');
                        }
                    });
                    
                    // Update tombol cart
                    if (cartButton) {
                        cartButton.classList.add('from-amber-500', 'to-orange-500', 'shadow-amber-500/30');
                        cartButton.classList.remove('from-amber-600', 'to-orange-600');
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
            
            // Format currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }
            
            // Get stock badge class
            function getStockBadgeClass(stock) {
                if (stock > 10) return 'stock-in';
                if (stock > 0) return 'stock-low';
                return 'stock-out';
            }
            
            // Get stock badge text
            function getStockBadgeText(stock) {
                if (stock > 10) return 'Tersedia';
                if (stock > 0) return 'Hampir Habis';
                return 'Habis';
            }
            
            // Generate product card
            function generateProductCard(product) {
                const cartItem = cart.find(item => item.id === product.id);
                const quantity = cartItem ? cartItem.quantity : 0;
                const isInCart = quantity > 0;
                
                return `
                    <div class="product-card fade-in" data-category="${product.category}">
                        <div class="relative overflow-hidden">
                            <img src="${product.image}" alt="${product.name}" class="product-image">
                            <div class="absolute top-3 right-3">
                                <span class="stock-badge ${getStockBadgeClass(product.stock)}">
                                    ${getStockBadgeText(product.stock)}
                                </span>
                            </div>
                            <div class="absolute top-3 left-3">
                                <span class="category-badge bg-blue-100 text-blue-800">
                                    ${product.category.replace('-', ' ')}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="font-bold text-gray-900 text-lg mb-2">${product.name}</h3>
                            <p class="text-gray-600 text-sm mb-4">${product.description}</p>
                            
                            <div class="flex justify-between items-center mb-4">
                                <div class="price-tag">
                                    ${formatCurrency(product.price)}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Stok: ${product.stock}
                                </div>
                            </div>
                            
                            ${product.stock > 0 ? `
                                <div class="flex items-center justify-between">
                                    ${isInCart ? `
                                        <div class="flex items-center space-x-2">
                                            <button class="quantity-btn decrease-btn" data-id="${product.id}">-</button>
                                            <input type="text" value="${quantity}" class="quantity-input" data-id="${product.id}" readonly>
                                            <button class="quantity-btn increase-btn" data-id="${product.id}">+</button>
                                        </div>
                                        <button class="cart-btn remove-from-cart" data-id="${product.id}">
                                            <i class="fas fa-trash-alt mr-2"></i> Hapus
                                        </button>
                                    ` : `
                                        <button class="cart-btn add-to-cart" data-id="${product.id}">
                                            <i class="fas fa-cart-plus mr-2"></i> Tambah
                                        </button>
                                    `}
                                </div>
                            ` : `
                                <button class="cart-btn" disabled>
                                    <i class="fas fa-ban mr-2"></i> Stok Habis
                                </button>
                            `}
                        </div>
                    </div>
                `;
            }
            
            // Render products
            function renderProducts() {
                loadingIndicator.classList.remove('hidden');
                productsGrid.innerHTML = '';
                
                setTimeout(() => {
                    const filteredProducts = products.filter(product => {
                        const matchesCategory = activeCategory === 'all' || product.category === activeCategory;
                        const matchesSearch = product.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                                             product.description.toLowerCase().includes(searchQuery.toLowerCase()) ||
                                             product.category.toLowerCase().includes(searchQuery.toLowerCase());
                        return matchesCategory && matchesSearch;
                    });
                    
                    if (filteredProducts.length === 0) {
                        emptyState.classList.remove('hidden');
                        loadingIndicator.classList.add('hidden');
                        return;
                    }
                    
                    emptyState.classList.add('hidden');
                    
                    filteredProducts.forEach(product => {
                        productsGrid.innerHTML += generateProductCard(product);
                    });
                    
                    loadingIndicator.classList.add('hidden');
                    
                    // Add event listeners to product buttons
                    document.querySelectorAll('.add-to-cart').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            addToCart(productId);
                        });
                    });
                    
                    document.querySelectorAll('.remove-from-cart').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            removeFromCart(productId);
                        });
                    });
                    
                    document.querySelectorAll('.increase-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            updateCartQuantity(productId, 1);
                        });
                    });
                    
                    document.querySelectorAll('.decrease-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            updateCartQuantity(productId, -1);
                        });
                    });
                    
                }, 500); // Simulate loading
            }
            
            // Add to cart
            function addToCart(productId) {
                const product = products.find(p => p.id === productId);
                const cartItem = cart.find(item => item.id === productId);
                
                if (cartItem) {
                    if (cartItem.quantity < product.stock) {
                        cartItem.quantity += 1;
                    } else {
                        showNotification('Stok produk tidak mencukupi', 'error');
                        return;
                    }
                } else {
                    cart.push({
                        id: productId,
                        quantity: 1,
                        name: product.name,
                        price: product.price,
                        image: product.image
                    });
                }
                
                saveCart();
                updateCartUI();
                renderProducts();
                showNotification(`${product.name} ditambahkan ke keranjang`, 'success');
            }
            
            // Remove from cart
            function removeFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                saveCart();
                updateCartUI();
                renderProducts();
                showNotification('Produk dihapus dari keranjang', 'info');
            }
            
            // Update cart quantity
            function updateCartQuantity(productId, change) {
                const cartItem = cart.find(item => item.id === productId);
                const product = products.find(p => p.id === productId);
                
                if (cartItem) {
                    const newQuantity = cartItem.quantity + change;
                    
                    if (newQuantity < 1) {
                        removeFromCart(productId);
                        return;
                    }
                    
                    if (newQuantity > product.stock) {
                        showNotification('Stok produk tidak mencukupi', 'error');
                        return;
                    }
                    
                    cartItem.quantity = newQuantity;
                    saveCart();
                    updateCartUI();
                    renderProducts();
                }
            }
            
            // Save cart to localStorage
            function saveCart() {
                localStorage.setItem('himafi_cart', JSON.stringify(cart));
            }
            
            // Update cart UI
            function updateCartUI() {
                // Update cart count
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCount.textContent = totalItems;
                
                // Update mobile cart button
                if (cartButtonMobile) {
                    cartButtonMobile.innerHTML = `<i class="fas fa-shopping-cart mr-2"></i> Keranjang (${totalItems})`;
                }
                
                // Update cart items in sidebar
                cartItems.innerHTML = '';
                
                if (cart.length === 0) {
                    cartItems.appendChild(emptyCart);
                    checkoutButton.disabled = true;
                } else {
                    emptyCart.classList.add('hidden');
                    cart.forEach(item => {
                        const product = products.find(p => p.id === item.id);
                        if (!product) return;
                        
                        const cartItemDiv = document.createElement('div');
                        cartItemDiv.className = 'flex items-center space-x-4 p-4 bg-gray-50 rounded-lg';
                        cartItemDiv.innerHTML = `
                            <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-medium text-gray-900">${product.name}</h4>
                                <p class="text-sm text-gray-600">${formatCurrency(product.price)}</p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <button class="quantity-btn decrease-cart-btn" data-id="${item.id}">-</button>
                                    <input type="text" value="${item.quantity}" class="quantity-input cart-quantity" data-id="${item.id}" readonly>
                                    <button class="quantity-btn increase-cart-btn" data-id="${item.id}">+</button>
                                    <button class="text-red-500 hover:text-red-700 ml-4 remove-cart-btn" data-id="${item.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-gray-900">${formatCurrency(product.price * item.quantity)}</div>
                            </div>
                        `;
                        cartItems.appendChild(cartItemDiv);
                    });
                    
                    checkoutButton.disabled = false;
                    
                    // Add event listeners to cart item buttons
                    document.querySelectorAll('.decrease-cart-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            updateCartQuantity(productId, -1);
                        });
                    });
                    
                    document.querySelectorAll('.increase-cart-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            updateCartQuantity(productId, 1);
                        });
                    });
                    
                    document.querySelectorAll('.remove-cart-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = parseInt(this.getAttribute('data-id'));
                            removeFromCart(productId);
                        });
                    });
                }
                
                // Update cart summary
                updateCartSummary();
            }
            
            // Update cart summary
            function updateCartSummary() {
                const subtotal = cart.reduce((sum, item) => {
                    const product = products.find(p => p.id === item.id);
                    return sum + (product.price * item.quantity);
                }, 0);
                
                const isMember = memberCheck.checked;
                const discount = isMember ? subtotal * 0.1 : 0;
                const shipping = cart.length > 0 ? 5000 : 0;
                const total = subtotal - discount + shipping;
                
                cartSubtotal.textContent = formatCurrency(subtotal);
                cartDiscount.textContent = `-${formatCurrency(discount)}`;
                cartShipping.textContent = formatCurrency(shipping);
                cartTotal.textContent = formatCurrency(total);
            }
            
            // Open cart sidebar
            function openCart() {
                cartSidebar.classList.add('open');
                cartOverlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            
            // Close cart sidebar
            function closeCartSidebar() {
                cartSidebar.classList.remove('open');
                cartOverlay.classList.remove('open');
                document.body.style.overflow = '';
            }
            
            // Cart event listeners
            cartButton.addEventListener('click', openCart);
            cartButtonMobile.addEventListener('click', openCart);
            closeCart.addEventListener('click', closeCartSidebar);
            cartOverlay.addEventListener('click', closeCartSidebar);
            
            // Member check change
            memberCheck.addEventListener('change', updateCartSummary);
            
            // Checkout button
            checkoutButton.addEventListener('click', function() {
                showNotification('Fitur checkout belum tersedia di versi demo. Silakan hubungi admin koperasi.', 'info');
                closeCartSidebar();
            });
            
            // Filter buttons
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    // Update active category
                    activeCategory = this.getAttribute('data-category');
                    // Render products with new filter
                    renderProducts();
                });
            });
            
            // Search input
            searchInput.addEventListener('input', function() {
                searchQuery = this.value;
                renderProducts();
            });
            
            // Reset filters
            resetFilters.addEventListener('click', function() {
                searchInput.value = '';
                searchQuery = '';
                activeCategory = 'all';
                
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.getAttribute('data-category') === 'all') {
                        btn.classList.add('active');
                    }
                });
                
                renderProducts();
            });
            
            // Sort button
            document.getElementById('sortButton').addEventListener('click', function() {
                showNotification('Fitur sorting belum tersedia di versi demo.', 'info');
            });
            
            // Filter button
            document.getElementById('filterButton').addEventListener('click', function() {
                showNotification('Fitur filter lanjutan belum tersedia di versi demo.', 'info');
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
            
            // Initialize
            updateCartUI();
            renderProducts();
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
        });
    </script>
</body>
</html>