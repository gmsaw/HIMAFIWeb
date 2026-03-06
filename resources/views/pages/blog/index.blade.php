@extends('layouts.app')

@section('title', 'Blog & Berita - HIMAFI UNUD')

{{-- Setup Variable untuk Layout --}}
@php
    $activePage = 'blog'; 
    $useTransparentHeader = true; // Header transparan di Hero Section
@endphp

@section('content')

<section class="relative w-full min-h-[50vh] flex flex-col justify-center items-center overflow-hidden bg-slate-900">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/homeimg.png') }}" alt="Background Blog" class="w-full h-full object-cover object-center opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 text-center mt-10">
        <span class="inline-block mb-4 animate-fade-in-down bg-blue-600/20 text-blue-300 px-4 py-1.5 rounded-full text-sm font-semibold border border-blue-500/30 backdrop-blur-sm">
            HIMAFI NEWSROOM
        </span>

        <h1 class="text-white text-4xl md:text-6xl font-extrabold tracking-tight mb-6 animate-fade-in-up drop-shadow-xl">
            Wawasan & <span class="text-blue-400">Informasi</span>
        </h1>

        <p class="text-slate-300 max-w-2xl mx-auto mb-8 text-lg animate-fade-in-up delay-100">
            Temukan berita terbaru, dokumentasi kegiatan, dan artikel akademik dari mahasiswa Fisika Universitas Udayana.
        </p>

        <div class="max-w-2xl mx-auto relative group animate-fade-in-up delay-200">
            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-lg group-focus-within:text-blue-500 transition-colors"></i>
            </div>
            <input 
                type="text" 
                id="searchInput"
                placeholder="Cari judul artikel, topik, atau kata kunci..." 
                class="w-full py-4 pl-14 pr-36 rounded-full bg-white text-gray-900 shadow-2xl border-none focus:ring-4 focus:ring-blue-500/50 focus:outline-none transition-all text-base placeholder:text-gray-400"
            >
        </div>
    </div>
</section>

