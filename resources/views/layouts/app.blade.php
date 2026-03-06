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

    @stack('scripts')
</body>
</html>