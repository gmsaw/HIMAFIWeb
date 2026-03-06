@extends('layouts.admin')
@section('title', 'Validasi Buku Biru')
@section('header-title', 'Validasi Sertifikat')

@section('content')

{{-- 1. SEARCH & FILTER SECTION --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
    <form action="{{ route('admin.bukubiru.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        
        <div class="flex-grow">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cari Nama Mahasiswa</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Ketik nama mahasiswa...">
            </div>
        </div>

        <div class="w-full md:w-64">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Filter Status</label>
            <select name="status" class="block w-full py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui (Valid)</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="flex items-end">
            <a href="{{ route('admin.bukubiru.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-bold hover:bg-gray-200 transition">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- 2. TABEL DATA --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 border-b border-green-100 flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3">Mahasiswa</th>
                    <th class="px-6 py-3">Kegiatan</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Bukti</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($certificates as $cert)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ $cert->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $cert->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $cert->activity_name }}</div>
                        <div class="text-xs text-gray-500">{{ $cert->activity_date->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs border border-blue-100">
                            {{ $cert->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ asset('storage/' . $cert->file_path) }}" target="_blank" class="text-blue-600 hover:underline text-xs flex items-center gap-1">
                            <i class="fas fa-external-link-alt"></i> Lihat File
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        @if($cert->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded inline-flex items-center gap-1">
                                <i class="fas fa-clock"></i> Menunggu
                            </span>
                        @elseif($cert->status == 'approved')
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded inline-flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> Valid
                            </span>
                        @else
                            <div class="flex flex-col">
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded inline-flex items-center gap-1 w-fit">
                                    <i class="fas fa-times-circle"></i> Ditolak
                                </span>
                                @if($cert->admin_note)
                                    <span class="text-[10px] text-red-500 italic mt-1 max-w-[150px] truncate" title="{{ $cert->admin_note }}">
                                        "{{ $cert->admin_note }}"
                                    </span>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        
                        {{-- CEK APAKAH ROLE BUKAN EKSTERNAL --}}
                        @if(Auth::user()->role !== 'eksternal')
                        
                            {{-- LOGIKA TOMBOL AKSI ADMIN / SEKRETARIS --}}
                            @if($cert->status == 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.bukubiru.approve', $cert->id) }}" method="POST" onsubmit="return confirm('Validasi kegiatan ini?')">
                                        @csrf
                                        <button class="w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition shadow-sm" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    <button onclick="rejectCert({{ $cert->id }})" class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                            @else
                                <form action="{{ route('admin.bukubiru.reset', $cert->id) }}" method="POST" onsubmit="return confirm('Batalkan status validasi? Status akan kembali menjadi Pending.')">
                                    @csrf
                                    <button class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs font-bold hover:bg-gray-200 hover:text-gray-700 transition flex items-center gap-1 mx-auto">
                                        <i class="fas fa-undo"></i> Batal Validasi
                                    </button>
                                </form>
                            @endif

                            {{-- Hidden Form untuk Reject --}}
                            <form id="reject-form-{{ $cert->id }}" action="{{ route('admin.bukubiru.reject', $cert->id) }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="admin_note" id="note-{{ $cert->id }}">
                            </form>

                        @else
                            {{-- TAMPILAN JIKA ROLE ADALAH EKSTERNAL --}}
                            <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-3 py-1.5 rounded-lg cursor-not-allowed inline-flex items-center gap-1.5 border border-gray-200">
                                <i class="fas fa-lock"></i> Hanya Lihat
                            </span>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <i class="fas fa-folder-open text-4xl mb-3"></i>
                        <p>Tidak ada data sertifikat ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100">
        {{ $certificates->links() }}
    </div>
</div>

{{-- Script JS untuk Reject Prompt --}}
<script>
    function rejectCert(id) {
        let reason = prompt("Masukkan alasan penolakan (Wajib diisi):");
        if (reason != null && reason.trim() !== "") {
            document.getElementById('note-' + id).value = reason;
            document.getElementById('reject-form-' + id).submit();
        } else if (reason === "") {
            alert("Alasan penolakan tidak boleh kosong!");
        }
    }
</script>
@endsection