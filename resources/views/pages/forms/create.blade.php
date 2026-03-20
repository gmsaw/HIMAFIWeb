@extends('layouts.app')
@section('title', 'Buat Formulir Baru')

@php
    $activePage = 'forms'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/30 to-blue-50/40">
    <div class="container px-4 mx-auto max-w-5xl pt-28 pb-20">
        
        {{-- Header Section --}}
        <div class="mb-10 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 mb-4 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full">
                <i class="fas fa-wand-magic"></i>
                <span>Form Builder Pro</span>
            </div>
            <h1 class="text-4xl font-black tracking-tight text-slate-800 md:text-5xl">
                Buat Formulir 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Digital</span>
            </h1>
            <p class="max-w-2xl mt-2 text-slate-500 md:mx-0 mx-auto">
                Rancang formulir interaktif dengan berbagai tipe pertanyaan. Drag & drop, atur validasi, dan publikasikan dalam hitungan detik.
            </p>
        </div>

        <form action="{{ route('form.store') }}" method="POST" id="form-builder" class="space-y-8">
            @csrf

            {{-- SECTION 1: FORM IDENTITY --}}
            <div class="relative overflow-hidden transition-all duration-300 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 hover:shadow-indigo-100/50 group">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-indigo-600"></div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-blue-100 rounded-xl">
                            <i class="text-xl text-blue-600 fas fa-info-circle"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">Informasi Formulir</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700">
                                Judul Formulir <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="absolute left-0 text-slate-400 fas fa-heading top-3"></i>
                                <input type="text" 
                                       name="title" 
                                       placeholder="Contoh: Pendaftaran Workshop Digital Marketing 2024" 
                                       required 
                                       class="w-full pl-8 text-xl font-semibold border-0 border-b-2 border-slate-200 focus:ring-0 focus:border-blue-500 px-0 py-2 bg-transparent transition-colors placeholder:text-slate-300 focus:placeholder:text-transparent">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700">
                                Deskripsi Singkat
                            </label>
                            <div class="relative">
                                <i class="absolute left-0 text-slate-400 fas fa-align-left top-3"></i>
                                <textarea name="description" 
                                          rows="3" 
                                          placeholder="Jelaskan tujuan formulir, petunjuk pengisian, atau informasi penting lainnya..." 
                                          class="w-full pl-8 text-slate-600 border-0 border-b-2 border-slate-200 focus:ring-0 focus:border-blue-500 px-0 py-2 bg-transparent transition-colors resize-none placeholder:text-slate-300"></textarea>
                            </div>
                            <p class="mt-1 text-xs text-slate-400">
                                <i class="fas fa-lightbulb mr-1"></i>Deskripsi yang jelas akan membantu responden memahami tujuan formulir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: DYNAMIC QUESTIONS AREA --}}
            <div class="relative">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-100 rounded-xl">
                            <i class="text-xl text-indigo-600 fas fa-question-circle"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">Daftar Pertanyaan</h2>
                        <span class="px-2 py-0.5 text-xs font-semibold text-indigo-600 bg-indigo-100 rounded-full" id="question-count">0</span>
                    </div>
                    <button type="button" 
                            onclick="scrollToToolbar()" 
                            class="hidden text-sm text-blue-600 transition-colors md:block hover:text-blue-800">
                        <i class="fas fa-arrow-down mr-1"></i> Tambah Pertanyaan
                    </button>
                </div>
                
                <div id="fields-container" class="space-y-5">
                    {{-- Questions will be added dynamically here --}}
                </div>
                
                {{-- Empty State for Questions --}}
                <div id="empty-questions-state" class="py-16 text-center transition-all bg-white rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="flex flex-col items-center gap-3">
                        <div class="p-4 bg-slate-100 rounded-full">
                            <i class="text-4xl text-slate-300 fas fa-arrow-down"></i>
                        </div>
                        <p class="text-slate-400">Belum ada pertanyaan</p>
                        <p class="text-sm text-slate-400">Klik tombol di bawah untuk menambahkan pertanyaan pertama</p>
                    </div>
                </div>
            </div>

            {{-- SECTION 3: QUESTION TYPE TOOLBAR --}}
            <div class="sticky bottom-4 z-20">
                <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-200/80 p-4">
                    <div class="flex items-center gap-2 mb-3 text-sm font-semibold text-slate-600">
                        <i class="fas fa-plus-circle text-blue-500"></i>
                        <span>Tambah Pertanyaan Baru</span>
                    </div>
                    <div class="flex flex-wrap gap-2 justify-center">
                        <button type="button" onclick="addField('text', 'Teks Singkat', 'fa-font')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-font text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Teks</span>
                        </button>
                        <button type="button" onclick="addField('textarea', 'Paragraf', 'fa-align-left')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-align-left text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Paragraf</span>
                        </button>
                        <button type="button" onclick="addField('email', 'Email', 'fa-envelope')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-envelope text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Email</span>
                        </button>
                        <button type="button" onclick="addField('date', 'Tanggal Saja', 'fa-calendar-day')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-calendar-day text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Tanggal</span>
                        </button>
                        <button type="button" onclick="addField('datetime-local', 'Tanggal & Waktu', 'fa-calendar-alt')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-calendar-alt text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Tgl & Waktu</span>
                        </button>
                        <button type="button" onclick="addField('radio', 'Pilihan Satu', 'fa-dot-circle')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-dot-circle text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Radio</span>
                        </button>
                        <button type="button" onclick="addField('checkbox', 'Pilihan Banyak', 'fa-check-square')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-check-square text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Checkbox</span>
                        </button>
                        <button type="button" onclick="addField('image_link', 'Link Gambar', 'fa-link')" class="group px-4 py-2.5 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-slate-200 hover:border-blue-300 hover:shadow-md">
                            <i class="fas fa-link text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Link Gambar</span>
                        </button>
                        <button type="button" onclick="addField('signature', 'Tanda Tangan', 'fa-signature')" class="group px-4 py-2.5 bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 text-green-700 hover:text-green-800 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 border border-green-200 hover:border-green-400 hover:shadow-md">
                            <i class="fas fa-signature text-sm group-hover:scale-110 transition-transform"></i>
                            <span>Tanda Tangan</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-4">
                <button type="submit" class="group relative w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-5 rounded-2xl shadow-xl shadow-blue-600/30 transition-all hover:-translate-y-1 flex justify-center items-center gap-3 text-lg overflow-hidden">
                    <div class="absolute inset-0 w-0 bg-white/20 transition-all duration-300 group-hover:w-full"></div>
                    <i class="fas fa-paper-plane relative z-10 group-hover:translate-x-1 transition-transform"></i>
                    <span class="relative z-10">Terbitkan Formulir</span>
                    <i class="fas fa-check-circle relative z-10 opacity-0 group-hover:opacity-100 transition-all"></i>
                </button>
                <p class="mt-3 text-xs text-center text-slate-400">
                    <i class="fas fa-shield-alt mr-1"></i>Formulir akan langsung aktif dan dapat dibagikan setelah diterbitkan
                </p>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    /* Smooth fade-in animation for question cards */
    .field-card {
        animation: slideInUp 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1) backwards;
        animation-delay: calc(var(--order, 0) * 0.05s);
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Sticky toolbar backdrop blur support */
    .backdrop-blur-md {
        backdrop-filter: blur(12px);
    }
    
    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 4px;
    }
    
    /* Question card hover effect */
    .field-card {
        transition: all 0.2s ease;
    }
    
    .field-card:hover {
        transform: translateX(4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
    }
    
    /* Date input styling */
    input[type="date"], input[type="datetime-local"] {
        cursor: pointer;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        padding: 4px;
        border-radius: 6px;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator:hover,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
        background-color: #e2e8f0;
    }
</style>
@endpush

@push('scripts')
<script>
    let fieldIndex = 0;
    const container = document.getElementById('fields-container');
    const emptyState = document.getElementById('empty-questions-state');
    const questionCountSpan = document.getElementById('question-count');

    // Initialize with one default question
    window.onload = () => { 
        addField('text', 'Teks Singkat', 'fa-font'); 
        updateEmptyState();
    };

    function updateEmptyState() {
        const questionCount = document.querySelectorAll('.field-card').length;
        if (questionCountSpan) {
            questionCountSpan.textContent = questionCount;
        }
        if (emptyState) {
            if (questionCount > 0) {
                emptyState.style.display = 'none';
            } else {
                emptyState.style.display = 'block';
            }
        }
    }

    function addField(type, typeLabel, iconClass) {
        let optionsHtml = '';
        let additionalHtml = '';
        
        // Add options for radio and checkbox
        if(type === 'radio' || type === 'checkbox') {
            optionsHtml = `
            <div class="w-full mt-4 pl-0 md:pl-16 transition-all">
                <div class="relative">
                    <i class="absolute left-0 text-slate-400 fas fa-list-ul top-2.5 text-xs"></i>
                    <input type="text" 
                           name="fields[${fieldIndex}][options]" 
                           placeholder="Pisahkan opsi dengan koma (contoh: Sangat Puas, Puas, Netral, Kurang Puas, Tidak Puas)" 
                           required 
                           class="w-full pl-6 text-sm border-0 border-b border-dashed border-slate-300 focus:ring-0 focus:border-indigo-500 px-0 py-1.5 bg-slate-50/50 rounded-t-lg transition-colors">
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                    <i class="fas fa-info-circle text-[10px]"></i>
                    Pisahkan setiap opsi dengan tanda koma (,)
                </p>
            </div>`;
        }
        
        // Add placeholder hint for date fields
        if(type === 'date') {
            additionalHtml = `
            <div class="w-full mt-2 pl-0 md:pl-16">
                <p class="text-[11px] text-slate-400 flex items-center gap-1">
                    <i class="fas fa-info-circle text-[10px]"></i>
                    Format: DD/MM/YYYY - Pengguna akan memilih tanggal dari kalender
                </p>
            </div>`;
        }
        
        if(type === 'datetime-local') {
            additionalHtml = `
            <div class="w-full mt-2 pl-0 md:pl-16">
                <p class="text-[11px] text-slate-400 flex items-center gap-1">
                    <i class="fas fa-info-circle text-[10px]"></i>
                    Format: DD/MM/YYYY HH:MM - Pengguna akan memilih tanggal dan waktu
                </p>
            </div>`;
        }
        
        const fieldHtml = `
            <div class="field-card bg-white rounded-2xl shadow-md border border-slate-200 relative group transition-all hover:shadow-lg" id="field-${fieldIndex}" style="--order: ${fieldIndex}">
                <button type="button" 
                        onclick="removeField(${fieldIndex})" 
                        class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 text-white hover:bg-red-600 rounded-full flex items-center justify-center transition-all shadow-md opacity-0 group-hover:opacity-100 scale-90 group-hover:scale-100 z-10 focus:outline-none focus:ring-2 focus:ring-red-400">
                    <i class="fas fa-times text-xs"></i>
                </button>

                <div class="p-5">
                    <div class="flex flex-col md:flex-row gap-4 items-start">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 text-slate-500 flex items-center justify-center flex-shrink-0 shadow-inner">
                            <i class="fas ${iconClass} text-lg"></i>
                        </div>

                        <div class="flex-grow w-full space-y-3">
                            <input type="hidden" name="fields[${fieldIndex}][type]" value="${type}">
                            <div class="relative">
                                <i class="absolute left-0 text-slate-400 fas fa-question-circle top-3 text-sm"></i>
                                <input type="text" 
                                       name="fields[${fieldIndex}][label]" 
                                       placeholder="Ketik pertanyaan Anda di sini..." 
                                       required 
                                       class="w-full pl-7 text-base font-semibold border-0 border-b-2 border-slate-200 focus:ring-0 focus:border-indigo-500 px-0 py-2 bg-transparent transition-colors placeholder:text-slate-300">
                            </div>
                            
                            <!-- Preview input example for better UX -->
                            <div class="text-xs text-slate-400 flex items-center gap-2">
                                <i class="fas fa-eye text-[10px]"></i>
                                <span>Contoh tampilan: </span>
                                ${type === 'date' ? '<code class="px-2 py-0.5 bg-slate-100 rounded text-blue-600">📅 Pilih tanggal</code>' : ''}
                                ${type === 'datetime-local' ? '<code class="px-2 py-0.5 bg-slate-100 rounded text-blue-600">📅 🕐 Pilih tanggal & waktu</code>' : ''}
                                ${type === 'text' ? '<code class="px-2 py-0.5 bg-slate-100 rounded">[ ] Teks pendek</code>' : ''}
                                ${type === 'textarea' ? '<code class="px-2 py-0.5 bg-slate-100 rounded">[ ] Area teks panjang</code>' : ''}
                                ${type === 'email' ? '<code class="px-2 py-0.5 bg-slate-100 rounded">nama@email.com</code>' : ''}
                                ${type === 'radio' ? '<code class="px-2 py-0.5 bg-slate-100 rounded">◉ Pilihan satu</code>' : ''}
                                ${type === 'checkbox' ? '<code class="px-2 py-0.5 bg-slate-100 rounded">☑ Pilihan banyak</code>' : ''}
                            </div>
                        </div>

                        <div class="flex items-center gap-2 bg-slate-50/80 px-4 py-2.5 rounded-xl border border-slate-200 flex-shrink-0">
                            <label class="text-sm font-medium text-slate-600 cursor-pointer" for="req-${fieldIndex}">
                                <i class="fas fa-asterisk text-red-400 text-[10px] mr-1"></i>
                                Wajib
                            </label>
                            <div class="relative">
                                <input type="checkbox" 
                                       name="fields[${fieldIndex}][required]" 
                                       id="req-${fieldIndex}" 
                                       checked 
                                       class="w-5 h-5 text-indigo-600 bg-white border-slate-300 rounded focus:ring-indigo-500 focus:ring-2 cursor-pointer">
                            </div>
                        </div>
                    </div>
                    ${optionsHtml}
                    ${additionalHtml}
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', fieldHtml);
        fieldIndex++;
        updateEmptyState();
        
        // Smooth scroll to the new field
        setTimeout(() => {
            const newField = document.getElementById(`field-${fieldIndex - 1}`);
            if (newField) {
                newField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                newField.style.transform = 'scale(1.01)';
                setTimeout(() => {
                    newField.style.transform = '';
                }, 300);
            }
        }, 100);
    }

    function removeField(id) {
        const field = document.getElementById(`field-${id}`);
        if (field) {
            field.style.opacity = '0';
            field.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                field.remove();
                updateEmptyState();
                // Re-index remaining fields for animation order
                const remainingFields = document.querySelectorAll('.field-card');
                remainingFields.forEach((card, idx) => {
                    card.style.setProperty('--order', idx);
                });
            }, 200);
        }
    }

    function scrollToToolbar() {
        document.querySelector('.sticky').scrollIntoView({ behavior: 'smooth', block: 'end' });
    }

    document.getElementById('form-builder').addEventListener('submit', function(e) {
        const questionCount = document.querySelectorAll('.field-card').length;
        if(questionCount === 0) {
            e.preventDefault();
            // Sweet alert style notification
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-24 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-bounce';
            alertDiv.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i> Harap tambahkan minimal 1 pertanyaan sebelum menerbitkan formulir!';
            document.body.appendChild(alertDiv);
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
            // Highlight empty state
            if (emptyState) {
                emptyState.style.borderColor = '#ef4444';
                emptyState.style.backgroundColor = '#fef2f2';
                setTimeout(() => {
                    emptyState.style.borderColor = '';
                    emptyState.style.backgroundColor = '';
                }, 1000);
            }
        }
    });
    
    // Update empty state on page load
    document.addEventListener('DOMContentLoaded', updateEmptyState);
</script>
@endpush
@endsection