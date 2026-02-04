<div class="bg-gray-50 min-h-screen py-16">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Lacak Status Pesanan</h1>
            <p class="text-gray-500">Masukkan nomor invoice Anda (contoh: INV-ABCD-20260204) untuk melihat status terkini.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-xl shadow-blue-900/5 mb-12">
            <form wire:submit="cariPesanan" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input wire:model="nomor_invoice" type="text" class="w-full bg-gray-50 border-none rounded-xl py-4 px-6 text-sm focus:ring-2 focus:ring-blue-500 font-mono placeholder-gray-400" placeholder="Nomor Invoice...">
                    @error('nomor_invoice') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    <span>LACAK</span>
                </button>
            </form>

            @if($pesan_error)
                <div class="mt-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-medium flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                    {{ $pesan_error }}
                </div>
            @endif
        </div>

        @if($hasil_pencarian)
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden animate-fade-in-up">
                <div class="p-8 border-b border-gray-50 bg-blue-50/30 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">Nomor Invoice</p>
                        <p class="text-xl font-bold text-blue-900 font-mono">#{{ $hasil_pencarian->nomor_invoice }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">Tanggal Pesanan</p>
                        <p class="text-sm font-bold text-gray-900">{{ $hasil_pencarian->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="p-8">
                    <!-- Timeline Status -->
                    <div class="mb-12">
                        <h3 class="font-bold text-gray-900 mb-6 text-sm uppercase tracking-wide">Status Perjalanan</h3>
                        <div class="flex items-center justify-between relative">
                            <!-- Garis Penghubung -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-100 z-0"></div>
                            
                            @php
                                $statusList = ['baru', 'diproses', 'dikirim', 'selesai'];
                                $currentStatusIndex = array_search($hasil_pencarian->status_pesanan, $statusList);
                                if ($hasil_pencarian->status_pesanan == 'batal') $currentStatusIndex = -1;
                            @endphp

                            @foreach($statusList as $index => $status)
                                @php
                                    $active = $index <= $currentStatusIndex;
                                    $current = $index === $currentStatusIndex;
                                @endphp
                                <div class="relative z-10 flex flex-col items-center gap-2">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-4 {{ $active ? 'bg-blue-600 border-blue-100 text-white shadow-lg shadow-blue-200' : 'bg-white border-gray-200 text-gray-300' }} transition-all">
                                        <i class="fas {{ $status == 'baru' ? 'fa-file-invoice' : ($status == 'diproses' ? 'fa-box-open' : ($status == 'dikirim' ? 'fa-truck' : 'fa-check')) }}"></i>
                                    </div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest {{ $active ? 'text-blue-600' : 'text-gray-400' }}">{{ $status }}</p>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($hasil_pencarian->status_pesanan == 'batal')
                            <div class="mt-8 p-4 bg-red-50 text-red-600 rounded-xl text-center font-bold">
                                Pesanan Dibatalkan
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Informasi Pengiriman</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <p><span class="font-bold text-gray-900 block">Penerima:</span> {{ $hasil_pencarian->pelanggan->nama }}</p>
                                <p><span class="font-bold text-gray-900 block">Alamat:</span> {{ $hasil_pencarian->pelanggan->alamat }}</p>
                                <p><span class="font-bold text-gray-900 block">Telepon:</span> {{ $hasil_pencarian->pelanggan->telepon }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide">Rincian Item</h3>
                            <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($hasil_pencarian->item as $item)
                                    <div class="flex justify-between items-center text-sm border-b border-gray-50 pb-2 last:border-0">
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-900 truncate">{{ $item->produk->nama ?? 'Produk Dihapus' }}</p>
                                            <p class="text-[10px] text-gray-500">{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                        <span class="font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="font-bold text-gray-900">Total Pembayaran</span>
                                <span class="text-xl font-bold text-blue-600">Rp {{ number_format($hasil_pencarian->total_harga, 0, ',', '.') }}</span>
                            </div>
                             <div class="mt-2 text-right">
                                @if($hasil_pencarian->status_pembayaran == 'lunas')
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded-full">Lunas</span>
                                @elseif($hasil_pencarian->status_pembayaran == 'pending')
                                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 text-[10px] font-bold uppercase rounded-full">Menunggu Pembayaran</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-[10px] font-bold uppercase rounded-full">Gagal / Dibatalkan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
