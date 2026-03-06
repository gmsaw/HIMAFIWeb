@extends('layouts.app')

@section('title', 'Kotak Aspirasi Mahasiswa')

@php
$activePage = 'aspirasi'; 
$useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-slate-50 relative pt-32 pb-20 px-4">
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-200/30 rounded-full filter blur-3xl -z-10"></div>
    <div class="absolute bottom-20 left-0 w-72 h-72 bg-blue-200/30 rounded-full filter blur-3xl -z-10"></div>

    <div class="max-w-2xl mx-auto">
        
        <div class="text-center mb-10 animate-fade-in-up">
            <span class="inline-block py-1 px-3 rounded-full bg-purple-100 text-purple-600 text-xs font-bold tracking-wider mb-3 border border-purple-200">
                SUARA MAHASISWA
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-3">
                Kotak Aspirasi
            </h1>
            <p class="text-slate-500 max-w-lg mx-auto">
                Sampaikan kritik, saran, dan ide Anda untuk kemajuan HIMAFI. Identitas Anda aman jika memilih opsi anonim.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
            <div class="h-1.5 w-full bg-gradient-to-r from-purple-500 to-pink-500"></div>

            <div class="p-8 md:p-10">
                
                @if(session('success'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div>
                            <h4 class="font-bold text-gray-700 text-sm">Kirim Sebagai Anonim?</h4>
                            <p class="text-xs text-gray-500">Nama dan email tidak akan direkam.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_anonymous" id="anonToggle" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div id="identityFields" class="grid grid-cols-1 md:grid-cols-2 gap-6 transition-all duration-300">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="Nama Anda">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Email</label>
                            <input type="email" name="email" class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="email@unud.ac.id">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Perihal / Topik</label>
                        <input type="text" name="subject" required class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="Contoh: Fasilitas Ruang Baca">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Pesan Aspirasi</label>
                        <textarea name="message" rows="5" required class="w-full rounded-xl border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="Tuliskan masukan Anda secara detail..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-purple-500/30 transition transform hover:-translate-y-1">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Aspirasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const anonToggle = document.getElementById('anonToggle');
    const identityFields = document.getElementById('identityFields');
    const inputs = identityFields.querySelectorAll('input');

    anonToggle.addEventListener('change', function() {
        if(this.checked) {
            identityFields.classList.add('opacity-50', 'pointer-events-none', 'blur-[1px]');
            inputs.forEach(input => input.value = ''); // Clear input
        } else {
            identityFields.classList.remove('opacity-50', 'pointer-events-none', 'blur-[1px]');
        }
    });
</script>
@endsection