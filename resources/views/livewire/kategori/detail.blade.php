<div class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Kategori: {{ $kategori->nama }}</h1>
            <p class="text-gray-500 mt-2">Menampilkan produk dalam kategori {{ $kategori->nama }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($produk as $item)
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl transition group flex flex-col h-full">
                    <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
                        <img src="https://placehold.co/400x300/e2e8f0/475569?text={{ urlencode($item->nama) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <a href="{{ route('produk.rincian', $item->slug) }}" class="absolute inset-0 z-10"></a>
                        @if($item->stok < 1)
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center z-20 pointer-events-none">
                                <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded uppercase">Habis</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex-grow flex flex-col relative">
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 leading-snug">
                            <a href="{{ route('produk.rincian', $item->slug) }}" class="hover:text-blue-600 transition">
                                {{ $item->nama }}
                            </a>
                        </h3>
                        <div class="text-lg font-bold text-gray-900 mt-auto">
                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="p-5 pt-0 mt-auto relative z-20">
                        <a href="{{ route('produk.rincian', $item->slug) }}" class="w-full py-2.5 px-4 bg-gray-900 hover:bg-blue-600 text-white text-sm font-semibold rounded-lg transition flex items-center justify-center gap-2">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    Belum ada produk di kategori ini.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $produk->links() }}
        </div>
    </div>
</div>
