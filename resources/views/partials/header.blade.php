<!-- Header & Navigation dengan efek scroll -->
<header id="mainHeader" class="sticky top-0 z-50 transition-all duration-300 bg-transparent">
    <div class="container mx-auto px-4 py-3 md:py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center overflow-hidde bg-white/20 backdrop-blur-sm">
                    <img 
                        src="/img/logo.jpg" 
                        alt="logohimafi" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <strong class="text-xl md:text-2xl font-bold bg-linear-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent">HIMAFI UNUD</strong>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 lg:space-x-8">
                <a href="/" class="font-semibold text-white hover:text-white border-b-2 border-cyan-300 pb-1 transition-colors duration-200">Beranda</a>
                <a href="/fungsionaris" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Fungsionaris</a>
                <a href="#" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Program Kerja</a>
                <a href="/artikel" class="font-medium text-white/90 hover:text-white transition-colors duration-200">Artikel</a>
                <a href="/login" class="bg-linear-to-r from-cyan-500 to-blue-500 text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 text-sm lg:text-base">Masuk</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="md:hidden text-white text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-white/20 pt-4">
            <div class="flex flex-col space-y-4">
                <a href="#" class="font-semibold text-white py-2">Beranda</a>
                <a href="#" class="font-medium text-white/90 hover:text-white py-2">Fungsionaris</a>
                <a href="#" class="font-medium text-white/90 hover:text-white py-2">Program Kerja</a>
                <a href="#" class="font-medium text-white/90 hover:text-white py-2">Artikel</a>
                <a href="#" class="bg-linear-to-r from-cyan-500 to-blue-500 text-white px-4 py-3 rounded-full font-semibold text-center hover:shadow-lg transition mt-2">Masuk</a>
            </div>
        </div>
    </div>
</header>