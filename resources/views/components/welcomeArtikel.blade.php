<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        
        <div class="flex justify-between items-end mb-12">
            <div class="animate-fade-in-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-2">Artikel & <span class="text-blue-600">Berita</span> Terkini</h2>
                <p class="text-gray-600">Update kegiatan, prestasi, dan informasi terbaru dari keluarga besar HIMAFI UNUD.</p>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                Lihat Arsip <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @forelse($latestPosts as $post)
            <article class="group flex flex-col h-full animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                <div class="overflow-hidden rounded-2xl mb-6 relative h-64 shadow-md">
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/800x600?text=No+Image' }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-blue-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">
                            {{ $post->category }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col flex-grow">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="flex items-center"><i class="far fa-calendar-alt mr-2 text-blue-500"></i> {{ $post->created_at->translatedFormat('d F Y') }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition line-clamp-2 leading-tight">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h3>

                    <p class="text-gray-600 mb-4 line-clamp-3 text-sm flex-grow">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center font-bold text-sm text-blue-600 hover:text-blue-800 transition group/link">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-12">
                <div class="inline-block p-4 rounded-full bg-gray-100 text-gray-400 mb-3">
                    <i class="fas fa-newspaper text-4xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Belum ada artikel terbaru.</p>
            </div>
            @endforelse

        </div>

        <div class="text-center mt-12 md:hidden">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold px-8 py-4 rounded-full hover:shadow-xl hover:scale-105 transition-all duration-300 shadow-lg shadow-blue-500/30">
                Lihat Semua Artikel <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    </div>
</section>