<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMAFI UNUD - Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    @vite('resources/css/app.css')
    <!-- Ikon untuk menu burger (dari Font Awesome via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* #mainHeader {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
    } */
    
    #mainHeader.scrolled {
        backdrop-filter: blur(0);
        -webkit-backdrop-filter: blur(0);
    }
    
    /* Smooth transition untuk semua elemen header */
    #mainHeader * {
        transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
    }
</style>
</head>
<body class="bg-gray-50 text-gray-800">
@include("layout.header")

<!-- Hero Section FULL SCREEN (setelah header) -->
<section class="relative w-full min-h-screen text-white overflow-hidden -mt-18">
    <!-- Background Image FULL SCREEN -->
    <div class="absolute inset-0 z-0">
        <img 
            src="/img/homeimg.png" 
            alt="Kabinet Arunika Swakarsa" 
            class="w-full h-full object-cover"
        >
        <!-- Overlay gradient untuk keterbacaan -->
        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/40 to-transparent"></div>
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    
    <!-- Konten Teks di tengah layar -->
    <div class="relative text-center z-10 min-h-screen flex flex-col justify-center items-center px-4 py-16 pt-20">
    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
            <span class="block">KABINET</span>
            <span class="block bg-linear-to-r from-amber-300 to-yellow-100 bg-clip-text text-transparent mt-2">
                ARUNIKA SWAKARSA
            </span>
        </h1>

        <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto">
        Himpunan Mahasiswa Fisika (HIMAFI) tahun 2026 merupakan organisasi mahasiswa yang berperan sebagai wadah pengembangan diri, kreativitas, dan aspirasi seluruh mahasiswa Fisika. Dengan semangat kolaborasi dan inovasi, HIMAFI 2026 berkomitmen untuk menciptakan lingkungan yang aktif, harmonis, serta berorientasi pada peningkatan kualitas akademik dan non-akademik mahasiswa.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-white text-blue-800 font-bold px-8 py-4 rounded-full hover:bg-gray-100 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-lg">
                Jelajahi Kabinet <i class="fas fa-arrow-right ml-2"></i>
            </a>
            <a href="/profilevideo"
               class="border-2 border-white font-bold px-8 py-4 rounded-full hover:bg-white/10 hover:shadow-2xl transition-all duration-300 text-lg">
                <i class="fas fa-play-circle mr-2"></i> Video Profil
            </a>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="hidden md:block absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce z-10">
        <i class="fas fa-chevron-down text-white/70 text-xl"></i>
    </div>
