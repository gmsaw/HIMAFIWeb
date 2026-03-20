@extends('layouts.app')
@section('title', 'Hasil: ' . $form->title)

@php
    $activePage = 'forms'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100">
    <div class="container px-4 mx-auto max-w-[95rem] pt-28 pb-20">
        
        {{-- Header Section with Stats --}}
        <div class="mb-8">
            <a href="{{ route('form.index') }}" class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm font-semibold text-blue-600 transition-all bg-blue-50 rounded-xl hover:bg-blue-100 hover:gap-3 group">
                <i class="fas fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Manajemen
            </a>
            
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 text-sm font-semibold text-indigo-700 bg-indigo-100 rounded-full">
                        <i class="fas fa-chalkboard-user"></i>
                        <span>Laporan Responden</span>
                    </div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-800 md:text-4xl lg:text-5xl">
                        {{ $form->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2">
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-white rounded-xl shadow-sm border border-slate-200">
                            <i class="fas fa-users text-indigo-500"></i>
                            <span class="text-sm font-semibold text-slate-700">Total Responden</span>
                            <span class="px-2 py-0.5 text-lg font-black text-indigo-700 bg-indigo-50 rounded-lg">{{ $submissions->count() }}</span>
                        </div>
                        @if($submissions->count() > 0)
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-white rounded-xl shadow-sm border border-slate-200">
                            <i class="fas fa-calendar-alt text-emerald-500"></i>
                            <span class="text-sm font-semibold text-slate-700">Terakhir Submit</span>
                            <span class="text-sm font-medium text-slate-600">{{ $submissions->last()?->created_at->diffForHumans() ?? '-' }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('form.download.pdf_all', $form->id) }}" class="group relative inline-flex items-center gap-2 px-5 py-3 overflow-hidden text-sm font-bold text-white transition-all bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-md hover:shadow-red-500/30 hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf group-hover:scale-110 transition-transform"></i>
                        <span>Export Semua (PDF)</span>
                    </a>
                    <a href="{{ route('form.download', $form->id) }}" class="group relative inline-flex items-center gap-2 px-5 py-3 overflow-hidden text-sm font-bold text-white transition-all bg-gradient-to-r from-emerald-600 to-green-700 rounded-xl shadow-md hover:shadow-emerald-500/30 hover:-translate-y-0.5">
                        <i class="fas fa-file-excel group-hover:scale-110 transition-transform"></i>
                        <span>Export CSV</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Stats Cards Row --}}
        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-4">
            <div class="p-5 transition-all bg-white rounded-2xl shadow-sm border-l-4 border-l-blue-500 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Responden</p>
                        <p class="text-2xl font-black text-slate-800">{{ $submissions->count() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <i class="text-xl text-blue-600 fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="p-5 transition-all bg-white rounded-2xl shadow-sm border-l-4 border-l-emerald-500 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pertanyaan</p>
                        <p class="text-2xl font-black text-slate-800">{{ count($form->fields) }}</p>
                    </div>
                    <div class="p-3 bg-emerald-100 rounded-xl">
                        <i class="text-xl text-emerald-600 fas fa-question-circle"></i>
                    </div>
                </div>
            </div>
            <div class="p-5 transition-all bg-white rounded-2xl shadow-sm border-l-4 border-l-purple-500 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Tingkat Respons</p>
                        <p class="text-2xl font-black text-slate-800">
                            {{ $submissions->count() > 0 ? '100' : '0' }}%
                        </p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <i class="text-xl text-purple-600 fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="p-5 transition-all bg-white rounded-2xl shadow-sm border-l-4 border-l-orange-500 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Formulir Dibuat</p>
                        <p class="text-2xl font-black text-slate-800">{{ $form->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="p-3 bg-orange-100 rounded-xl">
                        <i class="text-xl text-orange-600 fas fa-calendar-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Responses Table --}}
        <div class="overflow-hidden transition-all duration-300 bg-white rounded-3xl shadow-2xl shadow-slate-200/50 border border-slate-200/80">
            <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-100 rounded-xl">
                            <i class="text-indigo-600 fas fa-table-list"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Data Responden</h2>
                    </div>
                    <div class="text-sm text-slate-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Klik pada gambar tanda tangan untuk memperbesar
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-800 to-slate-900">
                            <th class="p-4 text-xs font-bold tracking-wider text-white uppercase border-b border-slate-700">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock"></i>
                                    Waktu Submit
                                </div>
                            </th>
                            
                            @foreach($form->fields as $index => $field)
                                <th class="p-4 text-xs font-bold tracking-wider text-white uppercase border-b border-slate-700">
                                    <div class="flex items-center gap-2">
                                        @if($field['type'] == 'signature')
                                            <i class="fas fa-signature"></i>
                                        @elseif($field['type'] == 'email')
                                            <i class="fas fa-envelope"></i>
                                        @elseif($field['type'] == 'image_link')
                                            <i class="fas fa-image"></i>
                                        @elseif($field['type'] == 'radio')
                                            <i class="fas fa-dot-circle"></i>
                                        @elseif($field['type'] == 'checkbox')
                                            <i class="fas fa-check-square"></i>
                                        @elseif($field['type'] == 'textarea')
                                            <i class="fas fa-align-left"></i>
                                        @else
                                            <i class="fas fa-font"></i>
                                        @endif
                                        <span class="truncate max-w-[150px]" title="{{ $field['label'] }}">
                                            {{ Str::limit($field['label'], 25) }}
                                        </span>
                                        @if($field['required'])
                                            <span class="text-[10px] text-red-300">*</span>
                                        @endif
                                    </div>
                                </th>
                            @endforeach
                            
                            <th class="p-4 text-xs font-bold tracking-wider text-center text-white uppercase border-b border-slate-700">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fas fa-print"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($submissions as $submission)
                        <tr class="transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-indigo-50/30 group">
                            <td class="p-4 align-top">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-600">
                                        <i class="fas fa-calendar-day text-slate-400"></i>
                                        <span>{{ $submission->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $submission->created_at->format('H:i:s') }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            @foreach($form->fields as $field)
                                @php 
                                    $answer = $submission->answers[$field['name']] ?? '-'; 
                                    if(is_array($answer)) { 
                                        $answer = implode(', ', $answer); 
                                    }
                                @endphp
                                
                                <td class="p-4 align-top max-w-xs">
                                    @if($field['type'] == 'signature' && !empty($answer) && $answer !== '-')
                                        <div class="relative">
                                            <img src="{{ $answer }}" 
                                                 alt="Tanda Tangan" 
                                                 class="h-12 object-contain border border-slate-200 rounded-lg bg-white shadow-sm cursor-pointer transition-all hover:scale-150 hover:z-10 hover:shadow-xl"
                                                 onclick="openSignatureModal(this.src)"
                                                 title="Klik untuk memperbesar">
                                        </div>
                                    @elseif($field['type'] == 'image_link' && filter_var($answer, FILTER_VALIDATE_URL))
                                        <a href="{{ $answer }}" 
                                           target="_blank" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white rounded-lg text-xs font-semibold transition-all group/link">
                                            <i class="fas fa-external-link-alt text-xs group-hover/link:translate-x-0.5 transition-transform"></i>
                                            <span>Lihat Gambar</span>
                                        </a>
                                    @elseif($field['type'] == 'email' && $answer != '-')
                                        <a href="mailto:{{ $answer }}" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1 text-sm">
                                            <i class="fas fa-envelope text-xs"></i>
                                            {{ $answer }}
                                        </a>
                                    @else
                                        <div class="text-sm text-slate-700 break-words whitespace-normal">
                                            @if(is_string($answer) && strlen($answer) > 100)
                                                <span class="cursor-help" title="{{ $answer }}">
                                                    {{ Str::limit($answer, 80) }}
                                                    <i class="fas fa-ellipsis-h text-xs text-slate-400"></i>
                                                </span>
                                            @else
                                                {{ $answer }}
                                            @endif
                                        </div>
                                    @endif
                                 </td>
                            @endforeach
                            
                            <td class="p-4 text-center align-top">
                                <a href="{{ route('form.download.pdf', $submission->id) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white rounded-xl text-xs font-bold transition-all shadow-sm group/btn">
                                    <i class="fas fa-file-pdf group-hover/btn:scale-110 transition-transform"></i>
                                    <span>PDF</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ count($form->fields) + 2 }}" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="p-6 bg-slate-100 rounded-full">
                                        <i class="text-5xl text-slate-300 fas fa-inbox"></i>
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-xl font-bold text-slate-600">Belum Ada Responden</h3>
                                        <p class="text-sm text-slate-400">Belum ada yang mengisi formulir ini.</p>
                                    </div>
                                    <div class="flex gap-3">
                                        <a href="{{ route('form.show', $form->slug) }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-2 px-5 py-2.5 mt-2 text-sm font-semibold text-white transition-all bg-blue-600 rounded-xl hover:bg-blue-700 shadow-md">
                                            <i class="fas fa-external-link-alt"></i>
                                            Lihat Formulir
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Table Footer with Pagination --}}
            @if(method_exists($submissions, 'links') && $submissions->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $submissions->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Signature Modal for Enlarged View --}}
