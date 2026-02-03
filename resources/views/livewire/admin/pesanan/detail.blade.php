<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <!-- Header & Navigasi -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.pesanan.index') }}" class="p-2 bg-white rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Pesanan {{ $pesanan->nomor_invoice }}</h2>
                    <p class="text-sm text-gray-500">Dibuat pada {{ $pesanan->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
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
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Item & Pembayaran -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Daftar Item -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800">Item Pesanan</h3>
                    </div>
                    <div class="p-0">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($pesanan->detailPesanan as $item)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                                    <img src="https://placehold.co/100x100?text=P" class="w-full h-full object-cover">
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="text-sm font-bold text-gray-900 truncate">{{ $item->produk->nama }}</div>
                                                    <div class="text-xs text-gray-500">{{ $item->produk->kategori->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-600">
                                            Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                            {{ $item->jumlah }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50/30">
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-500">Total Barang</td>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">Rp {{ number_format($pesanan->total_barang, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-500">Biaya Pengiriman</td>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">Rp {{ number_format($pesanan->biaya_pengiriman, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-blue-50/50">
                                    <td colspan="3" class="px-6 py-4 text-right text-base font-bold text-gray-900">Total Bayar</td>
                                    <td class="px-6 py-4 text-right text-xl font-extrabold text-blue-600">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Kontrol Status (Inline Form) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Update Status Pesanan</h3>
                    <div class="flex flex-wrap gap-3">
                        <button wire:click="updateStatus('menunggu_pembayaran')" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $pesanan->status == 'menunggu_pembayaran' ? 'bg-yellow-500 text-white shadow-lg shadow-yellow-200' : 'bg-gray-100 text-gray-600 hover:bg-yellow-50' }}">
                            Menunggu Pembayaran
                        </button>
                        <button wire:click="updateStatus('diproses')" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $pesanan->status == 'diproses' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-gray-100 text-gray-600 hover:bg-blue-50' }}">
                            Diproses
                        </button>
                        <button wire:click="updateStatus('dikirim')" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $pesanan->status == 'dikirim' ? 'bg-purple-600 text-white shadow-lg shadow-purple-200' : 'bg-gray-100 text-gray-600 hover:bg-purple-50' }}">
                            Dikirim
                        </button>
                        <button wire:click="updateStatus('selesai')" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $pesanan->status == 'selesai' ? 'bg-green-600 text-white shadow-lg shadow-green-200' : 'bg-gray-100 text-gray-600 hover:bg-green-50' }}">
                            Selesai
                        </button>
                        <button wire:click="updateStatus('dibatalkan')" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $pesanan->status == 'dibatalkan' ? 'bg-red-600 text-white shadow-lg shadow-red-200' : 'bg-gray-100 text-gray-600 hover:bg-red-50' }}">
                            Batalkan
                        </button>
                    </div>
                    <p class="mt-4 text-xs text-gray-400 italic">* Mengubah status akan dicatat dalam log aktivitas sistem secara otomatis.</p>
                </div>
            </div>

            <!-- Kolom Kanan: Pelanggan & Pengiriman -->
            <div class="space-y-6">
                <!-- Info Pelanggan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Informasi Pelanggan
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Nama Akun</div>
                            <div class="text-sm font-bold text-gray-900">{{ $pesanan->pengguna->nama }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Email</div>
                            <div class="text-sm text-gray-900">{{ $pesanan->pengguna->email }}</div>
                        </div>
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
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
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Kurir</div>
                            <div class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold uppercase">
                                {{ $pesanan->informasi_pengiriman_json['ekspedisi'] }}
                            </div>
                        </div>
                        @if($pesanan->catatan)
                            <div>
                                <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Catatan Pembeli</div>
                                <div class="text-xs text-gray-600 bg-yellow-50 p-2 rounded-lg border border-yellow-100 italic">
                                    "{{ $pesanan->catatan }}"
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification (Reuse Logic) -->
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
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 text-green-400">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
        </svg>
        <span class="font-medium" x-text="message"></span>
    </div>
</div>
