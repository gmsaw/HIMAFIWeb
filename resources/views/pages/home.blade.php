@extends('layouts.app')

@section('title', 'Beranda - HIMAFI UNUD')

@section('content')
    @php
        // Variabel ini digunakan oleh header.blade.php untuk menentukan menu aktif
        // dan membuat header transparan secara default.
        $activePage = 'beranda';
    @endphp

    {{-- Komponen Hero / Welcome Section --}}
    @include('components.welcome')
    
    {{-- Komponen Layanan --}}
    <div id="layanan">
        @include('components.layanan')
    </div>
    
    {{-- Komponen Artikel Terbaru --}}
    {{-- Pastikan controller mengirimkan variabel $latestPosts --}}
    <x-welcomeArtikel :latestPosts="$latestPosts" />

@endsection

{{-- 
    CATATAN PENTING:
    1. Script Hamburger Menu dan Back-to-Top sudah dihapus dari file ini 
       karena sudah ditangani secara global di 'header.blade.php' dan 'app.blade.php'.
    2. Menambahkan script di sini akan menyebabkan bentrok (konflik) dan menu tidak bisa dibuka.
--}}