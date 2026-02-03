<div class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout Pesanan</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Pengiriman -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">1</span>
                        Informasi Pengiriman
                    </h2>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                <input type="text" wire:model="nama_penerima" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="Nama Lengkap">
                                @error('nama_penerima') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="text" wire:model="nomor_telepon" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="08xxxxxxxxxx">
                                @error('nomor_telepon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea wire:model="alamat_lengkap" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos"></textarea>
                            @error('alamat_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ekspedisi Pengiriman</label>
                            <select wire:model="ekspedisi" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                                <option value="jne">JNE Reguler (Rp 25.000)</option>
                                <option value="jnt">J&T Express (Rp 25.000)</option>
                                <option value="sicepat">SiCepat REG (Rp 25.000)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Pesanan (Opsional)</label>
                            <textarea wire:model="catatan" rows="2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="Contoh: Tolong packing kayu"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">2</span>
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($items as $item)
                            <div class="flex gap-3">
                                <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
                                    <img src="https://placehold.co/100x100/e2e8f0/475569?text={{ urlencode($item->produk->nama) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->produk->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->jumlah }} x Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 mb-6">
                        <div class="flex justify-between text-gray-600 text-sm">
                            <span>Subtotal Barang</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 text-sm">
                            <span>Biaya Pengiriman</span>
                            <span>Rp {{ number_format($biaya_pengiriman, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between font-bold text-lg text-gray-900 mt-2">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @error('stok')
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('transaksi')
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                            {{ $message }}
                        </div>
                    @enderror

                    <button wire:click="buatPesanan" wire:loading.attr="disabled" class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-bold text-center rounded-lg shadow-lg shadow-green-600/30 transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                        <span wire:loading.remove wire:target="buatPesanan">Buat Pesanan</span>
                        <span wire:loading wire:target="buatPesanan">Memproses...</span>
                    </button>
                    
                    <p class="text-xs text-center text-gray-400 mt-4">
                        Dengan membuat pesanan, Anda menyetujui Syarat & Ketentuan Yala Computer.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
