<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan <span class="text-blue-600">Unggulan</span> Kami</h2>
            <p class="text-xl text-gray-600">Akses berbagai layanan kemahasiswaan HIMAFI UNUD yang dirancang untuk mendukung aktivitas akademik dan non-akademik Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            {{-- Layanan 1: Ruang Hilbert (Study Space) - EKSKLUSIF MEMBER --}}
            @auth
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-slate-700 group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-500/20 blur-3xl rounded-full pointer-events-none"></div>
                <div class="w-14 h-14 bg-slate-800 border border-slate-600 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500 shadow-inner">
                    <i class="fas fa-brain text-2xl text-cyan-400 drop-shadow-[0_0_8px_rgba(34,211,238,0.8)]"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3 flex items-center gap-2">
                    Ruang Hilbert
                    <span class="bg-cyan-500/20 text-cyan-400 text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider font-bold border border-cyan-500/30">Live</span>
                </h3>
                <p class="text-slate-400 mb-6 text-sm leading-relaxed">Study space virtual eksklusif. Gunakan Pomodoro timer, fokus mendalam, dan bersainglah di papan peringkat (Leaderboard) mahasiswa Fisika.</p>
                <a href="{{ route('hilbert.index') }}" class="text-cyan-400 font-bold inline-flex items-center hover:text-cyan-300 transition-colors">
                    Masuk Ruangan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @else
            <div class="bg-white rounded-2xl p-8 shadow-sm border-2 border-dashed border-gray-300 group flex flex-col justify-between opacity-80 hover:opacity-100 transition-all duration-300">
                <div>
                    <div class="w-14 h-14 bg-gray-100 rounded-xl mb-6 flex items-center justify-center text-gray-400">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-3">Ruang Hilbert</h3>
                    <p class="text-gray-500 mb-6 text-sm">Virtual study space dengan Live Pomodoro & Leaderboard. Fitur ini eksklusif hanya untuk anggota yang sudah masuk.</p>
                </div>
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 bg-blue-50 text-blue-600 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition-colors text-sm">
                    Login untuk Akses
                </a>
            </div>
            @endauth

            {{-- Layanan 2: Form Builder - EKSKLUSIF ADMIN/MEMBER --}}
            @auth
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-clipboard-list text-2xl text-indigo-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3 flex items-center gap-2">
                    Form Builder
                </h3>
                <p class="text-gray-600 mb-6 text-sm leading-relaxed">Buat formulir pendaftaran dinamis dengan fitur tanda tangan digital, bagikan tautan, dan kelola rekap data responden dengan mudah.</p>
                <a href="{{ route('form.index') }}" class="text-indigo-600 font-bold inline-flex items-center hover:text-indigo-800 transition-colors text-sm">
                    Kelola Formulir <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @else
            <div class="bg-white rounded-2xl p-8 shadow-sm border-2 border-dashed border-gray-300 group flex flex-col justify-between opacity-80 hover:opacity-100 transition-all duration-300">
                <div>
                    <div class="w-14 h-14 bg-gray-100 rounded-xl mb-6 flex items-center justify-center text-gray-400">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-3">Form Builder</h3>
                    <p class="text-gray-500 mb-6 text-sm leading-relaxed">Buat dan kelola formulir dinamis HIMAFI. Fitur administrasi ini eksklusif hanya untuk pengurus/anggota yang sudah masuk.</p>
                </div>
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 bg-indigo-50 text-indigo-600 rounded-lg font-bold hover:bg-indigo-600 hover:text-white transition-colors text-sm">
                    Login untuk Akses
                </a>
            </div>
            @endauth

            {{-- Layanan 3: Peminjaman Inventaris --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-box-open text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Peminjaman Inventaris</h3>
                <p class="text-gray-600 mb-6 text-sm">Ajukan peminjaman alat laboratorium, multimedia, dan inventaris organisasi lainnya secara online dengan proses yang cepat.</p>
                <a href="#" class="text-blue-600 font-semibold inline-flex items-center hover:text-blue-800 text-sm">
                    Ajukan Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 4: Pengajuan TTE --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-signature text-2xl text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Pengajuan E-Sign</h3>
                <p class="text-gray-600 mb-6 text-sm">Layanan pengajuan tanda tangan digital (TTE) untuk surat pengantar, proposal, dan dokumen administratif resmi HIMAFI.</p>
                <a href="/tte/ajukan" class="text-green-600 font-semibold inline-flex items-center hover:text-green-800 text-sm">
                    Mulai Pengajuan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 5: Koperasi --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-store text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Koperasi Mahasiswa</h3>
                <p class="text-gray-600 mb-6 text-sm">Temukan kebutuhan kampus dengan harga terjangkau. Dari alat tulis, merchandise HIMAFI, hingga snack tersedia di sini.</p>
                <a href="/katalog" class="text-amber-600 font-semibold inline-flex items-center hover:text-amber-800 text-sm">
                    Lihat Katalog <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 6: Ruang Aspirasi --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-comment-dots text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Ruang Aspirasi</h3>
                <p class="text-gray-600 mb-6 text-sm">Sampaikan ide, kritik, dan saran Anda untuk kemajuan HIMAFI dan jurusan Fisika. Aspirasi akan ditindaklanjuti.</p>
                <a href="/aspirasi" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-800 text-sm">
                    Beri Aspirasi <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 7: Pelatihan Online --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-red-100 to-red-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-laptop-code text-2xl text-red-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Pelatihan Online</h3>
                <p class="text-gray-600 mb-6 text-sm">Tingkatkan skill dengan webinar eksklusif anggota HIMAFI, mulai dari pemrograman, analisis data, hingga soft skills.</p>
                <a href="#" class="text-red-600 font-semibold inline-flex items-center hover:text-red-800 text-sm">
                    Lihat Jadwal <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 8: Perpustakaan --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-pink-100 to-pink-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fa-solid fa-book text-2xl text-pink-500"></i>  
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Perpustakaan</h3>
                <p class="text-gray-600 mb-6 text-sm">Akses literatur fisik maupun digital, jurnal penelitian, serta modul kuliah untuk menunjang kebutuhan referensi akademik Anda.</p>
                <a href="/perpustakaan" class="text-pink-500 font-semibold inline-flex items-center hover:text-pink-600 text-sm">
                    Lihat Rak Buku <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- Layanan 9: Simulasi Fisika --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group">
                <div class="w-14 h-14 bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-xl mb-6 flex items-center justify-center group-hover:scale-110 transition duration-500">
                    <i class="fas fa-atom text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Simulasi Fisika</h3>
                <p class="text-gray-600 mb-6 text-sm">Eksplorasi fenomena fisika secara interaktif dan komputasional. Akses berbagai modul dari mekanika hingga kuantum.</p>
                <a href="/simulasi" class="text-cyan-600 font-semibold inline-flex items-center hover:text-cyan-800 text-sm">
                    Coba Simulasi <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
        </div>
    </div>
</section>