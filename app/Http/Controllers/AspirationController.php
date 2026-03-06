<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    // --- PUBLIC SIDE ---

    public function index() {
        return view('pages.aspirasi.index');
    }

    public function store(Request $request) {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            // Nama/Email wajib jika TIDAK anonim
            'name' => 'required_without:is_anonymous', 
            'email' => 'required_without:is_anonymous|nullable|email',
        ]);

        Aspiration::create([
            'name' => $request->is_anonymous ? null : $request->name,
            'email' => $request->is_anonymous ? null : $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return back()->with('success', 'Aspirasi Anda berhasil dikirim. Terima kasih atas masukan Anda!');
    }

    // --- ADMIN SIDE ---

    public function adminIndex() {
        $aspirations = Aspiration::latest()->paginate(10);
        return view('pages.admin.aspirasi.index', compact('aspirations'));
    }

    public function markAsRead($id) {
        $asp = Aspiration::findOrFail($id);
        $asp->update(['is_read' => true]);
        return back();
    }

    public function destroy($id) {
        Aspiration::findOrFail($id)->delete();
        return back()->with('success', 'Data aspirasi dihapus.');
    }
}