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
        .article-content {
            max-width: 768px;
            margin: 0 auto;
        }
        
        .article-content h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .article-content h2 {
            font-size: 1.875rem;
            font-weight: 700;
            line-height: 1.3;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.4;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .article-content p {
            font-size: 1.125rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            color: #374151;
        }
        
        .article-content blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #4b5563;
        }
        
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }
        
        .article-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 1rem;
            margin: 2rem 0;
        }
        
        .tag-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #eff6ff;
            color: #1d4ed8;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .share-btn {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            background: white;
            transition: all 0.3s ease;
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                    <a href="fungsionaris.html" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Fungsionaris</a>
                    <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Program Kerja</a>
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
                    <a href="#" class="font-medium text-white/90 hover:text-white py-2">Program Kerja</a>
                    <a href="artikel.html" class="font-semibold text-white py-2">Artikel</a>
                    <a href="login.html" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">Masuk</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section untuk Artikel -->
    <section class="relative w-full min-h-[50vh] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-800"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); background-size: cover; background-position: center;"></div>
        </div>
        
        <!-- Konten Teks -->
        <div class="relative z-10 min-h-[50vh] flex flex-col justify-center items-center px-4 py-12">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">AKADEMIK</span>
                </div>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Suksesnya Saraswati Fisika 2025: Merayakan Ilmu & Budaya
                </h1>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-gray-200">
                    <div class="flex items-center">
                        <i class="fas fa-user-edit mr-2"></i>
                        <span>Oleh: Tim Redaksi HIMAFI</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>15 Maret 2025</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>5 min read</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Artikel Content -->
    <section class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="article-content fade-in">
                <!-- Featured Image -->
                <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Saraswati Fisika 2025" class="article-image">
                
                <!-- Article Meta -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                T
                            </div>
                            <div>
                                <h4 class="font-bold">Tim Redaksi HIMAFI</h4>
                                <p class="text-gray-600 text-sm">Divisi Media dan Informasi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-600">Bagikan:</span>
                        <a href="#" class="share-btn text-blue-600 hover:bg-blue-50">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="share-btn text-blue-400 hover:bg-blue-50">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="share-btn text-red-500 hover:bg-red-50">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="share-btn text-gray-800 hover:bg-gray-100">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Article Content -->
                <div class="prose prose-lg max-w-none">
                    <p class="lead text-xl text-gray-700 font-medium mb-8">
                        Rangkaian acara penghormatan kepada Dewi Ilmu Pengetahuan berhasil digelar dengan meriah, mengolaborasikan presentasi ilmiah dengan pertunjukan seni budaya Bali.
                    </p>
                    
                    <h2>Sinergi Ilmu Pengetahuan dan Kearifan Lokal</h2>
                    
                    <p>
                        Departemen Fisika Universitas Udayana kembali menggelar acara tahunan Saraswati Fisika 2025 yang berlangsung sukses pada tanggal 15 Maret 2025. Acara yang bertema "Vidya dan Budaya: Dua Sayap Menuju Kebijaksanaan" ini dihadiri oleh lebih dari 300 peserta yang terdiri dari mahasiswa, dosen, alumni, dan masyarakat umum.
                    </p>
                    
                    <blockquote>
                        "Saraswati bukan sekadar ritual, tetapi penghormatan terhadap ilmu pengetahuan itu sendiri. Fisika sebagai ilmu dasar harus terus dikembangkan dengan tetap menjaga akar budaya kita."
                        <footer class="mt-2 text-sm">— Prof. Dr. I Made Sukaryana, M.Si., Ketua Departemen Fisika</footer>
                    </blockquote>
                    
                    <h2>Rangkaian Kegiatan yang Berkesan</h2>
                    
                    <h3>1. Seminar Ilmiah Interdisipliner</h3>
                    <p>
                        Pagi hari diawali dengan seminar ilmiah yang menghadirkan tiga pembicara utama dari berbagai bidang. Dr. Ni Putu Ayu Sri Wulandari mempresentasikan penelitian terbaru tentang material semikonduktor berbasis perovskite, sementara Dr. I Gede Surya memaparkan aplikasi fisika dalam pelestarian budaya Bali.
                    </p>
                    
                    <h3>2. Pameran Inovasi Mahasiswa</h3>
                    <p>
                        Sepanjang hari, lobi gedung MIPA dipenuhi dengan stan-stan pameran yang menampilkan berbagai inovasi mahasiswa fisika. Mulai dari alat ukur presisi buatan sendiri, simulasi fisika berbasis komputer, hingga penerapan fisika dalam seni dan kerajinan tradisional Bali.
                    </p>
                    
                    <h3>3. Pentas Seni dan Budaya</h3>
                    <p>
                        Malam hari menjadi puncak acara dengan pertunjukan seni yang memadukan unsur modern dan tradisional. Kelompok tari mahasiswa fisika menampilkan Sendratari "Dewa Saraswati" dengan koreografi yang mengintegrasikan konsep fisika gerak dan momentum.
                    </p>
                    
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Pentas Seni Saraswati" class="article-image">
                    
                    <h2>Dampak dan Harapan ke Depan</h2>
                    
                    <p>
                        Menurut panitia pelaksana yang diketuai oleh Mahendra Putra dari HIMAFI UNUD, acara ini tidak hanya menjadi wadah silaturahmi, tetapi juga menunjukkan bahwa ilmu pengetahuan dan budaya dapat berjalan beriringan. "Kami ingin membuktikan bahwa fisika bukan ilmu yang kaku dan terpisah dari kehidupan sehari-hari, termasuk budaya kita," ungkapnya.
                    </p>
                    
                    <p>
                        Acara ditutup dengan pembacaan doa bersama dan pembagian hadiah bagi pemenang lomba karya ilmiah yang diadakan selama seminggu sebelumnya. Para peserta tampak antusias dan berharap acara serupa dapat terus dilaksanakan dengan skala yang lebih besar di tahun-tahun mendatang.
                    </p>
                    
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-6 my-8 rounded-r-lg">
                        <h3 class="font-bold text-gray-900 mb-2">Fakta Singkat Saraswati Fisika 2025</h3>
                        <ul class="list-none space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-500 mt-1 mr-3"></i>
                                <span>300+ peserta dari berbagai kalangan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-500 mt-1 mr-3"></i>
                                <span>15 stan pameran inovasi mahasiswa</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-500 mt-1 mr-3"></i>
                                <span>8 karya ilmiah dipresentasikan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-blue-500 mt-1 mr-3"></i>
                                <span>3 pertunjukan seni dan budaya</span>
                            </li>
                        </ul>
                    </div>
                    
                    <h2>Kata Penutup</h2>
                    
                    <p>
                        Saraswati Fisika 2025 telah membuktikan bahwa ilmu pengetahuan dan budaya bukanlah dua hal yang bertentangan, melainkan dapat saling memperkaya. Sebagai mahasiswa fisika, kita memiliki tanggung jawab tidak hanya mengembangkan ilmu, tetapi juga menjaga dan menghidupkan kearifan lokal yang menjadi identitas kita.
                    </p>
                    
                    <p>
                        HIMAFI UNUD berkomitmen untuk terus menjadi fasilitator dalam pengembangan potensi akademik dan budaya mahasiswa fisika. Melalui berbagai kegiatan seperti ini, kami berharap dapat mencetak fisikawan muda yang tidak hanya cerdas secara intelektual, tetapi juga memiliki rasa cinta terhadap budaya dan tradisi.
                    </p>
                </div>
                
                <!-- Tags -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Tags</h3>
                    <div class="flex flex-wrap">
                        <span class="tag-badge">Saraswati</span>
                        <span class="tag-badge">Fisika UNUD</span>
                        <span class="tag-badge">Budaya Bali</span>
                        <span class="tag-badge">Akademik</span>
                        <span class="tag-badge">HIMAFI 2026</span>
                        <span class="tag-badge">Event Kampus</span>
                    </div>
                </div>
                
                <!-- Author Bio -->
                <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                    <div class="flex items-start">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                            T
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">Tentang Penulis</h3>
                            <p class="text-gray-600 mb-2">
                                Tim Redaksi HIMAFI adalah bagian dari Divisi Media dan Informasi Kabinet Arunika Swakarsa. Bertugas menyampaikan informasi, berita, dan artikel terkait kegiatan HIMAFI UNUD dan perkembangan dunia fisika.
                            </p>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                Lihat Artikel Lainnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Articles -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="#" class="group">
                    <div class="flex items-center p-6 bg-gray-50 rounded-xl hover:bg-blue-50 transition duration-300">
                        <div class="mr-6">
                            <i class="fas fa-arrow-left text-2xl text-gray-400 group-hover:text-blue-600"></i>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500 block mb-1">Artikel Sebelumnya</span>
                            <h4 class="font-bold text-gray-900 group-hover:text-blue-600">Workshop Python untuk Fisika Komputasi Diikuti 100+ Peserta</h4>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="group">
                    <div class="flex items-center p-6 bg-gray-50 rounded-xl hover:bg-blue-50 transition duration-300 text-right">
                        <div class="ml-6">
                            <i class="fas fa-arrow-right text-2xl text-gray-400 group-hover:text-blue-600"></i>
                        </div>
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 block mb-1">Artikel Selanjutnya</span>
                            <h4 class="font-bold text-gray-900 group-hover:text-blue-600">Dua Mahasiswa Fisika Raih Medali di Olimpiade Sains Nasional</h4>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Related Articles -->
            <div class="mt-20">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Artikel Terkait</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article class="group">
                        <div class="overflow-hidden rounded-xl mb-4">
                            <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tim Olimpiade" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium mr-3">Prestasi</span>
                            <span><i class="far fa-calendar mr-1"></i> 28 Februari 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Dua Mahasiswa Fisika Raih Medali di Olimpiade Sains Nasional</h3>
                        <a href="#" class="inline-flex items-center font-medium text-blue-600">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                        </a>
                    </article>
                    
                    <article class="group">
                        <div class="overflow-hidden rounded-xl mb-4">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Workshop" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium mr-3">Workshop</span>
                            <span><i class="far fa-calendar mr-1"></i> 10 Februari 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Workshop Python untuk Fisika Komputasi Diikuti 100+ Peserta</h3>
                        <a href="#" class="inline-flex items-center font-medium text-blue-600">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                        </a>
                    </article>
                    
                    <article class="group">
                        <div class="overflow-hidden rounded-xl mb-4">
                            <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Pelantikan" class="w-full h-48 object-cover group-hover:scale-110 transition duration-700">
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium mr-3">Organisasi</span>
                            <span><i class="far fa-calendar mr-1"></i> 5 Januari 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">Pelantikan Pengurus HIMAFI 2026: Semangat Baru Kabinet Arunika Swakarsa</h3>
                        <a href="#" class="inline-flex items-center font-medium text-blue-600">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition"></i>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-blue-50 to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Tetap Terhubung dengan HIMAFI</h2>
                <p class="text-gray-600 mb-8">Dapatkan artikel terbaru dan informasi kegiatan langsung ke email Anda</p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Email Anda" class="flex-grow px-6 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition duration-300">
                        Berlangganan
                    </button>
                </div>
                
                <p class="text-sm text-gray-500 mt-4">Dengan berlangganan, Anda menyetujui kebijakan privasi kami</p>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elemen DOM
        const header = document.getElementById('mainHeader');
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const backToTopBtn = document.getElementById('backToTop');
        
        // Fungsi update header berdasarkan scroll
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
                    const icon = menuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });
        }
        
        // Back to top button
        if (backToTopBtn) {
            // Tampilkan/sembunyikan tombol berdasarkan scroll
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
        
        // Animasi fade-in untuk konten artikel
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
        const elementsToAnimate = document.querySelectorAll('.article-content');
        elementsToAnimate.forEach(el => observer.observe(el));
        
        // Fitur share artikel
        const shareButtons = document.querySelectorAll('.share-btn');
        shareButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const currentURL = window.location.href;
                const articleTitle = document.querySelector('h1').textContent;
                
                if (this.querySelector('.fa-facebook-f')) {
                    // Share ke Facebook
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentURL)}`, '_blank');
                } else if (this.querySelector('.fa-twitter')) {
                    // Share ke Twitter
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(articleTitle)}&url=${encodeURIComponent(currentURL)}`, '_blank');
                } else if (this.querySelector('.fa-whatsapp')) {
                    // Share ke WhatsApp
                    window.open(`https://wa.me/?text=${encodeURIComponent(articleTitle + ' ' + currentURL)}`, '_blank');
                } else if (this.querySelector('.fa-link')) {
                    // Salin link ke clipboard
                    navigator.clipboard.writeText(currentURL).then(() => {
                        // Tampilkan notifikasi
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.classList.add('bg-green-50', 'border-green-500');
                        
                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.classList.remove('bg-green-50', 'border-green-500');
                        }, 2000);
                    });
                }
            });
        });
        
        // Newsletter form
        const newsletterForm = document.querySelector('.bg-gradient-to-r.from-blue-50.to-cyan-50 form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');
                const submitBtn = this.querySelector('button');
                
                if (emailInput.value && emailInput.value.includes('@')) {
                    // Simpan state asli
                    const originalBtnText = submitBtn.textContent;
                    
                    // Tampilkan loading
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                    submitBtn.disabled = true;
                    
                    // Simulasi pengiriman
                    setTimeout(() => {
                        // Tampilkan sukses
                        submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Berhasil!';
                        submitBtn.classList.remove('from-blue-500', 'to-cyan-500');
                        submitBtn.classList.add('from-green-500', 'to-green-600');
                        
                        // Reset form
                        emailInput.value = '';
                        
                        // Kembali ke state asli setelah 3 detik
                        setTimeout(() => {
                            submitBtn.innerHTML = originalBtnText;
                            submitBtn.classList.remove('from-green-500', 'to-green-600');
                            submitBtn.classList.add('from-blue-500', 'to-cyan-500');
                            submitBtn.disabled = false;
                        }, 3000);
                    }, 1500);
                }
            });
        }
    });
</script>
</body>
</html>