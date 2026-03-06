<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLibraryController extends Controller
{
    public function index() {
        $books = Book::latest()->paginate(10);
        return view('pages.admin.library.index', compact('books'));
    }

    public function create() {
        return view('pages.admin.library.create');
    }

    public function store(Request $request) {
        // PERBAIKAN: Masukkan semua input form ke dalam validasi agar tidak dibuang oleh Laravel
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'nullable|string|max:255',
            'year'        => 'required|digits:4',
            'category'    => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'file_path'   => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'file_url'    => 'nullable|url', // Untuk link Google Drive
        ]);

        // Proses Upload Foto Sampul
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }
        
        // Proses Upload File PDF Lokal
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('ebooks', 'public');
        }

        // Simpan semua data yang sudah divalidasi ke database
        Book::create($validated);
        
        return redirect()->route('admin.library.index')->with('success', 'Buku berhasil ditambahkan!');
    }
    
    // Tambahkan method edit/update/destroy sesuai kebutuhan nanti
    public function destroy($id) {
        $book = Book::findOrFail($id);
        
        // Hapus file fisik dari storage jika ada
        if($book->cover_image) Storage::disk('public')->delete($book->cover_image);
        if($book->file_path) Storage::disk('public')->delete($book->file_path);
        
        $book->delete();
        
        return back()->with('success', 'Buku berhasil dihapus');
    }
}