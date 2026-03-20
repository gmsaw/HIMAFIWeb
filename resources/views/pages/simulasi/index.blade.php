@extends('layouts.app')
@section('title', 'Laboratorium Virtual - HIMAFI UNUD')

@section('content')
<div class="pt-28 pb-20 bg-slate-50 min-h-screen relative overflow-hidden font-sans">
    
    {{-- Latar Belakang Dekoratif (Dot Grid) --}}
    <div class="absolute inset-0 opacity-[0.15] pointer-events-none" style="background-image: radial-gradient(#64748b 2px, transparent 2px); background-size: 40px 40px;"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-cyan-400/20 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-cyan-100 text-cyan-700 text-xs font-bold tracking-widest uppercase mb-4 shadow-sm border border-cyan-200">
                Interactive Physics
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">
                Laboratorium <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Virtual</span>
            </h1>
            <p class="text-lg text-slate-600 leading-relaxed">
                Eksplorasi dan visualisasikan berbagai fenomena fisika secara komputasional. Atur parameter secara <span class="font-semibold text-slate-800">real-time</span> dan amati hasilnya secara langsung.
            </p>
        </div>

        {{-- Grid Simulasi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            {{-- Card 1: Gerak Parabola --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 group flex flex-col">
                {{-- Banner Image/Icon --}}
                <div class="w-full h-48 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl mb-6 flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-cyan-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <i class="fas fa-rocket text-6xl text-cyan-400 z-10 group-hover:scale-110 group-hover:-translate-y-2 transition-transform duration-500"></i>
                    
                    {{-- Grid lines on banner --}}
                    <div class="absolute bottom-0 w-full h-12 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4yKSIvPjwvc3ZnPg==')] opacity-50"></div>
                </div>
                
                {{-- Kategori & Judul --}}
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2.5 py-1 bg-cyan-50 text-cyan-600 rounded-md text-[10px] font-bold uppercase tracking-wider">Mekanika</span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">Gerak Parabola</h3>
                <p class="text-sm text-slate-600 mb-8 line-clamp-3 leading-relaxed flex-grow">
                    Simulasi interaktif proyektil 2D. Analisis pengaruh sudut elevasi, kecepatan, dan ketinggian awal terhadap jarak terjauh serta tinggi maksimum proyektil.
                </p>
                
                {{-- Tombol --}}
                <a href="{{ route('simulasi.parabola') }}" class="w-full block text-center py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 font-bold group-hover:bg-cyan-600 group-hover:border-cyan-600 group-hover:text-white transition-all shadow-sm">
                    Mulai Simulasi <i class="fas fa-arrow-right ml-1 text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"></i>
                </a>
            </div>

            {{-- Card 2: Hukum Ohm & Kirchhoff --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 group flex flex-col">
                {{-- Banner Image/Icon --}}
                <div class="w-full h-48 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl mb-6 flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <i class="fas fa-bolt text-6xl text-yellow-400 z-10 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 drop-shadow-[0_0_15px_rgba(250,204,21,0.5)]"></i>
                </div>
                
                {{-- Kategori & Judul --}}
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2.5 py-1 bg-purple-50 text-purple-600 rounded-md text-[10px] font-bold uppercase tracking-wider">Kelistrikan</span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">Ohm & Kirchhoff</h3>
                <p class="text-sm text-slate-600 mb-8 line-clamp-3 leading-relaxed flex-grow">
                    Rangkai sirkuit seri dan paralel dasar. Hitung distribusi tegangan, pembagian arus, dan daya total berdasarkan KVL (Kirchhoff's Voltage Law) dan KCL.
                </p>
                
                {{-- Tombol --}}
                <a href="{{ route('simulasi.ohmkirchoff') }}" class="w-full block text-center py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 font-bold group-hover:bg-purple-600 group-hover:border-purple-600 group-hover:text-white transition-all shadow-sm">
                    Mulai Simulasi <i class="fas fa-arrow-right ml-1 text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"></i>
                </a>
            </div>

            {{-- Card 3: Placeholder --}}
            <div class="bg-transparent rounded-3xl p-6 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-center opacity-80 hover:opacity-100 hover:border-slate-400 transition-all duration-300 min-h-[400px]">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-flask text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Simulasi Lainnya</h3>
                <p class="text-sm text-slate-500 mb-6 px-4">
                    Modul Gelombang Harmonik, Termodinamika, dan Optik Geometri sedang dalam tahap pengembangan oleh tim lab.
                </p>
                <span class="px-4 py-2 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold tracking-widest uppercase">
                    Segera Hadir
                </span>
            </div>

        </div>

    </div>
</div>
@endsection