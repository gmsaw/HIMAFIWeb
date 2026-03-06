@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header-title', 'Manajemen Pengguna')

@section('content')

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 animate-fade-in-up" role="alert">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 animate-fade-in-up" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-yellow-50/50">
            <h3 class="font-bold text-slate-800 text-lg flex items-center">
                <i class="fas fa-user-clock text-yellow-500 mr-2"></i> Menunggu Persetujuan
            </h3>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                {{ count($pendingUsers) }} Pending
            </span>
        </div>

        @if(count($pendingUsers) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">NIM</th>
                        <th class="px-6 py-3">WhatsApp</th>
                        <th class="px-6 py-3">KTM</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingUsers as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=32" class="rounded-full w-8 h-8">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono text-sm">{{ $user->nim ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($user->whatsapp)
                                <a href="https://wa.me/{{ $user->whatsapp }}" target="_blank" class="text-green-600 hover:underline flex items-center gap-1">
                                    <i class="fab fa-whatsapp"></i> {{ $user->whatsapp }}
                                </a>
                            @else - @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->ktm_path)
                                <a href="{{ asset('storage/' . $user->ktm_path) }}" target="_blank" class="text-blue-600 hover:underline text-xs flex items-center gap-1">
                                    <i class="fas fa-file-pdf"></i> Lihat KTM
                                </a>
                            @else <span class="text-gray-400 text-xs">Tidak ada</span> @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-xs px-3 py-2 transition">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak user ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-2 transition">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-8 text-center text-gray-500 text-sm italic">Tidak ada permintaan anggota baru.</div>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg flex items-center">
                <i class="fas fa-users text-blue-600 mr-2"></i> Daftar Anggota Aktif
            </h3>
            <div class="flex items-center gap-3">
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ count($activeUsers) }} User Aktif
                </span>
                <div class="relative">
                    <input type="text" id="searchUser" placeholder="Cari nama/NIM..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 w-64">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">NIM / Angkatan</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                @foreach($activeUsers as $user)
                <tr class="bg-white border-b hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=32" class="rounded-full w-8 h-8">
                            <div>
                                <div class="font-bold">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs">
                            <span class="font-bold text-gray-600">NIM:</span> {{ $user->nim ?? '-' }}<br>
                            <span class="font-bold text-gray-600">Angkatan:</span> {{ $user->angkatan ?? '-' }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $roleColors = [
                                'admin' => 'bg-purple-100 text-purple-800',
                                'sekretaris' => 'bg-pink-100 text-pink-800',
                                'bendahara' => 'bg-yellow-100 text-yellow-800',
                                'anggota' => 'bg-blue-100 text-blue-800',
                                'mahasiswa' => 'bg-gray-100 text-gray-800',
                                'eksternal' => 'bg-slate-100 text-slate-800'
                            ];
                            $color = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="{{ $color }} text-xs font-bold px-2.5 py-0.5 rounded border border-opacity-20 uppercase">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($user->id !== Auth::id())
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="showUserDetails({{ json_encode($user) }})" 
                                class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-xs px-3 py-2 transition"
                                title="Edit Role & Detail">
                                <i class="fas fa-edit mr-1"></i> Kelola
                            </button>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $user->name }}? Data tidak bisa kembali.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-xs px-3 py-2 transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @else
                            <span class="text-xs text-gray-400 italic">Akun Anda</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
        @if(method_exists($activeUsers, 'links'))
        <div class="p-4 border-t border-gray-100">
            {{ $activeUsers->links() }}
        </div>
        @endif
    </div>

    <div id="userDetailModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden transform transition-all scale-95 opacity-0" id="modalPanel">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-800">Detail & Kelola Pengguna</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-red-500 transition text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-6" id="modalContent">
                </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // 1. Search Logic
    document.getElementById('searchUser').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#userTableBody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // 2. Modal Logic
    const modal = document.getElementById('userDetailModal');
    const modalPanel = document.getElementById('modalPanel');

    function showUserDetails(user) {
        // PERBAIKAN 1: Gunakan properti 'birth_date' bukan 'tanggal_lahir'
        // PERBAIKAN 2: Gunakan 'ktm_path' bukan 'ktm_file'
        
        const birthDate = user.birth_date 
            ? new Date(user.birth_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) 
            : '<span class="text-gray-400">-</span>';
            
        const joinDate = new Date(user.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

        const ktmLink = user.ktm_path 
            ? `<a href="/storage/${user.ktm_path}" target="_blank" class="flex items-center gap-2 text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-2 rounded-lg transition w-fit">
                <i class="fas fa-file-pdf text-red-500 text-lg"></i> <span class="font-semibold text-sm">Lihat Dokumen KTM</span>
               </a>` 
            : '<span class="text-gray-400 italic">Tidak ada lampiran KTM</span>';

        const waLink = user.whatsapp 
            ? `<a href="https://wa.me/${user.whatsapp}" target="_blank" class="flex items-center gap-2 text-green-600 hover:text-green-800"><i class="fab fa-whatsapp text-lg"></i> <span class="font-mono font-bold">${user.whatsapp}</span></a>` 
            : '-';

        // Role Dropdown Options
        const roles = ['admin', 'sekretaris', 'bendahara', 'anggota', 'mahasiswa', 'eksternal'];
        let roleOptions = '';
        roles.forEach(r => {
            const selected = user.role === r ? 'selected' : '';
            // Huruf kapital awal
            const label = r.charAt(0).toUpperCase() + r.slice(1);
            roleOptions += `<option value="${r}" ${selected}>${label}</option>`;
        });

        // HTML Content untuk Modal
        const html = `
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/3 flex flex-col items-center text-center">
                    <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random&color=fff&size=128&bold=true" 
                         class="w-32 h-32 rounded-full shadow-lg mb-4 border-4 border-white ring-1 ring-gray-200">
                    
                    <h2 class="text-xl font-bold text-gray-800 leading-tight">${user.name}</h2>
                    <p class="text-sm text-gray-500 mb-4">${user.email}</p>

                    <div class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-left shadow-sm">
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block tracking-wider">Ubah Role / Akses</label>
                        <form action="/admin/users/${user.id}/role" method="POST">
                            @csrf @method('PUT')
                            <select name="role" class="w-full mb-3 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                ${roleOptions}
                            </select>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2.5 rounded-lg transition shadow-md shadow-blue-200">
                                <i class="fas fa-save mr-2"></i> Simpan Role
                            </button>
                        </form>
                    </div>
                </div>

                <div class="md:w-2/3 space-y-6">
                    <div>
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3 border-b border-slate-100 pb-1">Informasi Akademik</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">NIM</label>
                                <p class="font-mono font-medium text-gray-800">${user.nim || '-'}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Angkatan</label>
                                <p class="font-medium text-gray-800">${user.angkatan || '-'}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3 border-b border-slate-100 pb-1">Data Pribadi</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Tanggal Lahir</label>
                                <p class="font-medium text-gray-800">${birthDate}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">WhatsApp</label>
                                ${waLink}
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-3 border-b border-slate-100 pb-1">Lampiran</h4>
                        ${ktmLink}
                    </div>

                    <div class="pt-2 text-xs text-gray-400 text-right">
                        Bergabung sejak: ${joinDate}
                    </div>
                </div>
            </div>
        `;

        document.getElementById('modalContent').innerHTML = html;
        
        // Animasi Masuk
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalPanel.classList.remove('scale-95', 'opacity-0');
            modalPanel.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        // Animasi Keluar
        modalPanel.classList.remove('scale-100', 'opacity-100');
        modalPanel.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // Close on click outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
</script>
@endpush