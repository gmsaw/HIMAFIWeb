@extends('layouts.app')

@section('title', 'Ajukan Tanda Tangan Elektronik')

{{-- CSS Override: Memaksa Header Putih --}}
@section('content')

@php
    $activePage = 'tte'; 
    $useTransparentHeader = false; 
@endphp

<div class="min-h-screen bg-slate-50 relative overflow-hidden pt-32 pb-20 px-4">
    
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-100/50 to-transparent -z-10"></div>
    <div class="absolute top-20 right-0 w-72 h-72 bg-cyan-200/20 rounded-full filter blur-3xl -z-10 animate-pulse"></div>
    <div class="absolute bottom-20 left-0 w-72 h-72 bg-blue-200/20 rounded-full filter blur-3xl -z-10"></div>

    <div class="max-w-3xl mx-auto">
        
        <div class="text-center mb-10 animate-fade-in-up">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-wider mb-3 border border-blue-200">
                E-SIGNATURE SYSTEM
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-3">
                Pengajuan Tanda Tangan
            </h1>
            <p class="text-slate-500 max-w-lg mx-auto mb-6">
                Isi formulir di bawah ini untuk mengajukan permohonan tanda tangan digital pada dokumen surat atau proposal Anda.
            </p>

            <div class="flex justify-center">
                <a href="{{ route('tte.track') }}" class="group inline-flex items-center gap-3 px-5 py-2.5 bg-white text-slate-600 rounded-full shadow-md border border-gray-100 hover:border-blue-300 hover:text-blue-600 hover:shadow-lg transition-all duration-300">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <span class="text-sm font-bold">Sudah punya kode? Lacak Status Surat</span>
                    <i class="fas fa-arrow-right text-xs opacity-50 group-hover:translate-x-1 group-hover:opacity-100 transition-all"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up delay-100 relative">
            
            <div class="h-1.5 w-full bg-gray-100">
                <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-400 w-1/3"></div>
            </div>

            <div class="p-8 md:p-10">
                
                @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 shadow-sm text-center animate-fade-in">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-emerald-900 mb-2">Pengajuan Berhasil!</h3>
                    <p class="text-emerald-700 text-sm mb-4">Simpan <b>Kode Unik</b> ini untuk mengecek status:</p>
                    
                    <div class="bg-white border-2 border-dashed border-emerald-300 rounded-xl p-4 max-w-xs mx-auto mb-6 relative group">
                        <span class="text-3xl font-mono font-bold text-slate-800 tracking-wider block" id="tokenText">
                            {{ session('token_code') ?? 'TOKEN-ERR' }}
                        </span>
                        <button onclick="copyToken()" class="absolute top-2 right-2 text-gray-400 hover:text-emerald-600 transition" title="Salin">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>

                    <div class="flex justify-center gap-3">
                        <a href="{{ route('tte.track') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/30 text-sm">
                            <i class="fas fa-search mr-2"></i> Lacak Status Sekarang
                        </a>
                    </div>
                </div>
                @endif

                <form id="tteForm" action="{{ route('tte.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengaju</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <input type="text" name="user_name" 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm" 
                                    placeholder="Nama Lengkap Anda" 
                                    value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                            </div>
                        </div>

                        <div class="relative group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <input type="email" name="user_email" 
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm" 
                                    placeholder="email@example.com" 
                                    value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Perihal / Judul Dokumen</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <input type="text" name="document_title" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm" 
                                placeholder="Contoh: Surat Peminjaman Aula Student Center" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Tambahan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="description" rows="3" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm" 
                            placeholder="Tambahkan catatan untuk admin jika diperlukan..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Dokumen (PDF)</label>
                        <div class="relative group">
                            <input type="file" name="file" id="file-upload" accept="application/pdf" class="hidden" onchange="updateFileName(this)" required>
                            
                            <label for="file-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 group-hover:shadow-inner">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                    <div class="w-12 h-12 mb-3 bg-white rounded-full shadow-sm flex items-center justify-center text-blue-500">
                                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                    </div>
                                    <p class="mb-1 text-sm text-gray-600 font-medium"><span class="text-blue-600 font-bold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-400">PDF Only (Maks. 5MB)</p>
                                </div>
                                
                                <div id="file-info" class="hidden flex-col items-center animate-fade-in">
                                    <i class="fas fa-file-pdf text-red-500 text-3xl mb-2"></i>
                                    <p id="filename-display" class="text-sm font-bold text-gray-800 text-center px-4 truncate max-w-xs"></p>
                                    <p class="text-xs text-green-600 mt-1"><i class="fas fa-check-circle"></i> File siap diupload</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" id="submit-btn" class="w-full relative group overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                            <span class="relative flex items-center justify-center gap-2" id="btn-text">
                                <i class="fas fa-paper-plane"></i> Ajukan Permohonan
                            </span>
                            <span class="hidden absolute inset-0 flex items-center justify-center gap-2 bg-blue-600" id="btn-loading">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
            
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400">
                    <i class="fas fa-lock mr-1"></i> Data Anda dilindungi dan hanya digunakan untuk keperluan verifikasi.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- Logic Tampilan File Upload ---
    function updateFileName(input) {
        const placeholder = document.getElementById('upload-placeholder');
        const fileInfo = document.getElementById('file-info');
        const filenameDisplay = document.getElementById('filename-display');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            if(file.size > 5242880) {
                alert('Ukuran file terlalu besar! Maksimal 5MB.');
                input.value = '';
                return;
            }

            placeholder.classList.add('hidden');
            fileInfo.classList.remove('hidden');
            fileInfo.classList.add('flex');
            filenameDisplay.textContent = file.name;
        } else {
            placeholder.classList.remove('hidden');
            fileInfo.classList.add('hidden');
            fileInfo.classList.remove('flex');
        }
    }

    // --- Logic Copy Token ---
    function copyToken() {
        const token = document.getElementById('tokenText').innerText.trim();
        navigator.clipboard.writeText(token).then(() => {
            alert('Kode Token berhasil disalin!');
        });
    }

    // --- Logic Submit Button Loading ---
    document.getElementById('tteForm').addEventListener('submit', function() {
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');
        const btn = document.getElementById('submit-btn');

        btn.disabled = true;
        btn.classList.add('cursor-not-allowed', 'opacity-80');
        btnText.classList.add('opacity-0');
        btnLoading.classList.remove('hidden');
    });
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        opacity: 0;
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
    .delay-100 { animation-delay: 0.1s; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
@endpush