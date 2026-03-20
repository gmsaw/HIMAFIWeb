<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Respon - {{ $form->title }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #1e293b; padding-bottom: 15px; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; color: #1e293b; }
        .header p { margin: 5px 0 0; color: #64748b; font-size: 12px; }
        
        .field-box { margin-bottom: 20px; page-break-inside: avoid; }
        .label { font-weight: bold; font-size: 12px; color: #64748b; text-transform: uppercase; margin-bottom: 4px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px; }
        .value { font-size: 15px; margin-top: 5px; }
        
        .signature-container { margin-top: 10px; text-align: right; width: 100%; }
        .signature-box { border: 1px dashed #cbd5e1; padding: 10px; display: inline-block; text-align: center; width: 250px;}
        .signature-img { max-width: 100%; max-height: 100px; display: block; margin: 0 auto; }
        .signature-name { margin-top: 5px; font-weight: bold; border-top: 1px solid #333; padding-top: 5px;}
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; font-size: 10px; text-align: center; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $form->title }}</h1>
        <p>Rekapitulasi Pengisian Formulir Online HIMAFI UNUD<br>
        Disubmit pada: {{ $submission->created_at->format('d F Y, H:i') }} WITA</p>
    </div>

    <table width="100%" cellpadding="0" cellspacing="0">
        @foreach($form->fields as $field)
            @php 
                $answer = $submission->answers[$field['name']] ?? '-'; 
                if(is_array($answer)) { $answer = implode(', ', $answer); }
            @endphp
            
            <tr>
                <td>
                    <div class="field-box">
                        <div class="label">{{ $field['label'] }}</div>
                        
                        <div class="value">
                            @if($field['type'] == 'signature' && !empty($answer) && $answer !== '-')
                                <div class="signature-container">
                                    <div class="signature-box">
                                        <img src="{{ $answer }}" class="signature-img" alt="Tanda Tangan">
                                        <div class="signature-name">Tanda Tangan Elektronik Sah</div>
                                    </div>
                                </div>
                            @else
                                {{ $answer }}
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="footer">
        Dokumen ini dicetak secara otomatis dari Sistem Laboratorium Virtual HIMAFI UNUD. <br>
        ID Respon: #{{ str_pad($submission->id, 5, '0', STR_PAD_LEFT) }} | Validasi Integritas Sistem.
    </div>

</body>
</html>