<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PublicLibraryController extends Controller
{
    public function index(Request $request) {
        $query = Book::query();

        // 1. Fitur Cari (LOGIKA DIPERBAIKI)
        // Kita bungkus dalam function($q) agar logika OR tidak merusak filter Kategori
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                  ->orWhere('author', 'like', '%'.$search.'%');
            });
        }

        // 2. Fitur Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Ambil data terbaru, paginasi 12 per halaman, dan pertahankan query string saat ganti halaman
        $books = $query->latest()->paginate(12)->withQueryString();
        
        return view('pages.library.index', compact('books'));
    }

    public function show($id)
    {
        // Cari buku berdasarkan ID, jika tidak ketemu otomatis 404
        $book = Book::findOrFail($id);
        
        return view('pages.library.show', compact('book'));
    }
}