</section>
    <!-- Layanan Kami Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan <span class="text-blue-600">Unggulan</span> Kami</h2>
                <p class="text-xl text-gray-600">Akses berbagai layanan kemahasiswaan HIMAFI UNUD yang dirancang untuk mendukung aktivitas akademik dan non-akademik Anda.</p>
            </div>

            <!-- Service Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-14 h-14 bg-linear-to-br from-blue-100 to-blue-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                        <i class="fas fa-box-open text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Peminjaman Inventaris</h3>
                    <p class="text-gray-600 mb-6">Ajukan peminjaman alat laboratorium, multimedia, dan inventaris organisasi lainnya secara online dengan proses yang cepat dan terintegrasi.</p>
                    <a href="#" class="text-blue-600 font-semibold inline-flex items-center hover:text-blue-800">
                        Ajukan Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-14 h-14 bg-linear-to-br from-green-100 to-green-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                        <i class="fas fa-signature text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pengajuan Tanda Tangan</h3>
                    <p class="text-gray-600 mb-6">Layanan pengajuan tanda tangan digital untuk surat pengantar, proposal, dan dokumen administratif resmi lainnya dari pengurus HIMAFI.</p>
                    <a href="/pengajuantte" class="text-green-600 font-semibold inline-flex items-center hover:text-green-800">
                        Mulai Pengajuan <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-14 h-14 bg-linear-to-br from-amber-100 to-amber-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                        <i class="fas fa-store text-2xl text-amber-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Koperasi Mahasiswa</h3>
                    <p class="text-gray-600 mb-6">Temukan kebutuhan kampus dengan harga terjangkau. Dari alat tulis, merchandise HIMAFI, hingga snack tersedia di koperasi kami.</p>
                    <a href="/katalog" class="text-amber-600 font-semibold inline-flex items-center hover:text-amber-800">
                        Lihat Katalog <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-14 h-14 bg-linear-to-br from-purple-100 to-purple-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                        <i class="fas fa-comment-dots text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Ruang Aspirasi</h3>
                    <p class="text-gray-600 mb-6">Sampaikan ide, kritik, dan saran Anda untuk kemajuan HIMAFI dan jurusan Fisika. Setiap aspirasi akan didengar dan ditindaklanjuti.</p>
                    <a href="/aspirasi" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-800">
                        Beri Aspirasi <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Card 5 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-14 h-14 bg-linear-to-br from-red-100 to-red-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                        <i class="fas fa-laptop-code text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pelatihan Online</h3>
                    <p class="text-gray-600 mb-6">Tingkatkan skill dengan webinar dan pelatihan online eksklusif anggota HIMAFI, mulai dari pemrograman, analisis data, hingga soft skills.</p>
                    <a href="#" class="text-red-600 font-semibold inline-flex items-center hover:text-red-800">
                        Lihat Jadwal <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Card 6 (Bonus: Layanan Baru) -->
                <div class="bg-linear-to-br from-blue-600 to-cyan-500 rounded-2xl p-8 shadow-2xl text-white group">
                    <div class="w-14 h-14 bg-white/20 rounded-xl mb-6 flex items-center justify-center group-hover:rotate-12 transition duration-500">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Info Kegiatan Terbaru</h3>
                    <p class="mb-6 opacity-90">Jangan lewatkan event dan deadline penting! Dapatkan notifikasi langsung untuk berbagai lomba, workshop, dan kegiatan HIMAFI lainnya.</p>
                    <a href="#" class="font-semibold inline-flex items-center bg-white text-blue-700 px-5 py-3 rounded-full hover:bg-gray-100 transition">
                        <i class="fas fa-bell mr-2"></i> Aktifkan Notifikasi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel & Berita Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-2">Artikel & <span class="text-blue-600">Berita</span> Terkini</h2>
                    <p class="text-gray-600">Update kegiatan, prestasi, dan informasi terbaru dari keluarga besar HIMAFI UNUD.</p>
                </div>
                <a href="#" class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                    Lihat Arsip <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Artikel 1 -->
                <article class="group">
                    <div class="overflow-hidden rounded-2xl mb-6">
                        <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Saraswati Fisika 2025" class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium mr-3">Acara</span>
                        <span><i class="far fa-calendar mr-1"></i> 15 Maret 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Suksesnya Saraswati Fisika 2025: Merayakan Ilmu & Budaya</h3>
                    <p class="text-gray-600 mb-4">Rangkaian acara penghormatan kepada Dewi Ilmu Pengetahuan berhasil digelar dengan meriah, mengolaborasikan presentasi ilmiah dengan pertunjukan seni budaya Bali.</p>
                    <a href="#" class="inline-flex items-center font-medium text-blue-600">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                    </a>
                </article>

                <!-- Artikel 2 -->
                <article class="group">
                    <div class="overflow-hidden rounded-2xl mb-6">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tim Olimpiade" class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium mr-3">Prestasi</span>
                        <span><i class="far fa-calendar mr-1"></i> 28 Februari 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Dua Mahasiswa Fisika Raih Medali di Olimpiade Sains Nasional</h3>
                    <p class="text-gray-600 mb-4">Atas bimbingan dosen dan dukungan HIMAFI, tim perwakilan UNUD berhasil membawa pulang satu medali perak dan satu perunggu dalam OSN 2025.</p>
                    <a href="#" class="inline-flex items-center font-medium text-blue-600">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                    </a>
                </article>

                <!-- Artikel 3 -->
                <article class="group">
                    <div class="overflow-hidden rounded-2xl mb-6">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Workshop" class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium mr-3">Workshop</span>
                        <span><i class="far fa-calendar mr-1"></i> 10 Februari 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Workshop Python untuk Fisika Komputasi Diikuti 100+ Peserta</h3>
                    <p class="text-gray-600 mb-4">Menyongsong revolusi industri 4.0, HIMAFI sukses mengadakan workshop intensif pemrograman Python untuk simulasi dan analisis data fisika.</p>
                    <a href="#" class="inline-flex items-center font-medium text-blue-600">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                    </a>
                </article>
            </div>

            <div class="text-center mt-12 md:hidden">
                <a href="#" class="inline-flex items-center justify-center bg-linear-to-r from-blue-600 to-cyan-500 text-white font-bold px-8 py-4 rounded-full hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    Lihat Semua Artikel <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    @include("layout.footer")

    <!-- Tombol Back to Top -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-linear-to-br from-blue-600 to-cyan-500 text-white rounded-full shadow-2xl hover:shadow-cyan-500/30 hover:scale-110 transition-all duration-300 z-40 hidden items-center justify-center text-2xl">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Skrip JavaScript Sederhana untuk Menu Mobile dan Back to Top -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('mainHeader');
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        // Fungsi untuk update header berdasarkan scroll
        function updateHeaderOnScroll() {
            if (window.scrollY > 50) {
                // Saat di-scroll (lebih dari 50px)
                header.classList.remove('bg-transparent');
                header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                
                // Update teks navigasi desktop
                const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                desktopLinks.forEach(link => {
                    if (link.textContent === 'Beranda') {
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
                
                // Update logo text color
                const logoText = document.querySelector('strong.bg-gradient-to-r');
                if (logoText) {
                    logoText.classList.remove('from-blue-700', 'to-cyan-600');
                    logoText.classList.add('from-blue-700', 'to-cyan-600');
                }
                
            } else {
                // Saat di atas (posisi awal)
                header.classList.add('bg-transparent');
                header.classList.remove('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                
                // Update teks navigasi desktop
                const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                desktopLinks.forEach(link => {
                    if (link.textContent === 'Beranda') {
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
                
                // Update logo text color
                const logoText = document.querySelector('strong.bg-gradient-to-r');
                if (logoText) {
                    logoText.classList.add('from-blue-700', 'to-cyan-600');
                }
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
        
        // Event listener untuk scroll
        window.addEventListener('scroll', updateHeaderOnScroll);
        
        // Jalankan sekali saat load
        updateHeaderOnScroll();
    });

        // Toggle Menu Mobile
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        menuBtn.addEventListener('click', () => {
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

        // Back to Top Button
        const backToTopBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('hidden');
                backToTopBtn.classList.add('flex');
            } else {
                backToTopBtn.classList.add('hidden');
                backToTopBtn.classList.remove('flex');
            }
        });
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>