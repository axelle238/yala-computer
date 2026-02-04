<div wire:poll.10s>
    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Produk -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-full translate-x-12 -translate-y-12 group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                    @if($produk_stok_tipis > 0)
                        <span class="text-[9px] font-black text-red-500 bg-red-50 px-2 py-1 rounded-full animate-pulse border border-red-100">{{ $produk_stok_tipis }} STOK TIPIS</span>
                    @endif
                </div>
                <h3 class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Total Produk</h3>
                <p class="text-2xl font-black text-gray-900">{{ number_format($total_produk) }}</p>
            </div>
        </div>

        <!-- Pesanan -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </div>
                <span class="text-xs font-bold text-purple-500 bg-purple-50 px-2 py-1 rounded-full">Baru</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Pesanan Masuk</h3>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($total_pesanan) }}</p>
        </div>

        <!-- Pelanggan -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <span class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Total Pelanggan</h3>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($total_pelanggan) }}</p>
        </div>

        <!-- Pendapatan -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-green-50 rounded-full translate-x-12 -translate-y-12 group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 shadow-sm">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                    <i class="fas fa-chart-line text-green-500 text-sm"></i>
                </div>
                <h3 class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Total Pendapatan</h3>
                <p class="text-2xl font-black text-gray-900">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Tabel Pesanan Terbaru -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Pesanan Terbaru</h3>
                <a href="#" class="text-blue-600 text-xs font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Invoice</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pesanan_terbaru as $pesanan)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-blue-600 text-sm">#{{ $pesanan->nomor_invoice }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $pesanan->pelanggan->nama ?? 'Umum' }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $pesanan->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $warna = [
                                            'baru' => 'bg-blue-100 text-blue-700',
                                            'diproses' => 'bg-orange-100 text-orange-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'batal' => 'bg-red-100 text-red-700'
                                        ][$pesanan->status_pesanan] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $warna }}">
                                        {{ $pesanan->status_pesanan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-sm text-gray-900">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Log Aktivitas</h3>
            </div>
            <div class="p-6">
                <livewire:admin.ringkasan-log />
            </div>
        </div>
    </div>
</div>
