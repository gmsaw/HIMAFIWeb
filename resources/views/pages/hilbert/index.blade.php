@extends('layouts.app')
@section('title', 'Ruang Hilbert - Deep Work Zone')

@section('content')
@php
    $dailyGoal = 240; 
    $progressPercent = min(100, ($myTotalToday / $dailyGoal) * 100);
    $badge1 = $myTotalToday >= 30; 
    $badge2 = $myTotalToday >= 120;
    $badge3 = $myTotalToday >= 240;
@endphp

<div class="pt-24 pb-10 bg-slate-950 min-h-screen font-sans text-slate-200 relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#38bdf8 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-indigo-600/20 blur-[150px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400 mb-3 tracking-tight drop-shadow-sm">
                Ruang Hilbert
            </h1>
            <p class="text-slate-400">Virtual Study Space & Deep Work Zone. <br>Fokus tak terhingga dalam ruang dimensi tak terbatas.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- KIRI: POMODORO TIMER & ACHIEVEMENTS --}}
            <div class="lg:col-span-7 flex flex-col gap-6">
                
                {{-- Modul Timer --}}
                <div class="bg-slate-900/80 backdrop-blur-md p-8 rounded-3xl border border-slate-800 shadow-2xl flex flex-col items-center relative overflow-hidden">
                    
                    <div id="time-selector" class="flex flex-wrap justify-center gap-2 bg-slate-800/50 p-2 rounded-2xl mb-8 w-full max-w-md transition-all">
                        <button onclick="setMode('focus', 25)" class="px-4 py-2 rounded-xl text-sm font-bold bg-cyan-600/20 text-cyan-400 border border-cyan-500/30 hover:bg-cyan-600/40 transition-all">25m</button>
                        <button onclick="setMode('focus', 50)" class="px-4 py-2 rounded-xl text-sm font-bold bg-cyan-600/20 text-cyan-400 border border-cyan-500/30 hover:bg-cyan-600/40 transition-all">50m</button>
                        <button onclick="setMode('focus', 90)" class="px-4 py-2 rounded-xl text-sm font-bold bg-cyan-600/20 text-cyan-400 border border-cyan-500/30 hover:bg-cyan-600/40 transition-all">90m</button>
                        
                        <div class="flex items-center gap-2 ml-2 pl-2 border-l border-slate-700">
                            <input type="number" id="custom-time" min="1" max="180" placeholder="00" class="w-16 bg-slate-900 border border-slate-700 rounded-xl px-2 py-1.5 text-center text-sm text-cyan-400 font-bold focus:outline-none focus:border-cyan-500">
                            <button onclick="applyCustomTime()" class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-2 rounded-xl font-bold transition-all">Set</button>
                        </div>
                    </div>

                    <div class="relative flex items-center justify-center w-64 h-64 md:w-80 md:h-80 mb-10">
                        <svg class="-rotate-90 w-full h-full drop-shadow-[0_0_15px_rgba(34,211,238,0.2)]" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="3" fill="none" class="text-slate-800" />
                            <circle id="progress-ring" cx="50" cy="50" r="45" stroke="currentColor" stroke-width="3" fill="none" class="text-cyan-400 transition-all duration-1000 ease-linear" stroke-dasharray="283" stroke-dashoffset="0" stroke-linecap="round" />
                        </svg>
                        
                        <div class="absolute flex flex-col items-center">
                            <span id="session-label" class="text-cyan-400 text-xs font-bold uppercase tracking-widest mb-2">Deep Focus</span>
                            <div id="time-display" class="text-6xl md:text-7xl font-mono font-bold text-white tracking-wider drop-shadow-[0_0_20px_rgba(255,255,255,0.4)]">
                                25:00
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 relative z-10">
                        <button onclick="toggleTimer()" id="btn-toggle" class="w-40 py-4 rounded-2xl bg-gradient-to-r from-cyan-600 to-indigo-600 hover:from-cyan-500 hover:to-indigo-500 text-white font-black text-lg tracking-widest uppercase shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all hover:scale-105 active:scale-95">
                            START
                        </button>
                        <button onclick="resetTimer()" class="w-14 h-14 flex items-center justify-center rounded-2xl bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white transition-all shadow-lg border border-slate-700">
                            <i class="fas fa-stop text-lg"></i>
                        </button>
                    </div>
                </div>

                {{-- Modul Achievement & Tombol Profil --}}
                <div class="bg-slate-900/80 backdrop-blur-md p-6 rounded-3xl border border-slate-800 shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <i class="fas fa-medal text-amber-400"></i> Pencapaian Hari Ini
                            </h3>
                            <p class="text-xs text-slate-400 mt-1">Total: <span class="text-cyan-400 font-bold text-sm">{{ $myTotalToday }} Menit</span></p>
                        </div>
                        
                        <button onclick="openReportModal()" class="text-xs bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/40 hover:text-white px-4 py-2 rounded-xl font-bold transition-all border border-indigo-500/30 flex items-center gap-2 shadow-sm">
                            <i class="fas fa-user-astronaut"></i> Laporan Saya
                        </button>
                    </div>

                    <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden mb-6 border border-slate-700">
                        <div class="h-full bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-full transition-all duration-1000" style="width: {{ $progressPercent }}%;"></div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col items-center text-center p-3 rounded-2xl border {{ $badge1 ? 'bg-emerald-900/30 border-emerald-500/50 shadow-[0_0_15px_rgba(16,185,129,0.15)]' : 'bg-slate-800/30 border-slate-700/50 opacity-50 grayscale' }} transition-all">
                            <i class="fas fa-fire-alt text-2xl {{ $badge1 ? 'text-emerald-400' : 'text-slate-500' }} mb-2"></i>
                            <span class="text-xs font-bold text-white">Ignition</span>
                            <span class="text-[10px] text-slate-400">30 Menit</span>
                        </div>
                        <div class="flex flex-col items-center text-center p-3 rounded-2xl border {{ $badge2 ? 'bg-cyan-900/30 border-cyan-500/50 shadow-[0_0_15px_rgba(6,182,212,0.15)]' : 'bg-slate-800/30 border-slate-700/50 opacity-50 grayscale' }} transition-all">
                            <i class="fas fa-atom text-2xl {{ $badge2 ? 'text-cyan-400' : 'text-slate-500' }} mb-2"></i>
                            <span class="text-xs font-bold text-white">Deep State</span>
                            <span class="text-[10px] text-slate-400">2 Jam</span>
                        </div>
                        <div class="flex flex-col items-center text-center p-3 rounded-2xl border {{ $badge3 ? 'bg-indigo-900/30 border-indigo-500/50 shadow-[0_0_15px_rgba(99,102,241,0.15)]' : 'bg-slate-800/30 border-slate-700/50 opacity-50 grayscale' }} transition-all">
                            <i class="fas fa-infinity text-2xl {{ $badge3 ? 'text-indigo-400' : 'text-slate-500' }} mb-2"></i>
                            <span class="text-xs font-bold text-white">Hilbert Demon</span>
                            <span class="text-[10px] text-slate-400">4 Jam</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: LEADERBOARD --}}
            <div class="lg:col-span-5 bg-slate-900/80 backdrop-blur-md rounded-3xl border border-slate-800 shadow-2xl overflow-hidden flex flex-col h-[600px] lg:h-auto">
                <div class="p-6 border-b border-slate-800 bg-slate-900/50">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2 mb-4">
                        <i class="fas fa-crown text-amber-400 drop-shadow-[0_0_5px_rgba(251,191,36,0.5)]"></i> Hall of Fame
                    </h3>
                    <div class="flex bg-slate-950 rounded-xl p-1 shadow-inner border border-slate-800">
                        <a href="{{ route('hilbert.index', ['filter' => 'today']) }}" class="flex-1 text-center py-2 rounded-lg text-sm font-bold {{ $filter == 'today' ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-md' : 'text-slate-500 hover:text-slate-300' }} transition-all">Hari Ini</a>
                        <a href="{{ route('hilbert.index', ['filter' => 'monthly']) }}" class="flex-1 text-center py-2 rounded-lg text-sm font-bold {{ $filter == 'monthly' ? 'bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-md' : 'text-slate-500 hover:text-slate-300' }} transition-all">Bulan Ini</a>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3 relative">
                    @forelse($leaderboards as $index => $board)
                        <div class="flex items-center gap-4 p-3 rounded-2xl {{ $index == 0 ? 'bg-gradient-to-r from-amber-500/10 to-transparent border border-amber-500/30 shadow-[0_0_15px_rgba(245,158,11,0.05)]' : ($index == 1 ? 'bg-gradient-to-r from-slate-300/10 to-transparent border border-slate-400/20' : ($index == 2 ? 'bg-gradient-to-r from-orange-500/10 to-transparent border border-orange-500/20' : 'bg-slate-800/40 border border-slate-800/50')) }} transition-all hover:bg-slate-800/80">
                            
                            <div class="w-8 text-center font-black text-xl {{ $index == 0 ? 'text-amber-400 drop-shadow-md' : ($index == 1 ? 'text-slate-300 drop-shadow-md' : ($index == 2 ? 'text-orange-400 drop-shadow-md' : 'text-slate-600')) }}">
                                {{ $index + 1 }}
                            </div>

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($board->user->name) }}&background=random&color=fff" class="w-10 h-10 rounded-full border-2 {{ $index == 0 ? 'border-amber-400' : 'border-slate-700' }}">

                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-slate-200 truncate">{{ $board->user->name }}</h4>
                                <p class="text-[10px] uppercase tracking-widest text-slate-500">{{ $filter == 'today' ? 'Hari ini' : 'Bulan ini' }}</p>
                            </div>

                            <div class="text-right">
                                <span class="block font-mono font-bold text-lg text-cyan-400">{{ $board->total_minutes }}</span>
                                <span class="text-[9px] uppercase tracking-wider text-slate-500">Menit</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-slate-500 py-10">
                            <i class="fas fa-ghost text-4xl mb-4 opacity-20"></i>
                            <p class="text-sm font-medium">Belum ada anomali yang terdeteksi.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL PROFIL & LAPORAN STUDI --}}
