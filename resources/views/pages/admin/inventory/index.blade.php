@extends('layouts.admin')

@section('title', 'Manajemen Inventaris')
@section('header-title', 'Inventaris HIMAFI')

@section('content')

    {{-- ========================================== --}}
    {{-- HEADER & BUTTON TAMBAH                     --}}
    {{-- ========================================== --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Daftar Aset & Barang</h3>
            <p class="text-sm text-gray-500">Kelola data inventaris, stok, dan kondisi barang.</p>
        </div>
        <button type="button" onclick="toggleModal('modalAdd')" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition flex items-center gap-2 shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5">
            <i class="fas fa-plus"></i> Tambah Barang
        </button>
    </div>

    {{-- ========================================== --}}
    {{-- ALERT SUCCESS                              --}}
    {{-- ========================================== --}}
    @if(session('success'))
    <div id="flashMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 flex items-center gap-2 animate-fade-in-down" role="alert">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="block sm:inline font-medium">{{ session('success') }}</span>
        <button onclick="document.getElementById('flashMessage').remove()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- ALERT ERROR VALIDASI (Opsional tapi disarankan) --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg relative mb-6">
        <p class="font-bold mb-1"><i class="fas fa-exclamation-circle"></i> Terdapat Kesalahan Input:</p>
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ========================================== --}}
    {{-- FILTER & PENCARIAN                         --}}
    {{-- ========================================== --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6">
        <form action="{{ route('admin.inventory.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            
            <div class="md:col-span-5 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 border focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 transition" 
                    placeholder="Cari nama barang atau kode inventaris...">
            </div>

            <div class="md:col-span-3">
                <select name="category" class="block w-full rounded-lg border-gray-300 bg-gray-50 border focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach(['Elektronik', 'Furniture', 'ATK', 'Lainnya'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="status" class="block w-full rounded-lg border-gray-300 bg-gray-50 border focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2.5 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                </select>
            </div>

            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="flex-1 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2.5 rounded-lg transition font-medium shadow-md">
                    Filter
                </button>
                
                @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.inventory.index') }}" class="px-4 py-2.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition flex items-center justify-center" title="Reset Filter">
                    <i class="fas fa-redo-alt"></i>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- ========================================== --}}
    {{-- TABEL INVENTARIS                           --}}
    {{-- ========================================== --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold">Gambar</th>
                        <th class="px-6 py-4 font-bold">Info Barang</th>
                        <th class="px-6 py-4 font-bold">Kategori</th>
                        <th class="px-6 py-4 font-bold">Stok</th>
                        <th class="px-6 py-4 font-bold">Kondisi & Status</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($items as $item)
                    <tr class="bg-white hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="h-14 w-14 rounded-lg overflow-hidden border border-gray-200 bg-white p-0.5">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover rounded-md">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fas fa-image text-lg"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 text-base mb-1">{{ $item->name }}</div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 font-mono">
                                <i class="fas fa-barcode text-[10px]"></i> {{ $item->code }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 text-slate-600 text-xs font-semibold px-2.5 py-1 rounded-full border border-slate-200">
                                {{ $item->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-800 text-base">{{ $item->quantity }}</span>
                            <span class="text-xs text-gray-500">Unit</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2 items-start">
                                @php
                                    $condClass = match($item->condition) {
                                        'Baik' => 'text-green-600 bg-green-50 border-green-100',
                                        'Rusak Ringan' => 'text-orange-600 bg-orange-50 border-orange-100',
                                        'Rusak Berat' => 'text-red-600 bg-red-50 border-red-100',
                                        default => 'text-gray-600 bg-gray-50'
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-md text-xs font-medium border flex items-center gap-1.5 {{ $condClass }}">
                                    <div class="w-1.5 h-1.5 rounded-full bg-current"></div> {{ $item->condition }}
                                </span>

                                @if($item->status == 'available')
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-teal-600 bg-teal-50 px-2 py-0.5 rounded border border-teal-100">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-purple-600 bg-purple-50 px-2 py-0.5 rounded border border-purple-100">
                                        Dipinjam
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                <button type="button" onclick="editItem({{ $item }})" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition flex items-center justify-center" title="Edit Barang">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>
                                
                                <form action="{{ route('admin.inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus barang ini secara permanen?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center" title="Hapus Barang">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <i class="fas fa-search text-3xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-900 font-semibold text-lg">Data tidak ditemukan</p>
                                <p class="text-sm text-gray-500 max-w-sm mx-auto mt-1">Coba ubah kata kunci pencarian atau reset filter untuk melihat data lainnya.</p>
                                <button onclick="window.location.href='{{ route('admin.inventory.index') }}'" class="mt-4 text-blue-600 hover:underline text-sm font-medium">
                                    Reset Semua Filter
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
            {{ $items->links() }}
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL TAMBAH BARANG                        --}}
    {{-- ========================================== --}}
    <div id="modalAdd" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            {{-- Backdrop Blur --}}
            <div class="fixed inset-0 bg-slate-900/40 transition-opacity backdrop-blur-sm" onclick="toggleModal('modalAdd')"></div>

            {{-- Kotak Putih Modal --}}
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full relative z-10">
                
                {{-- Header --}}
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                    <div class="sm:flex sm:items-center">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-box-open text-blue-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">Tambah Barang Baru</h3>
                            <div class="mt-1">
                                <p class="text-sm text-gray-500">Isi form di bawah ini untuk menambahkan aset ke inventaris.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data" class="bg-white">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Kode Barang</label>
                                <input type="text" name="code" value="{{ old('code') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" placeholder="INV-001" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Kategori</label>
                                <select name="category" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                                    <option {{ old('category') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option {{ old('category') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                                    <option {{ old('category') == 'ATK' ? 'selected' : '' }}>ATK</option>
                                    <option {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Nama Barang</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" placeholder="Contoh: Projector Epson" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Jumlah</label>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Kondisi Awal</label>
                                <select name="condition" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                                    <option {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                    <option {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Foto Barang</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Pilih file foto</span>
                                            <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Maksimal 2MB (JPG, PNG)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Modal --}}
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Data
                        </button>
                        <button type="button" onclick="toggleModal('modalAdd')" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL EDIT BARANG                          --}}
    {{-- ========================================== --}}
    <div id="modalEdit" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            {{-- Backdrop Blur --}}
            <div class="fixed inset-0 bg-slate-900/40 transition-opacity backdrop-blur-sm" onclick="toggleModal('modalEdit')"></div>
            
            {{-- Kotak Putih Modal --}}
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full relative z-10">
                
                {{-- Header --}}
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                    <div class="sm:flex sm:items-center">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-orange-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900">Edit Data Barang</h3>
                            <p class="text-sm text-gray-500">Perbarui informasi barang di bawah ini.</p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form id="formEdit" method="POST" enctype="multipart/form-data" class="bg-white">
                    @csrf @method('PUT')
                    
                    <div class="p-6 space-y-4">
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Nama Barang</label>
                            <input type="text" name="name" id="editName" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Kategori</label>
                                <select name="category" id="editCategory" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                                    <option>Elektronik</option>
                                    <option>Furniture</option>
                                    <option>ATK</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Jumlah</label>
                                <input type="number" name="quantity" id="editQuantity" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Kondisi</label>
                                <select name="condition" id="editCondition" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                                    <option>Baik</option>
                                    <option>Rusak Ringan</option>
                                    <option>Rusak Berat</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Status Ketersediaan</label>
                                <select name="status" id="editStatus" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50">
                                    <option value="available">Tersedia</option>
                                    <option value="borrowed">Dipinjam</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Update Foto (Opsional)</label>
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                        </div>
                    </div>

                    {{-- Footer Modal --}}
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="toggleModal('modalEdit')" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // --- Toggle Modal (Universal) ---
    function toggleModal(modalID){
        const modal = document.getElementById(modalID);
        if(modal) {
            modal.classList.toggle("hidden");
        }
    }

    // Otomatis buka modal Tambah Barang jika ada error dari backend
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            toggleModal('modalAdd');
        @endif
    });

    // --- Populate Edit Form ---
    function editItem(item) {
        // 1. Set URL Action Form (misal: /admin/inventory/5)
        document.getElementById('formEdit').action = `/admin/inventory/${item.id}`;
        
        // 2. Isi value input dari data JSON
        document.getElementById('editName').value = item.name;
        document.getElementById('editCategory').value = item.category;
        document.getElementById('editQuantity').value = item.quantity;
        document.getElementById('editCondition').value = item.condition;
        document.getElementById('editStatus').value = item.status;

        // 3. Tampilkan Modal Edit
        toggleModal('modalEdit');
    }
</script>
@endpush