@extends('layouts.app')

@section('title', $book->title)

@section('content')

@php
    $activePage = 'library'; 
    $useTransparentHeader = false; 
@endphp

<div class="min-h-screen bg-slate-50 pt-28 pb-20">
    <div class="container mx-auto px-4">
        
        {{-- Breadcrumb --}}
        <div class="mb-6 animate-fade-in-up">
            <a href="{{ route('library.index') }}" class="text-slate-500 hover:text-blue-600 flex items-center gap-2 text-sm font-medium transition-colors w-fit">
                <i class="fas fa-arrow-left"></i> Kembali ke Perpustakaan
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in-up delay-100">
            <div class="grid grid-cols-1 lg:grid-cols-3 min-h-[600px] lg:min-h-[800px]">
                
                {{-- KOLOM KIRI: Informasi Detail Buku --}}
                <div class="p-6 lg:p-8 lg:col-span-1 bg-white border-r border-gray-100 relative z-10 flex flex-col">
                    
                    {{-- Cover Image --}}
                    <div class="aspect-[3/4] w-full max-w-[180px] mx-auto bg-gray-100 shadow-lg rounded-xl overflow-hidden mb-6 transform hover:scale-105 transition duration-500">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 class="w-full h-full object-cover" 
                                 alt="{{ $book->title }}">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-book text-5xl mb-2"></i>
                                <span class="text-xs font-medium">No Cover</span>
                            </div>
                        @endif
                    </div>

                    {{-- Judul & Penulis --}}
                    <h1 class="text-2xl font-extrabold text-slate-800 text-center mb-2 leading-snug">{{ $book->title }}</h1>
                    <p class="text-center text-slate-500 text-sm font-medium mb-8 border-b border-gray-100 pb-6">{{ $book->author }}</p>

                    {{-- Metadata Table --}}
                    <div class="space-y-4 text-sm mb-8">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Tahun Terbit</span>
                            <span class="font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-full">{{ $book->year }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Kategori</span>
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">{{ $book->category }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Penerbit</span>
                            <span class="font-semibold text-slate-700 text-right">{{ $book->publisher ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium">Status Fisik</span>
                            @if($book->stock > 0)
                                <span class="text-green-600 font-bold flex items-center gap-1"><i class="fas fa-check-circle"></i> Ada di Rak</span>
                            @else
                                <span class="text-red-500 font-bold flex items-center gap-1"><i class="fas fa-times-circle"></i> Dipinjam</span>
                            @endif
                        </div>
                    </div>

                    {{-- Sinopsis --}}
                    <div class="bg-slate-50 p-5 rounded-2xl flex-grow">
                        <h3 class="font-bold text-slate-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-align-left text-blue-500"></i> Sinopsis
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed text-justify max-h-60 lg:max-h-full overflow-y-auto pr-2 custom-scrollbar">
                            {{ $book->description ?? 'Tidak ada sinopsis untuk buku ini.' }}
                        </p>
                    </div>
                </div>

                {{-- KOLOM KANAN: PDF Viewer dengan Error Handling --}}
                <div class="p-0 lg:col-span-2 flex flex-col bg-slate-200 relative h-[80vh] lg:h-auto border-t lg:border-t-0 border-gray-200">
                    
                    @php
                        $embedUrl = null;
                        $directUrl = null; // URL asli untuk tombol download/buka langsung
                        $fileType = null;  // 'local' atau 'gdrive'
                        $isDrive = false;

                        // 1. Cek File Upload Lokal
                        if (!empty($book->file_path)) {
                            $fileType = 'local';
                            $directUrl = asset('storage/' . $book->file_path);
                            $embedUrl = $directUrl;
                        } 
                        // 2. Cek Link Eksternal (GDrive)
                        elseif (!empty($book->file_url)) {
                            $url = $book->file_url;
                            $directUrl = $url;
                            
                            if (str_contains($url, 'drive.google.com')) {
                                $fileType = 'gdrive';
                                $isDrive = true;
                                
                                preg_match('/[-\w]{25,}/', $url, $matches);
                                if (isset($matches[0])) {
                                    $fileId = $matches[0];
                                    $embedUrl = "https://drive.google.com/file/d/{$fileId}/preview";
                                } else {
                                    $embedUrl = str_replace(['/view', '/edit'], '/preview', $url);
                                }
                            } else {
                                $fileType = 'external';
                                $embedUrl = $url;
                            }
                        }
                    @endphp

                    @if($embedUrl)
                        {{-- PITA INFO & FALLBACK (Solusi jika error/blank) --}}
                        <div class="bg-blue-800 text-white px-4 py-3 flex flex-col sm:flex-row justify-between items-center z-20 shadow-md gap-3">
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <i class="fas fa-info-circle text-blue-300 text-lg"></i>
                                <span>Layar blank/error? Browser Anda mungkin memblokir viewer.</span>
                            </div>
                            <a href="{{ $directUrl }}" target="_blank" 
                               class="bg-white text-blue-800 hover:bg-blue-50 px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition whitespace-nowrap flex items-center gap-2 w-full sm:w-auto justify-center">
                                @if($fileType == 'local')
                                    <i class="fas fa-download"></i> Download PDF
                                @else
                                    <i class="fas fa-external-link-alt"></i> Buka via Google Drive
                                @endif
                            </a>
                        </div>

                        {{-- CONTAINER VIEWER --}}
                        <div class="flex-grow w-full h-full relative bg-gray-100">
                            @if($fileType === 'local')
                                {{-- Menggunakan <object> lebih baik untuk PDF lokal agar ada fallback bawaan browser --}}
                                <object data="{{ $embedUrl }}" type="application/pdf" class="w-full h-full absolute inset-0">
                                    {{-- Tampilan ini MUNCUL OTOMATIS jika browser gagal meload PDF (Misal di HP) --}}
                                    <div class="flex flex-col items-center justify-center h-full text-slate-500 p-8 text-center bg-white">
                                        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-file-pdf text-4xl text-red-400"></i>
                                        </div>
                                        <h4 class="font-bold text-xl text-slate-700 mb-2">Pratinjau Tidak Didukung</h4>
                                        <p class="text-sm text-slate-500 mb-6 max-w-sm">
                                            Perangkat atau browser Anda tidak memiliki fitur penampil PDF bawaan. Silakan unduh file untuk membacanya.
                                        </p>
                                        <a href="{{ $directUrl }}" download class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-blue-500/30">
                                            <i class="fas fa-download"></i> Download E-Book Sekarang
                                        </a>
                                    </div>
                                </object>
                            @else
                                {{-- Menggunakan Iframe untuk Google Drive --}}
                                <iframe src="{{ $embedUrl }}" 
                                        class="w-full h-full absolute inset-0 border-none bg-white" 
                                        allow="autoplay; encrypted-media" 
                                        allowfullscreen>
                                </iframe>
                            @endif
                        </div>
                    @else
                        {{-- State Kosong (Hanya Buku Fisik) --}}
                        <div class="flex flex-col items-center justify-center h-full text-slate-400 bg-slate-50">
                            <div class="w-24 h-24 bg-white shadow-sm border border-gray-100 rounded-full flex items-center justify-center mb-5">
                                <i class="fas fa-book-open text-4xl text-slate-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-700 mb-2">Versi Digital Tidak Tersedia</h3>
                            <p class="text-sm text-slate-500 max-w-xs text-center leading-relaxed">
                                Buku ini hanya tersedia dalam bentuk cetak (fisik). Silakan kunjungi ruang perpustakaan HIMAFI untuk membacanya.
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar untuk Sinopsis */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
</style>
@endsection