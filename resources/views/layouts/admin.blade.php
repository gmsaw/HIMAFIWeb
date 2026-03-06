<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HIMAFI UNUD') - Sistem Informasi</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.jpg') }}">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        himafi: {
                            dark: '#0f172a',
                            blue: '#2563eb'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    @stack('styles')
</head>

<body class="bg-gray-50 text-slate-800 font-sans antialiased">

{{-- 1. BACKDROP --}}
<div id="sidebarBackdrop" 
     class="fixed inset-0 bg-slate-900/50 z-40 hidden transition-opacity opacity-0 md:hidden"></div>

<div class="flex h-screen overflow-hidden">

    {{-- 2. SIDEBAR --}}
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white flex flex-col transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:relative md:flex-shrink-0">

        <div class="h-20 flex items-center px-6 border-b border-slate-700 justify-between md:justify-start">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold">H</div>
                <div>
                    <h1 class="font-bold text-lg">HIMAFI <span class="text-blue-400">IS</span></h1>
                    <p class="text-xs text-slate-400">Arunika Swakarsa</p>
                </div>
            </div>
            <button id="closeSidebarBtn" class="md:hidden text-slate-400 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1 no-scrollbar">

            {{-- MENU UTAMA --}}
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase mb-2">Menu Utama</p>

            {{-- SEMBUNYIKAN DASHBOARD UNTUK ROLE EKSTERNAL --}}
            @if(Auth::user()->role !== 'eksternal')
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg
                    {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-th-large w-5 text-center"></i>
                    Dashboard
                </a>
            @endif

            {{-- LOGIKA SIDEBAR BERDASARKAN ROLE --}}

            {{-- GROUP: KEUANGAN (Admin & Bendahara) --}}
            @if(in_array(Auth::user()->role, ['admin', 'bendahara']))
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase mt-6 mb-2">Keuangan</p>
                
                <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-3 px-3 py-3 {{ request()->routeIs('admin.finance.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-colors">
                    <i class="fas fa-wallet w-5 text-center"></i>
                    <span class="font-medium">Manajemen Kas</span>
                </a>
            @endif

            {{-- GROUP: ADMINISTRASI (Admin, Sekretaris, Eksternal) --}}
            @if(in_array(Auth::user()->role, ['admin', 'sekretaris', 'eksternal']))
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase mt-6 mb-2">Administrasi</p>

                {{-- HANYA ADMIN & SEKRETARIS YANG BISA LIHAT TTE UMUM --}}
                @if(in_array(Auth::user()->role, ['admin', 'sekretaris']))
                    <a href="{{ route('admin.tte.index') }}" class="flex items-center gap-3 px-3 py-3 {{ request()->routeIs('admin.tte.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-signature w-5 text-center"></i>
                        <span class="font-medium">E-Signature</span>
                        
                        @php 
                            $pendingDocs = \App\Models\Document::where('status', 'pending')->count(); 
                            $pendingBBTte = \App\Models\Certificate::where('tte_status', 'pending')->count();
                            $totalTtePending = $pendingDocs + $pendingBBTte;
                        @endphp
                        
                        @if($totalTtePending > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $totalTtePending }}</span>
                        @endif
                    </a>
                @endif

                {{-- BUKU BIRU (Bisa dilihat Admin, Sekretaris, & Eksternal) --}}
                <a href="{{ route('admin.bukubiru.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.bukubiru.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-all">
                    <i class="fas fa-id-card w-5 text-center"></i>
                    <span class="font-medium">Validasi Buku Biru</span>
                    
                    @php 
                        $pendingCert = \App\Models\Certificate::where('status', 'pending')->count(); 
                    @endphp
                    
                    @if($pendingCert > 0)
                        <span class="ml-auto bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingCert }}</span>
                    @endif
                </a>

                {{-- SISA MENU ADMINISTRASI HANYA UNTUK ADMIN & SEKRE --}}
                @if(in_array(Auth::user()->role, ['admin', 'sekretaris']))
                    {{-- Inventaris --}}
                    <a href="{{ route('admin.inventory.index') }}" class="flex items-center gap-3 px-3 py-3 {{ request()->routeIs('admin.inventory.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-boxes w-5 text-center"></i>
                        <span class="font-medium">Inventaris</span>
                    </a>

                    {{-- Perpustakaan --}}
                    <a href="{{ route('admin.library.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.library.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-all">
                        <i class="fas fa-book w-5 text-center"></i>
                        <span class="font-medium">Perpustakaan</span>
                    </a>

                    {{-- Aspirasi --}}
                    <a href="{{ route('admin.aspirasi.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.aspirasi.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-all">
                        <i class="fas fa-bullhorn w-5 text-center"></i>
                        <span class="font-medium">Kotak Aspirasi</span>
                        @php $unreadAsp = \App\Models\Aspiration::where('is_read', 0)->count(); @endphp
                        @if($unreadAsp > 0)
                            <span class="ml-auto bg-purple-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full animate-pulse">{{ $unreadAsp }}</span>
                        @endif
                    </a>

                    {{-- Short Link --}}
                    <a href="{{ route('admin.links.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.links.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:text-white hover:bg-slate-800' }} rounded-lg transition-all">
                        <i class="fas fa-link w-5 text-center"></i>
                        <span class="font-medium">Short Link</span>
                    </a>

                    {{-- Blog --}}
                    <a href="{{ route('admin.blog.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg {{ request()->routeIs('admin.blog.*') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-newspaper w-5 text-center"></i>
                        Blog & Berita
                    </a>
                @endif
            @endif

            {{-- GROUP: SUPER ADMIN (Hanya Admin) --}}
            @if(Auth::user()->role === 'admin')
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase mt-6 mb-2">Super Admin</p>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg
                    {{ request()->routeIs('admin.users.index') ? 'bg-blue-600/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-users-cog w-5 text-center"></i>
                    Manajemen User
                    
                    @php 
                        $pendingUsers = \App\Models\User::where('is_approved', 0)->count(); 
                    @endphp
                    
                    @if($pendingUsers > 0)
                        <span class="ml-auto bg-indigo-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingUsers }}</span>
                    @endif
                </a>
            @endif

        </nav>

        <div class="p-4 border-t border-slate-700">
            <div class="flex items-center gap-3">
                <img class="w-10 h-10 rounded-full"
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random">
                <div class="flex-1">
                    <p class="text-sm font-medium truncate max-w-[100px]">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button onclick="return confirm('Keluar?')" class="text-red-400 hover:text-red-300 transition" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col overflow-hidden relative">

        <header class="h-20 bg-white border-b flex items-center justify-between px-6 sticky top-0 z-30">
            
            <div class="flex items-center gap-4">
                {{-- Hamburger Mobile --}}
                <button id="sidebarToggle" class="text-slate-500 hover:text-blue-600 focus:outline-none md:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <h2 class="text-xl font-bold">@yield('header-title', 'Dashboard')</h2>
            </div>
            
            <p class="text-sm text-slate-500 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</p>
        </header>

        <div class="flex-1 overflow-y-auto p-6">
            @yield('content')

            <footer class="mt-12 text-center text-slate-400 text-sm">
                &copy; 2026 HIMAFI UNUD - Kabinet Arunika Swakarsa
            </footer>
        </div>
    </main>
</div>

{{-- JAVASCRIPT MOBILE MENU --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('closeSidebarBtn');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            
            if (isClosed) {
                // BUKA
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => { backdrop.classList.remove('opacity-0'); }, 10);
            } else {
                // TUTUP
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => { backdrop.classList.add('hidden'); }, 300);
            }
        }

        if(toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if(backdrop) backdrop.addEventListener('click', toggleSidebar);
    });
</script>

@stack('scripts')

</body>
</html>