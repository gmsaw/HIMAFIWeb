@extends('layouts.app')

@section('title', 'Buku Biru Mahasiswa')
@php $useTransparentHeader = false; @endphp

@section('content')
{{-- 1. LOGIC PHP: Sapaan & Data --}}
@php
    $activePage = 'bukubiru'; 
    $useTransparentHeader = false; 

    // Logic Sapaan Waktu
    $hour = now()->format('H');
    if ($hour >= 5 && $hour < 11) {
        $sapaan = 'Selamat Pagi';
        $iconSapaan = 'fa-sun text-yellow-400';
    } elseif ($hour >= 11 && $hour < 15) {
        $sapaan = 'Selamat Siang';
        $iconSapaan = 'fa-cloud-sun text-orange-400';
    } elseif ($hour >= 15 && $hour < 18) {
        $sapaan = 'Selamat Sore';
        $iconSapaan = 'fa-sunset text-orange-500';
    } else {
        $sapaan = 'Selamat Malam';
        $iconSapaan = 'fa-moon text-indigo-400';
    }

    // Helper Status Sertifikat
    function getStatus($certs, $name) {
        return $certs->firstWhere('activity_name', $name);
    }

    // Definisi Data Tabel
    $tabelKepanitiaan = [
        ['name' => 'Physton', 'required' => true],
        ['name' => 'Udayana Physics Championship', 'required' => true],
        ['name' => 'Radiasi', 'required' => true],
        ['name' => 'Physics Clean Day', 'required' => true],
        ['name' => 'Musyawarah Mahasiswa', 'required' => false],
        ['name' => 'Volunteer', 'required' => false],
        ['name' => 'Timses Porseni', 'required' => false],
        ['name' => 'Supporter', 'required' => false],
    ];

    $tabelWajib = [
        ['name' => 'Organisasi', 'desc' => 'Pengurus Hima/BEM/DPM'],
        ['name' => 'Akademik/Non Akademik', 'desc' => 'Lomba/Prestasi Juara'],
        ['name' => 'PKM (Seleksi Universitas)', 'desc' => 'Bukti lolos/submit'],
    ];

    $tabelOpsional = [
        ['name' => 'MBKM', 'desc' => 'Kampus Merdeka / Magang'],
    ];

    // Hitung Progress Sederhana (Hanya yang status 'approved')
    $totalApproved = $certificates->where('status', 'approved')->count();
    $totalItems = count($tabelKepanitiaan) + count($tabelWajib); // Opsional tidak dihitung target
    $percentage = ($totalItems > 0) ? ($totalApproved / $totalItems) * 100 : 0;

    // Ambil Data Buku Biru user saat ini untuk Status TTE
    $bukuBiru = \App\Models\Certificate::where('user_id', Auth::id())->first();
    if (!$bukuBiru) {
        // Fallback sementara jika record belum ada di database
        $bukuBiru = new \App\Models\Certificate();
        $bukuBiru->id = 0;
        $bukuBiru->tte_status = null;
    }
@endphp

