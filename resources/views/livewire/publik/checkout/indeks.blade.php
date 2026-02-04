<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Checkout Pesanan</h1>

        <form wire:submit="buatPesanan" class="flex flex-col lg:flex-row gap-8">
            <!-- Form Data Pengiriman -->
            <div class="flex-1 space-y-6">
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h2 class="font-bold text-gray-900 mb-6 text-lg flex items-center gap-2">
                        <i class="fas fa-user-circle text-blue-600"></i>
                        Informasi Pengiriman
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input wire:model="nama" type="text" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama penerima...">
                            @error('nama') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Surel (Email)</label>
                            <input wire:model="surel" type="email" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-blue-500" placeholder="contoh@surel.com">
                            @error('surel') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nomor Telepon/WA</label>
                            <input wire:model="telepon" type="text" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-blue-500" placeholder="0812xxxxxxxx">
                            @error('telepon') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                            <textarea wire:model="alamat" rows="3" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Tuliskan alamat pengiriman secara detail..."></textarea>
                            @error('alamat') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Catatan Pesanan (Opsional)</label>
                            <input wire:model="catatan" type="text" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Titip di satpam, dll">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h2 class="font-bold text-gray-900 mb-6 text-lg flex items-center gap-2">
                        <i class="fas fa-credit-card text-blue-600"></i>
                        Metode Pembayaran
                    </h2>
                    <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100 flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                            <i class="fas fa-university"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-blue-900">Transfer Bank (Manual)</p>
                            <p class="text-[10px] text-blue-400 font-medium">Instruksi pembayaran akan muncul setelah pesanan dibuat.</p>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="w-full lg:w-[400px]">
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-xl shadow-blue-900/5 sticky top-24">
                    <h2 class="font-bold text-gray-900 mb-6 text-lg">Ringkasan Pesanan</h2>
                    
                    <!-- Item List (Mini) -->
                    <div class="space-y-4 mb-8 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($items as $item)
                            <div class="flex gap-4 items-center">
                                <div class="w-12 h-12 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item['gambar'])
                                        <img src="{{ asset('storage/'.$item['gambar']) }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-box text-gray-200 p-3"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ $item['nama'] }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $item['kuantitas'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                </div>
                                <div class="text-xs font-bold text-gray-900">
                                    Rp {{ number_format($item['harga'] * $item['kuantitas'], 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-4 mb-8 pt-6 border-t border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Biaya Layanan</span>
                            <span class="font-bold text-gray-900">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                            <span class="font-bold text-gray-900">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" wire:loading.attr="disabled" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-orange-200 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <span wire:loading.remove>KONFIRMASI PESANAN</span>
                        <span wire:loading><i class="fas fa-spinner fa-spin mr-2"></i> MEMPROSES...</span>
                    </button>
                    
                    <p class="text-center text-[10px] text-gray-400 mt-4 leading-relaxed">
                        Dengan menekan tombol di atas, Anda menyetujui <br>
                        <a href="#" class="text-blue-600 underline">Syarat & Ketentuan</a> yang berlaku.
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
