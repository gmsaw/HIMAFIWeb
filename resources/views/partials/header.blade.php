@php
    // DAFTAR HALAMAN YANG HEADERNYA TRANSPARAN SAAT DI ATAS
    $transparentPages = ['beranda', 'divisi', 'kegiatan', 'blog'];
    
    // Cek apakah halaman aktif ada di dalam daftar tersebut
    $isTransparentDefault = in_array($activePage, $transparentPages);
@endphp

<header id="mainHeader" 
    data-transparent-default="{{ $isTransparentDefault ? 'true' : 'false' }}"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out border-b border-transparent
    {{ $isTransparentDefault ? 'bg-transparent py-5' : 'bg-white/80 backdrop-blur-md border-gray-200 shadow-sm py-3' }}">

    <div class="container mx-auto px-6 flex items-center justify-between">

        <a href="/" class="flex items-center gap-3 group relative z-50">
            <div class="relative">
                <div class="absolute inset-0 bg-blue-500 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <img src="{{ asset('img/logo.jpg') }}" 
                     class="w-10 h-10 rounded-full object-cover relative z-10 border-2 border-white/20 group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-bold tracking-tight leading-none group-hover:text-blue-500 transition-colors duration-300
                    {{ $isTransparentDefault ? 'text-white header-text' : 'text-slate-800' }}">
                    HIMAFI UNUD
                </span>
                <span class="text-[10px] font-medium tracking-widest uppercase opacity-70
                    {{ $isTransparentDefault ? 'text-blue-100 header-subtext' : 'text-slate-500' }}">
                    Kabinet Arunika Swakarsa
                </span>
            </div>
        </a>

        <div class="hidden md:flex items-center gap-6">
            
            <nav class="flex items-center gap-1" id="navContainer">
                @foreach($navItems as $item)
                    <a href="{{ $item['url'] }}" 
                       class="relative px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 group overflow-hidden
                       {{ $activePage === $item['page'] 
                           ? ($isTransparentDefault ? 'bg-white/10 text-white nav-active-transparent' : 'bg-blue-50 text-blue-600 nav-active-solid') 
                           : ($isTransparentDefault ? 'text-white/80 hover:text-white hover:bg-white/10 nav-item-transparent' : 'text-slate-600 hover:text-blue-600 hover:bg-gray-50 nav-item-solid') 
                       }}">
                        <span class="relative z-10">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="h-6 w-px bg-current opacity-10 {{ $isTransparentDefault ? 'text-white header-divider' : 'text-slate-800' }}"></div>

            <div>
                @guest
                    <a href="{{ route('login') }}" 
                       class="group relative px-6 py-2.5 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold text-sm shadow-[0_4px_14px_0_rgba(0,118,255,0.39)] hover:shadow-[0_6px_20px_rgba(0,118,255,0.23)] hover:-translate-y-0.5 transition-all duration-300 overflow-hidden flex items-center gap-2">
                        <span class="absolute inset-0 bg-white/20 group-hover:translate-x-full transition-transform duration-500 ease-out -skew-x-12 origin-left"></span>
                        <span>Masuk</span>
                        <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                    </a>
                @else
                    {{-- CEK ROLE PENGGUNA UNTUK DESKTOP --}}
                    @if(in_array(Auth::user()->role, ['admin', 'sekretaris', 'bendahara']))
                        {{-- JIKA PENGURUS INTI -> KE DASHBOARD --}}
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center gap-2 px-5 py-2 rounded-full bg-slate-800 text-white text-sm font-medium hover:bg-slate-700 transition-colors shadow-lg shadow-slate-800/20">
                            <i class="fas fa-user-circle"></i>
                            <span>Dashboard Admin</span>
                        </a>
                    @elseif(Auth::user()->role === 'eksternal')
                        {{-- JIKA EKSTERNAL -> KE HALAMAN VALIDASI BUKU BIRU --}}
                        <a href="{{ route('admin.bukubiru.index') }}" 
                           class="flex items-center gap-2 px-5 py-2 rounded-full bg-slate-800 text-white text-sm font-medium hover:bg-slate-700 transition-colors shadow-lg shadow-slate-800/20">
                            <i class="fas fa-check-double"></i>
                            <span>Validasi Buku Biru</span>
                        </a>
                    @else
                        {{-- JIKA MEMBER BIASA (Mahasiswa) -> KE BUKU BIRU --}}
                        <a href="{{ route('bukubiru.index') }}" 
                           class="flex items-center gap-2 px-5 py-2 rounded-full bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                            <i class="fas fa-book"></i>
                            <span>Buku Biru Saya</span>
                        </a>
                    @endif
                @endguest
            </div>

        </div>

        <button id="menuBtn" class="md:hidden relative z-50 p-2 focus:outline-none transition-colors duration-300
            {{ $isTransparentDefault ? 'text-white hamburger-color' : 'text-slate-800' }}">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <div id="mobileMenuBackdrop" class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-40 md:hidden"></div>

    <div id="mobileMenu" 
         class="fixed top-0 right-0 h-screen w-[280px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-out z-50 md:hidden flex flex-col">
        
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <span class="font-bold text-slate-800 text-lg">Menu</span>
        </div>

        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            @foreach($navItems as $item)
                <a href="{{ $item['url'] }}" 
                   class="flex items-center justify-between px-4 py-3.5 rounded-xl font-medium transition-all duration-200
                   {{ $activePage === $item['page'] ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-gray-50 hover:translate-x-1' }}">
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>

        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            @guest
                <a href="{{ route('login') }}" 
                   class="flex justify-center w-full py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30 active:scale-95 transition-all">
                    Masuk Akun
                </a>
            @else
                {{-- CEK ROLE PENGGUNA UNTUK MOBILE --}}
                @if(in_array(Auth::user()->role, ['admin', 'sekretaris', 'bendahara']))
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex justify-center w-full py-3 rounded-xl bg-slate-800 text-white font-bold shadow-lg shadow-slate-800/30 active:scale-95 transition-all">
                        Ke Dashboard Admin
                    </a>
                @elseif(Auth::user()->role === 'eksternal')
                    <a href="{{ route('admin.bukubiru.index') }}" 
                       class="flex justify-center w-full py-3 rounded-xl bg-slate-800 text-white font-bold shadow-lg shadow-slate-800/30 active:scale-95 transition-all">
                        Validasi Buku Biru
                    </a>
                @else
                    <a href="{{ route('bukubiru.index') }}" 
                       class="flex justify-center w-full py-3 rounded-xl bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30 active:scale-95 transition-all">
                        Ke Buku Biru Saya
                    </a>
                @endif
            @endguest
        </div>
    </div>
</header>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('mainHeader');
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const backdrop = document.getElementById('mobileMenuBackdrop');
    const btnIcon = menuBtn.querySelector('i');
    
    // Selector Elements
    const textElements = document.querySelectorAll('.header-text');
    const subtextElements = document.querySelectorAll('.header-subtext');
    const navItemsTransparent = document.querySelectorAll('.nav-item-transparent');
    const navActiveTransparent = document.querySelectorAll('.nav-active-transparent');
    const hamburgerIcon = document.querySelector('.hamburger-color');
    const headerDivider = document.querySelector('.header-divider');

    // Mengambil status default dari PHP
    const isTransparentDefault = header.dataset.transparentDefault === 'true';
    let isMenuOpen = false;

    function updateHeaderStyle() {
        const scrolled = window.scrollY > 20;
        
        // JIKA: Scrolled KE BAWAH -ATAU- Halaman ini TIDAK default transparan
        // MAKA: Jadikan Header SOLID (Putih/Glass)
        if (scrolled || !isTransparentDefault) {
            header.classList.remove('bg-transparent', 'py-5', 'border-transparent');
            header.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-sm', 'py-3', 'border-gray-200');

            textElements.forEach(el => { el.classList.remove('text-white'); el.classList.add('text-slate-800'); });
            subtextElements.forEach(el => { el.classList.remove('text-blue-100'); el.classList.add('text-slate-500'); });
            
            if(hamburgerIcon) { hamburgerIcon.classList.remove('text-white'); hamburgerIcon.classList.add('text-slate-800'); }
            if(headerDivider) { headerDivider.classList.remove('text-white'); headerDivider.classList.add('text-slate-800'); }

            navItemsTransparent.forEach(el => {
                el.classList.remove('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                el.classList.add('text-slate-600', 'hover:text-blue-600', 'hover:bg-gray-50');
            });
            navActiveTransparent.forEach(el => {
                el.classList.remove('bg-white/10', 'text-white');
                el.classList.add('bg-blue-50', 'text-blue-600');
            });

        } else {
            // JIKA: Di ATAS DAN Halaman ini Default Transparan
            // MAKA: Jadikan Header TRANSPARAN
            header.classList.add('bg-transparent', 'py-5', 'border-transparent');
            header.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-sm', 'py-3', 'border-gray-200');

            textElements.forEach(el => { el.classList.add('text-white'); el.classList.remove('text-slate-800'); });
            subtextElements.forEach(el => { el.classList.add('text-blue-100'); el.classList.remove('text-slate-500'); });
            
            if(hamburgerIcon) { hamburgerIcon.classList.add('text-white'); hamburgerIcon.classList.remove('text-slate-800'); }
            if(headerDivider) { headerDivider.classList.add('text-white'); headerDivider.classList.remove('text-slate-800'); }

            navItemsTransparent.forEach(el => {
                el.classList.add('text-white/80', 'hover:text-white', 'hover:bg-white/10');
                el.classList.remove('text-slate-600', 'hover:text-blue-600', 'hover:bg-gray-50');
            });
            navActiveTransparent.forEach(el => {
                el.classList.add('bg-white/10', 'text-white');
                el.classList.remove('bg-blue-50', 'text-blue-600');
            });
        }
    }

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            mobileMenu.classList.remove('translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            btnIcon.classList.remove('fa-bars');
            btnIcon.classList.add('fa-times');
            menuBtn.classList.remove('text-white');
            menuBtn.classList.add('text-slate-800');
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            btnIcon.classList.remove('fa-times');
            btnIcon.classList.add('fa-bars');
            updateHeaderStyle(); // Kembalikan warna sesuai posisi scroll
            document.body.style.overflow = '';
        }
    }

    menuBtn.addEventListener('click', (e) => { e.stopPropagation(); toggleMenu(); });
    backdrop.addEventListener('click', toggleMenu);
    
    // Event Listener Scroll
    window.addEventListener('scroll', updateHeaderStyle);
    
    // Jalankan sekali saat load
    updateHeaderStyle();
});
</script>
@endpush