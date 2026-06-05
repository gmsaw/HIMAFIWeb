@extends('layouts.app', ['activePage' => 'ceksurat'])
@section('title', 'Verifikasi Surat - HIMAFI UNUD')

@section('content')
<div class="relative min-h-screen bg-slate-900 pt-28 pb-20 overflow-hidden flex flex-col items-center justify-center font-sans">
    
    {{-- 1. BACKGROUND ANIMATIONS (ORBIT THEME) --}}
    {{-- Grid Pattern --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-40"></div>
    
    {{-- Glowing Orbs --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/30 rounded-full mix-blend-screen filter blur-[100px] animate-blob"></div>
    <div class="absolute top-20 right-1/4 w-96 h-96 bg-cyan-500/20 rounded-full mix-blend-screen filter blur-[100px] animate-blob animation-delay-2000"></div>

    {{-- Orbital Rings --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-white/5 rounded-full animate-spin-slow pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1200px] h-[1200px] border border-white/5 rounded-full animate-spin-reverse-slow pointer-events-none"></div>
    
    {{-- Floating Particle --}}
    <div class="absolute top-1/3 left-1/3 w-3 h-3 bg-cyan-400 rounded-full shadow-[0_0_15px_rgba(34,211,238,0.8)] animate-float pointer-events-none"></div>

    <div class="container mx-auto px-4 z-10 w-full max-w-3xl relative">
        
        {{-- 2. HEADER SECTION --}}
        <div class="text-center mb-12 animate-fade-in-down">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/5 backdrop-blur-xl text-cyan-400 mb-6 shadow-[0_0_30px_rgba(34,211,238,0.2)] border border-white/10 relative group">
                <!-- <div class="absolute inset-0 rounded-full border-2 border-cyan-400/50 border-t-cyan-400 animate-spin"></div> -->
                <i class="fas fa-fingerprint text-3xl group-hover:scale-110 transition-transform"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Verifikasi Dokumen <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">ORBIT</span></h1>
            <p class="text-slate-400 text-lg font-light max-w-xl mx-auto">Oprasional Registrasi Berkas & Informasi Terpadu. Masukkan nomor surat untuk mengecek keaslian dan validitas dokumen HIMAFI.</p>
        </div>

        {{-- 3. SEARCH BOX (GLASSMORPHISM) --}}
        <div class="bg-white/10 backdrop-blur-2xl p-2 md:p-3 rounded-3xl shadow-2xl border border-white/10 mb-10 relative overflow-hidden group focus-within:border-cyan-500/50 transition-colors duration-500 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 opacity-0 group-focus-within:opacity-100 transition-opacity duration-500"></div>
            
            <form action="{{ route('orbit.verify') }}" method="GET" class="relative z-10 flex flex-col md:flex-row gap-2" id="verifyForm">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fas fa-search text-cyan-400 text-lg animate-pulse"></i>
                    </div>
                    <input type="text" name="nomor_surat" id="nomor_surat" value="{{ request('nomor_surat') }}" required placeholder="Ketik nomor surat di sini..." 
                        class="w-full pl-14 pr-4 py-4 bg-transparent border-none text-white placeholder-slate-400 font-semibold focus:ring-0 outline-none text-lg">
                </div>
                
                <button type="submit" onclick="this.innerHTML='<i class=\'fas fa-circle-notch fa-spin mr-2\'></i> Memindai...'; this.classList.add('opacity-80', 'cursor-not-allowed');" 
                    class="bg-cyan-500 hover:bg-cyan-400 text-slate-900 px-8 py-4 rounded-2xl font-bold shadow-[0_0_20px_rgba(34,211,238,0.4)] hover:shadow-[0_0_30px_rgba(34,211,238,0.6)] transition-all flex items-center justify-center gap-2 whitespace-nowrap text-lg relative overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2"><i class="fas fa-qrcode"></i> Pindai</span>
                </button>
            </form>
        </div>

        {{-- 4. RESULT SECTION --}}
        @if($searched)
            <div id="resultSection">
                @if($surat)
                    {{-- SURAT DITEMUKAN (VALID) --}}
                    <div class="bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-emerald-500/30 overflow-hidden relative">
                        {{-- Efek Radar Latar --}}
                        <div class="absolute top-0 right-0 w-full h-1 bg-emerald-500/50 shadow-[0_0_15px_rgba(16,185,129,1)] animate-scan"></div>
                        
                        <div class="p-8 relative z-10">
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8 pb-8 border-b border-slate-700/50 text-center md:text-left">
                                {{-- Animasi Stempel --}}
                                <div class="w-24 h-24 bg-emerald-500/10 text-emerald-400 rounded-full flex items-center justify-center text-4xl shrink-0 border-2 border-emerald-500/50 shadow-[0_0_30px_rgba(16,185,129,0.3)] animate-stamp">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="mt-2">
                                    <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-3 py-1 rounded-full text-xs font-bold tracking-widest uppercase mb-3 inline-block animate-fade-in" style="animation-delay: 0.5s;">Verified</span>
                                    <h2 class="text-3xl font-bold text-white mb-2 animate-fade-in" style="animation-delay: 0.6s;">Dokumen Resmi</h2>
                                    <p class="text-slate-400 text-sm animate-fade-in" style="animation-delay: 0.7s;">Data terekam pada server ORBIT HIMAFI Universitas Udayana.</p>
                                </div>
                            </div>

                            {{-- Staggered Data Reveal --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">
                                <div class="animate-slide-up" style="animation-delay: 0.8s; opacity: 0; animation-fill-mode: forwards;">
                                    <span class="block text-xs font-bold text-cyan-500 uppercase tracking-wider mb-1">Nomor Surat</span>
                                    <span class="font-bold text-white text-xl">{{ $surat->nomor_surat }}</span>
                                </div>
                                <div class="animate-slide-up" style="animation-delay: 0.9s; opacity: 0; animation-fill-mode: forwards;">
                                    <span class="block text-xs font-bold text-cyan-500 uppercase tracking-wider mb-1">Tanggal Terbit</span>
                                    <span class="font-bold text-white text-xl">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="animate-slide-up bg-slate-900/50 p-4 rounded-xl border border-slate-700/50" style="animation-delay: 1.0s; opacity: 0; animation-fill-mode: forwards;">
                                    <span class="block text-xs font-bold text-cyan-500 uppercase tracking-wider mb-1">Pihak Pengirim</span>
                                    <span class="font-semibold text-slate-200">{{ $surat->pengirim }}</span>
                                </div>
                                <div class="animate-slide-up bg-slate-900/50 p-4 rounded-xl border border-slate-700/50" style="animation-delay: 1.1s; opacity: 0; animation-fill-mode: forwards;">
                                    <span class="block text-xs font-bold text-cyan-500 uppercase tracking-wider mb-1">Tujuan / Penerima</span>
                                    <span class="font-semibold text-slate-200">{{ $surat->penerima }}</span>
                                </div>
                                <div class="md:col-span-2 animate-slide-up" style="animation-delay: 1.2s; opacity: 0; animation-fill-mode: forwards;">
                                    <span class="block text-xs font-bold text-cyan-500 uppercase tracking-wider mb-2">Hal / Keterangan</span>
                                    <div class="bg-cyan-500/10 border border-cyan-500/20 px-5 py-4 rounded-xl">
                                        <span class="font-medium text-cyan-100 text-lg">{{ $surat->perihal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- SURAT TIDAK DITEMUKAN (TIDAK VALID) --}}
                    <div class="bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-rose-500/30 overflow-hidden relative animate-shake">
                        <div class="p-10 relative z-10 text-center flex flex-col items-center">
                            <div class="w-24 h-24 bg-rose-500/10 text-rose-500 rounded-full flex items-center justify-center text-5xl mb-6 shadow-[0_0_30px_rgba(244,63,94,0.3)]">
                                <i class="fas fa-times"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-white mb-3">Tidak Valid</h2>
                            <p class="text-slate-400 mb-8 max-w-md text-lg">Nomor surat <span class="text-rose-400 font-bold tracking-wider">"{{ request('nomor_surat') }}"</span> tidak ditemukan di dalam arsip digital kami.</p>
                            
                            <a href="{{ route('orbit.verify') }}" class="bg-slate-700 text-white hover:bg-slate-600 border border-slate-600 px-8 py-3 rounded-xl font-bold transition flex items-center gap-2">
                                <i class="fas fa-undo"></i> Ulangi Pencarian
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>

{{-- 5. KUMPULAN CSS ANIMASI KHUSUS --}}
<style>
    /* Orbit Rotations */
    .animate-spin-slow { animation: spin 25s linear infinite; }
    .animate-spin-reverse-slow { animation: spin-reverse 35s linear infinite; }
    @keyframes spin-reverse { from { transform: translate(-50%, -50%) rotate(360deg); } to { transform: translate(-50%, -50%) rotate(0deg); } }
    @keyframes spin { from { transform: translate(-50%, -50%) rotate(0deg); } to { transform: translate(-50%, -50%) rotate(360deg); } }

    /* Blob & Float */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 10s infinite alternate; }
    .animation-delay-2000 { animation-delay: 2s; }
    
    @keyframes float {
        0%, 100% { transform: translateY(0) scale(1); opacity: 0.5; }
        50% { transform: translateY(-20px) scale(1.5); opacity: 1; }
    }
    .animate-float { animation: float 4s ease-in-out infinite; }

    /* Result Animations */
    .animate-fade-in-down { animation: fadeInDown 0.8s ease-out forwards; }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; opacity: 0; }
    .animate-slide-up { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    /* Stamp Effect */
    @keyframes stamp {
        0% { opacity: 0; transform: scale(3) rotate(-20deg); }
        50% { opacity: 1; transform: scale(0.9) rotate(0deg); }
        100% { opacity: 1; transform: scale(1) rotate(0deg); }
    }
    .animate-stamp { animation: stamp 0.5s cubic-bezier(0.25, 1, 0.5, 1) forwards; }

    /* Radar Scan Line */
    @keyframes scan {
        0% { top: 0; opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }
    .animate-scan { animation: scan 3s linear infinite; }

    /* Error Shake */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    .animate-shake { animation: shake 0.6s cubic-bezier(.36,.07,.19,.97) both; }
</style>
@endsection