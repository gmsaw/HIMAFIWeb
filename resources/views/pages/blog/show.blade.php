@extends('layouts.app')

{{-- Judul Browser Dinamis --}}
@section('title', $post->title . ' - Blog HIMAFI')

@php
$activePage = 'blog'; 
$useTransparentHeader = false; 
@endphp

@push('styles')
    {{-- Konfigurasi MathJax yang benar --}}
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']],
                displayMath: [['$$', '$$'], ['\\[', '\\]']],
                processEscapes: true
            },
            startup: {
                // Biarkan MathJax merender otomatis seluruh halaman setelah siap
                pageReady: () => {
                    return MathJax.startup.defaultPageReady();
                }
            }
        };
    </script>
    
    {{-- Memuat Library MathJax Langsung (Tanpa Polyfill yang bermasalah) --}}
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush

@section('content')

{{-- Progress Bar (Indikator membaca) --}}
<div id="progress-container" class="fixed top-0 left-0 w-full h-1.5 z-[60] bg-transparent">
    <div id="progress-bar" class="h-full bg-blue-600 w-0 transition-all duration-150 rounded-r-full shadow-[0_0_10px_rgba(37,99,235,0.8)]"></div>
</div>

<main class="bg-white min-h-screen pb-24 pt-28 md:pt-32">
    <article class="container mx-auto px-4 max-w-4xl">
        
        {{-- Breadcrumb & Meta Atas --}}
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500 mb-8 animate-fade-in-up">
            <a href="{{ route('blog.index') }}" class="flex items-center gap-2 hover:text-blue-600 transition-colors">
                <div class="w-8 h-8 rounded-full bg-gray-50 hover:bg-blue-50 border border-gray-100 flex items-center justify-center transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                </div>
                Kembali
            </a>
            <span class="text-gray-300">|</span>
            <span class="bg-blue-50 text-blue-600 border border-blue-100 px-3 py-1.5 rounded-full font-bold text-[10px] tracking-wider uppercase">
                {{ $post->category }}
            </span>
            <span class="text-gray-300">|</span>
            <span class="font-medium flex items-center gap-1.5"><i class="far fa-calendar-alt"></i> {{ $post->created_at->translatedFormat('l, d F Y') }}</span>
        </div>

        {{-- Judul Artikel --}}
        <h1 class="text-3xl md:text-5xl lg:text-[3.5rem] font-extrabold text-slate-900 mb-8 leading-[1.1] tracking-tight animate-fade-in-up delay-100 text-balance">
            {{ $post->title }}
        </h1>

        {{-- Info Penulis --}}
        <div class="flex items-center gap-4 mb-10 pb-10 border-b border-gray-100 animate-fade-in-up delay-200">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name) }}&background=2563eb&color=fff&bold=true" 
                 class="w-14 h-14 rounded-full border-4 border-white shadow-md">
            <div>
                <p class="text-slate-900 font-bold text-lg leading-tight">{{ $post->author->name }}</p>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wide mt-0.5">Penulis HIMAFI</p>
            </div>
        </div>

        {{-- Thumbnail Utama --}}
        @if($post->thumbnail)
        <div class="rounded-3xl overflow-hidden shadow-2xl mb-14 animate-fade-in-up delay-300 border border-slate-100 group relative">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-auto object-cover max-h-[550px] transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
        </div>
        @endif

        {{-- Konten Artikel (Render HTML dari Database) --}}
        <div class="prose prose-lg md:prose-xl prose-slate max-w-none text-slate-700 leading-loose text-justify animate-fade-in-up delay-300" id="article-content">
            {!! $post->content !!}
        </div>

        {{-- Bagian Footer (Share) --}}
        <div class="mt-20 pt-10 border-t border-gray-200">
            <div class="bg-slate-50 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 border border-slate-100 shadow-sm">
                <div>
                    <h4 class="font-bold text-slate-800 text-lg">Bagikan artikel ini</h4>
                    <p class="text-sm text-slate-500">Bantu sebarkan informasi bermanfaat ini ke teman-temanmu.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="copyToClipboard()" class="h-12 px-6 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold shadow-sm flex items-center justify-center gap-2 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all group">
                        <i class="fas fa-link text-slate-400 group-hover:text-white transition-colors"></i> <span>Salin Tautan</span>
                    </button>
                </div>
            </div>
        </div>

    </article>
</main>

{{-- Notifikasi Salin Tautan --}}
<div id="copy-toast" class="fixed bottom-10 right-10 bg-slate-900 text-white px-6 py-3 rounded-xl shadow-2xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-3 font-medium">
    <div class="w-8 h-8 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center">
        <i class="fas fa-check"></i>
    </div>
    Tautan berhasil disalin!
</div>

@endsection

@push('scripts')
<script>
    // --- Script untuk Progress Bar saat scroll ---
    window.addEventListener('scroll', function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("progress-bar").style.width = scrolled + "%";
    });

    // --- Script untuk Copy Tautan ---
    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const toast = document.getElementById('copy-toast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        });
    }
</script>

<style>
    /* Styling manual untuk konten artikel (Tipografi yang lebih baik) */
    .prose p { margin-bottom: 1.8em; }
    .prose h2 { font-size: 1.875rem; font-weight: 800; color: #0f172a; margin-top: 2.5em; margin-bottom: 1.2em; line-height: 1.3; }
    .prose h3 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-top: 2em; margin-bottom: 1em; }
    .prose ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.8em; }
    .prose ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.8em; }
    .prose li { margin-bottom: 0.5em; }
    
    /* Styling Kutipan / Blockquote */
    .prose blockquote { 
        border-left: 4px solid #3b82f6; 
        padding-left: 1.5em; 
        font-style: italic; 
        color: #475569; 
        background: linear-gradient(to right, #eff6ff, transparent); 
        padding: 1.5rem; 
        margin: 2.5rem 0; 
        border-radius: 0 1rem 1rem 0; 
    }
    
    /* Styling Gambar Sisipan */
    .prose img { 
        margin: 3rem auto; 
        border-radius: 1rem; 
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); 
        max-width: 100%; 
        border: 1px solid #f1f5f9;
    }

    /* Styling Teks MathJax */
    .prose .MathJax_Display, .prose mjx-container[display="true"] {
        overflow-x: auto !important;
        overflow-y: hidden !important;
        padding-top: 1rem;
        padding-bottom: 1rem;
        background-color: #f8fafc;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        margin: 2rem 0;
        text-align: center;
    }
    
    /* Animasi Bawaan Tailwind */
    .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { 
        from { opacity: 0; transform: translateY(30px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>
@endpush