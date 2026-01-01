@extends('layouts.app')

@section('title', 'Fungsionaris HIMAFI 2026')

@section('content')

<!-- Hero Section -->
<section class="relative w-full h-[400px] md:h-[500px] flex items-center justify-center overflow-hidden -mt-18">
        
        <img src="img/homeimg.png" 
             alt="Background HIMAFI" 
             class="absolute inset-0 w-full h-full object-cover object-center z-0">

        <div class="absolute inset-0 bg-black/40 z-10"></div>

        <div class="relative z-20 text-center px-4 max-w-4xl mx-auto flex flex-col items-center">
            
            <div class="bg-[#4a80d6] px-6 py-2 md:px-10 md:py-3 mb-6 shadow-lg inline-block">
                <h1 class="text-white text-3xl md:text-5xl font-bold tracking-wide text-shadow-strong">
                    6 Bidang 1 Visi
                </h1>
            </div>

            <p class="text-white text-base md:text-xl leading-relaxed md:leading-loose text-shadow-strong font-medium">
                Satu Detak, Enam Nadi, Visi adalah jantung organisasi kami, dan 
                enam bidang ini adalah nadi yang mengalirkannya menjadi aksi nyata. 
                Setiap bidang membawa perspektif unik, namun semuanya bernapas 
                dalam irama yang sama untuk menciptakan dampak yang berarti.
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
<div class="container mx-auto px-4 py-12 {{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
    @include('components.fungsionaris-section', [
        'data' => $bidangData,
        'color' => $bidangData['color'] ?? 'blue-600'
    ])
</div>
@endforeach

@endsection