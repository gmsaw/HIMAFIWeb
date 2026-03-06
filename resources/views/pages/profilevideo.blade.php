@extends('layouts.app')

@section('title', 'Video Profil - HIMAFI UNUD Kabinet Arunika Swakarsa')

@section('content')
    <style>
        .text-glow { text-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
        .video-glow { box-shadow: 0 0 40px rgba(6, 182, 212, 0.2); }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    <section class="relative w-full h-[60vh] md:h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-blue-900/80 to-slate-50 z-10"></div>
            <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
                 class="w-full h-full object-cover animate-pulse-slow opacity-60" 
                 alt="Background">
        </div>

        <div class="relative z-20 text-center px-4 max-w-4xl mx-auto mt-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-panel text-cyan-300 text-xs font-bold tracking-widest uppercase mb-6 animate-fade-in-down">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                Official Release
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight drop-shadow-lg animate-fade-in-up">
                Wajah Baru <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 text-glow">Semangat Baru</span>
            </h1>
            
            <p class="text-slate-300 text-lg md:text-xl max-w-2xl mx-auto mb-8 font-light animate-fade-in-up" style="animation-delay: 0.1s;">
                Menyelami visi Kabinet <b>Arunika Swakarsa</b>. Sebuah perjalanan dedikasi untuk Fisika Udayana yang lebih bersinergi.
            </p>

            <button onclick="document.getElementById('mainVideo').scrollIntoView({behavior: 'smooth'})" 
                class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-blue-900 rounded-full font-bold transition-all hover:scale-105 hover:shadow-[0_0_30px_rgba(255,255,255,0.3)] animate-fade-in-up" style="animation-delay: 0.2s;">
                <span class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center group-hover:bg-blue-500 transition">
                    <i class="fas fa-play ml-1"></i>
                </span>
                Tonton Sekarang
            </button>
        </div>
    </section>

    <section id="mainVideo" class="relative py-12 md:py-20 bg-slate-50 -mt-10 rounded-t-[3rem] z-30">
        <div class="container mx-auto px-4 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2">
                    
                    <div class="relative group rounded-3xl p-2 bg-gradient-to-r from-blue-100 to-cyan-100 shadow-xl mb-8">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                        <div class="relative video-container rounded-2xl overflow-hidden shadow-inner bg-black">
                            <iframe 
                                src="https://www.youtube.com/embed/0TL9IxcR9CI?si=iDZ6UskyegfdWbvq&rel=0" 
                                title="Video Profil" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full h-full">
                            </iframe>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4 leading-snug">
                            Profil Kabinet Arunika Swakarsa 2026
                        </h2>
                        
                        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 pb-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('img/logo.jpg') }}" class="w-12 h-12 rounded-full border-2 border-blue-500 p-0.5" alt="HIMAFI">
                                <div>
                                    <h4 class="font-bold text-slate-800">HIMAFI UNUD</h4>
                                    <p class="text-xs text-slate-500">1.2K Subscribers</p>
                                </div>
                                <button class="ml-4 px-4 py-1.5 bg-slate-900 text-white text-xs font-bold rounded-full hover:bg-blue-600 transition">
                                    Subscribe
                                </button>
                            </div>

                            <div class="flex gap-2">
                                <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-full font-medium transition">
                                    <i class="far fa-thumbs-up"></i> 245
                                </button>
                                <button class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-full font-medium transition">
                                    <i class="far fa-share-square"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 mb-10">
                        <div class="flex gap-4 text-sm text-slate-500 mb-4 font-semibold">
                            <span>1.245x Ditonton</span>
                            <span>•</span>
                            <span>15 Maret 2025</span>
                        </div>
                        <p class="text-slate-700 leading-relaxed mb-4">
                            Selamat datang di era baru HIMAFI UNUD. <b>Kabinet Arunika Swakarsa</b> hadir dengan visi untuk menciptakan harmonisasi dalam keberagaman dan sinergi dalam pergerakan. Video ini merangkum semangat juang para fungsionaris dalam membangun iklim akademik dan organisasi yang progresif.
                        </p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            <span class="text-blue-600 text-sm font-medium hover:underline cursor-pointer">#HIMAFI2026</span>
                            <span class="text-blue-600 text-sm font-medium hover:underline cursor-pointer">#ArunikaSwakarsa</span>
                            <span class="text-blue-600 text-sm font-medium hover:underline cursor-pointer">#FisikaJaya</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100">
                        <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i class="far fa-comments text-blue-500"></i> 15 Komentar
                        </h3>
                        
                        <div class="flex gap-4 mb-8">
                            <div class="w-10 h-10 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center font-bold text-slate-500">
                                {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                            </div>
                            <div class="flex-grow">
                                <textarea class="w-full bg-slate-50 border-b-2 border-slate-200 focus:border-blue-500 p-3 outline-none transition rounded-t-lg resize-none text-sm" rows="2" placeholder="Tuliskan pendapatmu tentang kabinet ini..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button class="px-5 py-2 bg-blue-600 text-white rounded-full text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex gap-4 group">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                    R
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h5 class="font-bold text-sm text-slate-800">Rizki Pratama</h5>
                                        <span class="text-xs text-slate-400">2 hari lalu</span>
                                    </div>
                                    <p class="text-sm text-slate-600 mb-2">
                                        Visualnya keren banget! Transisinya halus. Semangat terus buat pengurus tahun ini! 🔥
                                    </p>
                                    <div class="flex items-center gap-4 text-xs text-slate-500">
                                        <button class="hover:text-blue-600 flex items-center gap-1"><i class="far fa-thumbs-up"></i> 12</button>
                                        <button class="hover:text-blue-600 font-semibold">Balas</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-4 group">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                    A
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h5 class="font-bold text-sm text-slate-800">Ayu Lestari</h5>
                                        <span class="text-xs text-slate-400">5 hari lalu</span>
                                    </div>
                                    <p class="text-sm text-slate-600 mb-2">
                                        Visi misinya sangat jelas tersampaikan. Semoga amanah!
                                    </p>
                                    <div class="flex items-center gap-4 text-xs text-slate-500">
                                        <button class="hover:text-blue-600 flex items-center gap-1"><i class="far fa-thumbs-up"></i> 5</button>
                                        <button class="hover:text-blue-600 font-semibold">Balas</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 sticky top-24">
                        <h3 class="font-bold text-slate-800 mb-4 flex justify-between items-center">
                            Dokumentasi Lain
                            <a href="#" class="text-xs text-blue-600 hover:underline">Lihat Semua</a>
                        </h3>

                        <div class="space-y-4">
                            
                            <div class="flex gap-3 p-2 rounded-xl bg-blue-50 border border-blue-100 cursor-pointer">
                                <div class="relative w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden group">
                                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         class="w-full h-full object-cover" alt="Thumb">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">Sedang Diputar</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-blue-700 line-clamp-2 leading-tight mb-1">Profil Kabinet Arunika Swakarsa 2026</h4>
                                    <p class="text-xs text-blue-500">HIMAFI UNUD</p>
                                </div>
                            </div>

                            <a href="#" class="flex gap-3 p-2 rounded-xl hover:bg-slate-50 transition group">
                                <div class="relative w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Thumb">
                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] px-1 rounded">12:20</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-700 group-hover:text-blue-600 line-clamp-2 leading-tight mb-1 transition">Workshop Python untuk Fisika Komputasi</h4>
                                    <p class="text-xs text-slate-400">2 Bulan lalu</p>
                                </div>
                            </a>

                            <a href="#" class="flex gap-3 p-2 rounded-xl hover:bg-slate-50 transition group">
                                <div class="relative w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Thumb">
                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] px-1 rounded">08:45</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-700 group-hover:text-blue-600 line-clamp-2 leading-tight mb-1 transition">Highlight Saraswati Fisika 2025</h4>
                                    <p class="text-xs text-slate-400">5 Bulan lalu</p>
                                </div>
                            </a>

                            <a href="#" class="flex gap-3 p-2 rounded-xl hover:bg-slate-50 transition group">
                                <div class="relative w-32 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Thumb">
                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] px-1 rounded">04:10</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-700 group-hover:text-blue-600 line-clamp-2 leading-tight mb-1 transition">After Movie Udayana Physics Championship</h4>
                                    <p class="text-xs text-slate-400">1 Tahun lalu</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
<style>
    /* Custom Animation Keyframes */
    @keyframes pulse-slow {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 20s infinite ease-in-out;
    }
</style>
@endpush