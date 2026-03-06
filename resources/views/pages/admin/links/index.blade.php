@extends('layouts.admin')

@section('title', 'Manajemen Short Link')
@section('header-title', 'Custom Short Link')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
    
    <div class="xl:col-span-1">
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 sticky top-24">
            <div class="flex items-center gap-3 mb-6 border-b border-slate-100 pb-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-slate-800">Buat Link Baru</h3>
                    <p class="text-xs text-slate-500">Persingkat link panjang Anda di sini.</p>
                </div>
            </div>
            
            <form action="{{ route('admin.links.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Custom Slug</label>
                    <div class="relative flex items-center group">
                        <span class="absolute left-0 pl-3 flex items-center pointer-events-none text-slate-400 font-mono text-sm">/</span>
                        <input type="text" name="slug" required placeholder="nama-kegiatan" 
                            class="w-full pl-6 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-semibold text-slate-700 transition-all placeholder:font-normal placeholder:text-slate-300">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i> Gunakan huruf, angka, dan tanda strip (-).
                    </p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Link Tujuan (URL Asli)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-link text-slate-400 text-xs"></i>
                        </div>
                        <input type="url" name="destination_url" required placeholder="https://docs.google.com/forms/..." 
                            class="w-full pl-9 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-slate-600 transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i> Buat Short Link
                </button>
            </form>
        </div>
    </div>

    <div class="xl:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 flex flex-col h-full">
            
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg text-slate-800">Daftar Link Aktif</h3>
                    <p class="text-xs text-slate-500">Kelola semua link yang telah dibuat.</p>
                </div>
                <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                    {{ $links->count() }} Link
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Informasi Link</th>
                            <th class="px-6 py-4 font-bold text-center">Statistik</th>
                            <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($links as $link)
                        <tr class="group hover:bg-slate-50 transition-colors duration-200">
                            <td class="px-6 py-4 align-top">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ url($link->slug) }}" target="_blank" class="text-base font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                            /{{ $link->slug }}
                                        </a>
                                        <button onclick="copyLink(this, '{{ url($link->slug) }}')" 
                                            class="text-slate-300 hover:text-blue-500 transition-colors p-1 rounded-md" 
                                            title="Salin Link">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </div>
                                    <div class="flex items-center gap-1 text-slate-400 text-xs max-w-xs truncate">
                                        <i class="fas fa-share fa-fw"></i>
                                        <a href="{{ $link->destination_url }}" target="_blank" class="hover:text-slate-600 truncate" title="{{ $link->destination_url }}">
                                            {{ $link->destination_url }}
                                        </a>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-1">
                                        Dibuat: {{ $link->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 align-middle text-center">
                                <div class="inline-flex flex-col items-center justify-center px-4 py-2 bg-slate-50 rounded-lg border border-slate-100 group-hover:border-blue-100 group-hover:bg-blue-50 transition-colors">
                                    <span class="text-lg font-bold text-slate-700 group-hover:text-blue-600">{{ $link->visits }}</span>
                                    <span class="text-[10px] uppercase font-bold text-slate-400 group-hover:text-blue-400">Klik</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 align-middle text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="copyLink(this, '{{ url($link->slug) }}')" 
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-200 shadow-sm transition-all"
                                        title="Salin">
                                        <i class="far fa-copy"></i>
                                    </button>

                                    <form action="{{ route('admin.links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus link ini secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-red-400 hover:text-red-600 hover:border-red-200 hover:bg-red-50 shadow-sm transition-all"
                                            title="Hapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                        <i class="fas fa-link text-slate-300 text-2xl"></i>
                                    </div>
                                    <h4 class="text-slate-500 font-medium">Belum ada link dibuat</h4>
                                    <p class="text-xs text-slate-400 mt-1">Buat link baru melalui formulir di samping.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function copyLink(btn, url) {
        // Copy ke clipboard
        navigator.clipboard.writeText(url).then(() => {
            // Simpan icon asli
            const originalIcon = btn.innerHTML;
            
            // Ubah jadi centang hijau & efek visual
            btn.innerHTML = '<i class="fas fa-check text-green-500"></i>';
            btn.classList.add('border-green-200', 'bg-green-50');
            
            // Kembalikan setelah 2 detik
            setTimeout(() => {
                btn.innerHTML = originalIcon;
                btn.classList.remove('border-green-200', 'bg-green-50');
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
            alert('Gagal menyalin link.');
        });
    }
</script>

@endsection