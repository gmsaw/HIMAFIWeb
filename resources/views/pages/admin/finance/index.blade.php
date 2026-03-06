@extends('layouts.admin')

@section('title', 'Keuangan & Kas')
@section('header-title', 'Keuangan Himpunan')

@section('content')

    {{-- ========================================== --}}
    {{-- KARTU RINGKASAN SALDO                      --}}
    {{-- ========================================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between relative overflow-hidden group hover:shadow-md transition-all duration-300">
            <div class="relative z-10">
                <p class="text-sm text-gray-500 font-medium mb-1 group-hover:text-blue-600 transition-colors">Saldo Saat Ini</p>
                <h3 class="text-3xl font-extrabold text-slate-800">Rp {{ number_format($currentBalance, 0, ',', '.') }}</h3>
            </div>
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl relative z-10 shadow-sm">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-blue-50 rounded-full opacity-50 transition-transform group-hover:scale-110"></div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Pemasukan</p>
                <h3 class="text-2xl font-bold text-green-600">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-green-100 transition-colors">
                <i class="fas fa-arrow-down"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Pengeluaran</p>
                <h3 class="text-2xl font-bold text-red-600">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-red-100 transition-colors">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TOOLBAR (FILTER & TOMBOL)                  --}}
    {{-- ========================================== --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-8 flex flex-col lg:flex-row justify-between items-center gap-4">
        
        <form action="{{ route('admin.finance.index') }}" method="GET" class="flex items-center gap-3 w-full lg:w-auto bg-gray-50 p-2 rounded-xl border border-gray-200">
            <span class="text-sm font-semibold text-gray-500 pl-2"><i class="far fa-calendar-alt mr-1"></i> Periode:</span>
            <input type="month" name="filter_month" value="{{ request('filter_month') }}" class="bg-white border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 p-1.5 border shadow-sm outline-none" onchange="this.form.submit()">
            @if(request('filter_month'))
                <a href="{{ route('admin.finance.index') }}" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" title="Hapus Filter"><i class="fas fa-times"></i></a>
            @endif
        </form>

        <div class="flex gap-3 w-full lg:w-auto">
            <button type="button" onclick="toggleModal('modalExport')" class="flex-1 lg:flex-none bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shadow-sm">
                <i class="fas fa-download text-slate-500"></i> Export Laporan
            </button>
            <button type="button" onclick="toggleModal('modalTransaction')" class="flex-1 lg:flex-none bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shadow-lg shadow-slate-500/20 transform active:scale-95">
                <i class="fas fa-plus"></i> Catat Transaksi
            </button>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- ALERT SUCCESS                              --}}
    {{-- ========================================== --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-2 shadow-sm animate-fade-in-down">
        <i class="fas fa-check-circle text-green-500 text-lg"></i> 
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ========================================== --}}
    {{-- TABEL TRANSAKSI                            --}}
    {{-- ========================================== --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Keterangan</th>
                        <th class="px-6 py-4 font-semibold">Jenis</th>
                        <th class="px-6 py-4 font-semibold text-right">Nominal</th>
                        <th class="px-6 py-4 font-semibold text-center">Bukti</th>
                        <th class="px-6 py-4 font-semibold text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transactions as $data)
                    <tr class="bg-white hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-slate-900 font-bold">{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400 mt-0.5">{{ $data->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ $data->description }}
                        </td>
                        <td class="px-6 py-4">
                            @if($data->type == 'income')
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full border border-green-100">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div> Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 text-xs font-bold px-2.5 py-1 rounded-full border border-red-100">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div> Keluar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right font-mono text-base font-bold {{ $data->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $data->type == 'income' ? '+' : '-' }} {{ number_format($data->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($data->image)
                                <a href="{{ asset('storage/' . $data->image) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Lihat Nota">
                                    <i class="fas fa-receipt text-xs"></i>
                                </a>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.finance.destroy', $data->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Hapus transaksi ini? Saldo akan berubah.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Hapus Data">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <i class="fas fa-file-invoice-dollar text-3xl text-gray-300"></i>
                                </div>
                                <span class="font-medium">Belum ada data transaksi</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
            {{ $transactions->links() }}
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL CATAT TRANSAKSI                      --}}
    {{-- ========================================== --}}
    <div id="modalTransaction" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            {{-- Backdrop Transparan & Blur --}}
            <div class="fixed inset-0 bg-slate-900/40 transition-opacity backdrop-blur-sm" onclick="toggleModal('modalTransaction')"></div>
            
            {{-- KOTAK PUTIH PEMBUNGKUS MODAL --}}
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full relative z-10">
                
                {{-- Header Modal --}}
                <div class="bg-white px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Catat Transaksi Baru</h3>
                    <button type="button" onclick="toggleModal('modalTransaction')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>

                {{-- Form Transaksi --}}
                <form action="{{ route('admin.finance.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 space-y-5">
                    @csrf
                    
                    {{-- ALERT ERROR VALIDASI --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl text-sm mb-4">
                            <p class="font-bold mb-1"><i class="fas fa-exclamation-circle"></i> Gagal menyimpan data:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Jenis Transaksi</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="income" class="peer sr-only" required {{ old('type') == 'income' ? 'checked' : '' }}>
                                <div class="text-center rounded-xl border-2 border-gray-100 p-3 hover:bg-green-50/50 peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 transition-all bg-white">
                                    <div class="mb-1"><i class="fas fa-arrow-down text-lg"></i></div>
                                    <span class="font-bold text-sm">Pemasukan</span>
                                </div>
                                <div class="absolute top-2 right-2 text-green-600 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fas fa-check-circle"></i></div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="type" value="expense" class="peer sr-only" required {{ old('type') == 'expense' ? 'checked' : '' }}>
                                <div class="text-center rounded-xl border-2 border-gray-100 p-3 hover:bg-red-50/50 peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700 transition-all bg-white">
                                    <div class="mb-1"><i class="fas fa-arrow-up text-lg"></i></div>
                                    <span class="font-bold text-sm">Pengeluaran</span>
                                </div>
                                <div class="absolute top-2 right-2 text-red-600 opacity-0 peer-checked:opacity-100 transition-opacity"><i class="fas fa-check-circle"></i></div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nominal (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400 font-bold">Rp</span>
                                <input type="number" name="amount" value="{{ old('amount') }}" class="w-full pl-10 rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 font-mono font-bold" placeholder="0" min="1000" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Keterangan</label>
                        <input type="text" name="description" value="{{ old('description') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Dana Usaha Makanan" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Bukti Nota (Opsional)</label>
                        <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-500/30">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL EXPORT LAPORAN                       --}}
    {{-- ========================================== --}}
    <div id="modalExport" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            {{-- Backdrop Transparan & Blur --}}
            <div class="fixed inset-0 bg-slate-900/40 transition-opacity backdrop-blur-sm" onclick="toggleModal('modalExport')"></div>
            
            {{-- KOTAK PUTIH PEMBUNGKUS MODAL --}}
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full relative z-10">
                
                {{-- Header Modal --}}
                <div class="bg-white px-6 py-6 text-center border-b border-gray-100 relative">
                    <button type="button" onclick="toggleModal('modalExport')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                    <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-blue-50 mb-4">
                        <i class="fas fa-file-download text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Export Laporan</h3>
                    <p class="text-sm text-gray-500 mt-1">Pilih rentang tanggal dan format file yang diinginkan.</p>
                </div>
                
                {{-- Body Form --}}
                <form action="{{ route('admin.finance.export') }}" method="GET" class="bg-white p-6">
                    
                    {{-- Rentang Tanggal --}}
                    <div class="space-y-4 bg-gray-50 p-5 rounded-xl border border-gray-100 mb-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Dari Tanggal</label>
                            <input type="date" name="start_date" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                        </div>
                    </div>

                    {{-- Format File --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Format File</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer p-3 border border-gray-200 rounded-lg flex-1 justify-center hover:bg-gray-50 transition bg-white">
                                <input type="radio" name="type" value="pdf" class="text-red-600 focus:ring-red-500 w-4 h-4" checked>
                                <span class="text-sm font-bold text-gray-700"><i class="fas fa-file-pdf text-red-500 mr-1"></i> PDF</span>
                            </label>
                            
                            {{-- Ubah baris di bawah ini menjadi komentar jika Anda belum menginstal Maatwebsite/Excel --}}
                            <label class="flex items-center gap-2 cursor-pointer p-3 border border-gray-200 rounded-lg flex-1 justify-center hover:bg-gray-50 transition bg-white">
                                <input type="radio" name="type" value="excel" class="text-green-600 focus:ring-green-500 w-4 h-4">
                                <span class="text-sm font-bold text-gray-700"><i class="fas fa-file-excel text-green-500 mr-1"></i> Excel</span>
                            </label> 
                            
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex gap-3 mt-4">
                        <button type="button" onclick="toggleModal('modalExport')" class="w-1/3 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition text-sm">Batal</button>
                        <button type="submit" class="w-2/3 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition text-sm shadow-lg shadow-blue-500/30 flex justify-center items-center gap-2">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if(modal) {
            modal.classList.toggle('hidden');
        }
    }

    // Otomatis buka modal Catat Transaksi jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            toggleModal('modalTransaction');
        @endif
    });
</script>
@endpush