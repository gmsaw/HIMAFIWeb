@if(!$data)
    <span class="inline-flex items-center gap-1 text-gray-400 text-xs">
        <i class="fas fa-minus-circle"></i> Belum ada
    </span>
@elseif($data->status == 'pending')
    <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">
        <i class="fas fa-clock"></i> Verifikasi
    </span>
@elseif($data->status == 'approved')
    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">
        <i class="fas fa-check-circle"></i> Valid
    </span>
@else
    <div class="flex flex-col items-start">
        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold mb-1">
            <i class="fas fa-times-circle"></i> Ditolak
        </span>
        @if($data->admin_note)
        <span class="text-[10px] text-red-500 italic max-w-[150px] leading-tight">"{{ $data->admin_note }}"</span>
        @endif
    </div>
@endif