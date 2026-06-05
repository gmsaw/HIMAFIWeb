<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Carbon\Carbon;

class BackupController extends Controller
{
    // 1. Menampilkan Halaman Daftar Backup
    public function index()
    {
        $backupDir = storage_path('app/backups');
        
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $backups = collect(File::files($backupDir))->map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'size' => round($file->getSize() / 1048576, 2),
                'date' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
            ];
        })->sortByDesc('date')->values();

        // Ambil waktu backup terakhir (file teratas karena sudah di-sort)
        $lastBackup = $backups->first() ? $backups->first()['date'] : null;

        return view('pages.admin.backup.index', compact('backups', 'lastBackup'));
    }

    // 2. Proses Generate File Backup
    public function generate()
    {
        if (!extension_loaded('zip')) {
            return back()->with('error', 'Ekstensi PHP ZipArchive tidak aktif di server.');
        }

        $backupDir = storage_path('app/backups');
        $zipFileName = 'Backup_HIMAFI_' . Carbon::now()->format('Y-m-d_H-i-s') . '.zip';
        $zipFilePath = $backupDir . '/' . $zipFileName;

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            $tables = ['users', 'orbits', 'inventories', 'finances', 'buku_birus', 'aspirations', 'posts', 'documents', 'certificates'];
            foreach ($tables as $table) {
                if (Schema::hasTable($table)) {
                    $data = DB::table($table)->get();
                    if ($data->count() > 0) {
                        $csvData = fopen('php://temp', 'r+');
                        fputcsv($csvData, array_keys((array) $data->first()));
                        foreach ($data as $row) {
                            fputcsv($csvData, (array) $row);
                        }
                        rewind($csvData);
                        $csvContent = stream_get_contents($csvData);
                        fclose($csvData);
                        $zip->addFromString('Database_Backup/' . strtoupper($table) . '_DATA.csv', $csvContent);
                    }
                }
            }

            $storagePath = storage_path('app/public');
            if (File::exists($storagePath)) {
                $files = File::allFiles($storagePath);
                foreach ($files as $file) {
                    $relativePath = str_replace($storagePath . DIRECTORY_SEPARATOR, '', $file->getRealPath());
                    $zip->addFile($file->getRealPath(), 'File_Uploads/' . str_replace('\\', '/', $relativePath));
                }
            }

            $zip->close();
            
            return redirect()->route('admin.backup.index')->with('success', 'File Backup baru berhasil dibuat!');
        }

        return back()->with('error', 'Gagal membuat file backup ZIP.');
    }

    // 3. Mengunduh File
    public function download($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);
        if (File::exists($filePath)) {
            return response()->download($filePath);
        }
        return back()->with('error', 'File tidak ditemukan.');
    }

    // 4. Menghapus File Backup
    public function destroy(Request $request, $filename)
    {
        if (strtolower($request->konfirmasi_text) !== 'konfirmasi') {
            return back()->with('error', 'Kata konfirmasi tidak cocok. File batal dihapus.');
        }

        $filePath = storage_path('app/backups/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
            return back()->with('success', 'File backup berhasil dihapus.');
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }

    // 5. MENGHAPUS SEMUA DATA WEBSITE (RESET)
    public function wipeData(Request $request)
    {
        if (strtolower($request->konfirmasi_text) !== 'konfirmasi') {
            return back()->with('error', 'Kata konfirmasi tidak cocok. Reset data dibatalkan.');
        }

        try {
            // A. Hapus isi Database (Kecuali Admin)
            Schema::disableForeignKeyConstraints();
            
            // Hapus tabel operasional
            $tablesToTruncate = ['orbits', 'inventories', 'finances', 'buku_birus', 'aspirations', 'posts', 'documents', 'certificates'];
            foreach ($tablesToTruncate as $table) {
                if (Schema::hasTable($table)) {
                    DB::table($table)->truncate();
                }
            }

            // Hapus semua user KECUALI admin agar website tidak terkunci
            DB::table('users')->where('role', '!=', 'admin')->delete();

            Schema::enableForeignKeyConstraints();

            // B. Hapus file upload di storage/app/public (Sisakan .gitignore)
            $storagePath = storage_path('app/public');
            if (File::exists($storagePath)) {
                $directories = File::directories($storagePath);
                foreach ($directories as $directory) {
                    File::deleteDirectory($directory); // Hapus folder di dalamnya (orbit, dll)
                }
                
                $files = File::files($storagePath);
                foreach ($files as $file) {
                    if ($file->getFilename() !== '.gitignore') {
                        File::delete($file); // Hapus file satuan
                    }
                }
            }

            return back()->with('success', 'Berhasil! Seluruh data operasional dan file website telah dihapus (Akun Admin tetap aman).');

        } catch (\Exception $e) {
            Schema::enableForeignKeyConstraints();
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}