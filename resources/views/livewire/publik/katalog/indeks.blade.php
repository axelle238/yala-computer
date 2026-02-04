<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('beranda') }}" wire:navigate class="hover:text-blue-600">Beranda</a>
            <span>/</span>
            <span class="font-bold text-gray-900">Katalog Produk</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filter -->
            <aside class="w-full lg:w-64 flex-shrink-0 space-y-6">
                <!-- Pencarian -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Pencarian</h3>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Cari nama produk..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 pl-10 text-sm focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Kategori</h3>
                    <div class="space-y-2">
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="kategori_terpilih" value="" class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-sm text-gray-600 group-hover:text-blue-600">Semua Kategori</span>
                            </div>
                        </label>
                        @foreach($daftar_kategori as $kat)
                            <label class="flex items-center justify-between cursor-pointer group">
                                <div class="flex items-center gap-3">
                                    <input type="radio" wire:model.live="kategori_terpilih" value="{{ $kat->slug }}" class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="text-sm text-gray-600 group-hover:text-blue-600">{{ $kat->nama }}</span>
                                </div>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $kat->produk_count }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- Grid Produk -->
            <div class="flex-1">
                <!-- Toolbar Atas -->
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        Menampilkan <span class="font-bold text-gray-900">{{ $daftar_produk->firstItem() ?? 0 }}-{{ $daftar_produk->lastItem() ?? 0 }}</span> dari <span class="font-bold text-gray-900">{{ $daftar_produk->total() }}</span> produk
                    </p>
                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-500">Urutkan:</label>
                        <select wire:model.live="urutan" class="bg-gray-50 border-none rounded-lg py-2 pl-3 pr-8 text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="terbaru">Terbaru</option>
                            <option value="termurah">Harga Terendah</option>
                            <option value="termahal">Harga Tertinggi</option>
                            <option value="abjad">Nama (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($daftar_produk as $produk)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden flex flex-col">
                            <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                @if($produk->gambar_utama)
                                    <img src="{{ asset('storage/'.$produk->gambar_utama) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-image text-4xl"></i>
                                    </div>
                                @endif
                                
                                @if($produk->apakah_unggulan)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">UNGGULAN</span>
                                    </div>
                                @endif

                                <!-- Stok Habis Overlay -->
                                @if($produk->jumlah_stok <= 0)
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <span class="bg-red-600 text-white font-bold px-4 py-2 rounded-lg transform -rotate-12 shadow-lg">STOK HABIS</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="text-xs text-gray-400 mb-1 font-medium">{{ $produk->kategori->nama }}</div>
                                <a href="#" class="block font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[40px]">
                                    {{ $produk->nama }}
                                </a>
                                <div class="mt-auto pt-4 flex items-end justify-between border-t border-gray-50">
                                    <div>
                                        <p class="text-lg font-bold text-blue-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <button 
                                        wire:click="tambahKeKeranjang({{ $produk->id }})"
                                        class="w-9 h-9 {{ $produk->jumlah_stok > 0 ? 'bg-blue-600 hover:bg-blue-700 text-white' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }} rounded-xl shadow-lg flex items-center justify-center transition-colors"
                                        {{ $produk->jumlah_stok <= 0 ? 'disabled' : '' }}
                                    >
                                        <i class="fas fa-cart-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <i class="fas fa-search text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
                            <button wire:click="$set('cari', '')" class="mt-6 text-blue-600 font-bold hover:underline">Reset Pencarian</button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $daftar_produk->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
