<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Daftar Item -->
            <div class="flex-1 space-y-4">
                @forelse($items as $item)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center gap-6">
                        <!-- Gambar -->
                        <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                            @if($item['gambar'])
                                <img src="{{ asset('storage/'.$item['gambar']) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1 text-center sm:text-left">
                            <a href="{{ route('produk.detail', $item['slug']) }}" wire:navigate class="font-bold text-gray-900 hover:text-blue-600 transition-colors">
                                {{ $item['nama'] }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($item['harga'], 0, ',', '.') }} / unit</p>
                        </div>

                        <!-- Kuantitas -->
                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden h-10">
                            <button wire:click="perbaruiKuantitas({{ $item['id'] }}, {{ $item['kuantitas'] - 1 }})" class="w-10 h-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-500 transition-colors">
                                <i class="fas fa-minus text-[10px]"></i>
                            </button>
                            <input type="text" readonly value="{{ $item['kuantitas'] }}" class="w-10 h-full text-center border-none text-sm font-bold text-gray-900 focus:ring-0">
                            <button wire:click="perbaruiKuantitas({{ $item['id'] }}, {{ $item['kuantitas'] + 1 }})" class="w-10 h-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-500 transition-colors">
                                <i class="fas fa-plus text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Subtotal -->
                        <div class="w-32 text-center sm:text-right">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mb-1">Subtotal</p>
                            <p class="font-bold text-blue-600">Rp {{ number_format($item['harga'] * $item['kuantitas'], 0, ',', '.') }}</p>
                        </div>

                        <!-- Hapus -->
                        <button wire:click="hapusItem({{ $item['id'] }})" class="w-10 h-10 flex items-center justify-center text-gray-300 hover:text-red-500 transition-colors">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                @empty
                    <div class="bg-white py-20 rounded-3xl border border-dashed border-gray-200 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-200">
                            <i class="fas fa-shopping-basket text-4xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Keranjang Kosong</h2>
                        <p class="text-gray-500 mb-8">Anda belum menambahkan produk apa pun.</p>
                        <a href="{{ route('katalog') }}" wire:navigate class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                            MULAI BELANJA
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Ringkasan -->
            @if(count($items) > 0)
                <div class="w-full lg:w-96">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-xl shadow-blue-900/5 sticky top-24">
                        <h2 class="font-bold text-gray-900 mb-6 text-lg">Ringkasan Belanja</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Total Harga ({{ count($items) }} Produk)</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Pengiriman</span>
                                <span class="text-green-600 font-bold uppercase text-[10px] bg-green-50 px-2 py-1 rounded">Gratis</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 mb-8">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-900">Total Tagihan</span>
                                <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-[10px] text-gray-400">Harga sudah termasuk pajak PPN (jika ada).</p>
                        </div>

                        <a href="{{ route('checkout') }}" wire:navigate class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                            <span>LANJUT KE CHECKOUT</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
