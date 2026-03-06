<section class="relative w-full min-h-[100dvh] text-white overflow-hidden font-sans flex items-center justify-center">
    
    <div class="absolute inset-0 z-0 select-none pointer-events-none">
        <img 
            src="/img/homeimg.png" 
            alt="Kabinet Arunika Swakarsa" 
            class="w-full h-full object-cover scale-105 animate-slow-zoom"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/30 opacity-90"></div>
        <div class="absolute inset-0 bg-blue-900/20 mix-blend-overlay"></div>
    </div>
    
    <div class="relative z-10 w-full flex flex-col justify-center items-center px-6 py-20 text-center max-w-7xl mx-auto h-full">
        
        <span class="opacity-0 animate-fadeInUp uppercase tracking-[0.15em] sm:tracking-[0.2em] text-blue-300 font-semibold mb-3 sm:mb-4 text-xs sm:text-sm md:text-base">
            Himpunan Mahasiswa Fisika 2026
        </span>

        <h1 class="opacity-0 animate-fadeInUp delay-100 font-extrabold mb-4 sm:mb-6 leading-tight drop-shadow-xl">
            <span class="block text-white text-4xl sm:text-6xl md:text-7xl lg:text-8xl">
                KABINET
            </span>
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-yellow-400 to-amber-600 mt-1 sm:mt-2 text-3xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl">
                ARUNIKA SWAKARSA
            </span>
        </h1>

        <p class="opacity-0 animate-fadeInUp delay-200 text-sm sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 sm:mb-12 max-w-xs sm:max-w-2xl lg:max-w-4xl leading-relaxed font-light mx-auto">
            Himpunan Mahasiswa Fisika (HIMAFI) tahun 2026 merupakan organisasi mahasiswa yang berperan sebagai <span class="text-amber-400 font-medium">wadah pengembangan diri, kreativitas, dan aspirasi</span> seluruh mahasiswa Fisika.
        </p>

        <div class="opacity-0 animate-fadeInUp delay-300 flex flex-col sm:flex-row gap-4 sm:gap-6 w-full sm:w-auto justify-center px-2">
            
            <a href="#layanan" class="group relative px-6 sm:px-8 py-3.5 sm:py-4 bg-white text-blue-900 font-bold rounded-full overflow-hidden shadow-lg hover:shadow-white/50 transition-all duration-300 w-full sm:w-auto flex justify-center items-center">
                <span class="relative z-10 flex items-center gap-2 text-sm sm:text-base">
                    Jelajahi Kabinet <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </span>
                <div class="absolute inset-0 h-full w-full scale-0 rounded-full transition-all duration-300 group-hover:scale-100 group-hover:bg-gray-100"></div>
            </a>
            
            <a href="/video-profile" class="group px-6 sm:px-8 py-3.5 sm:py-4 rounded-full border border-white/30 bg-white/5 backdrop-blur-sm text-white font-semibold hover:bg-white/10 transition-all duration-300 flex items-center justify-center gap-2 hover:border-white w-full sm:w-auto">
                <i class="fas fa-play-circle text-lg sm:text-xl text-amber-400 group-hover:text-white transition-colors"></i> 
                <span class="text-sm sm:text-base">Video Profil</span>
            </a>
        </div>
    </div>

    <div class="opacity-0 animate-fadeInUp delay-500 absolute bottom-6 sm:bottom-10 left-1/2 -translate-x-1/2 z-10 hidden h-short:hidden sm:block">
        <div class="animate-bounce flex flex-col items-center gap-2 opacity-70">
            <!-- <span class="text-[10px] sm:text-xs uppercase tracking-widest text-gray-300">Scroll Down</span> -->
            <i class="fas fa-chevron-down text-white text-lg sm:text-xl"></i>
        </div>
    </div>
</section>

<style>
    /* Mengatasi masalah tinggi layar di browser mobile */
    @supports (min-height: 100dvh) {
        section { min-height: 100dvh; }
    }

    /* Animasi Custom */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slowZoom {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }

    .animate-slow-zoom {
        animation: slowZoom 20s linear infinite alternate;
    }

    /* Utility Class untuk delay */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-500 { animation-delay: 0.8s; }

    /* Menyembunyikan elemen jika layar terlalu pendek (misal: HP Landscape) */
    @media (max-height: 600px) {
        .h-short\:hidden {
            display: none;
        }
    }
</style>