@extends('layouts.app')

@section('title', 'Perpustakaan HIMAFI')

@php
    $activePage = 'library'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-slate-50 pt-28 pb-20">
    <div class="container mx-auto px-4">
        
        {{-- HEADER SECTION --}}
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 mb-4">
                Perpustakaan <span class="text-blue-600">Digital</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto mb-8">
                Jelajahi koleksi buku, jurnal ilmiah, dan arsip skripsi mahasiswa Fisika Universitas Udayana.
            </p>

            <div class="max-w-3xl mx-auto bg-white p-2 rounded-full shadow-lg border border-gray-100 flex items-center">
                {{-- PERBAIKAN ROUTE PENCARIAN --}}
                <form action="{{ route('library.index') }}" method="GET" class="flex w-full items-center">
                    <div class="pl-4 text-gray-400"><i class="fas fa-search"></i></div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full border-none focus:ring-0 text-sm py-3 px-4 text-gray-700 bg-transparent placeholder-gray-400" 
                        placeholder="Cari judul buku, penulis, atau topik...">
                    
                    <select name="category" class="hidden md:block border-none focus:ring-0 text-sm text-gray-600 bg-gray-50 rounded-full py-2 px-4 mr-2 cursor-pointer hover:bg-gray-100">
                        <option value="">Semua Kategori</option>
                        <option value="Fisika Murni" {{ request('category') == 'Fisika Murni' ? 'selected' : '' }}>Fisika Murni</option>
                        <option value="Fisika Terapan" {{ request('category') == 'Fisika Terapan' ? 'selected' : '' }}>Fisika Terapan</option>
                        <option value="Astronomi" {{ request('category') == 'Astronomi' ? 'selected' : '' }}>Astronomi</option>
                        <option value="Skripsi/Tesis" {{ request('category') == 'Skripsi/Tesis' ? 'selected' : '' }}>Skripsi</option>
                    </select>

                    <button type="submit" class="bg-blue-600 text-white rounded-full px-6 py-2.5 font-bold text-sm hover:bg-blue-700 transition">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        {{-- GRID BUKU --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
            @forelse($books as $book)
            <div class="group bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                
                {{-- COVER IMAGE (PERBAIKAN ROUTE) --}}
                <a href="{{ route('library.show', $book->id) }}" class="relative w-full aspect-[2/3] rounded-xl overflow-hidden mb-4 bg-gray-100 block">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                            <i class="fas fa-book text-4xl mb-2"></i>
                            <span class="text-xs">No Cover</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-2 left-2">
                        <span class="bg-white/90 backdrop-blur-sm text-blue-800 text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase tracking-wide">
                            {{ $book->category }}
                        </span>
                    </div>
                </a>

                <div class="flex-grow flex flex-col">
                    {{-- JUDUL BUKU (PERBAIKAN ROUTE) --}}
                    <h3 class="text-slate-800 font-bold leading-tight mb-1 line-clamp-2 group-hover:text-blue-600 transition">
                        <a href="{{ route('library.show', $book->id) }}">
                            {{ $book->title }}
                        </a>
                    </h3>
                    <p class="text-xs text-slate-500 mb-3">{{ $book->author }} • {{ $book->year }}</p>
                    
                    <div class="mt-auto flex items-center justify-between pt-3 border-t border-gray-50">
                        {{-- STATUS STOK --}}
                        <div class="text-xs font-medium {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                            @if($book->stock > 0)
                                <i class="fas fa-check-circle mr-1"></i> Tersedia ({{ $book->stock }})
                            @else
                                <i class="fas fa-times-circle mr-1"></i> Habis
                            @endif
                        </div>
                        
                        {{-- TOMBOL BACA (PERBAIKAN ROUTE) --}}
                        @if($book->file_path || $book->file_url)
                            <a href="{{ route('library.show', $book->id) }}" class="flex items-center gap-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm group/btn" title="Baca E-Book">
                                <span>Baca</span>
                                <i class="fas fa-book-reader group-hover/btn:scale-110 transition-transform"></i>
                            </a>
                        @else
                            <span class="text-xs text-slate-400 italic">Fisik Only</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="inline-block p-6 bg-slate-100 rounded-full text-slate-400 mb-4">
                    <i class="fas fa-book-open text-4xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-700">Buku tidak ditemukan</h3>
                <p class="text-slate-500 text-sm">Coba cari dengan kata kunci lain.</p>
                {{-- TOMBOL RESET (PERBAIKAN ROUTE) --}}
                <a href="{{ route('library.index') }}" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Reset Pencarian</a>
            </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $books->links() }}
        </div>

    </div>
</div>
@endsection