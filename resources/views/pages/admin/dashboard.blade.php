@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('header-title', 'Dashboard Utama')

@section('content')

    <div class="relative bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-6 md:p-8 text-white mb-8 overflow-hidden shadow-lg border border-slate-700">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h3>
                <p class="text-slate-300 max-w-xl text-sm md:text-base">
                    Pusat kontrol HIMAFI. Pantau keuangan, inventaris, dan administrasi organisasi secara real-time di sini.
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-slate-400 text-sm">Saldo Kas Saat Ini</p>
                <h2 class="text-3xl font-bold text-emerald-400">Rp {{ number_format($currentBalance, 0, ',', '.') }}</h2>
            </div>
        </div>
        
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-blue-600 rounded-full mix-blend-overlay filter blur-3xl opacity-40"></div>
        <div class="absolute bottom-0 right-20 w-32 h-32 bg-emerald-500 rounded-full mix-blend-overlay filter blur-3xl opacity-30"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-blue-200 transition-all">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Total Anggota</p>
                <h4 class="text-2xl font-bold text-slate-800">{{ $totalUsers }} <span class="text-sm font-normal text-gray-400">User</span></h4>
                @if($pendingUsers > 0)
                    <span class="text-xs text-red-500 font-medium">{{ $pendingUsers }} perlu verifikasi</span>
                @endif
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-orange-200 transition-all">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Sedang Dipinjam</p>
                <h4 class="text-2xl font-bold text-slate-800">{{ $borrowedItems }} <span class="text-sm font-normal text-gray-400">Barang</span></h4>
                <p class="text-xs text-gray-400">Dari total {{ $totalItems }} aset</p>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-orange-600 group-hover:text-white transition-colors">
                <i class="fas fa-hand-holding"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-teal-200 transition-all">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Artikel Terbit</p>
                <h4 class="text-2xl font-bold text-slate-800">{{ $totalPosts }} <span class="text-sm font-normal text-gray-400">Post</span></h4>
                <p class="text-xs text-gray-400">Berita & Informasi</p>
            </div>
            <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-teal-600 group-hover:text-white transition-colors">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between group hover:border-purple-200 transition-all">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Permohonan TTE</p>
                <h4 class="text-2xl font-bold text-slate-800">{{ $pendingTTE }} <span class="text-sm font-normal text-gray-400">Surat</span></h4>
                <p class="text-xs text-purple-500 font-medium">Menunggu diproses</p>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <i class="fas fa-file-signature"></i>
            </div>
        </div>
    </div>

    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
        <i class="fas fa-th-large mr-2 text-blue-600"></i> Modul Manajemen
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        
        <a href="{{ route('admin.finance.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <i class="fas fa-wallet"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">Keuangan & Kas</h4>
                <p class="text-sm text-gray-500 mb-4">Catat pemasukan, pengeluaran, dan cetak laporan keuangan.</p>
                <span class="text-emerald-600 font-semibold text-sm flex items-center">
                    Kelola Keuangan <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.inventory.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            @if($borrowedItems > 0)
            <div class="absolute top-4 right-4 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg z-20">
                {{ $borrowedItems }} Dipinjam
            </div>
            @endif
            
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-box-open"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">Inventaris</h4>
                <p class="text-sm text-gray-500 mb-4">Data aset, peminjaman barang, dan kondisi perlengkapan.</p>
                <span class="text-blue-600 font-semibold text-sm flex items-center">
                    Cek Inventaris <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            @if($pendingUsers > 0)
            <div class="absolute top-4 right-4 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg z-20 animate-pulse">
                {{ $pendingUsers }} Baru
            </div>
            @endif
            <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">Manajemen User</h4>
                <p class="text-sm text-gray-500 mb-4">Kelola data anggota, verifikasi akun baru, dan hak akses.</p>
                <span class="text-indigo-600 font-semibold text-sm flex items-center">
                    Atur Anggota <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.blog.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                    <i class="fas fa-pen-fancy"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">Blog & Berita</h4>
                <p class="text-sm text-gray-500 mb-4">Publikasi artikel kegiatan dan informasi terkini.</p>
                <span class="text-teal-600 font-semibold text-sm flex items-center">
                    Tulis Artikel <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </a>

        <a href="#" class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-4 right-4 bg-gray-200 text-gray-600 text-[10px] font-bold px-2 py-1 rounded-full z-20">
                Coming Soon
            </div>
            <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-2xl mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fas fa-signature"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 mb-2">E-Signature</h4>
                <p class="text-sm text-gray-500 mb-4">Sistem pengajuan tanda tangan digital surat organisasi.</p>
                <span class="text-purple-600 font-semibold text-sm flex items-center">
                    Lihat Pengajuan <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </div>
        </a>

    </div>

@endsection