<div class="min-h-screen bg-slate-50 pt-28 pb-20 px-4">
    <div class="max-w-6xl mx-auto">
        
        {{-- HEADER CARD --}}
        <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas {{ $iconSapaan }} text-2xl animate-pulse"></i>
                        <span class="text-slate-500 font-medium text-sm uppercase tracking-wider">{{ $sapaan }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">
                        Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">{{ Auth::user()->name }}</span>! 👋
                    </h1>
                    <p class="text-slate-500 mt-2 max-w-lg">
                        Lengkapi portofolio kegiatanmu untuk mencetak Buku Biru. Pastikan data yang diupload valid sebelum mengajukan Tanda Tangan Elektronik (TTE).
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 relative z-10">
                <div class="flex justify-between text-sm font-bold text-slate-600 mb-2">
                    <span>Kelengkapan Dokumen Valid</span>
                    <span>{{ round($percentage) }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-3">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-400 h-3 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
        </div>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-sm animate-fade-in-down">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center mr-3 shrink-0">
                    <i class="fas fa-check text-emerald-600"></i>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-sm animate-fade-in-down">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3 shrink-0">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                </div>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- KARTU STATUS VALIDASI TTE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-10 animate-fade-in-up">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1 flex items-center gap-2">
                        <i class="fas fa-file-signature text-blue-500"></i> Status Validasi & TTE
                    </h3>
                    <p class="text-sm text-slate-500">Permohonan Tanda Tangan Elektronik sebagai syarat pengesahan Buku Biru.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                    
                    @if(is_null($bukuBiru->tte_status))
                        @if($bukuBiru->id != 0)
                            <form action="{{ route('buku-biru.request-tte', $bukuBiru->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" onclick="return confirm('Pastikan semua data dokumen sudah benar dan lengkap sebelum mengajukan validasi. Lanjutkan?')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 w-full sm:w-auto">
                                    <i class="fas fa-paper-plane"></i> Ajukan TTE
                                </button>
                            </form>
                        @else
                            <button disabled class="px-6 py-3 bg-slate-200 text-slate-400 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2 w-full sm:w-auto" title="Upload minimal 1 dokumen terlebih dahulu">
                                <i class="fas fa-paper-plane"></i> Ajukan TTE
                            </button>
                        @endif

                    @elseif($bukuBiru->tte_status == 'pending')
                        <span class="px-5 py-3 bg-orange-50 text-orange-600 border border-orange-200 rounded-xl text-sm font-bold flex items-center justify-center gap-2 w-full sm:w-auto">
                            <i class="fas fa-spinner fa-spin"></i> Menunggu Validasi
                        </span>

                    @elseif($bukuBiru->tte_status == 'rejected')
                        <form action="{{ route('buku-biru.request-tte', $bukuBiru->id) }}" method="POST" class="w-full sm:w-auto flex flex-col sm:items-end">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-slate-800 hover:bg-slate-900 text-white rounded-xl font-bold transition shadow-sm flex items-center justify-center gap-2 w-full sm:w-auto mb-1">
                                <i class="fas fa-redo"></i> Ajukan Ulang TTE
                            </button>
                            <p class="text-xs text-red-500 font-medium"><i class="fas fa-times-circle"></i> Ditolak: {{ $bukuBiru->tte_note }}</p>
                        </form>

                    @elseif($bukuBiru->tte_status == 'approved')
                        <div class="text-center sm:text-right w-full sm:w-auto">
                            <span class="px-5 py-3 bg-green-50 text-green-600 border border-green-200 rounded-xl text-sm font-bold flex items-center justify-center gap-2 w-full sm:w-auto">
                                <i class="fas fa-check-circle"></i> TTE Disetujui
                            </span>
                        </div>
                    @endif

                    {{-- TOMBOL CETAK BUKU BIRU --}}
                    @if($bukuBiru->tte_status == 'approved')
                        <a href="{{ route('bukubiru.pdf') }}" target="_blank" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 transform hover:-translate-y-0.5 w-full sm:w-auto group">
                            <i class="fas fa-print group-hover:animate-bounce"></i> Cetak Buku Biru
                        </a>
                    @else
                        <button disabled class="px-6 py-3 bg-slate-100 text-slate-400 border border-slate-200 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2 w-full sm:w-auto opacity-70" title="Anda belum bisa mencetak. TTE harus disetujui terlebih dahulu.">
                            <i class="fas fa-lock"></i> Cetak Buku Biru
                        </button>
                    @endif

                </div>
            </div>
        </div>

        {{-- DAFTAR TABEL KEGIATAN --}}
        <div class="space-y-10">

            {{-- TABEL KEPANITIAAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-blue-50 to-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-users text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">Kegiatan Kepanitiaan</h3>
                            <p class="text-xs text-slate-500">Wajib minimal 6 poin kegiatan</p>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 w-16">No</th>
                                <th class="px-6 py-4">Nama Kegiatan</th>
                                <th class="px-6 py-4">Sifat</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($tabelKepanitiaan as $item)
                            @php $data = getStatus($certificates, $item['name']); @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-700 block">{{ $item['name'] }}</span>
                                    @if($data) <span class="text-xs text-slate-400">Diupdate: {{ $data->updated_at->format('d M Y') }}</span> @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($item['required'])
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Wajib</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Pilihan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @include('pages.bukubiru.partials.status_badge', ['data' => $data])
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{-- Mengunci tombol upload HANYA JIKA TTE sedang di-pending --}}
                                    @if($bukuBiru->tte_status == 'pending')
                                        <button disabled class="text-xs font-bold px-4 py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed" title="Terkunci. TTE sedang diproses/disetujui.">
                                            <i class="fas fa-lock mr-1"></i> Terkunci
                                        </button>
                                    @else
                                        <button onclick="openModal('{{ $item['name'] }}', 'Kepanitiaan', '{{ $bukuBiru->tte_status ?? '' }}')" 
                                            class="text-xs font-bold px-4 py-2 rounded-lg transition-all {{ $data ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-blue-600 text-white hover:bg-blue-700 shadow-md shadow-blue-200' }}">
                                            {{ $data ? 'Update File' : 'Upload' }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TABEL WAJIB LAINNYA --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-indigo-50 to-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-star text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">Kegiatan Wajib Lainnya</h3>
                            <p class="text-xs text-slate-500">Syarat kelulusan akademik & organisasi</p>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 w-16">No</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Keterangan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($tabelWajib as $item)
                            @php $data = getStatus($certificates, $item['name']); @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-bold text-slate-700">{{ $item['name'] }}</td>
                                <td class="px-6 py-4 text-xs text-slate-500">{{ $item['desc'] }}</td>
                                <td class="px-6 py-4">
                                    @include('pages.bukubiru.partials.status_badge', ['data' => $data])
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($bukuBiru->tte_status == 'pending')
                                        <button disabled class="text-xs font-bold px-4 py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                            <i class="fas fa-lock mr-1"></i> Terkunci
                                        </button>
                                    @else
                                        <button onclick="openModal('{{ $item['name'] }}', 'Wajib', '{{ $bukuBiru->tte_status ?? '' }}')" 
                                            class="text-xs font-bold px-4 py-2 rounded-lg transition-all {{ $data ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-200' }}">
                                            {{ $data ? 'Update' : 'Upload' }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TABEL OPSIONAL --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-teal-50 to-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">
                            <i class="fas fa-layer-group text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">Kegiatan Opsional</h3>
                            <p class="text-xs text-slate-500">Pengembangan diri tambahan</p>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 w-16">No</th>
                                <th class="px-6 py-4">Nama Kegiatan</th>
                                <th class="px-6 py-4">Keterangan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($tabelOpsional as $item)
                            @php $data = getStatus($certificates, $item['name']); @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-bold text-slate-700">{{ $item['name'] }}</td>
                                <td class="px-6 py-4 text-xs text-slate-500">{{ $item['desc'] }}</td>
                                <td class="px-6 py-4">
                                    @include('pages.bukubiru.partials.status_badge', ['data' => $data])
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($bukuBiru->tte_status == 'pending')
                                        <button disabled class="text-xs font-bold px-4 py-2 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                            <i class="fas fa-lock mr-1"></i> Terkunci
                                        </button>
                                    @else
                                        <button onclick="openModal('{{ $item['name'] }}', 'Opsional', '{{ $bukuBiru->tte_status ?? '' }}')" 
                                            class="text-xs font-bold px-4 py-2 rounded-lg transition-all {{ $data ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-teal-600 text-white hover:bg-teal-700 shadow-md shadow-teal-200' }}">
                                            {{ $data ? 'Update' : 'Upload' }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL UPLOAD DOKUMEN --}}
<div id="uploadModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-slate-900/75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeModal()"></div>

        <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Upload Dokumen</h3>
                <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="uploadForm" action="{{ route('bukubiru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-6 space-y-5">
                    <input type="hidden" name="activity_name" id="inputActivityName">
                    <input type="hidden" name="category" id="inputCategory">

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Kegiatan</label>
                        <div class="flex items-center bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-semibold">
                            <i class="fas fa-tag mr-3 text-slate-400"></i>
                            <span id="displayActivityName"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="activity_date" required class="w-full border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">File Bukti (PDF/JPG)</label>
                        <div class="relative border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer group">
                            <input type="file" name="file" required accept=".pdf,image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewFile(this)">
                            <div id="filePlaceholder">
                                <i class="fas fa-cloud-upload-alt text-3xl text-slate-300 group-hover:text-blue-500 mb-2 transition"></i>
                                <p class="text-sm text-slate-500 font-medium">Klik untuk pilih file</p>
                                <p class="text-xs text-slate-400">Maksimal 2MB</p>
                            </div>
                            <div id="fileInfo" class="hidden">
                                <i class="fas fa-file-check text-green-500 text-2xl mb-2"></i>
                                <p id="fileName" class="text-sm font-bold text-slate-700 truncate px-4"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 px-6 py-4 flex justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl text-slate-600 font-bold hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
    // Menerima parameter ke-3 (tteStatus)
    function openModal(name, category, tteStatus) {
        
        // Jika Buku Biru sudah di-TTE, beri peringatan keras
        if (tteStatus === 'approved') {
            let confirmUpdate = confirm("PERHATIAN: Buku Biru Anda sudah disahkan.\n\nJika Anda memperbarui atau menambah data sertifikat sekarang, maka status Tanda Tangan Elektronik akan DIBATALKAN otomatis.\n\nAnda harus mengajukan validasi TTE ulang sebelum bisa mencetak PDF. Lanjutkan?");
            
            if (!confirmUpdate) {
                return; // Batalkan aksi jika user klik "Cancel"
            }
        }

        document.getElementById('uploadModal').classList.remove('hidden');
        document.getElementById('displayActivityName').innerText = name;
        document.getElementById('inputActivityName').value = name;
        document.getElementById('inputCategory').value = category;
        
        // Reset File Input visual
        document.getElementById('uploadForm').reset();
        document.getElementById('filePlaceholder').classList.remove('hidden');
        document.getElementById('fileInfo').classList.add('hidden');
    }

    function closeModal() {
        document.getElementById('uploadModal').classList.add('hidden');
    }

    function previewFile(input) {
        if (input.files && input.files[0]) {
            document.getElementById('filePlaceholder').classList.add('hidden');
            document.getElementById('fileInfo').classList.remove('hidden');
            document.getElementById('fileName').innerText = input.files[0].name;
        }
    }
</script>
@endsection