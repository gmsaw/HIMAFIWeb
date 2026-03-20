<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HilbertController extends Controller
{
    public function index(Request $request)
    {
        // 1. Menentukan filter leaderboard (today / monthly)
        $filter = $request->query('filter', 'today');

        // 2. Query untuk Leaderboard (Papan Peringkat)
        $query = StudySession::selectRaw('user_id, SUM(duration_minutes) as total_minutes')
            ->groupBy('user_id')
            ->orderByDesc('total_minutes')
            ->limit(10); // Ambil top 10

        if ($filter === 'monthly') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        $leaderboards = $query->with('user')->get();

        // ========================================================
        // 3. STATISTIK PROFIL USER SAAT INI (Untuk Modal Laporan)
        // ========================================================
        $userId = Auth::id();
        
        // Total Fokus Hari Ini
        $myTotalToday = StudySession::where('user_id', $userId)
                        ->whereDate('created_at', Carbon::today())
                        ->sum('duration_minutes');
                        
        // Total Fokus Minggu Ini
        $myTotalThisWeek = StudySession::where('user_id', $userId)
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->sum('duration_minutes');
                        
        // Total Fokus Bulan Ini
        $myTotalThisMonth = StudySession::where('user_id', $userId)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->sum('duration_minutes');
                        
        // Total Fokus Sepanjang Masa
        $myTotalAllTime = StudySession::where('user_id', $userId)
                        ->sum('duration_minutes');

        // Riwayat 5 sesi terakhir (Untuk Timeline)
        $myRecentSessions = StudySession::where('user_id', $userId)
                        ->latest()
                        ->limit(5)
                        ->get();

        // Kirim semua variabel ke tampilan Blade
        return view('pages.hilbert.index', compact(
            'leaderboards', 
            'filter', 
            'myTotalToday', 
            'myTotalThisWeek', 
            'myTotalThisMonth', 
            'myTotalAllTime', 
            'myRecentSessions'
        ));
    }

    // API untuk menyimpan sesi saat timer selesai
    public function saveSession(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1'
        ]);

        StudySession::create([
            'user_id' => Auth::id(),
            'duration_minutes' => $request->duration
        ]);

        return response()->json(['status' => 'success', 'message' => 'Sesi belajar berhasil disimpan!']);
    }
}