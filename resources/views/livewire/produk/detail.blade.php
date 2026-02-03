<div class="py-12 bg-white">
    <div class="container mx-auto px-4">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="#" class="ml-1 md:ml-2 hover:text-blue-600">{{ $produk->kategori->nama }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2 text-gray-400 truncate max-w-xs">{{ $produk->nama }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Gallery Section -->
            <div class="space-y-4">
                <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 relative group">
                    <img src="https://placehold.co/800x800/e2e8f0/475569?text={{ urlencode($produk->nama) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500 cursor-zoom-in">
                    
                    @if($produk->stok < 1)
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center pointer-events-none">
                            <span class="px-6 py-2 bg-red-600 text-white text-lg font-bold rounded-lg uppercase tracking-wider shadow-xl transform -rotate-12 border-2 border-white">Stok Habis</span>
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <!-- Placeholder Thumbnails -->
                    @foreach(range(1, 4) as $i)
                        <div class="aspect-square bg-gray-50 rounded-lg overflow-hidden border border-gray-200 hover:border-blue-500 cursor-pointer transition opacity-70 hover:opacity-100">
                             <img src="https://placehold.co/200x200/e2e8f0/475569?text={{ $i }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col h-full">
                <div class="mb-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $produk->kategori->nama }}</span>
                    @if($produk->stok > 0)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded ml-2">Stok Tersedia: {{ $produk->stok }}</span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4 leading-tight">{{ $produk->nama }}</h1>

                <div class="flex items-baseline gap-4 mb-6 border-b border-gray-100 pb-6">
                    <span class="text-4xl font-bold text-blue-600">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                    {{-- <span class="text-lg text-gray-400 line-through">Rp {{ number_format($produk->harga_jual * 1.2, 0, ',', '.') }}</span> --}}
                </div>

                <div class="prose prose-sm text-gray-600 mb-8 max-w-none">
                    <p>{{ $produk->deskripsi_pendek }}</p>
                </div>

                <!-- Spesifikasi Ringkas -->
                @if($produk->spesifikasi_json)
                    <div class="bg-gray-50 rounded-xl p-5 mb-8 border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-3 text-sm uppercase tracking-wide">Spesifikasi Utama</h3>
                        <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm">
                            @foreach($produk->spesifikasi_json as $key => $value)
                                <div class="text-gray-500">{{ $key }}</div>
                                <div class="font-medium text-gray-900">{{ $value }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="mt-auto pt-6 border-t border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-32">
                            <label for="quantity" class="sr-only">Jumlah</label>
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" wire:click="$set('jumlah', {{ max(1, $jumlah - 1) }})" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                                <input type="text" id="quantity" wire:model.live="jumlah" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5" required />
                                <button type="button" wire:click="$set('jumlah', {{ $jumlah + 1 }})" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button wire:click="tambahKeKeranjang" wire:loading.attr="disabled" class="flex-1 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-lg px-5 py-3 text-center transition flex items-center justify-center gap-2 shadow-lg shadow-blue-600/30 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="tambahKeKeranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                Tambah ke Keranjang
                            </span>
                            <span wire:loading wire:target="tambahKeKeranjang" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Lengkap -->
        <div class="mt-16">
            <div class="border-b border-gray-200 mb-6">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                    <li class="mr-2">
                        <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active" aria-current="page">Deskripsi Lengkap</a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Ulasan (0)</a>
                    </li>
                </ul>
            </div>
            <div class="prose prose-blue max-w-none text-gray-600">
                <p>{{ $produk->deskripsi_lengkap }}</p>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if($produkTerkait->count() > 0)
            <div class="mt-16 pt-16 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($produkTerkait as $terkait)
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                            <div class="aspect-[4/3] bg-gray-100 overflow-hidden relative">
                                <img src="https://placehold.co/300x225/e2e8f0/475569?text={{ urlencode($terkait->nama) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <a href="{{ route('produk.detail', $terkait->slug) }}" class="absolute inset-0"></a>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-1 truncate">
                                    <a href="{{ route('produk.detail', $terkait->slug) }}" class="hover:text-blue-600">{{ $terkait->nama }}</a>
                                </h3>
                                <div class="text-blue-600 font-bold text-sm">Rp {{ number_format($terkait->harga_jual, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Notification Toast Component (Inline) -->
<div 
    x-data="{ show: false, message: '' }" 
    x-on:tampilkan-notifikasi.window="show = true; message = $event.detail.pesan; setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed bottom-5 right-5 z-50 bg-gray-900 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3"
    style="display: none;"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-400">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
    </svg>
    <span class="font-medium" x-text="message"></span>
</div>
