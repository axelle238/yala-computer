<div class="bg-white min-h-screen">
    <!-- Breadcrumb & Header -->
    <div class="bg-gray-50 border-b border-gray-100 py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="flex items-center gap-2 text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] mb-6">
                <a href="{{ route('beranda') }}" wire:navigate class="hover:text-blue-600">Beranda</a>
                <i class="fas fa-chevron-right text-[8px] opacity-30"></i>
                <a href="{{ route('artikel') }}" wire:navigate class="hover:text-blue-600">Blog</a>
                <i class="fas fa-chevron-right text-[8px] opacity-30"></i>
                <span class="text-gray-400">{{ $artikel->kategori }}</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight mb-8 tracking-tight">
                {{ $artikel->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold">
                        {{ substr($artikel->penulis->nama ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Penulis</p>
                        <p class="text-sm font-bold text-gray-900">{{ $artikel->penulis->nama ?? 'Admin Yala' }}</p>
                    </div>
                </div>
                <div class="h-10 w-px bg-gray-200 hidden md:block"></div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Diterbitkan</p>
                    <p class="text-sm font-bold text-gray-900">{{ $artikel->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-4xl py-16">
        <!-- Content -->
        <article class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed font-medium">
            {!! nl2br(e($artikel->konten)) !!}
        </article>

        <!-- Share Section -->
        <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Bagikan:</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-pink-600 hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <a href="{{ route('artikel') }}" wire:navigate class="text-xs font-black text-blue-600 uppercase tracking-widest hover:underline flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> KEMBALI KE BLOG
            </a>
        </div>

        <!-- Related -->
        <div class="mt-24">
            <h3 class="text-2xl font-black text-gray-900 mb-10 tracking-tight">Baca Juga</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($artikel_terbaru as $art)
                    <a href="{{ route('artikel.detail', $art->slug) }}" wire:navigate class="group">
                        <div class="aspect-video bg-blue-900 rounded-2xl mb-4 overflow-hidden flex items-center justify-center p-4">
                            <span class="text-white font-bold text-xs text-center line-clamp-2 uppercase">{{ $art->judul }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">{{ $art->judul }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
