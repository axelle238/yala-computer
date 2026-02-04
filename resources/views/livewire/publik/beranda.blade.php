<div>
    <!-- Hero Section -->
    <section class="relative bg-blue-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-white rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute left-0 bottom-0 w-[300px] h-[300px] bg-blue-400 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="container mx-auto px-4 py-20 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="flex-1 text-center md:text-left space-y-6">
                    <div class="inline-block bg-blue-800 text-blue-200 text-xs font-bold px-4 py-2 rounded-full mb-2">
                        <i class="fas fa-bolt text-yellow-400 mr-2"></i> PROMO SPESIAL FEBRUARI 2026
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                        Upgrade Setup Impian <br>
                        <span class="text-blue-400">Mulai Dari Sini</span>
                    </h1>
                    <p class="text-blue-100 text-lg md:max-w-xl leading-relaxed">
                        Temukan laptop gaming, PC rakitan performa tinggi, dan aksesoris premium dengan harga terbaik dan garansi resmi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start pt-4">
                        <a href="{{ url('/katalog') }}" wire:navigate class="bg-white text-blue-900 font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all transform hover:-translate-y-1">
                            BELANJA SEKARANG
                        </a>
                        <a href="#" class="bg-blue-800/50 backdrop-blur-sm text-white font-bold py-4 px-8 rounded-xl border border-blue-700 hover:bg-blue-800 transition-all">
                            RAKIT PC KAMU
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative">
                    <img src="https://placehold.co/600x400/1e3a8a/ffffff?text=Laptop+Gaming+High+End" alt="Laptop Gaming" class="rounded-3xl shadow-2xl border-8 border-white/10 rotate-3 transform hover:rotate-0 transition-transform duration-500">
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl animate-bounce hidden md:block">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold">GARANSI RESMI</p>
                                <p class="font-bold text-gray-800">100% Original</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Jelajahi Kategori</h2>
                <p class="text-gray-500">Temukan produk sesuai kebutuhan Anda</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($kategori_populer as $kategori)
                    <a href="#" class="group bg-gray-50 hover:bg-white border border-gray-100 hover:border-blue-200 rounded-2xl p-6 text-center transition-all shadow-sm hover:shadow-lg hover:-translate-y-1">
                        <div class="w-14 h-14 mx-auto bg-white group-hover:bg-blue-600 rounded-full shadow-sm group-hover:shadow-blue-300 flex items-center justify-center text-blue-600 group-hover:text-white mb-4 transition-colors">
                            <i class="{{ $kategori->ikon ?? 'fas fa-box' }} text-xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 group-hover:text-blue-700 transition-colors text-sm">{{ $kategori->nama }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Produk Unggulan</h2>
                    <p class="text-gray-500 text-sm">Pilihan terbaik minggu ini</p>
                </div>
                <a href="{{ url('/katalog') }}" wire:navigate class="text-blue-600 font-bold text-sm hover:underline">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($produk_unggulan as $produk)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden">
                        <div class="relative aspect-square bg-gray-100 overflow-hidden">
                            @if($produk->gambar_utama)
                                <img src="{{ asset('storage/'.$produk->gambar_utama) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Badge -->
                            <div class="absolute top-3 left-3 flex flex-col gap-2">
                                <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">HOT</span>
                            </div>

                            <!-- Quick Action -->
                            <div class="absolute bottom-3 right-3 translate-y-12 group-hover:translate-y-0 transition-transform duration-300 flex gap-2">
                                <button class="w-9 h-9 bg-white text-blue-600 rounded-full shadow-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors">
                                    <i class="fas fa-shopping-cart text-xs"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="p-5">
                            <div class="text-xs text-gray-400 mb-1 font-medium">{{ $produk->kategori->nama }}</div>
                            <a href="#" class="block font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[40px]">
                                {{ $produk->nama }}
                            </a>
                            <div class="flex items-end justify-between">
                                <div>
                                    <p class="text-xs text-gray-400 line-through">Rp {{ number_format($produk->harga * 1.1, 0, ',', '.') }}</p>
                                    <p class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-blue-50/50 border border-blue-100">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-blue-200">
                        <i class="fas fa-shipping-fast text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Kami bekerja sama dengan logistik terpercaya untuk memastikan barang sampai tepat waktu.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-green-50/50 border border-green-100">
                    <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-green-200">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Garansi Resmi</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Semua produk yang kami jual bergaransi resmi distributor Indonesia. Aman & Terpercaya.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-purple-50/50 border border-purple-100">
                    <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-purple-200">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Dukungan 24/7</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Tim teknis kami siap membantu konsultasi spesifikasi atau kendala produk kapan saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
