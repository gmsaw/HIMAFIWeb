<?php

namespace App\Http\Controllers;

use App\Models\Orbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminOrbitController extends Controller
{
    public function index(Request $request)
    {
        $query = Orbit::query();
        
        // 1. Filter berdasarkan jenis_surat jika ada
        if ($request->filled('jenis')) {
            $query->where('jenis_surat', $request->jenis);
        }

        // 2. Filter berdasarkan fitur pencarian (search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('pengirim', 'like', "%{$search}%")
                  ->orWhere('penerima', 'like', "%{$search}%")
                  ->orWhere('perihal', 'like', "%{$search}%");
            });
        }

        // 3. Ambil data dengan pagination dan pertahankan parameter URL (agar search & filter tidak hilang saat pindah halaman)
        $surats = $query->latest('tanggal_surat')->paginate(10)->appends($request->query());
        
        return view('pages.admin.orbit.index', compact('surats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:masuk,keluar',
            'nomor_surat' => 'required|string|unique:orbits,nomor_surat',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string',
            'penerima' => 'required|string',
            'perihal' => 'required|string',
            'file_surat' => 'required|mimes:pdf|max:5120', // Maksimal 5MB, hanya PDF
        ]);

        $data = $request->all();

        if ($request->hasFile('file_surat')) {
            // Simpan ke storage/app/public/orbit
            $path = $request->file('file_surat')->store('orbit', 'public');
            $data['file_surat'] = $path;
        }

        Orbit::create($data);

        return redirect()->route('admin.orbit.index')->with('success', 'Arsip surat berhasil ditambahkan ke ORBIT.');
    }

    public function destroy(Orbit $orbit)
    {
        // Hapus file fisik
        if ($orbit->file_surat && Storage::disk('public')->exists($orbit->file_surat)) {
            Storage::disk('public')->delete($orbit->file_surat);
        }
        
        $orbit->delete();

        return redirect()->route('admin.orbit.index')->with('success', 'Arsip surat berhasil dihapus.');
    }
}