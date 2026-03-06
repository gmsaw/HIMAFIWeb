<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Inventory;
use App\Models\Finance;
use App\Models\Certificate;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Keuangan (Saldo)
        $totalIncome = Finance::where('type', 'income')->sum('amount');
        $totalExpense = Finance::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        // 2. Data User
        $totalUsers = User::count();
        // Opsional: Hitung user yang belum di-approve jika ada fitur approval
        $pendingUsers = User::where('is_approved', false)->count(); 

        // 3. Data Blog
        $totalPosts = Post::count();
        
        // 4. Data Inventaris
        $totalItems = Inventory::sum('quantity'); // Total seluruh barang
        $borrowedItems = Inventory::where('status', 'borrowed')->count(); // Barang yang sedang dipinjam
        
        // 5. Data TTE / Surat (Contoh logika)
        $pendingTTE = Certificate::where('status', 'pending')->count();

        return view('pages.admin.dashboard', compact(
            'currentBalance',
            'totalUsers',
            'pendingUsers',
            'totalPosts',
            'borrowedItems',
            'totalItems',
            'pendingTTE'
        ));
    }

    public function users()
    {
        // 1. Ambil user yang MENUNGGU (Pending)
        $pendingUsers = User::where('is_approved', false)->get();
        
        // 2. Ambil user yang SUDAH AKTIF (Approved) untuk tabel kedua
        $activeUsers = User::where('is_approved', true)->orderBy('name', 'asc')->get();
        
        return view('pages.admin.tableusers', compact('pendingUsers', 'activeUsers'));
    }

    // Method baru untuk update role
    public function updateUserRole(Request $request, $id)
{
    // 1. Validasi input agar sesuai dengan opsi ENUM di database
    $request->validate([
        'role' => 'required|in:admin,sekretaris,bendahara,anggota,mahasiswa,eksternal',
    ]);

    // 2. Cari User
    $user = User::findOrFail($id);

    // 3. Update Role
    $user->update([
        'role' => $request->role
    ]);

    // 4. Kembali dengan pesan sukses
    return back()->with('success', "Role pengguna {$user->name} berhasil diubah menjadi " . ucfirst($request->role));
}

    // Tambahkan method ini di paling bawah class
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // 1. Cek apakah admin mencoba menghapus dirinya sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login.');
        }

        // 2. Cek apakah user yang dihapus adalah admin lain (Opsional: Proteksi ganda)
        // if ($user->role == 'admin') { ... }

        // 3. Hapus user
        $user->delete();

        return back()->with('success', 'Pengguna ' . $user->name . ' berhasil dihapus dari sistem.');
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return back()->with('success', 'User ' . $user->name . ' berhasil disetujui!');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Hapus user jika ditolak

        return back()->with('success', 'User berhasil ditolak dan dihapus.');
    }
}