@extends('layouts.app')

@section('content')
    @include('components.welcome')
    @include('components.layanan')
    @include('components.welcomeArtikel')

    <!-- Tombol Back to Top -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-14 h-14 bg-linear-to-br from-blue-600 to-cyan-500 text-white rounded-full shadow-2xl hover:shadow-cyan-500/30 hover:scale-110 transition-all duration-300 z-40 hidden items-center justify-center text-2xl">
        <i class="fas fa-chevron-up"></i>
    </button>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('mainHeader');
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const backToTopBtn = document.getElementById('backToTop');

        // Fungsi untuk update header berdasarkan scroll
        function updateHeaderOnScroll() {
            if (window.scrollY > 50) {
                // Saat di-scroll
                header.classList.remove('bg-transparent');
                header.classList.add('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                
                // Update teks navigasi desktop
                const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                desktopLinks.forEach(link => {
                    if (link.textContent === 'Beranda') {
                        link.classList.remove('text-white', 'border-cyan-300');
                        link.classList.add('text-blue-600', 'border-blue-600');
                    } else {
                        link.classList.remove('text-white/90', 'hover:text-white');
                        link.classList.add('text-gray-600', 'hover:text-blue-600');
                    }
                });
                
                // Update tombol masuk
                const masukBtn = document.querySelector('nav.md\\:flex a:last-child');
                if (masukBtn) {
                    masukBtn.classList.remove('from-cyan-500', 'to-blue-500', 'shadow-cyan-500/30');
                    masukBtn.classList.add('from-blue-600', 'to-cyan-500');
                }
                
                // Update tombol mobile menu
                if (menuBtn) {
                    menuBtn.classList.remove('text-white');
                    menuBtn.classList.add('text-gray-700');
                }
                
                // Update logo text color
                const logoText = document.querySelector('strong.bg-gradient-to-r');
                if (logoText) {
                    logoText.classList.remove('from-blue-700', 'to-cyan-600');
                    logoText.classList.add('from-blue-700', 'to-cyan-600');
                }
                
            } else {
                // Saat di atas (posisi awal)
                header.classList.add('bg-transparent');
                header.classList.remove('bg-white', 'shadow-lg', 'border-b', 'border-gray-200');
                
                // Update teks navigasi desktop
                const desktopLinks = document.querySelectorAll('nav.md\\:flex a');
                desktopLinks.forEach(link => {
                    if (link.textContent === 'Beranda') {
                        link.classList.add('text-white', 'border-cyan-300');
                        link.classList.remove('text-blue-600', 'border-blue-600');
                    } else {
                        link.classList.add('text-white/90', 'hover:text-white');
                        link.classList.remove('text-gray-600', 'hover:text-blue-600');
                    }
                });
                
                // Update tombol masuk
                const masukBtn = document.querySelector('nav.md\\:flex a:last-child');
                if (masukBtn) {
                    masukBtn.classList.add('from-cyan-500', 'to-blue-500', 'shadow-cyan-500/30');
                    masukBtn.classList.remove('from-blue-600', 'to-cyan-500');
                }
                
                // Update tombol mobile menu
                if (menuBtn) {
                    menuBtn.classList.add('text-white');
                    menuBtn.classList.remove('text-gray-700');
                }
            }
        }

        // Toggle Mobile Menu
        function toggleMobileMenu() {
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    const icon = menuBtn.querySelector('i');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenu.classList.contains('hidden') && 
                        !mobileMenu.contains(event.target) && 
                        !menuBtn.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        const icon = menuBtn.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }
        }

        // Back to Top Button
        function initBackToTop() {
            if (!backToTopBtn) return;
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.remove('hidden');
                    backToTopBtn.classList.add('flex');
                } else {
                    backToTopBtn.classList.add('hidden');
                    backToTopBtn.classList.remove('flex');
                }
            });
            
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Inisialisasi semua fungsi
        updateHeaderOnScroll();
        toggleMobileMenu();
        initBackToTop();
        
        // Event listener untuk scroll
        window.addEventListener('scroll', updateHeaderOnScroll);
    });
</script>
@endpush