<div id="signatureModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm" onclick="closeSignatureModal()">
    <div class="relative max-w-2xl max-h-[90vh] p-4" onclick="event.stopPropagation()">
        <button onclick="closeSignatureModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl">
            <i class="fas fa-times-circle"></i>
        </button>
        <img id="modalSignatureImg" src="" alt="Tanda Tangan" class="w-full h-auto rounded-2xl shadow-2xl bg-white p-4">
    </div>
</div>

@push('styles')
<style>
    /* Staggered animation for table rows */
    tbody tr {
        animation: fadeInUp 0.3s ease-out backwards;
        animation-delay: calc(var(--order, 0) * 0.03s);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
    
    /* Table cell text overflow */
    .break-words {
        word-wrap: break-word;
        word-break: break-word;
    }
    
    /* Signature image hover effect */
    td img[alt="Tanda Tangan"] {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    /* Modal animation */
    #signatureModal {
        transition: opacity 0.3s ease;
    }
    
    #signatureModal img {
        animation: zoomIn 0.2s ease-out;
    }
    
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
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
    
    // Signature modal functions
    function openSignatureModal(src) {
        const modal = document.getElementById('signatureModal');
        const img = document.getElementById('modalSignatureImg');
        img.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeSignatureModal() {
        const modal = document.getElementById('signatureModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSignatureModal();
        }
    });
    
    // Tooltip for truncated text
    const truncatedCells = document.querySelectorAll('[title]');
    truncatedCells.forEach(cell => {
        cell.addEventListener('mouseenter', function(e) {
            // Native title tooltip will handle this
        });
    });
</script>
@endpush
@endsection