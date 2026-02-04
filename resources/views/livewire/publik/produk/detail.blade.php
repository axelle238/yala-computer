<div class="bg-white min-h-screen pb-12">
    <!-- Breadcrumb -->
    <div class="bg-gray-50 border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('beranda') }}" wire:navigate class="hover:text-blue-600">Beranda</a>
                <span>/</span>
                <a href="{{ route('katalog') }}" wire:navigate class="hover:text-blue-600">Katalog</a>
                <span>/</span>
                <a href="{{ route('katalog', ['kategori_terpilih' => $produk->kategori->slug]) }}" wire:navigate class="hover:text-blue-600">{{ $produk->kategori->nama }}</a>
                <span>/</span>
                <span class="font-bold text-gray-900 truncate max-w-[200px]">{{ $produk->nama }}</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Galeri Gambar -->
            <div class="space-y-4">
                <div class="bg-gray-100 rounded-2xl overflow-hidden aspect-square border border-gray-100 relative group">
                    @if($produk->gambar_utama)
                        <img src="{{ asset('storage/'.$produk->gambar_utama) }}" alt="{{ $produk->nama }}" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <i class="fas fa-image text-6xl"></i>
                        </div>
                    @endif
                    
                    @if($produk->apakah_unggulan)
                        <div class="absolute top-4 left-4">
                            <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">PRODUK UNGGULAN</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Produk -->
            <div>
                <div class="mb-6">
                    <span class="text-blue-600 font-bold text-sm bg-blue-50 px-3 py-1 rounded-full mb-3 inline-block">
                        {{ $produk->kategori->nama }}
                    </span>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">{{ $produk->nama }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-gray-400 ml-1">(Baru)</span>
                        </span>
                        <span>•</span>
                        <span>Terjual 0</span>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        @if($produk->harga > 10000000)
                            <span class="bg-red-100 text-red-600 text-[10px] font-bold px-2 py-0.5 rounded ml-2">HEMAT 5%</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-400">Jaminan harga terbaik & produk 100% original.</p>
                </div>

                <!-- Stok & Kuantitas -->
                <div class="mb-8 space-y-6">
                    <div>
                        <p class="font-bold text-gray-900 mb-2">Ketersediaan Stok</p>
                        @if($produk->jumlah_stok > 0)
                            <div class="flex items-center gap-2 text-green-600 font-medium">
                                <i class="fas fa-check-circle"></i>
                                <span>Tersedia ({{ $produk->jumlah_stok }} unit)</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 text-red-600 font-medium">
                                <i class="fas fa-times-circle"></i>
                                <span>Stok Habis</span>
                            </div>
                        @endif
                    </div>

                    @if($produk->jumlah_stok > 0)
                        <div>
                            <p class="font-bold text-gray-900 mb-2">Jumlah Pembelian</p>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden">
                                    <button wire:click="kurangJumlah" class="w-10 h-10 bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 transition-colors">
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>
                                    <input type="text" readonly value="{{ $jumlah_beli }}" class="w-12 h-10 text-center border-none text-gray-900 font-bold focus:ring-0">
                                    <button wire:click="tambahJumlah" class="w-10 h-10 bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 transition-colors">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>
                                <span class="text-sm text-gray-500">Maks. {{ $produk->jumlah_stok }} unit</span>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button wire:click="tambahKeKeranjang" class="flex-1 bg-white border-2 border-blue-600 text-blue-600 font-bold py-3.5 rounded-xl hover:bg-blue-50 transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>+ KERANJANG</span>
                            </button>
                            <button class="flex-1 bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                                <span>BELI SEKARANG</span>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="text-xs">
                                <p class="font-bold text-gray-900">Pengiriman Cepat</p>
                                <p class="text-gray-500">Estimasi 1-3 hari kerja</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="text-xs">
                                <p class="font-bold text-gray-900">Garansi Toko</p>
                                <p class="text-gray-500">7 hari ganti baru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Informasi -->
        <div class="mb-16">
            <div class="border-b border-gray-200 mb-6">
                <nav class="flex gap-8">
                    <button class="border-b-2 border-blue-600 text-blue-600 font-bold pb-4 text-sm">Deskripsi Produk</button>
                    <button class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium pb-4 text-sm transition-colors">Spesifikasi</button>
                    <button class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium pb-4 text-sm transition-colors">Ulasan</button>
                </nav>
            </div>
            
            <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($produk->deskripsi)) !!}
            </div>
        </div>

        <!-- Produk Terkait -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($produk_terkait as $item)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden">
                        <div class="relative aspect-square bg-gray-100 overflow-hidden">
                            @if($item->gambar_utama)
                                <img src="{{ asset('storage/'.$item->gambar_utama) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-gray-400 mb-1 font-medium">{{ $item->kategori->nama }}</div>
                            <a href="{{ route('produk.detail', $item->slug) }}" wire:navigate class="block font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[40px]">
                                {{ $item->nama }}
                            </a>
                            <p class="text-lg font-bold text-blue-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
