<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMAFI UNUD - Kabinet Arunika Swakarsa</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.jpg">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #mainHeader.scrolled {
            backdrop-filter: blur(0);
            -webkit-backdrop-filter: blur(0);
        }
        
        #mainHeader * {
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }

        /* Custom styles untuk video player */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Custom text shadow agar tulisan persis seperti di gambar (lebih terbaca) */
        .text-shadow-strong {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    </style>
</head>
<body>

@include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer')

@stack('scripts')
</body>
</html>