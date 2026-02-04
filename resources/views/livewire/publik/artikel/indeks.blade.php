<div class="bg-gray-50 min-h-screen py-16">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Pusat Edukasi & Berita IT</h1>
            <p class="text-gray-500 text-lg">Temukan tips, trik, tutorial, dan berita teknologi terbaru untuk mendukung setup impian Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($daftar_artikel as $art)
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all group overflow-hidden flex flex-col">
                    <div class="aspect-video bg-blue-900 relative overflow-hidden">
                        <!-- Placeholder image with text -->
                        <div class="w-full h-full flex items-center justify-center text-blue-300 font-black text-xl p-8 text-center uppercase tracking-tighter italic">
                            {{ $art->judul }}
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-widest">{{ $art->kategori }}</span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-[10px] font-bold text-gray-400 mb-4 uppercase tracking-widest">
                            <span><i class="far fa-calendar-alt mr-1"></i> {{ $art->created_at->format('d M Y') }}</span>
                            <span>•</span>
                            <span><i class="far fa-user mr-1"></i> {{ $art->penulis->nama ?? 'Admin' }}</span>
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">
                            {{ $art->judul }}
                        </h2>
                        
                        <p class="text-sm text-gray-500 mb-8 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($art->konten), 120) }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('artikel.detail', $art->slug) }}" wire:navigate class="inline-flex items-center gap-2 text-blue-600 font-black text-xs uppercase tracking-[0.2em] group/link">
                                <span>BACA SELENGKAPNYA</span>
                                <i class="fas fa-arrow-right transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-400 italic">Belum ada artikel yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $daftar_artikel->links() }}
        </div>
    </div>
</div>
