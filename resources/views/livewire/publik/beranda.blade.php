<div>
    <!-- Hero Section (Dynamic Banner) -->
    <section class="relative bg-[#020617] overflow-hidden min-h-[600px] flex items-center">
        <!-- Ambient Background -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 py-20">
            <!-- Carousel Container -->
            <div class="relative w-full" x-data="{ activeSlide: 0, slides: {{ $daftar_banner->count() }}, timer: null }" x-init="timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)">
                
                <!-- Slides -->
                <div class="relative overflow-hidden min-h-[500px] rounded-[3rem] shadow-2xl">
                    @forelse($daftar_banner as $index => $banner)
                        <div x-show="activeSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-700"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-105"
                             class="absolute inset-0 w-full h-full"
                        >
                            <img src="{{ asset('storage/'.$banner->gambar) }}" alt="{{ $banner->judul }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                            
                            <div class="absolute inset-0 flex items-center px-12 md:px-20">
                                <div class="max-w-2xl space-y-6">
                                    <span class="inline-block px-4 py-2 rounded-full bg-blue-600/20 border border-blue-500/30 text-blue-400 text-xs font-bold uppercase tracking-widest backdrop-blur-sm">
                                        Featured Promotion
                                    </span>
                                    <h2 class="text-4xl md:text-6xl font-['Outfit'] font-black text-white leading-tight tracking-tight drop-shadow-lg">
                                        {{ $banner->judul }}
                                    </h2>
                                    @if($banner->deskripsi)
                                        <p class="text-lg text-slate-300 leading-relaxed drop-shadow-md">
                                            {{ $banner->deskripsi }}
                                        </p>
                                    @endif
                                    @if($banner->tautan_tombol)
                                        <a href="{{ $banner->tautan_tombol }}" wire:navigate class="inline-flex items-center gap-3 bg-white text-slate-900 font-bold py-4 px-8 rounded-2xl hover:bg-blue-500 hover:text-white transition-all transform hover:-translate-y-1 shadow-xl mt-4">
                                            <span>{{ $banner->teks_tombol }}</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Default Static Slide if No Banner -->
                        <div class="absolute inset-0 w-full h-full flex items-center px-12 md:px-20 bg-[#0B1120]">
                            <div class="max-w-2xl space-y-6">
                                <h2 class="text-5xl md:text-7xl font-['Outfit'] font-black text-white leading-tight tracking-tight">
                                    Power Your <br>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Digital Dreams</span>
                                </h2>
                                <p class="text-lg text-slate-400 leading-relaxed">
                                    Temukan perangkat komputasi performa tinggi untuk gaming dan produktivitas Anda.
                                </p>
                                <a href="{{ url('/katalog') }}" wire:navigate class="inline-flex items-center gap-3 bg-blue-600 text-white font-bold py-4 px-8 rounded-2xl hover:bg-blue-500 transition-all shadow-xl">
                                    <span>Jelajahi Katalog</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Controls -->
                @if($daftar_banner->count() > 1)
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                        @foreach($daftar_banner as $index => $banner)
                            <button @click="activeSlide = {{ $index }}; clearInterval(timer); timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)" 
                                    class="w-3 h-3 rounded-full transition-all duration-300"
                                    :class="activeSlide === {{ $index }} ? 'bg-blue-500 w-8' : 'bg-white/30 hover:bg-white/50'">
                            </button>
                        @endforeach
                    </div>
                    
                    <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1; clearInterval(timer); timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition-all hidden md:flex">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1; clearInterval(timer); timer = setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md flex items-center justify-center text-white transition-all hidden md:flex">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-['Outfit'] font-black text-slate-900 mb-4 uppercase tracking-tight">Kategori Pilihan</h2>
                <div class="w-24 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($kategori_populer as $kategori)
                    <a href="{{ route('katalog', ['kategori_terpilih' => $kategori->slug]) }}" class="group relative bg-slate-50 hover:bg-white border border-slate-100 hover:border-blue-200 rounded-[2rem] p-8 text-center transition-all shadow-sm hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]"></div>
                        <div class="w-16 h-16 mx-auto bg-white group-hover:bg-blue-600 rounded-2xl shadow-md group-hover:shadow-blue-300/50 flex items-center justify-center text-blue-600 group-hover:text-white mb-6 transition-all duration-300">
                            <i class="{{ $kategori->ikon ?? 'fas fa-box' }} text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 group-hover:text-blue-700 transition-colors">{{ $kategori->nama }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="py-20 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-['Outfit'] font-black text-slate-900 mb-2 uppercase tracking-tight">Produk Unggulan</h2>
                    <p class="text-slate-500">Pilihan terbaik yang paling banyak dicari minggu ini</p>
                </div>
                <a href="{{ url('/katalog') }}" wire:navigate class="text-blue-600 font-bold text-sm hover:text-blue-700 flex items-center gap-2 group">
                    Lihat Semua <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($produk_unggulan as $produk)
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 group overflow-hidden flex flex-col h-full">
                        <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                            @if($produk->gambar_utama)
                                <img src="{{ asset('storage/'.$produk->gambar_utama) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1.5 rounded-lg shadow-lg uppercase tracking-wider">Unggulan</span>
                            </div>

                            <!-- Quick Action Overlay -->
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 backdrop-blur-[2px]">
                                <a href="{{ route('produk.detail', $produk->slug) }}" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-slate-900 hover:text-blue-600 hover:scale-110 transition-all shadow-xl">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="text-xs font-bold text-blue-500 mb-2 uppercase tracking-wider">{{ $produk->kategori->nama }}</div>
                            <a href="{{ route('produk.detail', $produk->slug) }}" class="block text-lg font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug">
                                {{ $produk->nama }}
                            </a>
                            
                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-50">
                                <div>
                                    <p class="text-xs text-slate-400 line-through font-medium">Rp {{ number_format($produk->harga * 1.1, 0, ',', '.') }}</p>
                                    <p class="text-xl font-['Outfit'] font-black text-slate-900">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                                <button class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-[2.5rem] bg-blue-50 border border-blue-100 flex flex-col items-center text-center group hover:bg-blue-600 hover:border-blue-600 transition-all duration-300">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-blue-600 text-2xl shadow-lg mb-6 group-hover:text-blue-600">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-white transition-colors">Pengiriman Cepat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed group-hover:text-blue-100 transition-colors">Kami bekerja sama dengan logistik premium untuk memastikan barang sampai tepat waktu dan aman.</p>
                </div>
                
                <div class="p-8 rounded-[2.5rem] bg-emerald-50 border border-emerald-100 flex flex-col items-center text-center group hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-emerald-600 text-2xl shadow-lg mb-6 group-hover:text-emerald-600">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-white transition-colors">Garansi Resmi</h3>
                    <p class="text-slate-500 text-sm leading-relaxed group-hover:text-emerald-100 transition-colors">Semua produk dilindungi garansi resmi distributor Indonesia. Klaim mudah dan cepat.</p>
                </div>

                <div class="p-8 rounded-[2.5rem] bg-purple-50 border border-purple-100 flex flex-col items-center text-center group hover:bg-purple-600 hover:border-purple-600 transition-all duration-300">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-purple-600 text-2xl shadow-lg mb-6 group-hover:text-purple-600">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-white transition-colors">Dukungan Ahli</h3>
                    <p class="text-slate-500 text-sm leading-relaxed group-hover:text-purple-100 transition-colors">Tim teknis kami siap membantu konsultasi spesifikasi sebelum Anda membeli.</p>
                </div>
            </div>
        </div>
    </section>
</div>