<div id="report-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 px-4">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeReportModal()"></div>
    
    <div class="bg-slate-900 border border-slate-700 p-1 rounded-3xl shadow-2xl relative z-10 w-full max-w-2xl transform scale-95 transition-transform duration-300" id="report-card">
        <div class="bg-slate-950/50 rounded-3xl p-6 md:p-8">
            
            <div class="flex justify-between items-start mb-8">
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=128" class="w-16 h-16 rounded-2xl border-2 border-cyan-500 shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h2>
                        <span class="text-xs font-bold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 px-2 py-1 rounded-md border border-cyan-500/20">
                            {{ $myTotalAllTime >= 1000 ? 'Grandmaster Scholar' : ($myTotalAllTime >= 500 ? 'Senior Scholar' : 'Hilbert Initiate') }}
                        </span>
                    </div>
                </div>
                <button onclick="closeReportModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-slate-800/50 border border-slate-700 p-4 rounded-2xl text-center">
                    <div class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mb-1">Hari Ini</div>
                    <div class="text-2xl font-mono font-bold text-white">{{ $myTotalToday }}<span class="text-xs text-slate-500 ml-1">m</span></div>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 p-4 rounded-2xl text-center">
                    <div class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mb-1">Minggu Ini</div>
                    <div class="text-2xl font-mono font-bold text-emerald-400">{{ $myTotalThisWeek }}<span class="text-xs text-slate-500 ml-1">m</span></div>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 p-4 rounded-2xl text-center">
                    <div class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mb-1">Bulan Ini</div>
                    <div class="text-2xl font-mono font-bold text-indigo-400">{{ $myTotalThisMonth }}<span class="text-xs text-slate-500 ml-1">m</span></div>
                </div>
                <div class="bg-slate-800 border border-cyan-900/50 shadow-[0_0_15px_rgba(6,182,212,0.1)] p-4 rounded-2xl text-center">
                    <div class="text-cyan-400 text-[10px] uppercase font-bold tracking-widest mb-1">Sepanjang Masa</div>
                    <div class="text-2xl font-mono font-bold text-cyan-400">{{ $myTotalAllTime }}<span class="text-xs text-slate-500 ml-1">m</span></div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold text-slate-300 mb-3 flex items-center gap-2 border-b border-slate-800 pb-2">
                    <i class="fas fa-history text-slate-500"></i> Riwayat Sesi Terakhir
                </h4>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-2">
                    @forelse($myRecentSessions as $session)
                        <div class="flex justify-between items-center bg-slate-800/30 p-3 rounded-xl border border-slate-700/50">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-cyan-400 shadow-[0_0_5px_rgba(6,182,212,0.8)]"></div>
                                <span class="text-sm font-medium text-slate-200">Deep Focus</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs font-bold text-cyan-400">+{{ $session->duration_minutes }} Menit</span>
                                <span class="text-[10px] text-slate-500">{{ $session->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-slate-500 text-xs py-4">Belum ada riwayat sesi.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // JS UNTUK MODAL PROFIL
    const modal = document.getElementById('report-modal');
    const modalContent = document.getElementById('report-card');

    function openReportModal() {
        modal.classList.remove('hidden');
        // Sedikit delay agar transisi CSS terlihat mulus
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeReportModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        // Sembunyikan div setelah animasi selesai (300ms)
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // ===============================================
    // JS UNTUK TIMER (Tetap Sama Seperti Sebelumnya)
    // ===============================================
    let totalSeconds = 25 * 60; 
    let currentFocusMinutes = 25; 
    let timeLeft = totalSeconds;
    let isRunning = false;
    let timerId = null;
    let currentMode = 'focus'; 

    const display = document.getElementById('time-display');
    const ring = document.getElementById('progress-ring');
    const btnToggle = document.getElementById('btn-toggle');
    const timeSelector = document.getElementById('time-selector');
    const sessionLabel = document.getElementById('session-label');
    
    const audioChime = new Audio('https://actions.google.com/sounds/v1/alarms/beep_short.ogg');
    const circleCircumference = 2 * Math.PI * 45; 
    ring.style.strokeDasharray = circleCircumference;

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function updateDisplay() {
        display.innerText = formatTime(timeLeft);
        const offset = circleCircumference - (timeLeft / totalSeconds) * circleCircumference;
        ring.style.strokeDashoffset = offset;
    }

    function setMode(mode, minutes) {
        if(isRunning) {
            if(!confirm('Timer sedang berjalan! Yakin mengatur ulang waktu?')) return;
            resetTimer();
        }
        
        currentMode = mode;
        currentFocusMinutes = minutes;
        totalSeconds = minutes * 60;
        timeLeft = totalSeconds;
        
        if(mode === 'focus') {
            sessionLabel.innerText = "DEEP FOCUS";
            sessionLabel.className = "text-cyan-400 text-xs font-bold uppercase tracking-widest mb-2";
            ring.classList.replace('text-emerald-400', 'text-cyan-400');
        } else {
            sessionLabel.innerText = "REST & RECHARGE";
            sessionLabel.className = "text-emerald-400 text-xs font-bold uppercase tracking-widest mb-2";
            ring.classList.replace('text-cyan-400', 'text-emerald-400');
        }
        updateDisplay();
    }

    function applyCustomTime() {
        const inputVal = document.getElementById('custom-time').value;
        const minutes = parseInt(inputVal);
        if(isNaN(minutes) || minutes < 1) return alert("Minimal 1 menit.");
        if(minutes > 300) return alert("Maksimal 300 menit per sesi.");
        setMode('focus', minutes);
    }

    function toggleTimer() {
        if (isRunning) {
            clearInterval(timerId);
            isRunning = false;
            btnToggle.innerText = "RESUME";
            timeSelector.style.opacity = "1";
            timeSelector.style.pointerEvents = "auto";
        } else {
            isRunning = true;
            btnToggle.innerText = "PAUSE";
            timeSelector.style.opacity = "0.3";
            timeSelector.style.pointerEvents = "none";
            
            timerId = setInterval(() => {
                timeLeft--;
                updateDisplay();

                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    isRunning = false;
                    audioChime.play();
                    
                    timeSelector.style.opacity = "1";
                    timeSelector.style.pointerEvents = "auto";
                    btnToggle.innerText = "START";

                    if(currentMode === 'focus') {
                        saveSessionToDB(currentFocusMinutes);
                        alert(`Sesi fokus ${currentFocusMinutes} menit selesai! Poin ditambahkan.`);
                        setMode('break', 5); 
                    } else {
                        alert("Istirahat selesai! Mari kembali fokus.");
                        setMode('focus', 25);
                    }
                }
            }, 1000);
        }
    }

    function resetTimer() {
        if(isRunning && !confirm("Yakin membatalkan sesi ini?")) return;
        clearInterval(timerId);
        isRunning = false;
        timeLeft = totalSeconds;
        updateDisplay();
        btnToggle.innerText = "START";
        timeSelector.style.opacity = "1";
        timeSelector.style.pointerEvents = "auto";
    }

    function saveSessionToDB(minutes) {
        fetch("{{ route('hilbert.save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ duration: minutes })
        })
        .then(response => response.json())
        .then(data => {
            setTimeout(() => { window.location.reload(); }, 1500);
        })
        .catch(error => console.error("Error saving session:", error));
    }

    updateDisplay();
</script>
@endpush
@endsection