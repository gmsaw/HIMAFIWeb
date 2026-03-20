@extends('layouts.app')

@section('title', 'Verifikasi Dokumen - HIMAFI')

@php
    $activePage = 'tte'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-slate-50 pt-28 pb-12 px-4 flex items-center justify-center">
    
    <div class="max-w-xl w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative animate-fade-in-up">
        
        <div class="h-2 w-full bg-gradient-to-r from-blue-500 to-cyan-400"></div>

        <div class="p-8 text-center">
            
            @if($doc = $document)
                
                @if($doc->status == 'approved')
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                        <i class="fas fa-check-circle text-4xl text-green-600"></i>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-slate-800 mb-1">Dokumen Terverifikasi</h2>
                    <p class="text-green-600 font-medium text-sm mb-8">Tanda Tangan Elektronik Valid & Asli</p>

                    <div class="bg-slate-50 rounded-xl p-6 text-left border border-slate-100 space-y-4 mb-8">
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">Judul Dokumen</p>
                            <p class="text-slate-800 font-semibold">{{ $doc->document_title }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">Ditandatangani Oleh</p>
                                <!-- <p class="text-slate-800 font-semibold">{{ $doc->signer_name }}</p> -->
                                <p class="text-slate-800 font-semibold">Gede Mahendra Sastra Adhi Wiguna</p>
                                <p class="text-xs text-slate-500">Ketua Himpunan</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">Waktu Penandatanganan</p>
                                {{-- PASTIKAN MENGGUNAKAN CARBON PARSE AGAR AMAN JIKA MASIH DIBACA SEBAGAI STRING --}}
                                <p class="text-slate-800 font-semibold">{{ \Carbon\Carbon::parse($doc->signed_at)->format('d M Y') }}</p>
                                <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($doc->signed_at)->format('H:i:s') }} WIB</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">ID Token</p>
                            <p class="font-mono text-xs text-slate-500 break-all select-all">{{ $doc->verification_token }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center gap-4 mb-8">
                        <div class="p-3 bg-white border border-gray-200 rounded-xl shadow-sm">
                            {{-- Menampilkan QR Code SVG dari Controller --}}
                            {!! $qrCode !!}
                        </div>
                        
                        <div class="text-center">
                            <p class="text-xs text-gray-400 mb-3">Scan QR Code ini untuk validasi ulang.</p>
                            
                            {{-- TOMBOL DOWNLOAD QR CODE (PNG/SVG) --}}
                            <a href="{{ route('tte.download_qr', $doc->verification_token) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-gray-50 hover:text-blue-600 hover:border-blue-300 transition shadow-sm">
                                <i class="fas fa-download"></i> Simpan Gambar QR
                            </a>
                        </div>
                    </div>

                    {{-- CEK APAKAH INI DOKUMEN BIASA ATAU BUKU BIRU --}}
                    @if(isset($doc->file_path) && $doc->file_path)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="inline-block w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            <i class="fas fa-file-pdf mr-2"></i> Unduh Dokumen Asli
                        </a>
                    @else
                        <div class="w-full py-3.5 bg-slate-100 text-slate-500 rounded-xl font-bold shadow-sm border border-slate-200">
                            <i class="fas fa-book-open mr-2"></i> Dokumen Internal (Buku Biru)
                        </div>
                    @endif

                @elseif($doc->status == 'pending')
                    <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-4xl text-yellow-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Menunggu Verifikasi</h2>
                    <p class="text-gray-500 mt-2 text-sm px-6">Dokumen ini sedang dalam antrean peninjauan oleh admin. Silakan cek kembali nanti.</p>
                    
                    <div class="mt-8">
                        <a href="{{ route('home') }}" class="text-blue-600 font-medium hover:underline text-sm">Kembali ke Beranda</a>
                    </div>

                @else
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-times-circle text-4xl text-red-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Dokumen Ditolak</h2>
                    <p class="text-gray-500 mt-2 text-sm px-6">Pengajuan dokumen ini tidak valid atau telah ditolak oleh admin karena alasan tertentu.</p>
                    
                    <div class="mt-8">
                        <a href="{{ route('tte.create') }}" class="text-blue-600 font-medium hover:underline text-sm">Ajukan Ulang Dokumen</a>
                    </div>
                @endif

            @else
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-4xl text-gray-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">Data Tidak Ditemukan</h2>
                <p class="text-gray-500 mt-2">Token verifikasi tidak valid.</p>
            @endif

        </div>
        
        <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100">
            <p class="text-xs text-gray-400">
                Sistem Verifikasi Digital Himpunan Mahasiswa Fisika Universitas Udayana.
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush