@extends('layouts.app')

@section('title', 'Fungsionaris HIMAFI 2026')

@php
    $activePage = 'divisi'; // Agar menu 'Divisi' menyala
    $useTransparentHeader = true; // Agar header transparan di awal
@endphp

@section('content')

<!-- Hero Section -->
<section class="relative w-full min-h-[60vh] flex flex-col justify-center items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="img/homeimg.png" alt="Background HIMAFI" class="w-full h-full object-cover object-center scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-gray-50/10"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 text-center mt-10">

        <h1 class="text-white text-4xl md:text-6xl font-extrabold tracking-tight mb-6 drop-shadow-lg leading-tight animate-fade-in-up">
            6 Bidang, <span class="text-blue-400">1 Visi</span>
        </h1>

        <p class="text-gray-100 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed font-light animate-fade-in-up delay-100">
            Satu Detak, Enam Nadi. Setiap bidang membawa perspektif unik, namun bernapas dalam irama yang sama untuk menciptakan dampak nyata.
        </p>
    </div>
</section>

<!-- FOTO FUNGSIONARIS -->

<!-- INTI HIMAFI -->
<div class="container mx-auto px-4 py-12">
    @include('components.fungsionaris-section', [
        'data' => $inti,
        'color' => 'blue-600'
    ])
</div>

<!-- BIDANG-BIDANG -->
@foreach($bidang as $index => $bidangData)
<div class="crelative py-20 {{ $index % 2 == 0 ? 'bg-slate-50' : 'bg-white' }}">
    @include('components.fungsionaris-section', [
        'data' => $bidangData,
        'color' => $bidangData['color'] ?? 'blue-600'
    ])
</div>
@endforeach

<style>
    /* Custom Animations for Tailwind */
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
</style>
@endsection