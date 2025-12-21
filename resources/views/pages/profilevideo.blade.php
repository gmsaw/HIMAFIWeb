<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Profil - HIMAFI UNUD Kabinet Arunika Swakarsa</title>
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
        
        /* Custom styles untuk video player */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
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
    @include('layout.header')

    <!-- Hero Section untuk Video -->
    <section class="relative w-full min-h-[40vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-linear-to-r from-blue-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative text-center z-10 min-h-[40vh] flex flex-col justify-center items-center px-4 py-12">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                <span class="block">VIDEO PROFIL</span>
                <span class="block bg-linear-to-r from-amber-300 to-yellow-100 bg-clip-text text-transparent mt-2">
                    KABINET ARUNIKA SWAKARSA
                </span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-3xl mx-auto">
                Sambut semangat baru, saksikan perjalanan, dan eksplorasi visi Kabinet Arunika Swakarsa melalui video profil eksklusif kami.
            </p>
            <div class="flex items-center justify-center text-cyan-300">
                <i class="fas fa-play-circle mr-2"></i>
                <span>HIMAFI UNUD 2026</span>
            </div>
        </div>
    </section>

    <!-- Video Player Section -->
    <section class="py-12 md:py-20 bg-linear-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Video Player Container -->
                <div class="mb-10">
                    <div class="video-container">
                        <!-- Ganti dengan embed YouTube atau video lokal -->
                        <iframe 
                            src="https://www.youtube.com/embed/0TL9IxcR9CI?si=iDZ6UskyegfdWbvq" 
                            title="Video Profil Kabinet Arunika Swakarsa - HIMAFI UNUD 2026" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>

                <!-- Video Information -->
                <div class="bg-white rounded-2xl p-8 shadow-lg mb-10 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Profil Kabinet Arunika Swakarsa 2026</h2>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600">
                                <span class="flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i> 15 Maret 2025
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-clock mr-2"></i> 5:42 Menit
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-eye mr-2"></i> 1.245x ditonton
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-5 py-3 rounded-full font-semibold transition duration-300">
                                <i class="far fa-thumbs-up mr-2"></i> 245
                            </button>
                            <button class="bg-red-50 text-red-600 hover:bg-red-100 px-5 py-3 rounded-full font-semibold transition duration-300">
                                <i class="far fa-share-square mr-2"></i> Bagikan
                            </button>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Video profil ini menampilkan visi, misi, dan perjalanan Kabinet Arunika Swakarsa HIMAFI UNUD 2026. Menyajikan semangat baru dalam kepemimpinan mahasiswa fisika dengan fokus pada pengembangan diri, kreativitas, dan inovasi untuk menciptakan lingkungan akademik yang aktif dan harmonis.
                    </p>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-3">
                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-medium">HIMAFI UNUD</span>
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-medium">Kabinet Arunika Swakarsa</span>
                            <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-medium">Profil Organisasi</span>
                            <span class="bg-amber-100 text-amber-800 px-4 py-2 rounded-full font-medium">Fisika Universitas Udayana</span>
                        </div>
                    </div>
                </div>

                <!-- Video Playlist (jika ada) -->
                <div class="mb-10">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Video Lainnya</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Video 1 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Saraswati Fisika 2025" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <div class="w-16 h-16 bg-linear-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-sm px-2 py-1 rounded">
                                    3:45
                                </div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">Saraswati Fisika 2025</h4>
                                <p class="text-gray-600 text-sm mb-3">Acara penghormatan kepada Dewi Ilmu Pengetahuan</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>15 Mar 2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- Video 2 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Workshop Python" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <div class="w-16 h-16 bg-linear-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-sm px-2 py-1 rounded">
                                    12:20
                                </div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">Workshop Python untuk Fisika</h4>
                                <p class="text-gray-600 text-sm mb-3">Pelatihan pemrograman untuk analisis data fisika</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>10 Feb 2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- Video 3 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pelantikan Pengurus" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                    <div class="w-16 h-16 bg-linear-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-sm px-2 py-1 rounded">
                                    8:15
                                </div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">Pelantikan Pengurus HIMAFI 2026</h4>
                                <p class="text-gray-600 text-sm mb-3">Upacara serah terima jabatan kepengurusan</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>5 Jan 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Komentar Section -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Komentar (15)</h3>
                    
                    <!-- Form Komentar -->
                    <div class="mb-10">
                        <div class="flex items-start space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                A
                            </div>
                            <div class="flex-1">
                                <textarea class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="Tambahkan komentar..."></textarea>
                                <div class="flex justify-end mt-3">
                                    <button class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition duration-300">
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Komentar -->
                    <div class="space-y-6">
                        <!-- Komentar 1 -->
                        <div class="flex items-start space-x-4 pb-6 border-b border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-yellow-400 rounded-full flex items-center justify-center text-white font-bold">
                                R
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900">Rizki Pratama</h4>
                                        <span class="text-gray-500 text-sm">2 hari yang lalu</span>
                                    </div>
                                    <button class="text-gray-400 hover:text-blue-600">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                </div>
                                <p class="text-gray-700 mb-3">
                                    Video yang sangat inspiratif! Semangat baru untuk HIMAFI UNUD 2026. Sukses selalu untuk Kabinet Arunika Swakarsa!
                                </p>
                                <div class="flex items-center space-x-4 text-gray-500">
                                    <button class="flex items-center hover:text-blue-600">
                                        <i class="far fa-thumbs-up mr-1"></i> 12
                                    </button>
                                    <button class="flex items-center hover:text-red-600">
                                        <i class="far fa-thumbs-down mr-1"></i> 1
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Komentar 2 -->
                        <div class="flex items-start space-x-4 pb-6 border-b border-gray-100">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex items-center justify-center text-white font-bold">
                                S
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900">Sari Dewi</h4>
                                        <span class="text-gray-500 text-sm">1 minggu yang lalu</span>
                                    </div>
                                    <button class="text-gray-400 hover:text-blue-600">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                </div>
                                <p class="text-gray-700 mb-3">
                                    Keren banget videonya! Produksi dan editingnya sangat profesional. Bisa lihat langsung visi misi kabinet baru. Good job tim kreatif!
                                </p>
                                <div class="flex items-center space-x-4 text-gray-500">
                                    <button class="flex items-center hover:text-blue-600">
                                        <i class="far fa-thumbs-up mr-1"></i> 8
                                    </button>
                                    <button class="flex items-center hover:text-red-600">
                                        <i class="far fa-thumbs-down mr-1"></i> 0
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Lihat Lebih Banyak -->
                        <div class="text-center pt-4">
                            <button class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <i class="fas fa-comment-dots mr-2"></i> Muat Lebih Banyak Komentar
                            </button>
                        </div>
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
            const header = document.getElementById('mainHeader');
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const backToTopBtn = document.getElementById('backToTop');
            
            // Fungsi untuk update header berdasarkan scroll
            function updateHeaderOnScroll() {
                if (window.scrollY > 50) {
                    // Saat di-scroll (lebih dari 50px)
                    header.classList.remove('bg-transparent');
                    header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                    
                    // Update teks navigasi desktop
                    const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                    desktopLinks.forEach(link => {
                        if (link.getAttribute('href') === 'video.html') {
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
                        if (link.getAttribute('href') === 'video.html') {
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
            
            // Event listener untuk scroll
            window.addEventListener('scroll', updateHeaderOnScroll);
            
            // Jalankan sekali saat load
            updateHeaderOnScroll();
            
            // Video play button functionality
            const playButtons = document.querySelectorAll('.video-play-button');
            playButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const videoCard = this.closest('.video-card');
                    const videoThumbnail = videoCard.querySelector('.video-thumbnail');
                    const videoIframe = videoCard.querySelector('iframe');
                    
                    if (videoIframe) {
                        // Ganti thumbnail dengan iframe aktif
                        videoThumbnail.style.display = 'none';
                        videoIframe.style.display = 'block';
                        videoIframe.src += "&autoplay=1";
                    }
                });
            });
        });
    </script>
</body>
</html>