<?php

namespace App\Exports;

use App\Models\Finance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FinanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return Finance::whereBetween('date', [$this->start_date, $this->end_date])
                      ->orderBy('date', 'asc')
                      ->get();
    }

    // Header Kolom di Excel
    public function headings(): array
    {
        return [
            'Tanggal',
            'Keterangan',
            'Jenis Transaksi',
            'Nominal (Rp)',
            'Dibuat Pada'
        ];
    }

    // Mapping Data per Baris
    public function map($finance): array
    {
        return [
            $finance->date->format('d/m/Y'),
            $finance->description,
            $finance->type == 'income' ? 'Pemasukan' : 'Pengeluaran',
            $finance->amount,
            $finance->created_at->format('d/m/Y H:i'),
        ];
    }

    // Styling (Bold Header)
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}