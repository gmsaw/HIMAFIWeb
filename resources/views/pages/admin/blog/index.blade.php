@extends('layouts.admin')

@section('title', 'Manajemen Blog')
@section('header-title', 'Artikel & Berita')

@section('content')

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Daftar Artikel</h3>
            <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Tulis Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Thumbnail</th>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Penulis</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-16 h-10 object-cover rounded">
                            @else
                                <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-xs">No Img</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ Str::limit($post->title, 40) }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ ucfirst($post->category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $post->author->name }}</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada artikel yang ditulis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection