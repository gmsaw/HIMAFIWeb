@extends('layouts.admin')
@section('title', 'ORBIT - Arsip Surat')
@section('header-title', 'Oprasional Registrasi Berkas & Informasi Terpadu')

@section('content')

{{-- MENGAMBIL DATA STATISTIK LANGSUNG DI BLADE --}}
@php
    $totalSemua = \App\Models\Orbit::count();
    $totalMasuk = \App\Models\Orbit::where('jenis_surat', 'masuk')->count();
    $totalKeluar = \App\Models\Orbit::where('jenis_surat', 'keluar')->count();
@endphp

{{-- 1. KARTU STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl relative z-10 shadow-inner">
            <i class="fas fa-folder-open"></i>
        </div>
        <div class="relative z-10">
            <p class="text-sm text-slate-500 font-medium mb-1">Total Arsip</p>
            <h4 class="text-3xl font-bold text-slate-800">{{ $totalSemua }} <span class="text-sm font-normal text-slate-400">Berkas</span></h4>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl relative z-10 shadow-inner">
            <i class="fas fa-inbox"></i>
        </div>
        <div class="relative z-10">
            <p class="text-sm text-slate-500 font-medium mb-1">Surat Masuk</p>
            <h4 class="text-3xl font-bold text-slate-800">{{ $totalMasuk }} <span class="text-sm font-normal text-slate-400">Berkas</span></h4>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
        <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl relative z-10 shadow-inner">
            <i class="fas fa-paper-plane"></i>
        </div>
        <div class="relative z-10">
            <p class="text-sm text-slate-500 font-medium mb-1">Surat Keluar</p>
            <h4 class="text-3xl font-bold text-slate-800">{{ $totalKeluar }} <span class="text-sm font-normal text-slate-400">Berkas</span></h4>
        </div>
    </div>
</div>

{{-- ALERT MESSAGES --}}
@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-6 rounded-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
        <i class="fas fa-check-circle text-xl"></i>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-6 py-4 mb-6 rounded-xl shadow-sm flex items-start gap-3">
        <i class="fas fa-exclamation-circle text-xl mt-0.5"></i>
        <ul class="list-disc ml-4 space-y-1 font-medium text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- 2. TOOLBAR (FILTER, SEARCH & TOMBOL TAMBAH) --}}
<div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-col xl:flex-row justify-between items-center gap-4">
    
    {{-- Filter Pill (Menyimpan query search saat berpindah filter) --}}
    <div class="flex bg-slate-100 p-1 rounded-xl w-full xl:w-auto overflow-x-auto hide-scrollbar">
        <a href="{{ route('admin.orbit.index', array_merge(request()->query(), ['jenis' => null])) }}" class="whitespace-nowrap flex-1 text-center px-6 py-2 rounded-lg text-sm font-semibold transition-all {{ !request('jenis') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
            Semua
        </a>
        <a href="{{ route('admin.orbit.index', array_merge(request()->query(), ['jenis' => 'masuk'])) }}" class="whitespace-nowrap flex-1 text-center px-6 py-2 rounded-lg text-sm font-semibold transition-all {{ request('jenis') == 'masuk' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
            Masuk
        </a>
        <a href="{{ route('admin.orbit.index', array_merge(request()->query(), ['jenis' => 'keluar'])) }}" class="whitespace-nowrap flex-1 text-center px-6 py-2 rounded-lg text-sm font-semibold transition-all {{ request('jenis') == 'keluar' ? 'bg-white text-amber-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
            Keluar
        </a>
    </div>

    {{-- Kolom Pencarian --}}
    <form action="{{ route('admin.orbit.index') }}" method="GET" class="w-full xl:max-w-md flex items-center gap-2">
        {{-- Simpan jenis_surat jika sedang ada filter yang aktif --}}
        @if(request('jenis'))
            <input type="hidden" name="jenis" value="{{ request('jenis') }}">
        @endif
        
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-slate-400"></i>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor surat, perihal, instansi..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring focus:ring-blue-200 focus:border-blue-500 transition-all outline-none">
        </div>
        
        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2 rounded-xl text-sm font-semibold transition-colors shadow-sm">
            Cari
        </button>

        {{-- Tombol Reset Pencarian --}}
        @if(request('search'))
            <a href="{{ route('admin.orbit.index', ['jenis' => request('jenis')]) }}" class="bg-rose-50 hover:bg-rose-100 text-rose-500 px-3 py-2 rounded-xl text-sm transition-colors" title="Hapus Pencarian">
                <i class="fas fa-times"></i>
            </a>
        @endif
    </form>

    {{-- Action Button --}}
    <div class="w-full xl:w-auto flex items-center justify-end shrink-0">
        <button onclick="document.getElementById('addOrbitModal').classList.remove('hidden')" class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
            <i class="fas fa-cloud-upload-alt"></i> Arsipkan Berkas
        </button>
    </div>
</div>

{{-- 3. TABEL DATA --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="bg-slate-50 border-b border-gray-100 text-slate-500 text-xs uppercase tracking-wider font-bold">
                    <th class="px-6 py-5">Jenis & Nomor</th>
                    <th class="px-6 py-5">Tanggal</th>
                    <th class="px-6 py-5">Instansi / Subjek</th>
                    <th class="px-6 py-5">Perihal</th>
                    <th class="px-6 py-5 text-center">Berkas</th>
                    <th class="px-6 py-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($surats as $surat)
                <tr class="hover:bg-slate-50/80 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $surat->jenis_surat == 'masuk' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                                <i class="fas {{ $surat->jenis_surat == 'masuk' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                            </div>
                            <div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase mb-1 inline-block {{ $surat->jenis_surat == 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    Surat {{ $surat->jenis_surat }}
                                </span>
                                <p class="font-bold text-slate-800">{{ $surat->nomor_surat }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2 text-slate-600">
                            <i class="far fa-calendar-alt text-slate-400"></i>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d M Y') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-800">{{ $surat->pengirim }}</span>
                            <span class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                <i class="fas fa-caret-right text-slate-300"></i> {{ $surat->penerima }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-[220px] truncate font-medium text-slate-700" title="{{ $surat->perihal }}">
                            {{ $surat->perihal }}
                        </div>
                        @if($surat->keterangan)
                            <div class="text-[11px] text-slate-400 truncate max-w-[220px] mt-0.5">{{ $surat->keterangan }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank" class="inline-flex items-center gap-2 bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 px-3 py-2 rounded-lg text-xs font-bold transition-colors">
                            <i class="fas fa-file-pdf text-sm"></i> PDF
                        </a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.orbit.destroy', $surat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus arsip ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-white border border-gray-200 text-slate-400 hover:text-rose-500 hover:border-rose-200 hover:bg-rose-50 flex items-center justify-center transition-all shadow-sm" title="Hapus Arsip">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-folder-open text-4xl text-slate-300"></i>
                            </div>
                            <h5 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Arsip</h5>
                            <p class="text-sm text-slate-500 mb-4 max-w-sm">Data surat masuk maupun surat keluar masih kosong. Silakan tambahkan arsip baru.</p>
                            <button onclick="document.getElementById('addOrbitModal').classList.remove('hidden')" class="text-blue-600 font-semibold text-sm hover:underline">
                                + Tambah Arsip Sekarang
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($surats->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-slate-50/50">
            {{ $surats->links() }}
        </div>
    @endif
</div>

{{-- 4. MODAL TAMBAH ARSIP (BEAUTIFIED) --}}
<div id="addOrbitModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 opacity-100 transition-opacity">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-transform duration-300 scale-100">
        
        {{-- Header Modal --}}
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white/90 backdrop-blur-sm z-20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-lg">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-slate-800 leading-tight">Arsipkan Berkas Baru</h3>
                    <p class="text-xs text-slate-500">Form input ke sistem ORBIT HIMAFI</p>
                </div>
            </div>
            <button onclick="document.getElementById('addOrbitModal').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        {{-- Body Modal --}}
        <form action="{{ route('admin.orbit.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Surat <span class="text-rose-500">*</span></label>
                    <select name="jenis_surat" required class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-2.5">
                        <option value="" disabled selected>-- Pilih Jenis --</option>
                        <option value="masuk">Surat Masuk</option>
                        <option value="keluar">Surat Keluar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor Surat <span class="text-rose-500">*</span></label>
                    <input type="text" name="nomor_surat" required placeholder="Contoh: 001/HIMAFI/UNUD/IV/2026" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Surat <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_surat" required class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Perihal <span class="text-rose-500">*</span></label>
                    <input type="text" name="perihal" required placeholder="Cth: Undangan Rapat / Peminjaman Barang" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pengirim <span class="text-rose-500">*</span></label>
                    <input type="text" name="pengirim" required placeholder="Instansi/Orang Pengirim" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Penerima <span class="text-rose-500">*</span></label>
                    <input type="text" name="penerima" required placeholder="Tujuan Surat" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-2.5">
                </div>
            </div>

            {{-- Input File ala Dropzone --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">File Scan Surat (Wajib PDF) <span class="text-rose-500">*</span></label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-xl px-6 py-8 text-center hover:border-blue-500 hover:bg-blue-50/50 transition-colors bg-slate-50">
                    <i class="fas fa-file-pdf text-4xl text-slate-300 mb-3"></i>
                    <p class="text-sm font-medium text-slate-700">Pilih file PDF untuk diunggah</p>
                    <p class="text-xs text-slate-500 mt-1">Maksimal ukuran file: 5 MB</p>
                    <input type="file" name="file_surat" accept=".pdf" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" rows="2" class="w-full border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm py-3" placeholder="Tulis catatan jika diperlukan..."></textarea>
            </div>

            {{-- Footer Modal --}}
            <div class="pt-6 flex justify-end gap-3 border-t border-gray-100 mt-8">
                <button type="button" onclick="document.getElementById('addOrbitModal').classList.add('hidden')" class="px-6 py-2.5 bg-white border border-gray-200 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-800 font-semibold text-sm transition">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-sm shadow-lg shadow-blue-500/30 transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan ke Server
                </button>
            </div>
        </form>
    </div>
</div>
@endsection