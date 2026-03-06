<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\FinanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminFinanceController extends Controller
{
    /**
     * Tampilkan halaman utama Manajemen Kas.
     */
    public function index(Request $request)
    {
        $query = Finance::query();

        // --- FILTER BULAN ---
        if ($request->has('filter_month') && $request->filter_month != '') {
            // Input type="month" formatnya "YYYY-MM"
            $year = substr($request->filter_month, 0, 4);
            $month = substr($request->filter_month, 5, 2);
            
            $query->whereYear('date', $year)
                  ->whereMonth('date', $month);
        }

        // Ambil data transaksi yang sudah difilter (jika ada) dan di-paginate
        $transactions = $query->latest('date')->paginate(10)->withQueryString();

        // Hitung Ringkasan (Tetap ambil total keseluruhan, bukan yang difilter, agar saldo akurat)
        // Saldo biasanya bersifat kumulatif sejak awal pembukuan
        $totalIncome = Finance::where('type', 'income')->sum('amount');
        $totalExpense = Finance::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        return view('pages.admin.finance.index', compact('transactions', 'totalIncome', 'totalExpense', 'currentBalance'));
    }

    /**
     * Simpan transaksi baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048', // Validasi Gambar Nota (Maks 2MB)
        ]);

        // Upload Gambar Nota jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('finance-proofs', 'public');
        }

        // Simpan ke database
        Finance::create($validated);

        return back()->with('success', 'Transaksi berhasil dicatat!');
    }

    /**
     * Hapus transaksi beserta bukti gambarnya.
     */
    public function destroy($id)
    {
        $finance = Finance::findOrFail($id);
        
        // Hapus file gambar di storage jika ada
        if ($finance->image) {
            Storage::disk('public')->delete($finance->image);
        }
        
        $finance->delete();
        return back()->with('success', 'Data transaksi berhasil dihapus.');
    }

    /**
     * Export laporan keuangan berdasarkan rentang tanggal dan tipe file (PDF/Excel).
     */
    public function export(Request $request)
    {
        // Validasi input tanggal dan tipe export
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:pdf,excel' // Memilih export PDF atau Excel
        ]);

        $start = $request->start_date;
        $end = $request->end_date;
        $filename = "Laporan_Keuangan_{$start}_sampai_{$end}";

        // --- JIKA EXPORT EXCEL ---
        if ($request->type == 'excel') {
            // Pastikan Anda sudah membuat class FinanceExport
            return Excel::download(new FinanceExport($start, $end), $filename . '.xlsx');
        }

        // --- JIKA EXPORT PDF ---
        // Ambil data dalam rentang tanggal
        $data = Finance::whereBetween('date', [$start, $end])
                       ->orderBy('date', 'asc')
                       ->get();

        // Hitung total di rentang tersebut untuk ringkasan PDF
        $totalIncome = $data->where('type', 'income')->sum('amount');
        $totalExpense = $data->where('type', 'expense')->sum('amount');

        // Pastikan view PDF berada di path yang benar (resources/views/pages/admin/finance/pdf.blade.php)
        $pdf = Pdf::loadView('pages.admin.finance.pdf', [
            'data' => $data, 
            'start' => $start, 
            'end' => $end,
            'income' => $totalIncome, 
            'expense' => $totalExpense
        ]);

        // Unduh file PDF
        return $pdf->download($filename . '.pdf');
    }
}