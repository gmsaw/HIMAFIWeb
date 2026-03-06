@extends('layouts.admin')
@section('title', 'Kotak Aspirasi')
@section('header-title', 'Aspirasi Mahasiswa')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    
    @if($aspirations->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pengirim</th>
                    <th class="px-6 py-4">Pesan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($aspirations as $asp)
                <tr class="hover:bg-gray-50 {{ $asp->is_read ? '' : 'bg-blue-50/30' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-900 font-medium">{{ $asp->created_at->format('d M Y') }}</span>
                        <div class="text-xs text-gray-500">{{ $asp->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($asp->is_anonymous)
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <i class="fas fa-user-secret"></i>
                                </div>
                                <span class="font-bold text-gray-500 italic">Anonim</span>
                            </div>
                        @else
                            <div class="font-bold text-gray-900">{{ $asp->name }}</div>
                            <div class="text-xs text-blue-600">{{ $asp->email }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-w-lg">
                        <div class="font-bold text-gray-800 mb-1">{{ $asp->subject }}</div>
                        <p class="text-gray-600 line-clamp-2">{{ $asp->message }}</p>
                        
                        <button onclick="alert('{{ jsEscape($asp->message) }}')" class="text-xs text-blue-500 hover:underline mt-1">
                            Baca Full
                        </button>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            @if(!$asp->is_read)
                            <form action="{{ route('admin.aspirasi.read', $asp->id) }}" method="POST">
                                @csrf
                                <button class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition" title="Tandai Dibaca">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('admin.aspirasi.destroy', $asp->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100">
        {{ $aspirations->links() }}
    </div>
    @else
    <div class="p-12 text-center text-gray-400">
        <i class="far fa-envelope-open text-6xl mb-4 text-gray-300"></i>
        <p>Belum ada aspirasi masuk.</p>
    </div>
    @endif
</div>
@endsection

{{-- Helper PHP kecil untuk alert js --}}
@php
    function jsEscape($string) {
        return str_replace(["\r", "\n"], ' ', addslashes($string));
    }
@endphp