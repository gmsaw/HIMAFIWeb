@php
    // Grupkan anggota berdasarkan size
    $largeMembers = array_filter($data['members'], fn($member) => $member['size'] === 'large');
    $mediumMembers = array_filter($data['members'], fn($member) => $member['size'] === 'medium');
@endphp

<div class="text-center max-w-4xl mx-auto mb-12">
    <h1 class="text-3xl md:text-4xl font-bold text-{{ $color }} mb-6 tracking-wide">
        {{ $data['title'] }}
    </h1>
    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
        {{ $data['description'] }}
    </p>
</div>

<!-- Kepala & Wakil Bidang (Large Cards) -->
@if(count($largeMembers) > 0)
<div class="flex flex-wrap justify-center gap-8 md:gap-12 mb-12">
    @foreach($largeMembers as $member)
    <div class="w-64 relative mt-10 group">
        <div class="border border-{{ $color }} rounded-[2rem] p-4 pt-0 text-center bg-white h-full relative shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="-mt-16 mb-2 flex justify-center">
                <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" 
                     class="h-48 object-cover z-10 relative drop-shadow-lg">
            </div>
            <h2 class="text-2xl font-black uppercase text-gray-800 tracking-wider mb-1">
                {{ $member['name'] }}
            </h2>
            <p class="font-bold text-gray-700 text-sm">
                {!! $member['position'] !!}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Anggota Bidang (Medium Cards) -->
@if(count($mediumMembers) > 0)
<div class="flex flex-wrap justify-center gap-6 md:gap-8">
    @foreach($mediumMembers as $member)
    <div class="w-60 relative mt-10">
        <div class="border border-{{ $color }} rounded-[2rem] p-4 pt-0 text-center bg-white h-full relative shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="-mt-14 mb-2 flex justify-center">
                <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" 
                     class="h-48 object-cover z-10 relative drop-shadow-lg">
            </div>
            <h2 class="text-xl font-black uppercase text-gray-800 tracking-wider mb-1">
                {{ $member['name'] }}
            </h2>
            <p class="font-bold text-gray-700 text-xs md:text-sm uppercase">
                {!! $member['position'] !!}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endif