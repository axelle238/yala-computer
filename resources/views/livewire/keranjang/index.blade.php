<div class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

        @if($items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- List Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($items as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex gap-4 items-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="https://placehold.co/200x200/e2e8f0/475569?text={{ urlencode($item->produk->nama) }}" class="w-full h-full object-cover">
                            </div>
                            
                            <div class="flex-grow min-w-0">
                                <h3 class="font-bold text-gray-900 truncate">
                                    <a href="{{ route('produk.detail', $item->produk->slug) }}" class="hover:text-blue-600">
                                        {{ $item->produk->nama }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $item->produk->kategori->nama }}</p>
                                <div class="font-bold text-blue-600">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</div>
                            </div>

                            <div class="flex flex-col items-end gap-4">
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button wire:click="decrement({{ $item->id }})" class="p-2 hover:bg-gray-100 text-gray-600 transition disabled:opacity-50" @if($item->jumlah <= 1) disabled @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                          <path fill-rule="evenodd" d="M4 10a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H4.75A.75.75 0 0 1 4 10Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div class="w-10 text-center text-sm font-semibold text-gray-900 bg-white py-2">
                                        {{ $item->jumlah }}
                                    </div>
                                    <button wire:click="increment({{ $item->id }})" class="p-2 hover:bg-gray-100 text-gray-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                          <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                                        </svg>
                                    </button>
                                </div>
                                <button wire:click="hapus({{ $item->id }})" class="text-sm text-red-500 hover:text-red-700 font-medium flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                      <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Belanja</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Harga ({{ $items->sum('jumlah') }} barang)</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Diskon</span>
                                <span class="text-green-600">- Rp 0</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3 flex justify-between font-bold text-lg text-gray-900">
                                <span>Total Belanja</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-center rounded-lg shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-1">
                            Lanjut ke Pembayaran
                        </a>

                        <div class="mt-4 text-center">
                            <a href="/" class="text-sm text-blue-600 hover:underline">Lanjut Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-xl border border-gray-200">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5.407c.441 1.889.661 2.833.088 3.565-.572.73-1.54.73-3.476.73H8.568c-1.936 0-2.904 0-3.476-.73-.573-.732-.353-1.676.088-3.565l1.263-5.407a1 1 0 0 1 .972-.773h8.97a1 1 0 0 1 .972.773Z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Keranjang Belanja Kosong</h2>
                <p class="text-gray-500 mb-8">Wah, keranjang belanjaanmu kosong nih. Yuk isi dengan barang impianmu!</p>
                <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Notification Toast Component (Inline Reuse) -->
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
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-400">
      <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
    </svg>
    <span class="font-medium" x-text="message"></span>
</div>
