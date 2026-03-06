<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with('author')->where('is_published', true)->latest()->get();
        return view('pages.blog.artikel', ['activePage' => 'blog']);
    }
}
