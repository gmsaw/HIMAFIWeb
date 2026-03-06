<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInventoryController extends Controller
{
    // Tampilkan Daftar Barang
    public function index(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Inventory::query();

        // 2. Logika Pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('code', 'LIKE', '%' . $search . '%');
            });
        }

        // 3. Logika Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // 4. Logika Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // 5. Ambil data dengan Pagination (10 item per halaman)
        // withQueryString() penting agar filter tidak hilang saat pindah halaman
        $items = $query->latest()->paginate(10)->withQueryString();

        return view('pages.admin.inventory.index', compact('items'));
    }

    // Simpan Barang Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:inventories,code',
            'category' => 'required',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('inventory-images', 'public');
        }

        Inventory::create($validated);

        return back()->with('success', 'Barang berhasil ditambahkan!');
    }

    // Update Barang
    public function update(Request $request, $id)
    {
        $item = Inventory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'quantity' => 'required|integer|min:0',
            'condition' => 'required',
            'status' => 'required'
        ]);

        if ($request->file('image')) {
            // Hapus gambar lama
            if($item->image) Storage::disk('public')->delete($item->image);
            $validated['image'] = $request->file('image')->store('inventory-images', 'public');
        }

        $item->update($validated);

        return back()->with('success', 'Data barang diperbarui!');
    }

    // Hapus Barang
    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
        if($item->image) Storage::disk('public')->delete($item->image);
        $item->delete();
        
        return back()->with('success', 'Barang berhasil dihapus.');
    }
}