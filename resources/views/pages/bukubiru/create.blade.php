@extends('layouts.app')
@section('title', 'Input Kegiatan')
@php $useTransparentHeader = false; @endphp

@section('content')
<div class="min-h-screen bg-slate-50 pt-32 pb-20 px-4 flex justify-center">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
        
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h2 class="text-2xl font-bold text-slate-800">Input Kegiatan Baru</h2>
            <p class="text-sm text-slate-500">Isi data kegiatan untuk divalidasi ke Buku Biru.</p>
        </div>

        <form action="{{ route('bukubiru.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kegiatan</label>
                <input type="text" name="activity_name" required class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Panitia Saraswati Fisika 2026">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="activity_date" required class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category" required class="w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Kepanitiaan">Kepanitiaan</option>
                        <option value="Lomba/Prestasi">Lomba/Prestasi</option>
                        <option value="Organisasi">Organisasi</option>
                        <option value="Seminar/Workshop">Seminar/Workshop</option>
                        <option value="Pengabdian">Pengabdian</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Upload Sertifikat / SK (PDF/Image)</label>
                <input type="file" name="file" required accept=".pdf,image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-400 mt-1">Maksimal ukuran file 2MB.</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('bukubiru.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 font-bold shadow-lg transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection