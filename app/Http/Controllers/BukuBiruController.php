<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\BukuBiru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class BukuBiruController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MAHASISWA / USER METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan halaman Buku Biru User (Tabel Kegiatan & Status TTE).
     */
    public function index()
    {
        // 1. Ambil semua sertifikat milik user yang sedang login (Ini BENAR pakai Certificate)
        $certificates = Certificate::where('user_id', Auth::id())->get();

        // 2. PERBAIKAN DI SINI: Gunakan model BukuBiru, BUKAN Certificate
        $bukuBiru = BukuBiru::firstOrCreate(
            ['user_id' => Auth::id()],
            ['tte_status' => null] 
        );

        return view('pages.bukubiru.index', compact('certificates', 'bukuBiru'));
    }

    /**
     * Menyimpan atau Mengupdate Sertifikat Kegiatan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'activity_date' => 'required|date',
            'file'          => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // 1. Cek apakah user sudah pernah upload kegiatan dengan nama yang sama
        $existingCert = Certificate::where('user_id', Auth::id())
                            ->where('activity_name', $request->activity_name)
                            ->first();

        // 2. Jika ada file lama, hapus dulu dari storage biar tidak menumpuk sampah
        if ($existingCert && $existingCert->file_path) {
            if (Storage::disk('public')->exists($existingCert->file_path)) {
                Storage::disk('public')->delete($existingCert->file_path);
            }
        }

        // 3. Simpan file baru
        $path = $request->file('file')->store('certificates', 'public');

        // 4. Simpan ke Database (Sertifikat Kegiatan)
        Certificate::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'activity_name' => $request->activity_name // Kunci pencarian (Nama Kegiatan)
            ],
            [
                'category'      => $request->category,
                'activity_date' => $request->activity_date,
                'file_path'     => $path,
                'status'        => 'pending', // Reset status jadi pending setiap upload baru
                'admin_note'    => null       // Hapus catatan penolakan lama (jika ada)
            ]
        );

        // 5. PERBAIKAN: RESET STATUS TTE DI MODEL BUKU BIRU
        $bukuBiru = Certificate::where('user_id', Auth::id())->first();
        if ($bukuBiru && in_array($bukuBiru->tte_status, ['approved', 'rejected'])) {
            $bukuBiru->update([
                'tte_status' => null,
                'tte_note' => null,
                'tte_approved_at' => null,
            ]);
            
            return back()->with('success', 'Bukti kegiatan berhasil diunggah. PERHATIAN: Karena Anda mengubah data, status TTE Anda telah di-reset. Silakan ajukan ulang TTE.');
        }

        return back()->with('success', 'Bukti kegiatan berhasil diunggah dan menunggu verifikasi.');
    }

    /**
     * Mengajukan Permohonan TTE / Validasi Buku Biru (User)
     */
    public function requestTTE($id)
    {
        // Pastikan menggunakan model BukuBiru
        $bukuBiru = Certificate::findOrFail($id);

        if($bukuBiru->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Generate Token Baru yang pasti unik (tidak ada duplikat di DB)
        do {
            $newToken = Str::random(10);
        } while (
            Certificate::where('verification_token', $newToken)->exists() || 
            \App\Models\Document::where('verification_token', $newToken)->exists()
        );

        // Update status dan timpa token lama dengan yang baru
        $bukuBiru->update([
            'tte_status' => 'pending',
            'tte_note' => null,
            'verification_token' => $newToken // Selalu masukkan token baru
        ]);

        return back()->with('success', 'Permohonan TTE diajukan. Token Validasi Anda yang baru: ' . $newToken);
    }

    /**
     * Download Rekapitulasi Buku Biru (PDF).
     */
    public function exportPdf()
    {
        $user = Auth::user();
        
        // Ambil data sertifikat user
        $certificates = Certificate::where('user_id', $user->id)
                            ->orderBy('activity_date', 'asc') // Urutkan berdasarkan tanggal
                            ->get();

        // PERBAIKAN: Ambil data TTE dari BukuBiru
        $bukuBiru = Certificate::where('user_id', $user->id)->first();
        
        // Render View ke PDF
        $pdf = Pdf::loadView('pages.bukubiru.pdf', compact('user', 'certificates', 'bukuBiru'));
        
        // Set ukuran kertas (Opsional, default A4)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Buku_Biru_' . str_replace(' ', '_', $user->name) . '.pdf');
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN METHODS (Validasi Sertifikat & TTE)
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan semua pengajuan sertifikat masuk.
     */
    public function adminIndex(Request $request)
    {
        $query = Certificate::with('user');

        // 1. Fitur Search (Berdasarkan Nama Mahasiswa)
        if ($request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Fitur Filter (Berdasarkan Status)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $certificates = $query->latest()
                            ->paginate(10)
                            ->withQueryString(); // Agar parameter search tidak hilang saat ganti halaman

        return view('pages.admin.bukubiru.index', compact('certificates'));
    }

    /**
     * Menyetujui sertifikat individu.
     */
    public function approve($id)
    {
        $cert = Certificate::findOrFail($id);
        
        $cert->update([
            'status' => 'approved',
            'admin_note' => null // Hapus catatan jika sebelumnya ada
        ]);

        return back()->with('success', 'Kegiatan mahasiswa berhasil divalidasi.');
    }

    /**
     * Menolak sertifikat individu dengan catatan.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'required|string|max:255'
        ]);

        $cert = Certificate::findOrFail($id);
        
        $cert->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Kegiatan ditolak dan catatan telah dikirim ke mahasiswa.');
    }

    /**
     * Membatalkan Validasi Sertifikat (Reset status jadi Pending).
     */
    public function resetStatus($id)
    {
        $cert = Certificate::findOrFail($id);
        
        $cert->update([
            'status' => 'pending',
            'admin_note' => null // Hapus catatan penolakan jika ada
        ]);

        return back()->with('success', 'Status validasi dibatalkan. Kembali ke status Menunggu.');
    }

    /**
     * Admin Menyetujui TTE Buku Biru Keseluruhan.
     */
    public function approveTTE($id)
    {
        // PERBAIKAN: Gunakan model BukuBiru
        $bukuBiru = Certificate::findOrFail($id);
        
        $bukuBiru->update([
            'tte_status' => 'approved',
            'tte_approved_at' => now(), // Mencatat waktu validasi
        ]);

        return back()->with('success', 'Buku Biru berhasil divalidasi. Mahasiswa kini dapat mencetaknya.');
    }

    /**
     * Admin Menolak TTE Buku Biru Keseluruhan dengan Catatan.
     */
    public function rejectTTE(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        // PERBAIKAN: Gunakan model BukuBiru
        $bukuBiru = Certificate::findOrFail($id);
        
        $bukuBiru->update([
            'tte_status' => 'rejected',
            'tte_note' => $request->note, // Alasan kenapa ditolak (misal: "Sertifikat Wajib kurang 1")
        ]);

        return back()->with('success', 'Permohonan TTE ditolak. Catatan telah dikirim ke mahasiswa.');
    }
}