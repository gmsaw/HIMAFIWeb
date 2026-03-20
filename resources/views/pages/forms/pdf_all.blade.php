<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekapitulasi - {{ $form->title }}</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px; 
            color: #333; 
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            padding-bottom: 10px;
            border-bottom: 2px solid #1e293b;
        }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #64748b; font-size: 11px; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: auto;
        }
        th, td {
            border: 1px solid #94a3b8;
            padding: 6px;
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
        }
        th {
            background-color: #f1f5f9;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        tr:nth-child(even) { background-color: #f8fafc; }
        
        .signature-img { 
            max-height: 35px; 
            max-width: 80px; 
            display: block; 
        }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h1>REKAPITULASI: {{ $form->title }}</h1>
        <p>Total Responden: {{ $submissions->count() }} | Dicetak pada: {{ now()->format('d M Y, H:i') }} WITA</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="3%">No</th>
                <th width="12%">Waktu Submit</th>
                @foreach($form->fields as $field)
                    <th>{{ $field['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $index => $submission)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                    
                    @foreach($form->fields as $field)
                        @php 
                            $answer = $submission->answers[$field['name']] ?? '-'; 
                            if(is_array($answer)) { $answer = implode(', ', $answer); }
                        @endphp
                        
                        <td>
                            @if($field['type'] == 'signature' && !empty($answer) && $answer !== '-')
                                <img src="{{ $answer }}" class="signature-img" alt="TTE">
                            @else
                                {{ $answer }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($form->fields) + 2 }}" class="text-center">Belum ada data responden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>