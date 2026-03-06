@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('header-title', 'Tambah Koleksi Pustaka')

@section('content')

<div class="max-w-5xl mx-auto mb-8">
    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Form Tambah Buku</h2>
            <p class="text-sm text-slate-500 mt-1">Lengkapi informasi di bawah ini untuk menambah koleksi baru.</p>
        </div>
        <a href="{{ route('admin.library.index') }}" class="flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:text-blue-600 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.library.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI (Informasi Utama) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Card 1: Detail Dasar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                    <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="fas fa-info-circle text-blue-500"></i> Informasi Dasar
                    </h3>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Judul Buku / Jurnal <span class="text-red-500">*</span></label>
                                <input type="text" name="title" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm" placeholder="Contoh: Pengantar Fisika Kuantum" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Penulis / Pengarang <span class="text-red-500">*</span></label>
                                <input type="text" name="author" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm" placeholder="Nama Penulis Utama" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Penerbit</label>
                                <input type="text" name="publisher" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm" placeholder="Nama Penerbit (Opsional)">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tahun Terbit <span class="text-red-500">*</span></label>
                                <input type="number" name="year" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm font-mono" placeholder="2024" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Sinopsis / Abstrak</label>
                            <textarea name="description" rows="5" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm" placeholder="Tuliskan deskripsi singkat mengenai buku atau jurnal ini..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Sumber Digital (E-Book) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                    <h3 class="text-base font-bold text-slate-800 mb-2 flex items-center gap-2">
                        <i class="fas fa-laptop-code text-blue-500"></i> Sumber File Digital (E-Book)
                    </h3>
                    <p class="text-xs text-slate-500 mb-6 border-b border-slate-100 pb-4">Isi salah satu opsi di bawah ini jika buku memiliki versi digital.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Opsi Upload --}}
                        <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 hover:border-blue-300 transition-colors group">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3 flex justify-between">
                                <span>Opsi A: Upload PDF</span>
                                <i class="fas fa-file-pdf text-slate-400 group-hover:text-red-500 transition-colors"></i>
                            </label>
                            <input type="file" name="file_path" accept="application/pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white file:text-slate-700 file:shadow-sm hover:file:bg-blue-50 hover:file:text-blue-700 transition cursor-pointer">
                            <p class="text-[10px] text-slate-400 mt-2"><i class="fas fa-info-circle"></i> Maks 10MB. File disimpan di server.</p>
                        </div>

                        {{-- Opsi Link Drive --}}
                        <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 hover:border-blue-300 transition-colors group">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3 flex justify-between">
                                <span>Opsi B: Link Eksternal</span>
                                <i class="fab fa-google-drive text-slate-400 group-hover:text-green-500 transition-colors"></i>
                            </label>
                            <input type="url" name="file_url" class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm placeholder-slate-300" placeholder="https://drive.google.com/file/d/...">
                            <p class="text-[10px] text-slate-400 mt-2"><i class="fas fa-globe"></i> Pastikan akses link di-set ke "Public".</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (Klasifikasi & Cover) --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Card 3: Klasifikasi --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="fas fa-tags text-blue-500"></i> Klasifikasi
                    </h3>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm cursor-pointer" required>
                                <option value="" disabled selected>Pilih Kategori...</option>
                                <option value="Fisika Murni">Fisika Murni</option>
                                <option value="Fisika Terapan">Fisika Terapan</option>
                                <option value="Astronomi">Astronomi</option>
                                <option value="Skripsi/Tesis">Skripsi/Tesis</option>
                                <option value="Jurnal">Jurnal Ilmiah</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Stok Fisik <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" name="stock" value="1" min="0" class="w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm font-mono pr-12" required>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 text-xs font-bold pointer-events-none">Unit</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Cover Image --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="fas fa-image text-blue-500"></i> Sampul Buku
                    </h3>

                    <div>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 hover:bg-slate-100 hover:border-blue-400 transition-colors group cursor-pointer relative" id="drop-area">
                            <div class="space-y-2 text-center" id="upload-content">
                                <i class="fas fa-cloud-upload-alt text-slate-400 text-3xl group-hover:text-blue-500 transition-colors"></i>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="cover-upload" class="relative cursor-pointer rounded-md font-bold text-blue-600 hover:text-blue-700 focus-within:outline-none">
                                        <span>Pilih Gambar</span>
                                        <input id="cover-upload" name="cover_image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400">PNG, JPG up to 2MB</p>
                            </div>
                            
                            {{-- Image Preview Container --}}
                            <div id="image-preview-container" class="hidden absolute inset-0 rounded-xl overflow-hidden bg-black">
                                <img id="image-preview" src="" class="w-full h-full object-cover opacity-80">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity bg-black/50">
                                    <span class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full"><i class="fas fa-sync-alt"></i> Ganti</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Footer Action --}}
        <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-slate-200">
            <a href="{{ route('admin.library.index') }}" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Buku
            </button>
        </div>
        
    </form>
</div>

@push('scripts')
<script>
    // Script untuk memunculkan preview gambar cover yang diupload
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');
        const uploadContent = document.getElementById('upload-content');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadContent.classList.add('opacity-0'); // Sembunyikan teks upload
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection