<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'HIMAFI UNUD - Kabinet Arunika Swakarsa')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans text-slate-800 antialiased flex flex-col min-h-screen">

    @php
        $activePage = $activePage ?? 'beranda';
        // Definisikan Nav Items disini (atau lebih baik di AppServiceProvider)
        $navItems = [
            ['label' => 'Beranda', 'page' => 'beranda', 'url' => '/'],
            ['label' => 'Divisi', 'page' => 'divisi', 'url' => '/divisi'],
            ['label' => 'Kegiatan', 'page' => 'kegiatan', 'url' => '/kegiatan'],
            ['label' => 'Blog', 'page' => 'blog', 'url' => '/blog'],
        ];
    @endphp

    @include('partials.header', ['activePage' => $activePage, 'navItems' => $navItems])

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    @include('partials.footer')

    <button id="backToTop" 
        class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-500 text-white rounded-full shadow-lg hidden items-center justify-center z-50 transition-all duration-300 hover:scale-110 hover:shadow-xl focus:outline-none">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Logic Back to Top
            const backToTop = document.getElementById('backToTop');
            
            if (backToTop) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTop.classList.remove('hidden');
                        backToTop.classList.add('flex');
                    } else {
                        backToTop.classList.add('hidden');
                        backToTop.classList.remove('flex');
                    }
                });

                backToTop.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('submit', function(e) {
            // Tangkap elemen form yang sedang disubmit
            const form = e.target;

            // Pastikan yang memicu event benar-benar sebuah tag <form>
            if (form.tagName.toLowerCase() === 'form') {
                
                // Jangan halangi jika form memiliki class khusus 'allow-double' (opsional)
                if (form.classList.contains('allow-double')) return;

                // Cari semua tombol submit di dalam form tersebut
                const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');

                // Matikan (disable) semua tombol submit agar tidak bisa diklik lagi
                submitButtons.forEach(button => {
                    // Jangan nonaktifkan jika form belum lolos validasi HTML5 bawaan browser
                    if (form.checkValidity()) {
                        button.disabled = true;
                        button.classList.add('opacity-75', 'cursor-not-allowed', 'pointer-events-none');
                        
                        // Jika elemennya berupa <button>, tambahkan efek loading
                        if (button.tagName.toLowerCase() === 'button') {
                            // Simpan teks asli jika suatu saat perlu dikembalikan
                            if (!button.dataset.originalHtml) {
                                button.dataset.originalHtml = button.innerHTML;
                            }
                            // Ganti teks dengan animasi spinner
                            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                        }
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>