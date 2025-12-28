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