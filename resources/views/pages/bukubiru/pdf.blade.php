<!DOCTYPE html>
<html>
<head>
    <title>Buku Biru - {{ $user->name }}</title>
    <style>
        body { 
            font-family: sans-serif; 
            font-size: 12px; 
            color: #333;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid black; 
            padding-bottom: 15px; 
        }
        .header h1 { 
            margin: 0 0 5px 0; 
            font-size: 20px; 
            text-transform: uppercase; 
            letter-spacing: 1px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
            color: #555;
        }
        .info-table { 
            width: 100%; 
            margin-bottom: 20px; 
        }
        .info-table td {
            padding: 4px 0;
            border: none;
        }
        .info-table td:first-child {
            width: 120px;
            font-weight: bold;
        }
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
        }
        table.data-table th, table.data-table td { 
            border: 1px solid #000; 
            padding: 8px; 
            text-align: left; 
        }
        table.data-table th { 
            background-color: #f2f2f2; 
            text-transform: uppercase;
            font-size: 11px;
        }
        .status-valid { 
            color: #166534; 
            font-weight: bold; 
        }
        
        /* --- STYLING UNTUK TTE --- */
        .signature-section {
            width: 320px;
            float: right;
            text-align: center;
            margin-top: 30px;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rekapitulasi Buku Biru Mahasiswa</h1>
        <p>Himpunan Mahasiswa Fisika Universitas Udayana</p>
    </div>

    <table class="info-table">
        <tr>
            <td>Nama Lengkap</td>
            <td>: {{ $user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{ $user->email }}</td>
        </tr>
        <tr>
            <td>Tanggal Cetak</td>
            <td>: {{ now()->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <h3 style="margin-bottom: 10px; font-size: 14px;">Daftar Kegiatan Terverifikasi</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 35%;">Nama Kegiatan</th>
                <th style="width: 25%;">Kategori</th>
                <th style="width: 20%;">Tanggal Pelaksanaan</th>
                <th style="width: 15%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($certificates as $cert)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $cert->activity_name }}</td>
                <td>{{ $cert->category }}</td>
                <td>{{ \Carbon\Carbon::parse($cert->activity_date)->translatedFormat('d M Y') }}</td>
                <td style="text-align: center;">
                    @if($cert->status == 'approved') 
                        <span class="status-valid">VALID</span>
                    @else 
                        {{ strtoupper($cert->status) }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Belum ada kegiatan yang diverifikasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- BAGIAN TANDA TANGAN ELEKTRONIK & QR CODE --}}
    <div class="signature-section">
        <p style="margin: 0 0 5px 0;">Jimbaran, {{ \Carbon\Carbon::parse($bukuBiru->tte_approved_at ?? now())->translatedFormat('d F Y') }}</p>
        <p style="margin: 0; font-weight: bold;">Mengetahui,</p>
        <p style="margin: 0 0 10px 0;">Ketua Himpunan Mahasiswa Fisika</p>

        @if($bukuBiru && $bukuBiru->tte_status == 'approved')
            
            @php
                // 1. Generate URL Verifikasi berdasarkan Token Buku Biru
                $verifyUrl = route('tte.verify', $bukuBiru->verification_token);
                
                // 2. Generate QR Code menjadi SVG, lalu konversi ke string base64 agar aman di render oleh dompdf
                $qrCodeSvg = QrCode::size(80)->margin(0)->generate($verifyUrl);
                $qrCodeBase64 = base64_encode((string) $qrCodeSvg);
            @endphp

            {{-- 3. Tampilkan QR Code berdampingan dengan teks stempel TTE --}}
            <table style="margin: 10px auto; border: none; width: auto; border-collapse: collapse;">
                <tr>
                    <td style="border: none; padding: 0 10px 0 0; vertical-align: middle;">
                        {{-- Render Base64 SVG Image --}}
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" style="width: 75px; height: 75px;" alt="QR Code Validasi">
                    </td>
                    <td style="border: none; padding: 0; vertical-align: middle; text-align: left;">
                        <div style="color: #2563eb; font-family: monospace; border-left: 2px solid #2563eb; padding-left: 10px;">
                            <strong style="font-size: 11px; text-transform: uppercase;">Disahkan Secara<br>Elektronik</strong><br>
                            <span style="font-size: 10px; color: #1e3a8a; margin-top: 4px; display: block;">ID: {{ $bukuBiru->verification_token }}</span>
                        </div>
                    </td>
                </tr>
            </table>

        @else
            {{-- Jika dipaksa cetak tapi belum TTE, sediakan ruang tanda tangan basah / manual --}}
            <div style="height: 75px;"></div>
        @endif

        <p style="margin: 0;">Gede Mahendra Sastra Adhi Wiguna</p>
    </div>
    
    <div class="clear"></div>

</body>
</html>