<main class="bg-gray-50 min-h-screen py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <aside class="lg:col-span-3">
                <div class="sticky top-24 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center">
                            <i class="fas fa-sliders-h mr-2 text-blue-600"></i> Filter
                        </h3>
                        <button onclick="resetFilters()" class="text-xs font-medium text-gray-400 hover:text-blue-600 transition flex items-center gap-1 group">
                            <i class="fas fa-redo-alt group-hover:rotate-180 transition-transform duration-500"></i> Reset
                        </button>
                    </div>
                    
                    <div class="space-y-3" id="categoryFilters">
                        @php 
                            // Pastikan value ini lowercase agar mudah dicocokkan di JS
                            $categories = ['news', 'event', 'academic']; 
                        @endphp
                        
                        @foreach($categories as $cat)
                        <label class="flex items-center gap-3 cursor-pointer group p-2 hover:bg-gray-50 rounded-lg transition select-none">
                            <div class="relative flex items-center">
                                <input type="checkbox" value="{{ $cat }}" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 transition-all checked:border-blue-600 checked:bg-blue-600" checked>
                                <div class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                    <i class="fas fa-check text-xs"></i>
                                </div>
                            </div>
                            <span class="text-gray-600 font-medium group-hover:text-blue-700 transition capitalize">
                                {{ $cat == 'news' ? 'Berita' : ($cat == 'event' ? 'Kegiatan' : 'Akademik') }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-9 space-y-10">
                
                @if($latest = $posts->first())
                <a href="{{ route('blog.show', $latest->slug) }}" class="block group relative rounded-3xl overflow-hidden shadow-xl h-[400px] cursor-pointer transition-all hover:shadow-2xl hover:-translate-y-1">
                    <img src="{{ $latest->thumbnail ? asset('storage/' . $latest->thumbnail) : 'https://via.placeholder.com/800x400?text=No+Image' }}" 
                         alt="Featured" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent flex flex-col justify-end p-8 md:p-12">
                        <div class="flex gap-2 mb-3">
                            <span class="bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                Terbaru
                            </span>
                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                {{ ucfirst($latest->category) }}
                            </span>
                        </div>
                        <h2 class="text-2xl md:text-4xl font-bold text-white mb-3 group-hover:text-blue-300 transition-colors line-clamp-2 leading-tight">
                            {{ $latest->title }}
                        </h2>
                        <p class="text-gray-300 text-base md:text-lg line-clamp-2 max-w-3xl">
                            {{ \Illuminate\Support\Str::limit(strip_tags($latest->content), 150) }}
                        </p>
                    </div>
                </a>
                @endif

                <div id="articleContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    </div>

                <div id="emptyState" class="hidden flex-col items-center justify-center py-20 text-center animate-fade-in">
                    <div class="bg-white p-6 rounded-full mb-4 shadow-sm">
                        <i class="fas fa-search text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Artikel tidak ditemukan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Kami tidak dapat menemukan artikel yang cocok dengan kata kunci atau filter Anda. Coba reset filter.</p>
                    <button onclick="resetFilters()" class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                        Reset Filter
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
{{-- 
    BLOCK PHP: 
    Memproses data dari Database menjadi Array bersih yang siap dikonsumsi JavaScript.
    Ini mencegah error syntax pada @json direktif.
--}}
@php
    $formattedArticles = $posts->map(function($post) {
        // Tentukan path gambar default jika kosong
        $img = $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/500x300?text=HIMAFI+UNUD';
        
        return [
            'id' => $post->id,
            'title' => $post->title,
            'category' => ucfirst($post->category), // Huruf depan besar
            'cat_raw' => strtolower($post->category), // Lowercase untuk filtering
            'date' => \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y'),
            'image' => $img,
            'desc' => \Illuminate\Support\Str::limit(strip_tags($post->content), 100),
            'url' => route('blog.show', $post->slug) // URL Menuju Detail
        ];
    });
@endphp

<script>
    // --- 1. Ambil Data dari PHP ---
    const articles = @json($formattedArticles);

    // --- 2. Referensi DOM ---
    const container = document.getElementById('articleContainer');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    const checkboxes = document.querySelectorAll('#categoryFilters input[type="checkbox"]');

    // --- 3. Helper: Warna Kategori ---
    function getCategoryColor(category) {
        const cat = category.toLowerCase();
        if (cat === 'academic' || cat === 'akademik') return 'bg-blue-100 text-blue-700 border-blue-200';
        if (cat === 'event' || cat === 'kegiatan') return 'bg-purple-100 text-purple-700 border-purple-200';
        if (cat === 'news' || cat === 'berita') return 'bg-teal-100 text-teal-700 border-teal-200';
        return 'bg-gray-100 text-gray-700 border-gray-200';
    }

    // --- 4. Fungsi Render Artikel ---
    function renderArticles(data) {
        container.innerHTML = ''; // Bersihkan container
        
        if (data.length === 0) {
            // Tampilkan Empty State
            emptyState.classList.remove('hidden');
            emptyState.classList.add('flex');
        } else {
            // Sembunyikan Empty State
            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');
            
            // Loop dan buat HTML Card
            data.forEach((item, index) => {
                const badgeColor = getCategoryColor(item.cat_raw);
                const delay = index * 50; // Efek muncul bertahap

                // Translate Kategori untuk Tampilan
                let displayCategory = item.category;
                if(item.cat_raw === 'news') displayCategory = 'Berita';
                if(item.cat_raw === 'event') displayCategory = 'Kegiatan';
                if(item.cat_raw === 'academic') displayCategory = 'Akademik';

                const card = `
                    <article class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1 animate-fade-in" style="animation-delay: ${delay}ms">
                        
                        <div class="h-56 overflow-hidden relative">
                            <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition"></div>
                            
                            <span class="absolute top-4 left-4 ${badgeColor} text-xs font-bold px-3 py-1.5 rounded-full border backdrop-blur-sm shadow-sm">
                                ${displayCategory}
                            </span>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 font-medium">
                                <span class="bg-gray-50 px-2 py-1 rounded border border-gray-100 flex items-center gap-1">
                                    <i class="far fa-calendar-alt text-gray-400"></i> ${item.date}
                                </span>
                            </div>

                            <h3 class="font-bold text-xl text-gray-900 mb-3 group-hover:text-blue-600 transition-colors cursor-pointer leading-snug line-clamp-2">
                                <a href="${item.url}">${item.title}</a>
                            </h3>

                            <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-3 flex-1">
                                ${item.desc}
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                                <a href="${item.url}" class="text-blue-600 font-bold text-sm hover:text-blue-800 transition flex items-center gap-1 group/link">
                                    Baca Selengkapnya <i class="fas fa-arrow-right text-xs transition-transform group-hover/link:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                `;
                container.innerHTML += card;
            });
        }
    }

    // --- 5. Logika Filter ---
    function filterData() {
        const query = searchInput.value.toLowerCase();
        
        // Ambil kategori yang dicentang
        const checkedCategories = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        // Lakukan Filter pada Array Artikel
        const filtered = articles.filter(item => {
            const itemCat = item.cat_raw; // Gunakan kategori raw (lowercase)
            
            // Cek Pencarian (Judul atau Deskripsi)
            const matchesSearch = item.title.toLowerCase().includes(query) || 
                                  item.desc.toLowerCase().includes(query);
            
            // Cek Kategori
            const matchesCategory = checkedCategories.includes(itemCat);
            
            return matchesSearch && matchesCategory;
        });

        renderArticles(filtered);
    }

    // --- 6. Event Listeners ---
    searchInput.addEventListener('input', filterData);
    checkboxes.forEach(cb => cb.addEventListener('change', filterData));

    // Expose reset function ke Global Scope (agar bisa dipanggil tombol onclick)
    window.resetFilters = function() {
        searchInput.value = '';
        checkboxes.forEach(cb => cb.checked = true);
        filterData();
    }

    // --- 7. Jalankan Saat Load ---
    document.addEventListener('DOMContentLoaded', () => {
        renderArticles(articles);
    });

</script>

<style>
    /* CSS Animation Utilities */
    .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; opacity: 0; }
    .animate-fade-in-down { animation: fadeInDown 0.8s ease-out forwards; opacity: 0; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
</style>
@endpush