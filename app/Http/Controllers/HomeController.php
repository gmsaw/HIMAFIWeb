<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 2. Ambil data artikel dari database
        $latestPosts = Post::where('is_published', true)
                           ->latest() // Urutkan terbaru
                           ->take(3)  // Ambil 3 saja
                           ->get();

        // 3. Kirim data '$latestPosts' ke View
        return view('pages.home', [
            'activePage' => 'beranda',
            'latestPosts' => $latestPosts // <--- Masukkan ke array ini
        ]);
    }
}
