<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan HIMAFI</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .income { color: green; }
        .expense { color: red; }
        .summary { margin-top: 20px; width: 40%; float: right; }
        .summary table { border: none; }
        .summary td { border: none; padding: 5px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Keuangan Himpunan Mahasiswa Fisika</h2>
        <p>Universitas Udayana - Kabinet Arunika Swakarsa</p>
        <p>Periode: {{ \Carbon\Carbon::parse($start)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($end)->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th class="text-right">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->date->format('d/m/Y') }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}</td>
                <td class="text-right {{ $item->type == 'income' ? 'income' : 'expense' }}">
                    {{ number_format($item->amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td><strong>Total Pemasukan:</strong></td>
                <td class="text-right income">+ Rp {{ number_format($income, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Pengeluaran:</strong></td>
                <td class="text-right expense">- Rp {{ number_format($expense, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border-top: 2px solid #000;"><strong>Surplus/Defisit:</strong></td>
                <td class="text-right" style="border-top: 2px solid #000;">
                    <strong>Rp {{ number_format($income - $expense, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>