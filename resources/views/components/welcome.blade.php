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
            <a href="/video-profile"
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