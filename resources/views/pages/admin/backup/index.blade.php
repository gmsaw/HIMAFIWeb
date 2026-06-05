@extends('layouts.admin')
@section('title', 'Manajemen Backup')
@section('header-title', 'Pusat Data & Keamanan')

@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 mb-6 rounded-xl shadow-sm flex items-center gap-3">
        <i class="fas fa-check-circle text-xl"></i>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="bg-rose-50 border border-rose-200 text-rose-700 px-6 py-4 mb-6 rounded-xl shadow-sm flex items-center gap-3">
        <i class="fas fa-exclamation-triangle text-xl"></i>
        <p class="font-medium">{{ session('error') }}</p>
    </div>
@endif

{{-- DUA KARTU FITUR UTAMA --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    
    {{-- Kartu 1: Backup Semua Data --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-100 relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-cloud-download-alt"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Backup Semua Data</h3>
                    <p class="text-sm text-slate-500">Ekspor Database & File ke format ZIP</p>
                </div>
            </div>
            
            <div class="bg-slate-50 p-3 rounded-lg mb-6 border border-slate-100">
                <span class="text-xs text-slate-500 font-bold uppercase tracking-wider block mb-1">Terakhir Di-Backup:</span>
                <span class="text-sm font-semibold {{ $lastBackup ? 'text-emerald-600' : 'text-slate-600' }}">
                    {!! $lastBackup ? '<i class="far fa-clock mr-1"></i> ' . \Carbon\Carbon::parse($lastBackup)->translatedFormat('d F Y, H:i') : 'Belum pernah dibackup' !!}
                </span>
            </div>

            <form action="{{ route('admin.backup.generate') }}" method="POST" class="allow-double" onsubmit="this.querySelector('button').innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i> Sedang Memproses...'; this.querySelector('button').classList.add('opacity-75', 'cursor-not-allowed');">
                @csrf
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl text-sm font-bold shadow-lg shadow-emerald-500/30 transition flex items-center justify-center gap-2">
                    <i class="fas fa-cogs"></i> Buat Backup Baru Sekarang
                </button>
            </form>
        </div>
    </div>

    {{-- Kartu 2: Hapus Semua Data (Danger Zone) --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-rose-100 relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-rose-50 rounded-full group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-radiation"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Danger Zone: Reset Website</h3>
                    <p class="text-sm text-slate-500">Hapus seluruh data untuk memulai lembaran baru</p>
                </div>
            </div>
            
            <div class="bg-rose-50 p-3 rounded-lg mb-6 border border-rose-100">
                <p class="text-xs text-rose-700 font-medium leading-relaxed">
                    <i class="fas fa-exclamation-triangle mr-1"></i> <strong>Peringatan:</strong> Tindakan ini akan menghapus seluruh data operasional (Surat, Inventaris, Keuangan, File) dan user non-admin. Akun Admin Anda tetap aman.
                </p>
            </div>

            <button type="button" onclick="openWipeDataModal()" class="w-full bg-white border-2 border-rose-500 text-rose-600 hover:bg-rose-600 hover:text-white py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-rose-500/20 transition flex items-center justify-center gap-2">
                <i class="fas fa-trash-alt"></i> Hapus Semua Data Website
            </button>
        </div>
    </div>

</div>

{{-- TABEL RIWAYAT BACKUP --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h4 class="font-bold text-slate-800">Riwayat File Backup di Server</h4>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead class="bg-slate-50 border-b border-gray-100 text-slate-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Nama File ZIP</th>
                    <th class="px-6 py-4">Ukuran</th>
                    <th class="px-6 py-4">Tanggal Dibuat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($backups as $backup)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-blue-600">
                        <i class="fas fa-file-archive text-amber-500 mr-2 text-lg"></i>
                        {{ $backup['name'] }}
                    </td>
                    <td class="px-6 py-4 text-slate-600 font-medium">{{ $backup['size'] }} MB</td>
                    <td class="px-6 py-4 text-slate-600">{{ \Carbon\Carbon::parse($backup['date'])->translatedFormat('d M Y - H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.backup.download', $backup['name']) }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg font-bold text-xs transition">
                                <i class="fas fa-download mr-1"></i> Unduh
                            </a>
                            <button type="button" onclick="openDeleteFileModal('{{ route('admin.backup.destroy', $backup['name']) }}', '{{ $backup['name'] }}')" class="bg-rose-50 text-rose-600 hover:bg-rose-100 px-3 py-1.5 rounded-lg font-bold text-xs transition">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                        <i class="fas fa-hdd text-4xl text-slate-300 mb-3"></i>
                        <p>Belum ada file backup yang tersimpan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL 1: KONFIRMASI HAPUS FILE BACKUP --}}
<div id="deleteFileModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-opacity">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-slate-800 p-6 text-center">
            <h3 class="font-bold text-xl text-white">Hapus File Backup</h3>
            <p class="text-slate-300 text-sm mt-1 truncate" id="modalFileName"></p>
        </div>
        <form id="deleteFileForm" method="POST" class="p-6">
            @csrf @method('DELETE')
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Ketik <span class="text-rose-600 select-none">konfirmasi</span> untuk melanjutkan:
            </label>
            <input type="text" name="konfirmasi_text" id="konfirmasiFileInput" onkeyup="checkWord('btnSubmitFile', this.value)" autocomplete="off" placeholder="Ketik di sini..." class="w-full border-gray-300 rounded-xl focus:border-rose-500 focus:ring-rose-200 text-sm py-2.5 mb-6 text-center font-bold tracking-widest">
            
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('deleteFileModal')" class="flex-1 bg-slate-100 text-slate-600 hover:bg-slate-200 px-4 py-2.5 rounded-xl font-bold transition">Batal</button>
                <button type="submit" id="btnSubmitFile" disabled class="flex-1 bg-rose-600 text-white px-4 py-2.5 rounded-xl font-bold transition-all opacity-50 cursor-not-allowed">Hapus File</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL 2: KONFIRMASI RESET WEBSITE (WIPE DATA) --}}
<div id="wipeDataModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-50 hidden flex items-center justify-center p-4 transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border-2 border-rose-500">
        <div class="bg-rose-600 p-8 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 flex justify-center items-center">
                <i class="fas fa-radiation text-9xl"></i>
            </div>
            <div class="w-20 h-20 bg-white text-rose-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 relative z-10 shadow-lg">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="font-bold text-2xl text-white relative z-10">PERINGATAN KERAS!</h3>
            <p class="text-rose-100 text-sm mt-2 relative z-10">Tindakan ini tidak dapat dibatalkan. Pastikan Anda sudah mem-backup data terlebih dahulu.</p>
        </div>
        
        <form action="{{ route('admin.backup.wipe') }}" method="POST" class="p-8">
            @csrf
            <label class="block text-sm font-bold text-slate-700 mb-2 text-center">
                Ketik kalimat <span class="text-rose-600 select-none bg-rose-50 px-2 py-1 rounded">konfirmasi</span> untuk menghapus seluruh data website.
            </label>
            <input type="text" name="konfirmasi_text" id="konfirmasiWipeInput" onkeyup="checkWord('btnSubmitWipe', this.value)" autocomplete="off" placeholder="konfirmasi" class="w-full border-rose-300 rounded-xl shadow-inner focus:border-rose-600 focus:ring focus:ring-rose-200 text-lg py-3 mb-8 text-center font-bold tracking-widest text-rose-600 uppercase">
            
            <div class="flex gap-4">
                <button type="button" onclick="closeModal('wipeDataModal')" class="flex-1 bg-white border border-gray-300 text-slate-600 hover:bg-slate-50 px-4 py-3 rounded-xl font-bold transition">Batalkan</button>
                <button type="submit" id="btnSubmitWipe" disabled class="flex-1 bg-rose-600 text-white px-4 py-3 rounded-xl font-bold transition-all opacity-50 cursor-not-allowed flex justify-center items-center gap-2">
                    <i class="fas fa-radiation"></i> EKSEKUSI HAPUS
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteFileModal(actionUrl, fileName) {
        document.getElementById('deleteFileForm').action = actionUrl;
        document.getElementById('modalFileName').textContent = fileName;
        document.getElementById('deleteFileModal').classList.remove('hidden');
        document.getElementById('konfirmasiFileInput').value = '';
        checkWord('btnSubmitFile', ''); 
    }

    function openWipeDataModal() {
        document.getElementById('wipeDataModal').classList.remove('hidden');
        document.getElementById('konfirmasiWipeInput').value = '';
        checkWord('btnSubmitWipe', ''); 
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function checkWord(buttonId, val) {
        const btn = document.getElementById(buttonId);
        if(val.toLowerCase() === 'konfirmasi') {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            if(buttonId === 'btnSubmitWipe') {
                btn.classList.add('hover:bg-rose-800', 'shadow-lg', 'shadow-rose-600/40', 'animate-pulse');
            } else {
                btn.classList.add('hover:bg-rose-700', 'shadow-lg', 'shadow-rose-500/30');
            }
        } else {
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.classList.remove('hover:bg-rose-700', 'hover:bg-rose-800', 'shadow-lg', 'shadow-rose-500/30', 'shadow-rose-600/40', 'animate-pulse');
        }
    }
</script>
@endsection