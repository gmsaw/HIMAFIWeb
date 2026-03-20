@extends('layouts.app') 
@section('title', 'Simulasi Gerak Parabola')

@section('content')
<div class="pt-28 pb-10 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        
        {{-- Header --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">
                    <i class="fas fa-rocket text-cyan-600 mr-2"></i> Simulasi Gerak Parabola
                </h1>
                <p class="text-gray-600 mt-2 text-lg">Atur parameter dan amati lintasan proyektil secara realtime.</p>
            </div>
            <a href="{{ route('simulasi.index') }}" class="px-5 py-2.5 bg-white hover:bg-gray-100 text-gray-700 rounded-xl shadow-sm border border-gray-200 text-sm font-medium transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- PANEL KONTROL (KIRI) --}}
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-xl border border-white/50">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                    <i class="fas fa-sliders-h text-cyan-600"></i> Parameter Fisika
                </h3>
                
                <div class="space-y-6">
                    {{-- Kecepatan Awal --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1 flex justify-between">
                            <span>Kecepatan Awal (v₀) <span class="text-cyan-600">m/s</span></span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-0.5 rounded-full text-xs" id="v0-val">50</span>
                        </label>
                        <input type="range" id="v0" min="1" max="150" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-cyan-600" oninput="updateVal('v0', this.value); calculateTheory()">
                    </div>
                    
                    {{-- Sudut Elevasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1 flex justify-between">
                            <span>Sudut Elevasi (θ) <span class="text-cyan-600">°</span></span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-0.5 rounded-full text-xs" id="angle-val">45</span>
                        </label>
                        <input type="range" id="angle" min="1" max="89" value="45" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-cyan-600" oninput="updateVal('angle', this.value); calculateTheory()">
                        <div id="angle-optimum-message" class="text-xs mt-1 text-emerald-600 font-medium hidden">
                            <i class="fas fa-check-circle"></i> Sudut optimum untuk jarak maks (45°)
                        </div>
                    </div>

                    {{-- Ketinggian Awal --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1 flex justify-between">
                            <span>Ketinggian Awal (h₀) <span class="text-cyan-600">m</span></span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-0.5 rounded-full text-xs" id="h0-val">0</span>
                        </label>
                        <input type="range" id="h0" min="0" max="100" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-cyan-600" oninput="updateVal('h0', this.value); calculateTheory()">
                    </div>

                    {{-- Gravitasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Percepatan Gravitasi (g)</label>
                        <select id="gravity" class="w-full border-gray-300 rounded-xl text-sm focus:ring-cyan-500 focus:border-cyan-500 bg-gray-50 p-2.5 shadow-sm" onchange="calculateTheory()">
                            <option value="9.81">🌍 Bumi (9.81 m/s²)</option>
                            <option value="1.62">🌕 Bulan (1.62 m/s²)</option>
                            <option value="3.72">🔴 Mars (3.72 m/s²)</option>
                            <option value="24.79">🪐 Jupiter (24.79 m/s²)</option>
                        </select>
                    </div>
                </div>

                {{-- Tombol Aksi (DIPERBAIKI: hijau solid) --}}
                <div class="mt-8 flex gap-3">
                    <button onclick="startSim()" id="btn-play" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold transition flex justify-center items-center gap-2 shadow-lg text-lg border-2 border-white/30">
                        <i class="fas fa-play"></i> Play
                    </button>
                    <button onclick="resetSim()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-4 rounded-xl font-bold transition flex justify-center items-center gap-2 shadow-md">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>

                {{-- Hasil Perhitungan Teoritis --}}
                <div class="mt-8 p-5 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl text-white shadow-2xl border border-slate-700">
                    <h4 class="text-xs font-bold text-cyan-400 uppercase tracking-wider mb-4 border-b border-slate-700 pb-2 flex items-center gap-2">
                        <i class="fas fa-square-root-alt"></i> Analisis Teori
                    </h4>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm">
                        <div>
                            <span class="block text-gray-400 text-xs mb-1">Tinggi Maks (h<sub>max</sub>)</span>
                            <span id="res-hmax" class="font-mono font-bold text-xl text-green-400">0.00</span> <span class="text-xs">m</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-xs mb-1">Jarak Terjauh (x<sub>max</sub>)</span>
                            <span id="res-xmax" class="font-mono font-bold text-xl text-yellow-400">0.00</span> <span class="text-xs">m</span>
                        </div>
                        <div class="col-span-2">
                            <span class="block text-gray-400 text-xs mb-1">Waktu Total di Udara</span>
                            <span id="res-time" class="font-mono font-bold text-xl text-white">0.00</span> <span class="text-xs">s</span>
                        </div>
                    </div>
                </div>

                {{-- KOTAK INFORMASI KONDISI TEORI --}}
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl text-sm text-blue-800">
                    <h5 class="font-bold flex items-center gap-1 mb-2"><i class="fas fa-lightbulb text-amber-500"></i> Insight Teori</h5>
                    <ul class="space-y-1 list-disc list-inside text-xs">
                        <li id="cond-angle">Sudut <strong>45°</strong> memberikan jarak maksimum (tanpa ketinggian awal).</li>
                        <li id="cond-h0">Ketinggian awal <span id="h0-condition">0 m</span> <span id="h0-effect">tidak mempengaruhi jarak optimum.</span></li>
                        <li id="cond-g">Gravitasi <span id="g-val">9.81 m/s²</span> (Bumi).</li>
                    </ul>
                </div>
            </div>

            {{-- LAYAR KANVAS SIMULASI (KANAN) --}}
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm p-3 rounded-3xl shadow-xl border border-white/50 flex flex-col relative">
                <div class="bg-slate-50 flex-1 rounded-2xl relative overflow-hidden border border-gray-200" style="min-height: 500px;">
                    <canvas id="simCanvas" class="absolute inset-0 w-full h-full"></canvas>
                    
                    {{-- Indikator Live Realtime --}}
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-5 py-4 rounded-2xl shadow-lg border border-gray-100 text-sm font-mono min-w-[170px]">
                        <div class="text-xs font-bold text-gray-400 mb-3 uppercase tracking-wide flex items-center gap-1">
                            <i class="fas fa-satellite-dish text-cyan-500"></i> Live Telemetry
                        </div>
                        <div class="flex justify-between mb-2"><span class="text-gray-500">waktu:</span> <span id="live-t" class="font-bold text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded">0.00 s</span></div>
                        <div class="flex justify-between mb-2"><span class="text-gray-500">pos X:</span> <span id="live-x" class="font-bold text-gray-800">0.00 m</span></div>
                        <div class="flex justify-between"><span class="text-gray-500">pos Y:</span> <span id="live-y" class="font-bold text-gray-800">0.00 m</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const canvas = document.getElementById('simCanvas');
    const ctx = canvas.getContext('2d');
    
    // State Simulasi
    let animFrame;
    let t = 0;
    let isRunning = false;
    let path = [];
    let theory = {};
    let scale = 1;

    const paddingX = 60;
    const paddingY = 60;

    // Update Label UI
    function updateVal(id, val) {
        document.getElementById(id + '-val').innerText = val;
    }

    function resizeCanvas() {
        canvas.width = canvas.parentElement.clientWidth;
        canvas.height = canvas.parentElement.clientHeight;
        calculateTheory();
    }
    window.addEventListener('resize', resizeCanvas);

    // Fungsi menggambar panah vektor kecepatan awal
    function drawArrow(fromX, fromY, length, angleRad, color) {
        let arrowLength = length;
        let toX = fromX + arrowLength * Math.cos(angleRad);
        let toY = fromY - arrowLength * Math.sin(angleRad);
        
        ctx.strokeStyle = color;
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(fromX, fromY);
        ctx.lineTo(toX, toY);
        ctx.stroke();
        
        let headLength = 10;
        let headAngle = 0.5;
        let angle = Math.atan2(toY - fromY, toX - fromX);
        
        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.moveTo(toX, toY);
        ctx.lineTo(toX - headLength * Math.cos(angle - headAngle), toY - headLength * Math.sin(angle - headAngle));
        ctx.lineTo(toX - headLength * Math.cos(angle + headAngle), toY - headLength * Math.sin(angle + headAngle));
        ctx.closePath();
        ctx.fill();
        
        ctx.font = 'bold 12px monospace';
        ctx.fillStyle = '#1e293b';
        ctx.fillText('v₀ = ' + document.getElementById('v0').value + ' m/s', fromX + 20, fromY - 30);
    }

    // Fungsi untuk memperbarui kotak insight
    function updateTheoryInsights() {
        let angle = parseFloat(document.getElementById('angle').value);
        let h0 = parseFloat(document.getElementById('h0').value);
        let g = parseFloat(document.getElementById('gravity').value);
        let gText = document.getElementById('gravity').selectedOptions[0].text.split(' ')[0];

        let angleMsg = document.getElementById('cond-angle');
        if (Math.abs(angle - 45) < 0.1 && h0 === 0) {
            angleMsg.innerHTML = '✅ Sudut <strong>45°</strong> adalah optimum untuk jarak maks (tanpa ketinggian awal).';
        } else if (h0 > 0) {
            angleMsg.innerHTML = 'ℹ️ Dengan ketinggian awal, sudut optimum < 45° (geser slider untuk lihat perubahan).';
        } else {
            angleMsg.innerHTML = '📐 Sudut <strong>' + angle + '°</strong> (jarak maks optimum di 45°).';
        }

        let h0Cond = document.getElementById('h0-condition');
        let h0Effect = document.getElementById('h0-effect');
        h0Cond.innerText = h0 + ' m';
        if (h0 > 0) {
            h0Effect.innerHTML = 'menambah waktu tempuh dan jarak.';
        } else {
            h0Effect.innerHTML = 'tidak mempengaruhi jarak optimum.';
        }

        document.getElementById('g-val').innerText = g + ' m/s² (' + gText + ')';
    }

    // Rumus Fisika Teoritis (dengan ketinggian awal)
    function calculateTheory() {
        let v0 = parseFloat(document.getElementById('v0').value);
        let angle = parseFloat(document.getElementById('angle').value);
        let g = parseFloat(document.getElementById('gravity').value);
        let h0 = parseFloat(document.getElementById('h0').value);
        
        let rad = angle * (Math.PI / 180);
        let v0y = v0 * Math.sin(rad);
        let v0x = v0 * Math.cos(rad);
        
        let discriminant = v0y * v0y + 2 * g * h0;
        theory.tTotal = (v0y + Math.sqrt(discriminant)) / g;
        
        let tPeak = v0y / g;
        theory.hMax = h0 + v0y * tPeak - 0.5 * g * tPeak * tPeak;
        
        theory.xMax = v0x * theory.tTotal;

        document.getElementById('res-time').innerText = theory.tTotal.toFixed(2);
        document.getElementById('res-hmax').innerText = theory.hMax.toFixed(2);
        document.getElementById('res-xmax').innerText = theory.xMax.toFixed(2);
        
        let maxX = Math.max(theory.xMax, 1);
        let maxY = Math.max(theory.hMax, 1);
        let scaleX = (canvas.width - paddingX * 2) / maxX;
        let scaleY = (canvas.height - paddingY * 2) / maxY;
        scale = Math.min(scaleX, scaleY);
        
        updateTheoryInsights();

        let angleOptMsg = document.getElementById('angle-optimum-message');
        if (Math.abs(angle - 45) < 0.1 && h0 === 0) {
            angleOptMsg.classList.remove('hidden');
        } else {
            angleOptMsg.classList.add('hidden');
        }

        if(!isRunning && path.length === 0) {
            draw();
        }
    }

    // Fungsi Menggambar ke Canvas
    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        let originX = paddingX;
        let originY = canvas.height - paddingY;
        let h0 = parseFloat(document.getElementById('h0').value);
        let v0 = parseFloat(document.getElementById('v0').value);
        let angle = parseFloat(document.getElementById('angle').value);
        let rad = angle * (Math.PI / 180);

        // 1. GAMBAR TANAH
        ctx.fillStyle = '#8B5A2B';
        ctx.fillRect(0, originY, canvas.width, canvas.height - originY);
        ctx.strokeStyle = '#2E7D32';
        ctx.lineWidth = 2;
        for (let i = 0; i < canvas.width; i += 15) {
            ctx.beginPath();
            ctx.moveTo(i, originY);
            ctx.lineTo(i - 5, originY - 8);
            ctx.strokeStyle = '#2E7D32';
            ctx.stroke();
        }
        ctx.fillStyle = '#5D8C2B';
        ctx.globalAlpha = 0.3;
        ctx.fillRect(0, originY, canvas.width, 20);
        ctx.globalAlpha = 1.0;

        // 2. GAMBAR BALOK KETINGGIAN
        if (h0 > 0) {
            let buildingWidth = 40;
            let buildingHeight = h0 * scale;
            // Batasi tinggi agar tidak keluar area
            let maxAllowedHeight = canvas.height - 2 * paddingY - 5;
            if (buildingHeight > maxAllowedHeight) buildingHeight = maxAllowedHeight;
            
            ctx.fillStyle = '#9ca3af';
            ctx.fillRect(originX - buildingWidth/2, originY - buildingHeight, buildingWidth, buildingHeight);
            ctx.strokeStyle = '#4b5563';
            ctx.lineWidth = 2;
            ctx.strokeRect(originX - buildingWidth/2, originY - buildingHeight, buildingWidth, buildingHeight);
            
            ctx.font = 'bold 10px monospace';
            ctx.fillStyle = 'white';
            ctx.shadowColor = 'black';
            ctx.shadowBlur = 4;
            ctx.fillText(h0 + ' m', originX - 20, originY - buildingHeight - 5);
            ctx.shadowBlur = 0;
        }

        // 3. GAMBAR SUMBU
        ctx.strokeStyle = '#94a3b8';
        ctx.lineWidth = 2;
        ctx.setLineDash([]);
        ctx.beginPath(); ctx.moveTo(originX, 0); ctx.lineTo(originX, canvas.height); ctx.stroke(); 
        ctx.beginPath(); ctx.moveTo(0, originY); ctx.lineTo(canvas.width, originY); ctx.stroke(); 

        // 4. GAMBAR PANAH KECEPATAN AWAL (jika tidak running)
        if (!isRunning) {
            let startX = originX;
            let startY = originY - h0 * scale;
            let arrowLength = (v0 / 150) * 100;
            drawArrow(startX, startY, arrowLength, rad, '#dc2626');
        }

        // 5. GAMBAR LINTASAN
        if(path.length > 0) {
            ctx.strokeStyle = '#06b6d4';
            ctx.lineWidth = 3;
            ctx.setLineDash([8, 5]);
            ctx.beginPath();
            ctx.moveTo(originX + path[0].x * scale, originY - path[0].y * scale);
            for(let i = 1; i < path.length; i++) {
                ctx.lineTo(originX + path[i].x * scale, originY - path[i].y * scale);
            }
            ctx.stroke();
            ctx.setLineDash([]);
        }

        // 6. GAMBAR BOLA
        if(path.length > 0) {
            let lastPos = path[path.length - 1];
            
            ctx.shadowColor = 'rgba(239, 68, 68, 0.6)';
            ctx.shadowBlur = 15;
            ctx.shadowOffsetY = 3;
            ctx.fillStyle = '#ef4444';
            ctx.beginPath();
            ctx.arc(originX + lastPos.x * scale, originY - lastPos.y * scale, 10, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.shadowBlur = 0;
            ctx.fillStyle = '#ffffff';
            ctx.beginPath();
            ctx.arc(originX + lastPos.x * scale - 3, originY - lastPos.y * scale - 3, 3, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.shadowBlur = 0;
            ctx.shadowOffsetY = 0;
        }
    }

    // Fungsi Utama Menjalankan Animasi
    function startSim() {
        if(isRunning) return;
        
        let btnPlay = document.getElementById('btn-play');
        btnPlay.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Running';
        btnPlay.classList.remove('bg-green-600', 'hover:bg-green-700');
        btnPlay.classList.add('bg-orange-500', 'hover:bg-orange-600');
        
        resetSim(false);
        isRunning = true;
        
        let v0 = parseFloat(document.getElementById('v0').value);
        let angle = parseFloat(document.getElementById('angle').value);
        let g = parseFloat(document.getElementById('gravity').value);
        let h0 = parseFloat(document.getElementById('h0').value);
        let rad = angle * (Math.PI / 180);
        let v0y = v0 * Math.sin(rad);
        let v0x = v0 * Math.cos(rad);

        function animate() {
            if(!isRunning) return;

            t += theory.tTotal / 150; 
            
            let currentX = v0x * t;
            let currentY = h0 + v0y * t - 0.5 * g * t * t;

            document.getElementById('live-t').innerText = t.toFixed(2) + " s";
            document.getElementById('live-x').innerText = currentX.toFixed(2) + " m";
            document.getElementById('live-y').innerText = (currentY >= 0 ? currentY.toFixed(2) : "0.00") + " m";

            if (currentY >= 0) {
                path.push({x: currentX, y: currentY});
                draw();
                animFrame = requestAnimationFrame(animate);
            } else {
                path.push({x: theory.xMax, y: 0});
                document.getElementById('live-t').innerText = theory.tTotal.toFixed(2) + " s";
                document.getElementById('live-x').innerText = theory.xMax.toFixed(2) + " m";
                document.getElementById('live-y').innerText = "0.00 m";
                draw();
                isRunning = false;
                
                btnPlay.innerHTML = '<i class="fas fa-play"></i> Play Again';
                btnPlay.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                btnPlay.classList.add('bg-green-600', 'hover:bg-green-700');
            }
        }
        
        animate();
    }

    // Fungsi Reset
    function resetSim(fullReset = true) {
        cancelAnimationFrame(animFrame);
        isRunning = false;
        t = 0;
        path = [];
        
        document.getElementById('live-t').innerText = "0.00 s";
        document.getElementById('live-x').innerText = "0.00 m";
        document.getElementById('live-y').innerText = "0.00 m";
        
        let btnPlay = document.getElementById('btn-play');
        btnPlay.innerHTML = '<i class="fas fa-play"></i> Play';
        btnPlay.classList.remove('bg-orange-500', 'hover:bg-orange-600');
        btnPlay.classList.add('bg-green-600', 'hover:bg-green-700');

        if(fullReset) {
            calculateTheory();
        }
        draw();
    }

    window.onload = () => {
        resizeCanvas();
        updateVal('v0', document.getElementById('v0').value);
        updateVal('angle', document.getElementById('angle').value);
        updateVal('h0', document.getElementById('h0').value);
        calculateTheory();
    };
</script>
@endpush
@endsection