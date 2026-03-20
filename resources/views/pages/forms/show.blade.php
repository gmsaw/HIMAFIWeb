@extends('layouts.app')
@section('title', $form->title)

@php
    $activePage = 'forms'; 
    $useTransparentHeader = false; 
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100">
    <div class="container px-4 mx-auto max-w-3xl pt-28 pb-20">
        
        {{-- Alert Success with Animation --}}
        @if(session('success'))
            <div class="relative mb-8 overflow-hidden bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-2xl shadow-lg animate-pulse">
                <div class="flex items-center gap-3 px-5 py-4">
                    <div class="p-2 bg-emerald-100 rounded-full">
                        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-emerald-800">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Error Alert --}}
        @if($errors->any())
            <div class="relative mb-8 overflow-hidden bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-2xl shadow-lg">
                <div class="flex items-start gap-3 px-5 py-4">
                    <div class="p-2 bg-red-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-red-800 mb-1">Perhatian!</p>
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Main Form Card --}}
        <div class="overflow-hidden transition-all duration-300 bg-white rounded-3xl shadow-2xl shadow-slate-200/60 hover:shadow-slate-300/70">
            {{-- Header with Gradient --}}
            <div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 p-8 md:p-10">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="px-2 py-0.5 bg-white/20 rounded-full text-white/90 text-xs font-semibold backdrop-blur-sm">
                            <i class="fas fa-file-alt mr-1"></i> Formulir Digital
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-3 leading-tight">{{ $form->title }}</h1>
                    @if($form->description)
                        <p class="text-blue-100 text-base md:text-lg leading-relaxed">{{ $form->description }}</p>
                    @endif
                </div>
                <div class="absolute bottom-0 right-0 opacity-10">
                    <i class="fas fa-pen-fancy text-8xl"></i>
                </div>
            </div>

            <form action="{{ route('form.submit', $form->slug) }}" method="POST" id="form-submit" class="p-6 md:p-8 space-y-8">
                @csrf

                @foreach($form->fields as $index => $field)
                    <div class="group relative transition-all duration-200 hover:translate-x-1" data-field-type="{{ $field['type'] }}" data-field-name="{{ $field['name'] }}">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                            <div class="p-5 md:p-6">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-sm font-bold shadow-md">
                                        {{ $index + 1 }}
                                    </div>
                                    <label class="flex-1 text-base md:text-lg font-bold text-slate-800 leading-relaxed">
                                        {{ $field['label'] }}
                                        @if($field['required'])
                                            <span class="ml-1 text-red-500 text-sm font-semibold">
                                                <i class="fas fa-asterisk text-[10px] align-top"></i>
                                            </span>
                                        @endif
                                    </label>
                                </div>

                                @if($field['type'] == 'text')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 fas fa-font text-sm"></i>
                                        <input type="text" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ old($field['name']) }}"
                                               placeholder="Jawaban Anda..." 
                                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700 placeholder:text-slate-400"
                                               {{ $field['required'] ? 'required' : '' }}>
                                    </div>
                                
                                @elseif($field['type'] == 'email')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 fas fa-envelope text-sm"></i>
                                        <input type="email" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ old($field['name']) }}"
                                               placeholder="contoh@email.com" 
                                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700"
                                               {{ $field['required'] ? 'required' : '' }}>
                                    </div>
                                
                                @elseif($field['type'] == 'date')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 fas fa-calendar-day text-sm"></i>
                                        <input type="date" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ old($field['name']) }}"
                                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700"
                                               {{ $field['required'] ? 'required' : '' }}>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                        <i class="fas fa-info-circle text-blue-400"></i>
                                        Pilih tanggal dari kalender yang tersedia
                                    </p>
                                
                                @elseif($field['type'] == 'datetime-local')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 fas fa-calendar-alt text-sm"></i>
                                        <input type="datetime-local" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ old($field['name']) }}"
                                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700"
                                               {{ $field['required'] ? 'required' : '' }}>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                        <i class="fas fa-info-circle text-blue-400"></i>
                                        Pilih tanggal dan waktu dari kalender yang tersedia
                                    </p>
                                
                                @elseif($field['type'] == 'textarea')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-4 text-slate-400 fas fa-align-left text-sm"></i>
                                        <textarea name="{{ $field['name'] }}" 
                                                  rows="4" 
                                                  placeholder="Tulis jawaban Anda di sini..." 
                                                  class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700 resize-y"
                                                  {{ $field['required'] ? 'required' : '' }}>{{ old($field['name']) }}</textarea>
                                    </div>
                                
                                @elseif($field['type'] == 'radio')
                                    <div class="space-y-3 mt-3">
                                        @foreach($field['options'] as $opt)
                                            <label class="flex items-center gap-4 cursor-pointer p-3 rounded-xl bg-slate-50 border border-slate-200 hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 group/radio">
                                                <input type="radio" 
                                                       name="{{ $field['name'] }}" 
                                                       value="{{ $opt }}" 
                                                       class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-slate-300"
                                                       {{ $field['required'] ? 'required' : '' }}
                                                       {{ old($field['name']) == $opt ? 'checked' : '' }}>
                                                <span class="text-slate-700 font-medium group-hover/radio:text-blue-700 transition-colors">{{ $opt }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                
                                @elseif($field['type'] == 'checkbox')
                                    <div class="space-y-3 mt-3">
                                        @php
                                            $oldValues = old($field['name'], []);
                                            if (!is_array($oldValues)) $oldValues = [];
                                        @endphp
                                        @foreach($field['options'] as $opt)
                                            <label class="flex items-center gap-4 cursor-pointer p-3 rounded-xl bg-slate-50 border border-slate-200 hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 group/checkbox">
                                                <input type="checkbox" 
                                                       name="{{ $field['name'] }}[]" 
                                                       value="{{ $opt }}" 
                                                       class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 border-slate-300"
                                                       {{ in_array($opt, $oldValues) ? 'checked' : '' }}>
                                                <span class="text-slate-700 font-medium group-hover/checkbox:text-blue-700 transition-colors">{{ $opt }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                
                                @elseif($field['type'] == 'image_link')
                                    <div class="relative mt-2">
                                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 fas fa-image text-sm"></i>
                                        <input type="url" 
                                               name="{{ $field['name'] }}" 
                                               value="{{ old($field['name']) }}"
                                               placeholder="https://drive.google.com/..." 
                                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-slate-700"
                                               {{ $field['required'] ? 'required' : '' }}>
                                    </div>
                                    <div class="flex items-start gap-2 mt-2 p-2.5 bg-blue-50/50 rounded-lg border border-blue-100">
                                        <i class="fas fa-info-circle text-blue-500 text-xs mt-0.5"></i>
                                        <p class="text-[11px] text-slate-600 leading-relaxed">
                                            <span class="font-semibold text-blue-700">Catatan:</span> Pastikan tautan gambar (Google Drive) telah disetel ke <span class="font-mono bg-white px-1.5 py-0.5 rounded text-blue-800">Public (Anyone with the link)</span>
                                        </p>
                                    </div>

                                @elseif($field['type'] == 'signature')
                                    <div class="mt-3">
                                        <div class="border-2 border-dashed border-slate-300 rounded-2xl bg-gradient-to-br from-slate-50 to-white relative overflow-hidden transition-all duration-200 hover:border-blue-400 hover:shadow-md signature-container" data-field-name="{{ $field['name'] }}">
                                            <canvas id="signature-pad-{{ $field['name'] }}" 
                                                    class="w-full h-56 touch-none cursor-crosshair bg-white"
                                                    style="min-height: 200px;"></canvas>
                                            <div class="absolute bottom-3 right-3 flex gap-2">
                                                <button type="button" 
                                                        onclick="clearSignature('{{ $field['name'] }}')" 
                                                        class="bg-white/90 backdrop-blur-sm hover:bg-red-50 text-slate-600 hover:text-red-600 text-xs px-3 py-1.5 rounded-lg font-semibold transition-all shadow-sm border border-slate-200 hover:border-red-300">
                                                    <i class="fas fa-eraser mr-1"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                        <div class="signature-error-message hidden mt-2 text-xs text-red-500 flex items-center gap-1" id="signature-error-{{ $field['name'] }}">
                                            <i class="fas fa-exclamation-circle"></i>
                                            <span>Tanda tangan wajib diisi</span>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                            <i class="fas fa-pen-alt text-blue-400"></i>
                                            Tanda tangani di area di atas menggunakan mouse atau sentuhan
                                        </p>
                                    </div>
                                    <input type="hidden" name="{{ $field['name'] }}" id="signature-input-{{ $field['name'] }}" value="{{ old($field['name']) }}" {{ $field['required'] ? 'required' : '' }}>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="pt-6">
                    <button type="submit" id="submit-btn" class="group relative w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-blue-600/30 transition-all duration-300 hover:-translate-y-1 flex justify-center items-center gap-3 text-lg overflow-hidden">
                        <div class="absolute inset-0 w-0 bg-white/20 transition-all duration-300 group-hover:w-full"></div>
                        <i class="fas fa-paper-plane relative z-10 group-hover:translate-x-1 transition-transform"></i>
                        <span class="relative z-10">Kirim Formulir</span>
                        <i class="fas fa-check-circle relative z-10 opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
                    </button>
                    <p class="mt-3 text-xs text-center text-slate-400 flex items-center justify-center gap-1">
                        <i class="fas fa-lock text-[10px]"></i>
                        Data Anda aman dan akan diproses secara rahasia
                    </p>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center text-xs text-slate-400">
            <i class="fas fa-shield-alt mr-1"></i>
            Formulir ini dikelola oleh administrator. Pastikan data yang Anda isikan sudah benar.
        </div>
    </div>
</div>

@push('styles')
<style>
    .group {
        animation: fadeInUp 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1) backwards;
        animation-delay: calc(var(--order, 0) * 0.05s);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    input[type="radio"], input[type="checkbox"] {
        accent-color: #3b82f6;
        cursor: pointer;
    }
    
    /* Styling untuk date dan datetime-local inputs */
    input[type="date"], 
    input[type="datetime-local"] {
        cursor: pointer;
        color-scheme: light;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        padding: 4px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator:hover,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
        background-color: #e2e8f0;
        transform: scale(1.1);
    }
    
    canvas {
        background: repeating-linear-gradient(
            45deg,
            #f8fafc,
            #f8fafc 20px,
            #f1f5f9 20px,
            #f1f5f9 40px
        );
    }
    
    canvas:active {
        cursor: crosshair;
    }
    
    .signature-container.required-empty {
        border-color: #ef4444;
        background-color: #fef2f2;
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const signatureFields = @json(collect($form->fields)->where('type', 'signature')->pluck('name'));
        window.signaturePads = {};
        window.signatureHasValue = {};

        // Add staggered animation delay
        const questionGroups = document.querySelectorAll('.group');
        questionGroups.forEach((group, idx) => {
            group.style.setProperty('--order', idx);
        });

        signatureFields.forEach(name => {
            const canvas = document.getElementById('signature-pad-' + name);
            const input = document.getElementById('signature-input-' + name);
            
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            
            const resizeCanvas = () => {
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width;
                canvas.height = rect.height;
                ctx.lineWidth = 2.5;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.strokeStyle = '#1e293b';
                
                // Restore existing signature if any
                if (input.value && input.value !== "") {
                    const img = new Image();
                    img.onload = () => {
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        window.signatureHasValue[name] = true;
                    };
                    img.src = input.value;
                }
            };
            
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
            
            let isDrawing = false;

            const startDrawing = (e) => {
                isDrawing = true;
                const pos = getCanvasCoordinates(e, canvas);
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
                e.preventDefault();
                
                // Remove error styling when user starts drawing
                const container = canvas.closest('.signature-container');
                if (container) {
                    container.classList.remove('required-empty');
                }
                const errorMsg = document.getElementById('signature-error-' + name);
                if (errorMsg) {
                    errorMsg.classList.add('hidden');
                }
            };
            
            const draw = (e) => {
                if (!isDrawing) return;
                e.preventDefault();
                const pos = getCanvasCoordinates(e, canvas);
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
                saveSignatureValue(name, canvas, input);
            };
            
            const stopDrawing = () => {
                isDrawing = false;
                ctx.beginPath();
                saveSignatureValue(name, canvas, input);
            };

            const getCanvasCoordinates = (e, canvas) => {
                const rect = canvas.getBoundingClientRect();
                let clientX, clientY;
                
                if (e.touches) {
                    clientX = e.touches[0].clientX;
                    clientY = e.touches[0].clientY;
                } else {
                    clientX = e.clientX;
                    clientY = e.clientY;
                }
                
                let x = clientX - rect.left;
                let y = clientY - rect.top;
                
                x = (x / rect.width) * canvas.width;
                y = (y / rect.height) * canvas.height;
                
                return { x, y };
            };

            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseleave', stopDrawing);
            
            canvas.addEventListener('touchstart', startDrawing, { passive: false });
            canvas.addEventListener('touchmove', draw, { passive: false });
            canvas.addEventListener('touchend', stopDrawing);
            canvas.addEventListener('touchcancel', stopDrawing);

            window.signaturePads[name] = { canvas: canvas, ctx: ctx, input: input };
            
            // Initialize signature value check
            if (input.value && input.value !== "") {
                window.signatureHasValue[name] = true;
            } else {
                window.signatureHasValue[name] = false;
            }
        });
    });

    function saveSignatureValue(name, canvas, input) {
        const dataURL = canvas.toDataURL("image/png");
        input.value = dataURL;
        
        // Check if signature is not empty (not just a blank canvas)
        const isEmpty = isCanvasBlank(canvas);
        window.signatureHasValue[name] = !isEmpty;
        
        if (isEmpty) {
            input.value = "";
        }
        
        // Trigger change event for validation
        const event = new Event('change', { bubbles: true });
        input.dispatchEvent(event);
    }
    
    function isCanvasBlank(canvas) {
        const ctx = canvas.getContext('2d');
        const pixelBuffer = new Uint32Array(
            ctx.getImageData(0, 0, canvas.width, canvas.height).data.buffer
        );
        return !pixelBuffer.some(color => color !== 0);
    }

    function clearSignature(name) {
        let pad = window.signaturePads[name];
        if (pad) {
            pad.ctx.clearRect(0, 0, pad.canvas.width, pad.canvas.height);
            pad.input.value = "";
            window.signatureHasValue[name] = false;
            
            // Remove error styling if any
            const container = pad.canvas.closest('.signature-container');
            if (container) {
                container.classList.remove('required-empty');
            }
            const errorMsg = document.getElementById('signature-error-' + name);
            if (errorMsg) {
                errorMsg.classList.add('hidden');
            }
        }
    }
    
    // Enhanced form validation
    document.getElementById('form-submit')?.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredSignatures = document.querySelectorAll('[id^="signature-input-"]');
        
        requiredSignatures.forEach(input => {
            const fieldName = input.id.replace('signature-input-', '');
            const isRequired = input.hasAttribute('required');
            
            if (isRequired) {
                const hasValue = window.signatureHasValue && window.signatureHasValue[fieldName];
                const isEmpty = !input.value || input.value === "";
                
                if (!hasValue || isEmpty) {
                    isValid = false;
                    
                    // Highlight the signature container
                    const canvas = document.getElementById('signature-pad-' + fieldName);
                    const container = canvas?.closest('.signature-container');
                    if (container) {
                        container.classList.add('required-empty');
                        setTimeout(() => {
                            container.classList.remove('required-empty');
                        }, 1000);
                    }
                    
                    // Show error message
                    const errorMsg = document.getElementById('signature-error-' + fieldName);
                    if (errorMsg) {
                        errorMsg.classList.remove('hidden');
                        setTimeout(() => {
                            errorMsg.classList.add('hidden');
                        }, 3000);
                    }
                    
                    // Scroll to the field
                    if (canvas) {
                        canvas.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Sweet alert style notification
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-24 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-bounce';
            alertDiv.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i> ⚠️ Harap lengkapi tanda tangan digital yang wajib diisi!';
            document.body.appendChild(alertDiv);
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    });
    
    // Additional validation for signature fields on change
    document.addEventListener('change', function(e) {
        if (e.target && e.target.id && e.target.id.startsWith('signature-input-')) {
            const fieldName = e.target.id.replace('signature-input-', '');
            const hasValue = e.target.value && e.target.value !== "";
            window.signatureHasValue[fieldName] = hasValue;
            
            // Hide error if now filled
            if (hasValue) {
                const errorMsg = document.getElementById('signature-error-' + fieldName);
                if (errorMsg) {
                    errorMsg.classList.add('hidden');
                }
                const container = document.getElementById('signature-pad-' + fieldName)?.closest('.signature-container');
                if (container) {
                    container.classList.remove('required-empty');
                }
            }
        }
    });
</script>
@endpush
@endsection