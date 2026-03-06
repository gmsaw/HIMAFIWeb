@extends('layouts.admin')

@section('title', 'Tulis Artikel')
@section('header-title', 'Tulis Artikel Baru')

@push('styles')
    {{-- Kita tidak pakai Summernote lagi, tapi pakai MathJax untuk LaTeX --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <style>
        /* Custom Scrollbar untuk Modal Preview */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc; 
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
    </style>
@endpush

@section('content')

<div class="max-w-5xl mx-auto mb-10">
    
    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Form Tulis Artikel</h2>
            <p class="text-sm text-slate-500 mt-1">Buat artikel dengan menambahkan blok teks, gambar, dan rumus matematika.</p>
        </div>
        <a href="{{ route('admin.blog.index') }}" class="flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-slate-50 hover:text-blue-600 transition-all shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Form Container --}}
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI (Judul & Konten Dinamis) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Judul Artikel --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="articleTitle" class="w-full p-3 rounded-xl border border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-colors text-slate-800 font-medium text-lg" placeholder="Masukkan judul artikel di sini..." required>
                </div>

                {{-- BUILDER KONTEN DINAMIS --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                    <h3 class="text-base font-bold text-slate-800 mb-5 border-b border-slate-100 pb-3 flex justify-between items-center">
                        <span><i class="fas fa-layer-group text-blue-500 mr-2"></i> Isi Artikel</span>
                    </h3>

                    {{-- Container Blok akan muncul di sini --}}
                    <div id="blocks-container" class="space-y-4 mb-6">
                        {{-- Blok pertama otomatis Paragraf (di-inject via JS) --}}
                    </div>

                    {{-- Tombol Tambah Blok --}}
                    <div class="grid grid-cols-3 gap-3 pt-4 border-t border-dashed border-slate-200">
                        <button type="button" onclick="addBlock('text')" class="py-3 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition font-bold text-xs sm:text-sm flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2">
                            <i class="fas fa-align-left"></i> Paragraf
                        </button>
                        <button type="button" onclick="addBlock('image')" class="py-3 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition font-bold text-xs sm:text-sm flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2">
                            <i class="fas fa-image"></i> Gambar
                        </button>
                        <button type="button" onclick="addBlock('equation')" class="py-3 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl hover:bg-purple-50 hover:text-purple-600 hover:border-purple-200 transition font-bold text-xs sm:text-sm flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-2">
                            <i class="fas fa-square-root-alt"></i> Rumus
                        </button>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (Kategori, Thumbnail & Aksi) --}}
            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full p-3 rounded-xl border border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-slate-800 cursor-pointer">
                            <option value="news">Berita & Informasi</option>
                            <option value="event">Acara / Kegiatan</option>
                            <option value="academic">Akademik</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Thumbnail Utama <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 hover:bg-slate-100 hover:border-blue-400 transition cursor-pointer relative">
                            <div class="space-y-2 text-center" id="upload-content-thumb">
                                <i class="fas fa-image text-slate-400 text-3xl"></i>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="thumbnail-upload" class="relative cursor-pointer rounded-md font-bold text-blue-600 hover:text-blue-700">
                                        <span>Pilih File</span>
                                        <input id="thumbnail-upload" name="thumbnail" type="file" class="sr-only" accept="image/*" onchange="previewMainImage(event)" required>
                                    </label>
                                </div>
                            </div>
                            <img id="image-preview-thumb" src="" class="hidden absolute inset-0 w-full h-full object-cover rounded-xl z-10">
                        </div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="space-y-3">
                    <button type="button" onclick="openPreview()" class="w-full py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-lg shadow-slate-500/30 hover:bg-slate-900 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-eye"></i> Tinjau Sementara
                    </button>
                    <button type="submit" class="w-full py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i> Terbitkan Artikel
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- ========================================== --}}
{{-- MODAL LIVE PREVIEW                         --}}
{{-- ========================================== --}}
<div id="modalPreview" class="fixed inset-0 z-[60] hidden">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closePreview()"></div>
    
    {{-- Wrapper Vertikal & Horizontal Centering --}}
    <div class="fixed inset-0 flex items-center justify-center p-4 sm:p-6 pointer-events-none">
        
        {{-- Kotak Utama Modal --}}
        <div class="bg-white rounded-3xl text-left shadow-2xl w-full max-w-4xl max-h-full flex flex-col pointer-events-auto relative">
            
            {{-- Header Modal Preview (Sticky di atas) --}}
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center shrink-0 rounded-t-3xl">
                <h3 class="text-lg font-bold text-slate-800"><i class="fas fa-eye text-blue-500 mr-2"></i> Mode Tinjau Sementara</h3>
                <button type="button" onclick="closePreview()" class="text-slate-400 hover:text-red-500 bg-white hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition shadow-sm border border-slate-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Content Area Preview (Bisa di-scroll) --}}
            <div class="p-6 sm:p-8 overflow-y-auto custom-scrollbar flex-grow">
                
                {{-- Container yang meniru tampilan front-end --}}
                <div class="max-w-3xl mx-auto">
                    
                    {{-- Thumbnail Preview --}}
                    <div class="w-full h-[250px] sm:h-[350px] bg-slate-100 rounded-2xl overflow-hidden mb-8 border border-slate-200 relative group">
                        <img id="preview-render-thumb" src="" class="w-full h-full object-cover hidden transition-transform duration-500 group-hover:scale-105">
                        <div id="preview-render-no-thumb" class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                            <i class="fas fa-image text-5xl mb-3 opacity-50"></i>
                            <span class="text-sm font-medium">Belum ada thumbnail</span>
                        </div>
                    </div>

                    {{-- Title Preview --}}
                    <h1 id="preview-render-title" class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight tracking-tight">Judul Artikel</h1>
                    
                    {{-- Meta Preview --}}
                    <div class="flex items-center gap-3 mb-10 pb-6 border-b border-slate-100 text-sm text-slate-500">
                        <span class="bg-blue-50 text-blue-600 border border-blue-100 px-3 py-1 rounded-full font-bold uppercase text-[10px] tracking-wider">Kategori</span>
                        <span class="text-slate-300">|</span>
                        <span class="flex items-center gap-1.5 font-medium"><i class="far fa-calendar-alt"></i> Pratinjau Saat Ini</span>
                    </div>

                    {{-- Dynamic Content Render --}}
                    <div id="preview-render-content" class="prose prose-lg md:prose-xl prose-slate max-w-none text-slate-700 leading-loose text-justify pb-10">
                        {{-- Blok hasil render akan masuk ke sini --}}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let blockIndex = 0;
    const container = document.getElementById('blocks-container');

    // Mencegah form tersubmit jika menekan Enter
    document.getElementById('articleForm').addEventListener('keydown', function(e) {
        if(e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
            e.preventDefault();
        }
    });

    // 1. FUNGSI MENAMBAH BLOK BARU
    function addBlock(type) {
        const blockId = `block-${blockIndex}`;
        const blockWrapper = document.createElement('div');
        blockWrapper.className = 'relative bg-slate-50 border border-slate-200 rounded-xl p-5 transition hover:border-blue-300 group block-item';
        blockWrapper.id = blockId;
        blockWrapper.dataset.type = type; // Tanda tipe blok untuk preview

        // Tombol Hapus (Muncul saat di-hover)
        const deleteBtn = `
            <button type="button" onclick="document.getElementById('${blockId}').remove()" class="absolute -top-3 -right-3 w-8 h-8 bg-red-100 text-red-600 rounded-full hover:bg-red-600 hover:text-white shadow-sm opacity-0 group-hover:opacity-100 transition flex items-center justify-center z-10" title="Hapus Blok">
                <i class="fas fa-times"></i>
            </button>
        `;

        let contentHtml = '';

        if (type === 'text') {
            contentHtml = `
                <input type="hidden" name="blocks[${blockIndex}][type]" value="text">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2"><i class="fas fa-align-left mr-1"></i> Paragraf Teks</label>
                <textarea name="blocks[${blockIndex}][content]" rows="4" class="block-input w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-sm p-3 placeholder-slate-400" placeholder="Tuliskan paragraf di sini..." required></textarea>
            `;
        } else if (type === 'image') {
            contentHtml = `
                <input type="hidden" name="blocks[${blockIndex}][type]" value="image">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2"><i class="fas fa-image mr-1"></i> Gambar Sisipan</label>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <input type="file" name="blocks[${blockIndex}][image]" accept="image/*" class="block-input block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white file:text-slate-700 file:shadow-sm border border-slate-200 rounded-lg p-1 bg-slate-100" onchange="previewBlockImage(event, 'preview-${blockIndex}')" required>
                    <div class="w-full sm:w-24 h-24 bg-slate-200 rounded-lg overflow-hidden flex-shrink-0 border border-slate-300 flex items-center justify-center">
                        <img id="preview-${blockIndex}" class="block-preview-img hidden w-full h-full object-cover">
                        <i id="icon-${blockIndex}" class="fas fa-camera text-slate-400"></i>
                    </div>
                </div>
            `;
        } else if (type === 'equation') {
            contentHtml = `
                <input type="hidden" name="blocks[${blockIndex}][type]" value="equation">
                <label class="block text-xs font-bold text-purple-600 uppercase mb-2"><i class="fas fa-square-root-alt mr-1"></i> Rumus (LaTeX)</label>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <textarea name="blocks[${blockIndex}][content]" rows="3" class="block-input font-mono bg-slate-800 text-green-400 w-full rounded-lg border-slate-700 focus:ring-purple-500 focus:border-purple-500 text-sm p-3" placeholder="Contoh: E = mc^2" oninput="updateMathPreview(this, 'math-preview-${blockIndex}')" required></textarea>
                        <p class="text-[10px] text-slate-500 mt-1">Tanpa perlu menuliskan tag $$</p>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-lg flex items-center justify-center p-4 min-h-[5rem] overflow-x-auto">
                        <div id="math-preview-${blockIndex}" class="text-lg">\\( \\text{Preview Rumus} \\)</div>
                    </div>
                </div>
            `;
        }

        blockWrapper.innerHTML = deleteBtn + contentHtml;
        container.appendChild(blockWrapper);
        blockIndex++;
    }

    // 2. FUNGSI PREVIEW IMAGE (UMUM)
    function previewMainImage(event) {
        const input = event.target;
        const previewImage = document.getElementById('image-preview-thumb');
        const uploadContent = document.getElementById('upload-content-thumb');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                uploadContent.classList.add('opacity-0');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewBlockImage(event, previewId) {
        const input = event.target;
        const imgElement = document.getElementById(previewId);
        const iconElement = imgElement.nextElementSibling; 

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;
                imgElement.classList.remove('hidden');
                if(iconElement) iconElement.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 3. FUNGSI LIVE PREVIEW MATHJAX (DI DALAM FORM)
    function updateMathPreview(textarea, previewId) {
        const previewDiv = document.getElementById(previewId);
        const latexCode = textarea.value;
        // Menggunakan delimiter block MathJax
        previewDiv.innerHTML = `\\[ ${latexCode} \\]`;
        // Meminta MathJax merender ulang div spesifik
        MathJax.typesetPromise([previewDiv]).catch(function (err) {
            console.log('MathJax render error: ', err.message);
        });
    }

    // 4. FUNGSI TINJAU SEMENTARA (LIVE PREVIEW MODAL)
    function openPreview() {
        // A. Set Judul
        const title = document.getElementById('articleTitle').value;
        document.getElementById('preview-render-title').innerText = title || 'Judul Artikel Belum Diisi';

        // B. Set Thumbnail
        const thumbSrc = document.getElementById('image-preview-thumb').src;
        const renderThumb = document.getElementById('preview-render-thumb');
        const renderNoThumb = document.getElementById('preview-render-no-thumb');
        
        if(thumbSrc && !thumbSrc.includes(window.location.href)) {
            renderThumb.src = thumbSrc;
            renderThumb.classList.remove('hidden');
            renderNoThumb.classList.add('hidden');
        } else {
            renderThumb.classList.add('hidden');
            renderNoThumb.classList.remove('hidden');
        }

        // C. Susun Konten Dinamis
        let htmlContent = '';
        const blocks = document.querySelectorAll('.block-item');
        
        blocks.forEach((block) => {
            const type = block.dataset.type;
            
            if(type === 'text') {
                const text = block.querySelector('.block-input').value.replace(/\n/g, '<br>');
                htmlContent += `<p class="mb-5 text-slate-700 leading-loose text-justify">${text}</p>`;
            } 
            else if(type === 'image') {
                const imgSrc = block.querySelector('.block-preview-img').src;
                if(imgSrc && !imgSrc.includes(window.location.href)) {
                    htmlContent += `
                        <div class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-100 bg-slate-50">
                            <img src="${imgSrc}" class="w-full h-auto" alt="Preview Sisipan">
                        </div>`;
                }
            } 
            else if(type === 'equation') {
                const equation = block.querySelector('.block-input').value;
                htmlContent += `<div class="my-6 py-4 overflow-x-auto text-center text-lg">\\[ ${equation} \\]</div>`;
            }
        });

        const renderContainer = document.getElementById('preview-render-content');
        renderContainer.innerHTML = htmlContent || '<p class="text-slate-400 italic text-center py-10">Belum ada konten yang ditulis.</p>';

        // D. Tampilkan Modal & Render MathJax
        document.getElementById('modalPreview').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Mengunci scroll body belakang

        // Render ulang MathJax di dalam modal
        MathJax.typesetPromise([renderContainer]).catch(function (err) {
            console.log('MathJax modal render error: ', err.message);
        });
    }

    function closePreview() {
        document.getElementById('modalPreview').classList.add('hidden');
        document.body.style.overflow = ''; // Membuka kembali scroll body belakang
    }

    // Panggil 1 blok teks secara otomatis saat halaman load
    document.addEventListener("DOMContentLoaded", function() {
        addBlock('text');
    });
</script>
@endpush