<div class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 text-blue-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Riwayat Pesanan Saya
        </h1>

        <div class="space-y-6">
            @forelse($riwayatPesanan as $pesanan)
                <a href="{{ route('pesanan.saya.detail', $pesanan->id) }}" class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                    <!-- Header Kartu -->
                    <div class="px-6 py-4 border-b border-gray-50 flex flex-wrap justify-between items-center gap-4 bg-gray-50/30">
                        <div class="flex items-center gap-4">
                            <div>
                                <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">No. Invoice</div>
                                <div class="text-sm font-extrabold text-blue-600">{{ $pesanan->nomor_invoice }}</div>
                            </div>
                            <div class="h-8 w-px bg-gray-200"></div>
                            <div>
                                <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Tanggal</div>
                                <div class="text-sm font-medium text-gray-700">{{ $pesanan->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        @php
                            $statusLabel = [
                                'menunggu_pembayaran' => ['label' => 'Menunggu Pembayaran', 'warna' => 'bg-yellow-100 text-yellow-800'],
                                'diproses' => ['label' => 'Diproses', 'warna' => 'bg-blue-100 text-blue-800'],
                                'dikirim' => ['label' => 'Dikirim', 'warna' => 'bg-purple-100 text-purple-800'],
                                'selesai' => ['label' => 'Selesai', 'warna' => 'bg-green-100 text-green-800'],
                                'dibatalkan' => ['label' => 'Dibatalkan', 'warna' => 'bg-red-100 text-red-800'],
                            ][$pesanan->status];
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold {{ $statusLabel['warna'] }}">
                            {{ $statusLabel['label'] }}
                        </span>
                    </div>

                    <!-- Isi Kartu -->
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Info Produk (Hanya Tampilkan 1 sebagai perwakilan) -->
                            <div class="flex-grow">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0 overflow-hidden">
                                        <img src="https://placehold.co/100x100?text=PC" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 mb-1">
                                            {{ $pesanan->detailPesanan->first()->produk->nama }}
                                            @if($pesanan->detailPesanan->count() > 1)
                                                <span class="text-gray-400 font-normal"> +{{ $pesanan->detailPesanan->count() - 1 }} produk lainnya</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500">Total belanja Anda di Yala Computer</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Harga -->
                            <div class="flex flex-col md:items-end justify-center">
                                <div class="text-xs text-gray-400 mb-1">Total Bayar</div>
                                <div class="text-xl font-black text-gray-900">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-blue-50 text-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5.407c.441 1.889.661 2.833.088 3.565-.572.73-1.54.73-3.476.73H8.568c-1.936 0-2.904 0-3.476-.73-.573-.732-.353-1.676.088-3.565l1.263-5.407a1 1 0 0 1 .972-.773h8.97a1 1 0 0 1 .972.773Z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 text-sm mb-6">Anda belum pernah melakukan transaksi di toko kami.</p>
                    <a href="/" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Mulai Belanja Sekarang
                    </a>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $riwayatPesanan->links() }}
            </div>
        </div>
    </div>
</div>
