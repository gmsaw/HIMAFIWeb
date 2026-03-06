<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    // --- BAGIAN ADMIN (Manajemen) ---

    public function index()
    {
        $links = ShortLink::latest()->get();
        return view('pages.admin.links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|alpha_dash|unique:short_links,slug|not_in:admin,login,register,logout,dashboard', // Cegah slug yang bentrok dengan sistem
            'destination_url' => 'required|url'
        ]);

        ShortLink::create([
            'slug' => $request->slug,
            'destination_url' => $request->destination_url
        ]);

        return back()->with('success', 'Link berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $link = ShortLink::findOrFail($id);
        
        $request->validate([
            'slug' => 'required|alpha_dash|unique:short_links,slug,'.$link->id.'|not_in:admin,login,register',
            'destination_url' => 'required|url'
        ]);

        $link->update([
            'slug' => $request->slug,
            'destination_url' => $request->destination_url,
            'is_active' => $request->has('is_active')
        ]);

        return back()->with('success', 'Link berhasil diperbarui.');
    }

    public function destroy($id)
    {
        ShortLink::findOrFail($id)->delete();
        return back()->with('success', 'Link dihapus.');
    }

    // --- BAGIAN PUBLIC (Redirect Logic) ---

    public function handleRedirect($slug)
    {
        // Cari slug di database
        $link = ShortLink::where('slug', $slug)->first();

        // Jika ada dan aktif
        if ($link && $link->is_active) {
            // Tambah counter visit
            $link->increment('visits');
            
            // Redirect ke link asli
            return redirect()->away($link->destination_url);
        }

        // Jika tidak ketemu, biarkan Laravel menangani 404 atau redirect ke home
        abort(404); 
    }
}