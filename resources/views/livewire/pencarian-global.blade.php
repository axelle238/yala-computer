<div class="relative w-full max-w-md" x-data="{ open: false }" @click.away="open = false">
    <!-- Input Field -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input 
            wire:model.live.debounce.300ms="query"
            @focus="open = true"
            @input="open = true"
            type="text" 
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
            placeholder="Cari produk, pesanan, user..."
            autocomplete="off"
        >
        <!-- Loading Indicator -->
        <div wire:loading class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <!-- Dropdown Results -->
    @if(strlen($query) >= 2 && !empty($hasil))
        <div 
            x-show="open" 
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 mt-1 w-full rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 overflow-hidden"
        >
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                
                {{-- Hasil Produk --}}
                @if(!empty($hasil['produk']) && $hasil['produk']->count() > 0)
                    <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        Produk
                    </div>
                    @foreach($hasil['produk'] as $produk)
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-600" role="menuitem">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ $produk->nama }}</span>
                                <span class="text-xs text-gray-500 self-center">Stok: {{ $produk->stok }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif

                {{-- Hasil Pesanan --}}
                @if(!empty($hasil['pesanan']) && $hasil['pesanan']->count() > 0)
                    <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        Pesanan
                    </div>
                    @foreach($hasil['pesanan'] as $pesanan)
                        <a href="{{ route('admin.pesanan.detail', $pesanan->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-600" role="menuitem">
                            {{ $pesanan->nomor_invoice }} - Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}
                        </a>
                    @endforeach
                @endif

                {{-- Hasil Pengguna --}}
                @if(isset($hasil['pengguna']) && !empty($hasil['pengguna']) && $hasil['pengguna']->count() > 0)
                    <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        Pengguna
                    </div>
                    @foreach($hasil['pengguna'] as $user)
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-200 dark:hover:bg-gray-600" role="menuitem">
                            {{ $user->nama }} <span class="text-xs text-gray-500">({{ $user->email }})</span>
                        </a>
                    @endforeach
                @endif

                @if(empty($hasil['produk']) && empty($hasil['pesanan']) && empty($hasil['pengguna']))
                    <div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                        Tidak ditemukan hasil untuk "{{ $query }}"
                    </div>
                @endif

            </div>
        </div>
    @endif
</div>
