<div class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <!-- Header & Navigasi -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('pesanan.saya') }}" class="p-2 bg-white rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 group-hover:text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
                    <p class="text-sm text-gray-500">Invoice: <span class="font-mono font-bold text-blue-600">{{ $pesanan->nomor_invoice }}</span></p>
                </div>
            </div>

            @php
                $statusWarna = [
                    'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
                    'diproses' => 'bg-blue-100 text-blue-800',
                    'dikirim' => 'bg-purple-100 text-purple-800',
                    'selesai' => 'bg-green-100 text-green-800',
                    'dibatalkan' => 'bg-red-100 text-red-800',
                ][$pesanan->status];
            @endphp
            <span class="px-4 py-2 rounded-xl text-sm font-bold {{ $statusWarna }} border border-current opacity-80">
                {{ str_replace('_', ' ', ucfirst($pesanan->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Item -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Daftar Produk</h3>
                        <span class="text-xs text-gray-500">{{ $pesanan->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="p-0">
                        <table class="min-w-full divide-y divide-gray-100">
                            <tbody class="divide-y divide-gray-100">
                                @foreach($pesanan->detailPesanan as $item)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                                    <img src="https://placehold.co/100x100?text={{ urlencode($item->produk->nama) }}" class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ $item->produk->nama }}</div>
                                                    <div class="text-xs text-gray-500">{{ $item->produk->kategori->nama }}</div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right align-middle">
                                            <div class="text-sm font-bold text-gray-900">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Rincian Biaya -->
                    <div class="bg-gray-50/50 p-6 border-t border-gray-100 space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Total Harga Barang</span>
                            <span>Rp {{ number_format($pesanan->total_barang, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Biaya Pengiriman ({{ strtoupper($pesanan->informasi_pengiriman_json['ekspedisi']) }})</span>
                            <span>Rp {{ number_format($pesanan->biaya_pengiriman, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-base font-bold text-gray-900 pt-2 border-t border-gray-200 mt-2">
                            <span>Total Bayar</span>
                            <span class="text-blue-600">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Info Pengiriman -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-green-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        Alamat Pengiriman
                    </h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="text-sm font-bold text-gray-900 mb-1">{{ $pesanan->informasi_pengiriman_json['nama_penerima'] }}</div>
                            <div class="text-xs text-gray-600 mb-2">{{ $pesanan->informasi_pengiriman_json['nomor_telepon'] }}</div>
                            <div class="text-xs text-gray-500 leading-relaxed">
                                {{ $pesanan->informasi_pengiriman_json['alamat_lengkap'] }}
                            </div>
                        </div>
                        
                        @if($pesanan->catatan)
                            <div>
                                <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Catatan Anda</div>
                                <div class="text-xs text-gray-600 bg-yellow-50 p-2 rounded-lg border border-yellow-100 italic">
                                    "{{ $pesanan->catatan }}"
                                </div>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-gray-100">
                            <a href="#" class="block w-full py-2 bg-white border border-gray-300 rounded-lg text-center text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                Hubungi Bantuan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
