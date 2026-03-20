@extends('layouts.app')
@section('title', 'Manajemen Formulir')

@php
    $activePage = 'forms'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100">
    <div class="container px-4 mx-auto max-w-7xl pt-28 pb-20">
        
        {{-- Header Section with Quota Indicator --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 mb-3 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full">
                    <i class="fas fa-chalkboard-user"></i>
                    <span>Dashboard Formulir</span>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900">
                    <i class="fas fa-folder-open text-blue-600 mr-2"></i> Manajemen Formulir
                </h1>
                <p class="text-slate-600 mt-1">Kelola formulir, lihat jawaban, dan unduh rekap data.</p>
                
                {{-- Indikator Kuota Formulir --}}
                <div class="mt-4 flex items-center gap-3 flex-wrap">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-chart-simple text-slate-400 text-sm"></i>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kuota Anda:</span>
                    </div>
                    <div class="flex-1 max-w-xs">
                        <div class="relative w-full h-3 bg-slate-200 rounded-full overflow-hidden shadow-inner">
                            @php 
                                $percent = ($formCount / $maxForms) * 100;
                                $percent = min($percent, 100);
                            @endphp
                            <div class="absolute top-0 left-0 h-full transition-all duration-500 rounded-full 
                                {{ $percent >= 100 ? 'bg-gradient-to-r from-red-500 to-red-600' : ($percent >= 80 ? 'bg-gradient-to-r from-orange-400 to-orange-500' : 'bg-gradient-to-r from-blue-500 to-indigo-600') }}" 
                                style="width: {{ $percent }}%">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold {{ $formCount >= $maxForms ? 'text-red-600 animate-pulse' : 'text-slate-700' }}">
                            {{ $formCount }} / {{ $maxForms }}
                        </span>
                        @if($formCount >= $maxForms)
                            <span class="px-2 py-0.5 text-xs font-semibold text-red-600 bg-red-100 rounded-full">
                                <i class="fas fa-exclamation-circle mr-1"></i> Penuh
                            </span>
                        @else
                            <span class="px-2 py-0.5 text-xs font-semibold text-green-600 bg-green-100 rounded-full">
                                {{ $maxForms - $formCount }} tersisa
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- Additional info when quota is full --}}
                @if($formCount >= $maxForms)
                    <div class="mt-2 text-xs text-amber-600 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        <span>Kuota formulir Anda sudah penuh. Hapus formulir yang tidak terpakai untuk membuat yang baru.</span>
                    </div>
                @endif
            </div>
            
            {{-- Tombol Buat Form Pintar --}}
            @if($formCount >= $maxForms)
                <button disabled 
                        class="px-6 py-3 bg-slate-200 text-slate-500 font-bold rounded-xl shadow-none cursor-not-allowed flex items-center gap-2 transition-all"
                        title="Hapus formulir lama untuk membuat yang baru">
                    <i class="fas fa-ban"></i> 
                    <span>Kuota Penuh</span>
                    <i class="fas fa-lock text-xs opacity-50"></i>
                </button>
            @else
                <a href="{{ route('form.create') }}" 
                   class="group relative px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transition-all flex items-center gap-2 hover:-translate-y-0.5 overflow-hidden">
                    <div class="absolute inset-0 w-0 bg-white/20 transition-all duration-300 group-hover:w-full"></div>
                    <i class="fas fa-plus relative z-10 group-hover:rotate-90 transition-transform duration-300"></i>
                    <span class="relative z-10">Buat Form Baru</span>
                    <i class="fas fa-arrow-right relative z-10 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300"></i>
                </a>
            @endif
        </div>

        {{-- Notifikasi Error Kuota --}}
        @if(session('error'))
            <div class="relative mb-6 overflow-hidden bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-xl shadow-md animate-pulse">
                <div class="flex items-center gap-3 px-5 py-4">
                    <div class="p-2 bg-red-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="relative mb-6 overflow-hidden bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-xl shadow-md">
                <div class="flex items-center gap-3 px-5 py-4">
                    <div class="p-2 bg-emerald-100 rounded-full">
                        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-emerald-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Stats Cards Row (Optional) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold">Total Formulir</p>
                        <p class="text-2xl font-black text-slate-800">{{ $formCount }}</p>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-xl">
                        <i class="text-blue-600 fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold">Kuota Tersedia</p>
                        <p class="text-2xl font-black text-slate-800">{{ max(0, $maxForms - $formCount) }}</p>
                    </div>
                    <div class="p-2 bg-emerald-100 rounded-xl">
                        <i class="text-emerald-600 fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold">Kuota Maksimal</p>
                        <p class="text-2xl font-black text-slate-800">{{ $maxForms }}</p>
                    </div>
                    <div class="p-2 bg-purple-100 rounded-xl">
                        <i class="text-purple-600 fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-semibold">Penggunaan</p>
                        <p class="text-2xl font-black text-slate-800">{{ round($percent) }}%</p>
                    </div>
                    <div class="p-2 bg-orange-100 rounded-xl">
                        <i class="text-orange-600 fas fa-percent"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="overflow-hidden transition-all duration-300 bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-200/80">
            <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-100 rounded-xl">
                            <i class="text-indigo-600 fas fa-table-list"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Daftar Formulir</h2>
                    </div>
                    <div class="text-sm text-slate-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ $formCount }} dari {{ $maxForms }} formulir digunakan
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-800 to-slate-900">
                            <th class="p-4 text-xs font-bold tracking-wider text-white uppercase border-b border-slate-700">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file-alt"></i>
                                    Judul Formulir
                                </div>
                            </th>
                            <th class="p-4 text-xs font-bold tracking-wider text-center text-white uppercase border-b border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fas fa-users"></i>
                                    Responden
                                </div>
                            </th>
                            <th class="p-4 text-xs font-bold tracking-wider text-center text-white uppercase border-b border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fas fa-circle-notch"></i>
                                    Status
                                </div>
                            </th>
                            <th class="p-4 text-xs font-bold tracking-wider text-center text-white uppercase border-b border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fas fa-cog"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($forms as $form)
                        <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-indigo-50/30">
                            <td class="p-4">
                                <div class="space-y-1">
                                    <p class="text-base font-extrabold text-slate-800 group-hover:text-blue-700 transition-colors">
                                        {{ $form->title }}
                                    </p>
                                    <div class="flex items-center gap-1 text-xs text-slate-400">
                                        <i class="fas fa-link text-slate-300 text-[10px]"></i>
                                        <a href="{{ route('form.show', $form->slug) }}" target="_blank" class="flex items-center gap-1 transition-colors hover:text-blue-600 hover:underline">
                                            <span class="truncate max-w-[200px] md:max-w-none">/form/{{ $form->slug }}</span>
                                            <i class="fas fa-external-link-alt text-[10px]"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="inline-flex items-center justify-center gap-1 px-4 py-2 font-mono text-xl font-black text-indigo-700 bg-indigo-50 rounded-2xl shadow-sm">
                                    <i class="fas fa-user-check text-indigo-500 text-sm"></i>
                                    {{ $form->submissions_count }}
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if($form->is_active)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold tracking-wide text-green-700 bg-green-100 rounded-full shadow-sm">
                                        <i class="fas fa-play-circle text-[10px]"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-bold tracking-wide text-red-700 bg-red-100 rounded-full shadow-sm">
                                        <i class="fas fa-lock text-[10px]"></i>
                                        Ditutup
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('form.responses', $form->id) }}" 
                                       class="group/btn relative p-2.5 text-blue-600 transition-all duration-200 bg-blue-50 rounded-xl hover:bg-blue-600 hover:text-white hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       title="Lihat Jawaban">
                                        <i class="fas fa-table text-base group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    <a href="{{ route('form.download', $form->id) }}" 
                                       class="group/btn relative p-2.5 text-emerald-600 transition-all duration-200 bg-emerald-50 rounded-xl hover:bg-emerald-600 hover:text-white hover:shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                       title="Download Excel">
                                        <i class="fas fa-file-excel text-base group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    <form action="{{ route('form.destroy', $form->id) }}" method="POST" onsubmit="return confirm('⚠️ Peringatan: Semua jawaban akan ikut terhapus secara permanen. Yakin ingin menghapus formulir ini?');" class="inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2.5 text-red-600 transition-all duration-200 bg-red-50 rounded-xl hover:bg-red-600 hover:text-white hover:shadow-md focus:outline-none focus:ring-2 focus:ring-red-400"
                                                title="Hapus Formulir">
                                            <i class="fas fa-trash-alt text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="p-6 bg-slate-100 rounded-full">
                                        <i class="text-5xl text-slate-300 fas fa-folder-open"></i>
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-xl font-bold text-slate-600">Belum Ada Formulir</h3>
                                        <p class="text-sm text-slate-400">Mulai dengan membuat formulir digital pertama Anda.</p>
                                    </div>
                                    @if($formCount < $maxForms)
                                        <a href="{{ route('form.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 mt-2 text-sm font-semibold text-white transition-all bg-blue-600 rounded-xl hover:bg-blue-700 shadow-md hover:shadow-lg">
                                            <i class="fas fa-plus-circle"></i>
                                            Buat Formulir Sekarang
                                        </a>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-5 py-2.5 mt-2 text-sm font-semibold text-slate-500 bg-slate-100 rounded-xl cursor-not-allowed">
                                            <i class="fas fa-ban"></i>
                                            Kuota Penuh
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Table Footer with Pagination --}}
            @if(method_exists($forms, 'links') && $forms->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $forms->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@push('styles')
<style>
    /* Smooth fade-in animation for table rows */
    tbody tr {
        animation: fadeInUp 0.3s ease-out backwards;
        animation-delay: calc(var(--order, 0) * 0.05s);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Progress bar animation */
    .transition-all {
        transition: all 0.3s ease;
    }
    
    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Disabled button styling */
    button:disabled {
        cursor: not-allowed;
        opacity: 0.7;
    }
</style>
@endpush

@push('scripts')
<script>
    // Add staggered animation delay to table rows
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('tbody tr:not(:only-child)');
        rows.forEach((row, index) => {
            row.style.setProperty('--order', index);
        });
    });
</script>
@endpush
@endsection