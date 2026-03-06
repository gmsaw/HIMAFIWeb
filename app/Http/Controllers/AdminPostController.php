<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    // 1. Tampilkan Daftar Blog
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('pages.admin.blog.index', compact('posts'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('pages.admin.blog.create');
    }

    // 3. Simpan Blog Baru (Dengan Logika Block Builder)
    public function store(Request $request)
    {
        // Validasi input dasar dan array blocks
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'blocks' => 'required|array', // Memastikan blocks dikirim
        ]);

        // Upload Thumbnail Utama
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blog/thumbnails', 'public');
        }

        // Proses perakitan Block Builder menjadi 1 string HTML
        $htmlContent = '';
        
        if ($request->has('blocks')) {
            foreach ($request->blocks as $index => $block) {
                
                // JIKA BLOK TEKS (PARAGRAF)
                if ($block['type'] === 'text' && !empty($block['content'])) {
                    // nl2br mengubah enter menjadi <br>, htmlspecialchars mencegah XSS script
                    $text = nl2br(htmlspecialchars($block['content']));
                    $htmlContent .= '<p class="mb-5 text-slate-700 leading-loose text-justify">' . $text . '</p>';
                } 
                
                // JIKA BLOK GAMBAR (SISIPAN DALAM ARTIKEL)
                elseif ($block['type'] === 'image' && $request->hasFile("blocks.{$index}.image")) {
                    // Upload gambar sisipan ke folder berbeda
                    $imagePath = $request->file("blocks.{$index}.image")->store('blog/images', 'public');
                    // Buat full URL
                    $imageUrl = asset('storage/' . $imagePath);
                    
                    // Bungkus gambar dengan styling Tailwind
                    $htmlContent .= '<div class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-100 bg-slate-50">';
                    $htmlContent .= '<img src="' . $imageUrl . '" class="w-full h-auto object-cover" alt="Ilustrasi Artikel">';
                    $htmlContent .= '</div>';
                }

                // JIKA BLOK RUMUS (EQUATION LATEX)
                elseif ($block['type'] === 'equation' && !empty($block['content'])) {
                    $latexCode = htmlspecialchars($block['content']);
                    // Bungkus dengan \[ ... \] agar dibaca oleh MathJax sebagai rumus Block/Display
                    $htmlContent .= '<div class="my-6 py-4 overflow-x-auto text-center text-lg">\\[ ' . $latexCode . ' \\]</div>';
                }
            }
        }

        // Simpan ke Database
        Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'thumbnail' => $thumbnailPath,
            'content' => $htmlContent, // Menyimpan hasil rakitan HTML
            'user_id' => Auth::id(), // ID penulis
            'slug' => Str::slug($request->title) . '-' . time(), // Slug unik
            'is_published' => true
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    // 4. Hapus Blog
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Hapus gambar thumbnail lama dari storage jika ada
        if($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Catatan: Jika ingin lebih bersih, Anda juga bisa membuat script untuk 
        // mengekstrak URL gambar sisipan di dalam $post->content menggunakan Regex 
        // lalu menghapusnya dari storage. Namun untuk sekarang, menghapus record post sudah cukup.

        $post->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}