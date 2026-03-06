@extends('layouts.admin')
@section('title', 'Manajemen E-Signature')
@section('header-title', 'Permohonan Tanda Tangan')

@section('content')

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative mb-6 flex items-center shadow-sm">
        <i class="fas fa-check-circle text-green-500 mr-2"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative mb-6 flex items-center shadow-sm">
        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> {{ session('error') }}
    </div>
@endif

{{-- ========================================================= --}}
{{-- BAGIAN 1: PENGESAHAN BUKU BIRU (INTERNAL MAHASISWA)       --}}
{{-- ========================================================= --}}
<div class="mb-10">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shadow-sm border border-blue-200">
            <i class="fas fa-book text-lg"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-800">TTE Buku Biru</h2>
            <p class="text-sm text-slate-500">Persetujuan akhir kelulusan administrasi kegiatan mahasiswa.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Mahasiswa</th>
                        <th class="px-6 py-4 text-center">Total Bukti Diupload</th>
                        <th class="px-6 py-4">Waktu Pengajuan</th>
                        <th class="px-6 py-4">Status TTE</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bukuBirus as $bb)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 text-base">{{ $bb->user->name }}</div>
                            <div class="text-xs text-slate-500">{{ $bb->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{-- Menghitung total sertifikat yang sudah diapprove milik user ini --}}
                            @php
                                $approvedCount = \App\Models\Certificate::where('user_id', $bb->user_id)->where('status', 'approved')->count();
                            @endphp
                            <span class="bg-indigo-50 text-indigo-700 font-bold px-3 py-1 rounded-full border border-indigo-100">
                                {{ $approvedCount }} Valid
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-700">{{ $bb->updated_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $bb->updated_at->format('H:i') }} WITA</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($bb->tte_status == 'pending')
                                <span class="bg-orange-100 text-orange-800 text-xs font-bold px-2.5 py-1 rounded-md border border-orange-200 flex items-center gap-1.5 w-max">
                                    <i class="fas fa-circle text-[8px] text-orange-500 animate-pulse"></i> Menunggu
                                </span>
                            @elseif($bb->tte_status == 'approved')
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-md border border-green-200 flex items-center gap-1.5 w-max">
                                    <i class="fas fa-check-circle text-green-500"></i> Disetujui
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-md border border-red-200 flex items-center gap-1.5 w-max" title="{{ $bb->tte_note }}">
                                    <i class="fas fa-times-circle text-red-500"></i> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                @if($bb->tte_status == 'pending')
                                    {{-- Tombol Approve Buku Biru --}}
                                    <form action="{{ route('admin.tte.approveBukuBiru', $bb->id) }}" method="POST" onsubmit="return confirm('Sahkan Buku Biru atas nama {{ $bb->user->name }}?')">
                                        @csrf
                                        <button class="px-4 py-2 rounded-lg bg-green-50 text-green-600 font-bold hover:bg-green-600 hover:text-white transition shadow-sm text-xs flex items-center gap-1">
                                            <i class="fas fa-check"></i> Sahkan
                                        </button>
                                    </form>
                                    
                                    {{-- Tombol Reject Buku Biru (Membuka Modal) --}}
                                    <button onclick="openRejectModal('{{ $bb->id }}', '{{ $bb->user->name }}')" class="px-4 py-2 rounded-lg bg-red-50 text-red-600 font-bold hover:bg-red-600 hover:text-white transition shadow-sm text-xs flex items-center gap-1">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                @elseif($bb->tte_status == 'approved')
                                    <span class="text-xs font-bold text-slate-400 italic">Telah Disahkan</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-book-open text-4xl text-slate-200 mb-3"></i>
                                <p class="font-medium">Belum ada pengajuan TTE Buku Biru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50">
            {{ $bukuBirus->appends(['doc_page' => request('doc_page')])->links() }}
        </div>
    </div>
</div>

<hr class="border-t-2 border-dashed border-slate-200 my-10">

{{-- ========================================================= --}}
{{-- BAGIAN 2: PENGESAHAN DOKUMEN UMUM (SURAT/PROPOSAL)        --}}
{{-- ========================================================= --}}
<div class="mb-10">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-200">
            <i class="fas fa-file-signature text-lg"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-800">TTE Dokumen Eksternal/Umum</h2>
            <p class="text-sm text-slate-500">Pengajuan validasi QR Code untuk surat, proposal, dan sertifikat luar.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Pengaju</th>
                        <th class="px-6 py-4">Dokumen</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($documents as $doc)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-700">{{ $doc->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $doc->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $doc->user_name }}</div>
                            <div class="text-xs text-slate-500">{{ $doc->user_email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 mb-1">{{ $doc->document_title }}</div>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline bg-blue-50 px-2 py-1 rounded-md border border-blue-100 w-max">
                                <i class="fas fa-file-pdf"></i> Lihat File
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @if($doc->status == 'pending')
                                <span class="bg-orange-100 text-orange-800 text-xs font-bold px-2.5 py-1 rounded-md border border-orange-200 flex items-center gap-1.5 w-max">
                                    <i class="fas fa-circle text-[8px] text-orange-500 animate-pulse"></i> Menunggu
                                </span>
                            @elseif($doc->status == 'approved')
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-md border border-green-200 flex items-center gap-1.5 w-max">
                                    <i class="fas fa-check-circle text-green-500"></i> Disetujui
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-md border border-red-200 flex items-center gap-1.5 w-max">
                                    <i class="fas fa-times-circle text-red-500"></i> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                
                                @if($doc->status == 'pending')
                                    {{-- Tombol Approve Dokumen --}}
                                    <form action="{{ route('admin.tte.approve', $doc->id) }}" method="POST" onsubmit="return confirm('Tanda tangani dokumen ini secara digital?')">
                                        @csrf
                                        <button class="w-8 h-8 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition flex items-center justify-center shadow-sm" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    {{-- Tombol Reject Dokumen --}}
                                    <form action="{{ route('admin.tte.reject', $doc->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan ini?')">
                                        @csrf
                                        <button class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition flex items-center justify-center shadow-sm" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>

                                @elseif($doc->status == 'approved')
                                    {{-- Link Verifikasi QR Code --}}
                                    <a href="{{ route('tte.verify', $doc->verification_token) }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition flex items-center justify-center shadow-sm" title="Lihat Halaman Verifikasi Token">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                @endif

                                {{-- TOMBOL HAPUS (Muncul di semua status) --}}
                                <form action="{{ route('admin.tte.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus dokumen ini akan menghilangkan file fisik dan data verifikasi selamanya. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center shadow-sm" title="Hapus Permanen">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-folder-open text-4xl text-slate-200 mb-3"></i>
                                <p class="font-medium">Belum ada pengajuan dokumen umum.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50">
            {{ $documents->appends(['bb_page' => request('bb_page')])->links() }}
        </div>
    </div>
</div>

{{-- ========================================================= --}}
{{-- MODAL PENOLAKAN BUKU BIRU                                 --}}
{{-- ========================================================= --}}
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeRejectModal()"></div>

        <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full z-10">
            <div class="bg-red-50 px-6 py-4 border-b border-red-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-red-700 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i> Tolak TTE Buku Biru
                </h3>
                <button type="button" onclick="closeRejectModal()" class="text-red-400 hover:text-red-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="rejectForm" method="POST">
                @csrf
                <div class="p-6">
                    <p class="text-sm text-slate-600 mb-4">Berikan alasan mengapa permohonan TTE Buku Biru milik <strong id="rejectUserName" class="text-slate-800"></strong> ditolak, agar mahasiswa dapat memperbaikinya.</p>
                    
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Catatan Penolakan</label>
                    <textarea name="note" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-red-500 focus:border-red-500 text-sm p-3" placeholder="Contoh: Sertifikat kegiatan X tidak valid / buram..." required></textarea>
                </div>
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeRejectModal()" class="px-5 py-2 rounded-xl text-slate-600 font-bold hover:bg-slate-200 transition text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition shadow-lg shadow-red-200 text-sm flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i> Kirim Penolakan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Logic untuk Modal Penolakan Buku Biru
    function openRejectModal(id, userName) {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectUserName').innerText = userName;
        
        // Ubah action URL form secara dinamis
        // Note: URL route ini merujuk ke name('admin.tte.rejectBukuBiru') yang sudah diset di web.php
        let formUrl = `/admin/tte/bukubiru/${id}/reject`; 
        document.getElementById('rejectForm').action = formUrl;
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }
</script>
@endpush