<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon; // Wajib ditambahkan untuk perbaikan error tanggal

class TteController extends Controller
{
    // --- HALAMAN PUBLIC ---

    // 1. Form Pengajuan
    public function create() {
        return view('pages.tte.create');
    }

    // 2. Simpan Pengajuan (Dokumen Eksternal/Umum)
    public function store(Request $request) {
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'document_title' => 'required',
            'file' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('file')->store('documents', 'public');
        $token = Str::random(10); // Token 10 karakter agar mudah diketik

        Document::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'document_title' => $request->document_title,
            'description' => $request->description,
            'file_path' => $path,
            'verification_token' => $token, // Simpan token pendek ini
            'status' => 'pending'
        ]);

        // Kirim flash message + Token
        return back()->with([
            'success' => 'Dokumen berhasil diajukan!',
            'token_code' => $token // Variable ini akan kita tampilkan di view
        ]);
    }

    // 3. Halaman Form Lacak
    public function trackPage() {
        return view('pages.tte.track');
    }

    // 4. Proses Pencarian Status
    public function trackSearch(Request $request) {
        $request->validate(['token' => 'required']);
        $token = $request->token;

        // 1. Cari di tabel Dokumen Umum
        $document = Document::where('verification_token', $token)->first();

        // 2. Jika tidak ada, cari di tabel Sertifikat (Buku Biru)
        if (!$document) {
            $bukuBiru = Certificate::with('user')->where('verification_token', $token)->first();
            
            if ($bukuBiru) {
                // Trik: Mapping data Buku Biru menjadi format objek Document
                $document = (object)[
                    'user_name' => $bukuBiru->user->name,
                    'user_email' => $bukuBiru->user->email,
                    'document_title' => 'Rekapitulasi Buku Biru Akademik',
                    'status' => $bukuBiru->tte_status,
                    'signer_name' => 'Gede Mahendra Sastra Adhi Wiguna',
                    // PERBAIKAN: Gunakan Carbon::parse agar fungsi ->format() tidak error di Blade
                    'signed_at' => $bukuBiru->tte_approved_at ? Carbon::parse($bukuBiru->tte_approved_at) : null,
                    'verification_token' => $bukuBiru->verification_token,
                    // PERBAIKAN: Gunakan Carbon::parse
                    'created_at' => Carbon::parse($bukuBiru->updated_at),
                    'file_path' => null // Ditambahkan agar tidak error undefined property
                ];
            }
        }

        if(!$document) {
            return back()->with('error', 'Token tidak ditemukan. Mohon cek kembali kode Anda.');
        }

        return view('pages.tte.track', compact('document'));
    }

    // 5. Halaman Verifikasi (Cek Keaslian via Scan QR)
    public function verify($token) {
        $document = Document::where('verification_token', $token)->first();

        if (!$document) {
            $bukuBiru = Certificate::with('user')->where('verification_token', $token)->first();
            
            if ($bukuBiru) {
                $document = (object)[
                    'user_name' => $bukuBiru->user->name,
                    'user_email' => $bukuBiru->user->email,
                    'document_title' => 'Rekapitulasi Buku Biru Akademik',
                    'status' => $bukuBiru->tte_status,
                    'signer_name' => 'Admin HIMAFI / Program Studi',
                    // PERBAIKAN: Gunakan Carbon::parse
                    'signed_at' => $bukuBiru->tte_approved_at ? Carbon::parse($bukuBiru->tte_approved_at) : null,
                    'verification_token' => $bukuBiru->verification_token,
                    // PERBAIKAN: Gunakan Carbon::parse
                    'created_at' => Carbon::parse($bukuBiru->updated_at),
                    'file_path' => null // Ditambahkan agar tidak error undefined property
                ];
            }
        }

        if(!$document) {
            abort(404, 'Dokumen tidak ditemukan atau token tidak valid.');
        }
        
        $qrCode = QrCode::size(150)->generate(route('tte.verify', $token));

        return view('pages.tte.verify', compact('document', 'qrCode'));
    }

    // 6. Download QR Code (Public)
    public function downloadQr($token) {
        $document = Document::where('verification_token', $token)->first();
        $docTitle = '';

        // PERBAIKAN: Deteksi apakah ini dokumen biasa atau buku biru
        if (!$document) {
            $bukuBiru = Certificate::with('user')->where('verification_token', $token)->firstOrFail();
            $docTitle = 'Buku_Biru_' . $bukuBiru->user->name;
        } else {
            $docTitle = $document->document_title;
        }
        
        $url = route('tte.verify', $token);
        
        // Menggunakan SVG agar kompatibel di semua server tanpa extension Imagick
        $qrCode = QrCode::size(500)
                        ->margin(2)
                        ->generate($url);

        // Return sebagai file download SVG
        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="QR_TTE_' . Str::slug($docTitle) . '.svg"');
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN (MANAJEMEN TTE)
    |--------------------------------------------------------------------------
    */

    // 7. List Dokumen & Buku Biru (Admin)
    public function adminIndex() {
        // Ambil data pengajuan dokumen umum (Surat, Proposal, dll)
        $documents = Document::latest()->paginate(10, ['*'], 'doc_page');

        // Ambil data pengajuan TTE Buku Biru (Hanya yang statusnya tidak null)
        $bukuBirus = Certificate::with('user')
                        ->whereNotNull('tte_status')
                        ->orderByRaw("FIELD(tte_status, 'pending', 'approved', 'rejected')")
                        ->latest()
                        ->paginate(10, ['*'], 'bb_page');

        return view('pages.admin.tte.index', compact('documents', 'bukuBirus'));
    }

    // ===================================================
    // AKSI DOKUMEN UMUM
    // ===================================================

    // 8. Approve / Tanda Tangani Dokumen Umum
    public function approve($id) {
        $doc = Document::findOrFail($id);
        
        $doc->update([
            'status' => 'approved',
            'signer_name' => Auth::user()->name, // Admin yang login
            'signed_at' => now(),
        ]);

        return back()->with('success', 'Dokumen berhasil ditanda tangani secara digital.');
    }

    // 9. Reject Dokumen Umum
    public function reject($id) {
        Document::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('error', 'Dokumen ditolak.');
    }

    // 10. Hapus Permanen Dokumen Umum
    public function destroy($id) {
        $doc = Document::findOrFail($id);

        // Hapus file fisik dari storage
        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();
        return back()->with('success', 'Dokumen dan file berhasil dihapus permanen.');
    }

    // ===================================================
    // AKSI BUKU BIRU
    // ===================================================

    // 11. Approve TTE Buku Biru
    public function approveBukuBiru($id) {
        $bukuBiru = Certificate::findOrFail($id);
        
        $bukuBiru->update([
            'tte_status' => 'approved',
            'tte_approved_at' => now(),
            'tte_note' => null // Bersihkan catatan jika sebelumnya ditolak
        ]);

        return back()->with('success', 'TTE Buku Biru berhasil divalidasi dan disetujui.');
    }

    // 12. Reject TTE Buku Biru
    public function rejectBukuBiru(Request $request, $id) {
        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        $bukuBiru = Certificate::findOrFail($id);
        
        $bukuBiru->update([
            'tte_status' => 'rejected',
            'tte_note' => $request->note, // Simpan alasan penolakan
        ]);

        return back()->with('error', 'Permohonan TTE Buku Biru dikembalikan ke mahasiswa.');
    }
}