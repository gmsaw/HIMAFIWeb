@extends('layouts.app') 
@section('title', 'Simulasi Hukum Ohm & Kirchhoff')

@section('content')
<div class="pt-28 pb-10 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 max-w-6xl">
        
        {{-- Header --}}
        <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-3"></i> Hukum Ohm & Kirchhoff
                </h1>
                <p class="text-gray-600 mt-2 text-lg font-medium">Pilih jenis rangkaian, atur parameter, dan amati hasilnya.</p>
            </div>
            <a href="{{ route('simulasi.index') }}" class="px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 rounded-xl shadow-sm border border-gray-200 text-sm font-bold transition-all flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Lab
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- PANEL KONTROL (KIRI - 4 Kolom) --}}
            <div class="lg:col-span-4 bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-xl border border-white/50 flex flex-col gap-6">
                
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-3 flex items-center gap-2">
                        <i class="fas fa-sliders-h text-purple-600"></i> Parameter Rangkaian
                    </h3>
                    
                    <div class="space-y-6">
                        {{-- Pilihan Jenis Rangkaian --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Rangkaian</label>
                            <select id="tipeRangkaian" class="w-full border-gray-300 rounded-xl text-sm focus:ring-purple-500 focus:border-purple-500 bg-gray-50 py-3 px-4 shadow-sm font-medium cursor-pointer" onchange="hitung()">
                                <option value="seri" selected>Rangkaian Seri (2 Resistor)</option>
                                <option value="paralel">Rangkaian Paralel (2 Resistor)</option>
                            </select>
                        </div>

                        {{-- Tegangan Sumber --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between items-center">
                                <span>Tegangan Sumber ($V$)</span>
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-lg text-xs font-bold" id="V-val">12 V</span>
                            </label>
                            <input type="range" id="V" min="1" max="50" value="12" step="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600" oninput="updateVal('V', this.value, ' V'); hitung()">
                        </div>
                        
                        {{-- Resistor R1 --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between items-center">
                                <span>Resistor 1 ($R_1$)</span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-lg text-xs font-bold" id="R1-val">100 Ω</span>
                            </label>
                            <input type="range" id="R1" min="1" max="1000" value="100" step="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-green-600" oninput="updateVal('R1', this.value, ' Ω'); hitung()">
                        </div>

                        {{-- Resistor R2 --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between items-center">
                                <span>Resistor 2 ($R_2$)</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-xs font-bold" id="R2-val">220 Ω</span>
                            </label>
                            <input type="range" id="R2" min="1" max="1000" value="220" step="1" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600" oninput="updateVal('R2', this.value, ' Ω'); hitung()">
                        </div>
                    </div>
                </div>

                {{-- Hasil Perhitungan (Dashboard Bawah) --}}
                <div class="mt-auto p-5 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl text-white shadow-2xl border border-slate-700 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500/20 blur-3xl rounded-full pointer-events-none"></div>

                    <h4 class="text-xs font-bold text-purple-400 uppercase tracking-widest mb-4 border-b border-slate-700 pb-2 flex items-center gap-2">
                        <i class="fas fa-microchip"></i> Analisis Teori
                    </h4>
                    
                    <div class="grid grid-cols-2 gap-y-4 gap-x-3 text-sm relative z-10">
                        <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                            <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Arus Total ($I$)</span>
                            <span id="res-I" class="font-mono font-bold text-lg text-yellow-400">0.00</span> <span class="text-xs text-slate-400">A</span>
                        </div>
                        <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                            <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Daya ($P$)</span>
                            <span id="res-P" class="font-mono font-bold text-lg text-orange-400">0.00</span> <span class="text-xs text-slate-400">W</span>
                        </div>
                        <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                            <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Voltase R₁ ($V_1$)</span>
                            <span id="res-V1" class="font-mono font-bold text-lg text-green-400">0.00</span> <span class="text-xs text-slate-400">V</span>
                        </div>
                        <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                            <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Voltase R₂ ($V_2$)</span>
                            <span id="res-V2" class="font-mono font-bold text-lg text-blue-400">0.00</span> <span class="text-xs text-slate-400">V</span>
                        </div>
                        
                        {{-- Cabang Paralel --}}
                        <div class="col-span-2 hidden" id="arusCabangContainer">
                            <div class="grid grid-cols-2 gap-3 mt-1">
                                <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                                    <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Arus R₁ ($I_1$)</span>
                                    <span id="res-I1" class="font-mono font-bold text-lg text-white">0.00 A</span>
                                </div>
                                <div class="bg-slate-800/80 p-2 rounded-lg border border-slate-700/50">
                                    <span class="block text-slate-400 text-[10px] uppercase mb-1 font-bold">Arus R₂ ($I_2$)</span>
                                    <span id="res-I2" class="font-mono font-bold text-lg text-white">0.00 A</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-slate-950/50 rounded-xl text-xs border border-slate-700/50">
                        <span class="text-purple-300 font-bold tracking-wide">HUKUM KIRCHHOFF:</span> 
                        <span id="kvl-check" class="text-white block mt-1 font-mono">V = V₁ + V₂</span>
                    </div>
                </div>
            </div>

            {{-- LAYAR KANVAS SIMULASI (KANAN - 8 Kolom) --}}
            <div class="lg:col-span-8 bg-white/80 backdrop-blur-sm p-3 rounded-3xl shadow-xl border border-white/50 flex flex-col relative h-[500px] lg:h-[650px]">
                <div class="bg-[#f8fafc] flex-1 rounded-2xl relative overflow-hidden border border-slate-200">
                    <div class="absolute inset-0 opacity-[0.15]" style="background-image: radial-gradient(#334155 2px, transparent 2px); background-size: 30px 30px;"></div>
                    
                    <canvas id="circuitCanvas" class="absolute inset-0 w-full h-full z-10"></canvas>
                    
                    {{-- HUD Live values --}}
                    <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-md px-5 py-4 rounded-2xl shadow-lg border border-gray-100 text-sm font-mono min-w-[200px] z-20">
                        <div class="text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-widest border-b border-gray-100 pb-2">
                            <i class="fas fa-satellite-dish text-purple-500 mr-1"></i> Data Sensor
                        </div>
                        <div class="space-y-2 text-slate-600">
                            <div class="flex justify-between items-center">
                                <span>$I_{tot}$ :</span> <span id="live-I" class="font-bold text-purple-600 bg-purple-50 px-2 rounded">0.00 A</span>
                            </div>
                            <div id="live-I1-container" style="display: none;" class="flex justify-between items-center">
                                <span>$I_1$ :</span> <span id="live-I1" class="font-bold text-slate-800">0.00 A</span>
                            </div>
                            <div id="live-I2-container" style="display: none;" class="flex justify-between items-center">
                                <span>$I_2$ :</span> <span id="live-I2" class="font-bold text-slate-800">0.00 A</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>$V_1$ :</span> <span id="live-V1" class="font-bold text-green-600 bg-green-50 px-2 rounded">0.00 V</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>$V_2$ :</span> <span id="live-V2" class="font-bold text-blue-600 bg-blue-50 px-2 rounded">0.00 V</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-4 left-5 text-slate-400 font-bold tracking-widest text-[10px] opacity-70 z-20">
                        <i class="fas fa-info-circle"></i> PANAH KUNING MENUNJUKKAN ARAH ARUS (I)
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

@push('scripts')
<script>
    const canvas = document.getElementById('circuitCanvas');
    const ctx = canvas.getContext('2d');
    
    let V = 12, R1 = 100, R2 = 220;
    let tipe = 'seri';
    let I = 0, I1 = 0, I2 = 0, V1 = 0, V2 = 0, P = 0;

    function updateVal(id, val, satuan) {
        document.getElementById(id + '-val').innerText = val + satuan;
    }

    function resizeCanvas() {
        canvas.width = canvas.parentElement.clientWidth;
        canvas.height = canvas.parentElement.clientHeight;
        hitung(); 
    }
    window.addEventListener('resize', resizeCanvas);

    function hitung() {
        V = parseFloat(document.getElementById('V').value);
        R1 = parseFloat(document.getElementById('R1').value);
        R2 = parseFloat(document.getElementById('R2').value);
        tipe = document.getElementById('tipeRangkaian').value;
        
        if (tipe === 'seri') {
            I = V / (R1 + R2);
            V1 = I * R1;
            V2 = I * R2;
            I1 = I; I2 = I;
            P = V * I;
            
            document.getElementById('arusCabangContainer').style.display = 'none';
            document.getElementById('live-I1-container').style.display = 'none';
            document.getElementById('live-I2-container').style.display = 'none';
            
            let kvlCheck = document.getElementById('kvl-check');
            let totalV = V1 + V2;
            kvlCheck.innerHTML = Math.abs(totalV - V) < 0.01 
                ? `✅ KVL: V = V₁ + V₂ (${V.toFixed(1)} = ${V1.toFixed(1)} + ${V2.toFixed(1)})`
                : `⚠️ Error Pembulatan`;
                
        } else {
            let Rtotal = 1 / ((1/R1) + (1/R2));
            I = V / Rtotal;
            I1 = V / R1;
            I2 = V / R2;
            V1 = V; V2 = V;
            P = V * I;
            
            document.getElementById('arusCabangContainer').style.display = 'block';
            document.getElementById('live-I1-container').style.display = 'flex';
            document.getElementById('live-I2-container').style.display = 'flex';
            
            document.getElementById('res-I1').innerText = I1.toFixed(2) + ' A';
            document.getElementById('res-I2').innerText = I2.toFixed(2) + ' A';
            document.getElementById('live-I1').innerText = I1.toFixed(2) + ' A';
            document.getElementById('live-I2').innerText = I2.toFixed(2) + ' A';
            
            let kvlCheck = document.getElementById('kvl-check');
            let totalI = I1 + I2;
            kvlCheck.innerHTML = Math.abs(totalI - I) < 0.01 
                ? `✅ KCL: I = I₁ + I₂ (${I.toFixed(2)} = ${I1.toFixed(2)} + ${I2.toFixed(2)})`
                : `⚠️ Error Pembulatan`;
        }
        
        // Update UI HTML
        document.getElementById('res-I').innerText = I.toFixed(2);
        document.getElementById('res-V1').innerText = V1.toFixed(1);
        document.getElementById('res-V2').innerText = V2.toFixed(1);
        document.getElementById('res-P').innerText = P.toFixed(1);
        
        document.getElementById('live-I').innerText = I.toFixed(2) + ' A';
        document.getElementById('live-V1').innerText = V1.toFixed(1) + ' V';
        document.getElementById('live-V2').innerText = V2.toFixed(1) + ' V';
        
        gambarRangkaian();
    }

    /* -----------------------------------------------------------
       ALGORITMA PENGGAMBARAN KANVAS (DIPERBAIKI)
       ----------------------------------------------------------- */
       
    function gambarRangkaian() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        let w = canvas.width;
        let h = canvas.height;
        let cx = w / 2;
        let cy = h / 2;

        if (tipe === 'seri') {
            // Ukuran Loop Kotak Seri
            let boxW = Math.min(450, w - 100);
            let boxH = Math.min(300, h - 100);
            let x = cx - boxW/2;
            let y = cy - boxH/2;

            // GAMBAR KABEL TERTUTUP (DENGAN RUANG KOSONG UNTUK KOMPONEN)
            ctx.beginPath();
            ctx.strokeStyle = '#334155'; // Warna Kabel
            ctx.lineWidth = 3;
            
            // Atas (ada R1 & R2)
            ctx.moveTo(x, y); 
            ctx.lineTo(x + boxW/3 - 25, y); // Stop sebelum R1
            ctx.moveTo(x + boxW/3 + 25, y); 
            ctx.lineTo(x + 2*boxW/3 - 25, y); // Antara R1 & R2
            ctx.moveTo(x + 2*boxW/3 + 25, y); 
            ctx.lineTo(x + boxW, y); // Setelah R2

            // Kanan (kabel lurus)
            ctx.lineTo(x + boxW, y + boxH);
            
            // Bawah (kabel lurus)
            ctx.lineTo(x, y + boxH);
            
            // Kiri (Ada Baterai)
            ctx.lineTo(x, cy + 20); // Bawah baterai
            ctx.moveTo(x, cy - 20); // Atas baterai
            ctx.lineTo(x, y);
            ctx.stroke();

            // GAMBAR KOMPONEN
            drawBattery(x, cy, true);
            drawResistor(x + boxW/3, y, 'R₁', R1, false, '#059669'); // Hijau
            drawResistor(x + 2*boxW/3, y, 'R₂', R2, false, '#2563eb'); // Biru

            // PANAH ARUS
            drawArrow(x + boxW/2, y, 'right'); // Atas
            drawArrow(x + boxW, cy, 'down');   // Kanan
            drawArrow(x + boxW/2, y + boxH, 'left'); // Bawah
            drawArrow(x, y + boxH/4, 'up'); // Kiri (arah positif)

            // LABEL
            drawText('I = ' + I.toFixed(2) + ' A', x + boxW/2, y - 45, '#d97706');
        } 
        else {
            // RANGKAIAN PARALEL
            let boxW = Math.min(450, w - 100);
            let boxH = Math.min(300, h - 100);
            let x = cx - boxW/2;
            let y = cy - boxH/2;

            ctx.beginPath();
            ctx.strokeStyle = '#334155';
            ctx.lineWidth = 3;

            // Kabel Kiri (Baterai)
            ctx.moveTo(x, y); ctx.lineTo(x, cy - 20);
            ctx.moveTo(x, cy + 20); ctx.lineTo(x, y + boxH);
            
            // Kabel Atas & Bawah
            ctx.moveTo(x, y); ctx.lineTo(x + boxW, y);
            ctx.moveTo(x, y + boxH); ctx.lineTo(x + boxW, y + boxH);

            // Kabel Tengah (R1)
            ctx.moveTo(cx, y); ctx.lineTo(cx, cy - 25);
            ctx.moveTo(cx, cy + 25); ctx.lineTo(cx, y + boxH);

            // Kabel Kanan (R2)
            ctx.moveTo(x + boxW, y); ctx.lineTo(x + boxW, cy - 25);
            ctx.moveTo(x + boxW, cy + 25); ctx.lineTo(x + boxW, y + boxH);
            ctx.stroke();

            // TITIK CABANG (NODE)
            drawNode(cx, y); drawNode(cx, y + boxH);
            drawNode(x + boxW, y); drawNode(x + boxW, y + boxH);

            // GAMBAR KOMPONEN
            drawBattery(x, cy, true);
            drawResistor(cx, cy, 'R₁', R1, true, '#059669'); // Vertikal R1
            drawResistor(x + boxW, cy, 'R₂', R2, true, '#2563eb'); // Vertikal R2

            // PANAH ARUS
            drawArrow(x + boxW/4, y, 'right'); // Arus Utama (atas)
            drawArrow(cx, y + boxH/4, 'down'); // Arus R1
            drawArrow(x + boxW, y + boxH/4, 'down'); // Arus R2
            drawArrow(x + boxW/4, y + boxH, 'left'); // Arus balik (bawah)

            // LABEL
            drawText('I_tot = ' + I.toFixed(2) + ' A', x + boxW/4, y - 15, '#d97706');
            drawText('I₁ = ' + I1.toFixed(2) + ' A', cx - 55, cy + 60, '#059669');
            drawText('I₂ = ' + I2.toFixed(2) + ' A', x + boxW - 55, cy + 60, '#2563eb');
        }
    }

    function drawBattery(bx, by, isVertical) {
        ctx.beginPath();
        ctx.strokeStyle = '#0f172a';
        ctx.lineWidth = 3;
        if(isVertical) {
            ctx.moveTo(bx - 20, by - 8); ctx.lineTo(bx + 20, by - 8); // Plat Positif (panjang)
            ctx.moveTo(bx - 10, by + 8); ctx.lineTo(bx + 10, by + 8); // Plat Negatif (pendek)
            ctx.stroke();
            
            ctx.fillStyle = '#ef4444'; ctx.font = 'bold 16px sans-serif'; ctx.fillText('+', bx + 25, by - 2);
            ctx.fillStyle = '#3b82f6'; ctx.fillText('-', bx + 25, by + 16);
            ctx.fillStyle = '#0f172a'; ctx.font = 'bold 16px monospace'; ctx.fillText(V.toFixed(1) + ' V', bx - 65, by + 5);
        }
    }

    function drawResistor(rx, ry, label, val, isVertical, color='#1e293b') {
        ctx.beginPath();
        ctx.strokeStyle = color;
        ctx.lineWidth = 3;
        ctx.lineJoin = 'miter';

        if(!isVertical) {
            ctx.moveTo(rx - 25, ry); ctx.lineTo(rx - 20, ry - 12);
            ctx.lineTo(rx - 10, ry + 12); ctx.lineTo(rx, ry - 12);
            ctx.lineTo(rx + 10, ry + 12); ctx.lineTo(rx + 20, ry - 12);
            ctx.lineTo(rx + 25, ry);
            ctx.stroke();
            
            ctx.fillStyle = color; ctx.font = 'bold 15px sans-serif';
            ctx.fillText(label, rx - 10, ry - 25);
            ctx.font = '13px monospace'; ctx.fillText(val + ' Ω', rx - 15, ry + 30);
        } else {
            ctx.moveTo(rx, ry - 25); ctx.lineTo(rx + 12, ry - 20);
            ctx.lineTo(rx - 12, ry - 10); ctx.lineTo(rx + 12, ry);
            ctx.lineTo(rx - 12, ry + 10); ctx.lineTo(rx + 12, ry + 20);
            ctx.lineTo(rx, ry + 25);
            ctx.stroke();

            ctx.fillStyle = color; ctx.font = 'bold 15px sans-serif';
            ctx.fillText(label, rx + 20, ry - 5);
            ctx.font = '13px monospace'; ctx.fillText(val + ' Ω', rx + 20, ry + 15);
        }
    }

    function drawNode(nx, ny) {
        ctx.beginPath();
        ctx.fillStyle = '#0f172a';
        ctx.arc(nx, ny, 5, 0, Math.PI * 2);
        ctx.fill();
    }

    function drawArrow(ax, ay, dir) {
        ctx.beginPath();
        ctx.fillStyle = '#eab308'; // Yellow-500
        if(dir === 'right') {
            ctx.moveTo(ax-8, ay-8); ctx.lineTo(ax+10, ay); ctx.lineTo(ax-8, ay+8);
        } else if(dir === 'left') {
            ctx.moveTo(ax+8, ay-8); ctx.lineTo(ax-10, ay); ctx.lineTo(ax+8, ay+8);
        } else if(dir === 'up') {
            ctx.moveTo(ax-8, ay+8); ctx.lineTo(ax, ay-10); ctx.lineTo(ax+8, ay+8);
        } else if(dir === 'down') {
            ctx.moveTo(ax-8, ay-8); ctx.lineTo(ax, ay+10); ctx.lineTo(ax+8, ay-8);
        }
        ctx.fill();
    }

    function drawText(txt, x, y, color='#475569') {
        ctx.fillStyle = color;
        ctx.font = 'bold 14px monospace';
        ctx.fillText(txt, x, y);
    }

    window.onload = () => {
        resizeCanvas();
    };
</script>
@endpush
@endsection