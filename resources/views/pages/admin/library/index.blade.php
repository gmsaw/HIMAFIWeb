@extends('layouts.admin')
@section('title', 'Koleksi Buku')
@section('header-title', 'Daftar Pustaka')

@section('content')

{{-- HEADER & TOMBOL TAMBAH --}}
<div class="flex justify-between items-center mb-6">
    <h3 class="text-xl font-bold text-gray-800">Manajemen Buku</h3>
    <a href="{{ route('admin.library.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Buku
    </a>
</div>

{{-- TABEL BUKU --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-bold border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Cover</th>
                    <th class="px-6 py-4">Judul & Penulis</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($books as $book)
                <tr class="hover:bg-slate-50 transition-colors">
                    {{-- Kolom Cover --}}
                    <td class="px-6 py-4">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/'.$book->cover_image) }}" class="h-16 w-12 object-cover rounded-md shadow-sm border border-gray-200">
                        @else
                            <div class="h-16 w-12 bg-slate-200 rounded-md flex items-center justify-center text-slate-400 border border-slate-300">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>

                    {{-- Kolom Info --}}
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800 text-base mb-1 line-clamp-1" title="{{ $book->title }}">{{ $book->title }}</div>
                        <div class="text-xs text-slate-500 flex flex-col gap-0.5">
                            <span><i class="fas fa-user-edit mr-1"></i> {{ $book->author }}</span>
                            <span><i class="fas fa-calendar-alt mr-1"></i> {{ $book->year }} • {{ $book->publisher ?? '-' }}</span>
                        </div>
                    </td>

                    {{-- Kolom Kategori --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $book->category }}
                        </span>
                    </td>

                    {{-- Kolom Stok --}}
                    <td class="px-6 py-4">
                        <div class="font-mono font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $book->stock }}
                        </div>
                    </td>

                    {{-- Kolom Aksi --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Tombol Detail (Trigger Modal) --}}
                            <button onclick="showBookDetail({{ json_encode($book) }})" 
                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center"
                                title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.library.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini secara permanen?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">
                        Belum ada data buku.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100 bg-gray-50">
        {{ $books->links() }}
    </div>
</div>

{{-- MODAL DETAIL BUKU --}}
<div id="bookModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    {{-- Modal Panel --}}
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl border border-gray-100">
                
                {{-- Header Modal --}}
                <div class="bg-white px-6 py-4 border-b border-gray-100 flex justify-between items-center sticky top-0 z-20">
                    <h3 class="text-lg font-bold text-gray-900" id="modal-title">Detail Buku</h3>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                {{-- Content Modal --}}
                <div class="px-6 py-6 max-h-[80vh] overflow-y-auto">
                    <div class="flex flex-col md:flex-row gap-8">
                        
                        {{-- Kiri: Cover --}}
                        <div class="w-full md:w-1/3 flex flex-col items-center">
                            <div class="aspect-[3/4] w-full bg-gray-100 rounded-lg overflow-hidden shadow-md mb-4 relative">
                                <img id="modalCover" src="" class="w-full h-full object-cover hidden">
                                <div id="modalNoCover" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-book text-4xl mb-2"></i>
                                    <span class="text-xs">No Cover</span>
                                </div>
                            </div>
                            
                            {{-- Tombol Link --}}
                            <div id="modalLinkContainer" class="w-full">
                                <a id="modalLinkBtn" href="#" target="_blank" class="flex items-center justify-center gap-2 w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-sm">
                                    <i class="fas fa-external-link-alt"></i> <span>Buka E-Book</span>
                                </a>
                                <div id="modalNoLink" class="text-center text-xs text-gray-400 italic py-2 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                                    Tidak ada file digital
                                </div>
                            </div>
                        </div>

                        {{-- Kanan: Detail Text --}}
                        <div class="w-full md:w-2/3 space-y-5">
                            <div>
                                <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 leading-tight mb-1">Judul Buku</h2>
                                <p id="modalAuthor" class="text-blue-600 font-medium text-sm">Penulis</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Penerbit</p>
                                    <p id="modalPublisher" class="font-semibold text-gray-700">-</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Tahun Terbit</p>
                                    <p id="modalYear" class="font-semibold text-gray-700">-</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Kategori</p>
                                    <p id="modalCategory" class="font-semibold text-gray-700">-</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Stok Fisik</p>
                                    <p id="modalStock" class="font-semibold text-gray-700">-</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold mb-2 border-b border-gray-100 pb-1">Sinopsis</p>
                                <p id="modalDesc" class="text-sm text-gray-600 leading-relaxed text-justify h-32 overflow-y-auto pr-2">
                                    -
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse">
                    <button type="button" onclick="closeModal()" class="inline-flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 sm:ml-3 sm:w-auto">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PENGENDALI MODAL --}}
<script>
    const modal = document.getElementById('bookModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalAuthor = document.getElementById('modalAuthor');
    const modalPublisher = document.getElementById('modalPublisher');
    const modalYear = document.getElementById('modalYear');
    const modalCategory = document.getElementById('modalCategory');
    const modalStock = document.getElementById('modalStock');
    const modalDesc = document.getElementById('modalDesc');
    const modalCover = document.getElementById('modalCover');
    const modalNoCover = document.getElementById('modalNoCover');
    const modalLinkBtn = document.getElementById('modalLinkBtn');
    const modalNoLink = document.getElementById('modalNoLink');

    function showBookDetail(book) {
        // 1. Isi Data Teks
        modalTitle.innerText = book.title;
        modalAuthor.innerText = book.author;
        modalPublisher.innerText = book.publisher || '-';
        modalYear.innerText = book.year;
        modalCategory.innerText = book.category;
        modalStock.innerText = book.stock + ' Eksemplar';
        modalDesc.innerText = book.description || 'Tidak ada sinopsis.';

        // 2. Handle Cover Image
        if (book.cover_image) {
            modalCover.src = "/storage/" + book.cover_image;
            modalCover.classList.remove('hidden');
            modalNoCover.classList.add('hidden');
        } else {
            modalCover.classList.add('hidden');
            modalNoCover.classList.remove('hidden');
        }

        // 3. Handle Link E-Book (File Upload atau URL GDrive)
        let link = null;
        if (book.file_path) {
            link = "/storage/" + book.file_path; // File Lokal
        } else if (book.file_url) {
            link = book.file_url; // Link Eksternal
        }

        if (link) {
            modalLinkBtn.href = link;
            modalLinkBtn.classList.remove('hidden');
            modalLinkBtn.classList.add('flex');
            modalNoLink.classList.add('hidden');
        } else {
            modalLinkBtn.classList.add('hidden');
            modalLinkBtn.classList.remove('flex');
            modalNoLink.classList.remove('hidden');
        }

        // 4. Tampilkan Modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Disable scroll body
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Enable scroll body
    }

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
</script>

@endsection