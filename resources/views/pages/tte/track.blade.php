@extends('layouts.app')

@section('title', 'Lacak Status TTE')

@php
    $activePage = 'tte'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-slate-50 pt-32 pb-20 px-4">
    <div class="max-w-xl mx-auto">
        
        <div class="text-center mb-10 animate-fade-in-up">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-3">Lacak Dokumen</h1>
            <p class="text-slate-500">Masukkan Kode Unik yang Anda dapatkan saat pengajuan.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8 animate-fade-in-up delay-100">
            <form action="{{ route('tte.search') }}" method="POST">
                @csrf
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Kode Token</label>
                <div class="flex gap-2">
                    <input type="text" name="token" value="{{ request('token') }}"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-slate-800 font-mono text-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent uppercase" 
                        placeholder="Contoh: X7Y2Z9A1" required>
                    <button type="submit" class="bg-slate-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-900 transition shadow-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            @if(session('error'))
                <div class="mt-4 p-4 bg-red-50 text-red-600 rounded-xl border border-red-100 text-sm text-center font-medium">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                </div>
            @endif
        </div>

        @if(isset($document))
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">
            
            {{-- Header Status Berwarna --}}
            <div class="p-6 text-center 
                {{ $document->status == 'approved' ? 'bg-green-50 border-b border-green-100' : 
                  ($document->status == 'rejected' ? 'bg-red-50 border-b border-red-100' : 'bg-yellow-50 border-b border-yellow-100') }}">
                
                @if($document->status == 'approved')
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 text-green-600">
                        <i class="fas fa-check-double text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-green-800">Selesai Ditandatangani</h2>
                    <p class="text-green-600 text-sm">Dokumen sah dan dapat digunakan.</p>
                
                @elseif($document->status == 'rejected')
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 text-red-600">
                        <i class="fas fa-times text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-red-800">Pengajuan Ditolak</h2>
                    <p class="text-red-600 text-sm">Mohon hubungi admin untuk info lebih lanjut.</p>
                
                @else
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3 text-yellow-600">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-yellow-800">Menunggu Peninjauan</h2>
                    <p class="text-yellow-600 text-sm">Dokumen sedang dalam antrean admin.</p>
                @endif
            </div>

            {{-- Detail Dokumen --}}
            <div class="p-8 space-y-4">
                <div class="flex justify-between border-b border-gray-50 pb-4">
                    <span class="text-slate-500 text-sm">Judul Dokumen</span>
                    <span class="text-slate-800 font-bold text-right">{{ $document->document_title }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-50 pb-4">
                    <span class="text-slate-500 text-sm">Pengaju</span>
                    <span class="text-slate-800 font-medium text-right">{{ $document->user_name }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-50 pb-4">
                    <span class="text-slate-500 text-sm">Tanggal Pengajuan</span>
                    <span class="text-slate-800 font-medium text-right">{{ $document->created_at->format('d M Y, H:i') }}</span>
                </div>

                @if($document->status == 'approved')
                <div class="flex justify-between border-b border-gray-50 pb-4">
                    <span class="text-slate-500 text-sm">Ditandatangani Oleh</span>
                    <span class="text-slate-800 font-medium text-right">{{ $document->signer_name }}</span>
                </div>
                <div class="flex justify-between pb-4">
                    <span class="text-slate-500 text-sm">Tanggal TTD</span>
                    <span class="text-slate-800 font-medium text-right">{{ $document->signed_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="pt-4">
                    <a href="{{ route('tte.verify', $document->verification_token) }}" class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-xl font-bold shadow-lg shadow-blue-500/30 transition">
                        <i class="fas fa-qrcode mr-2"></i> Lihat Halaman Verifikasi
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<style>
    .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .delay-100 { animation-delay: 0.1s; }
</style>
@endpush