<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.251l4.125 5.25m-4.125-5.25L7.875 16.001M6 6.75h12m-6-3.75a3 3 0 0 1 3 3h-6a3 3 0 0 1 3-3Zm0 6.75v5.25m6-5.25v5.25" />
                    </svg>
                    Manajemen Stok
                </h2>
                <p class="text-sm text-gray-500">Monitor dan lakukan penyesuaian stok produk (Stock Opname).</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Daftar Produk & Penyesuaian -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Card Penyesuaian (Hanya muncul jika produk dipilih) -->
                @if($produkIdDipilih)
                    <div class="bg-white rounded-2xl shadow-xl border border-blue-200 overflow-hidden ring-2 ring-blue-500 ring-opacity-50 transition">
                        <div class="px-6 py-4 bg-blue-600 text-white flex justify-between items-center">
                            <h3 class="font-bold">Penyesuaian Stok</h3>
                            <button wire:click="batal" class="text-white hover:text-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-6">
                            @php $prod = \App\Models\Produk::find($produkIdDipilih); @endphp
                            <div class="mb-4">
                                <div class="text-xs text-gray-400 uppercase tracking-wider font-bold">Produk</div>
                                <div class="font-bold text-gray-800 text-lg">{{ $prod->nama }}</div>
                                <div class="text-sm text-gray-500">Stok Saat Ini: <span class="font-bold text-gray-900">{{ $prod->stok }}</span></div>
                            </div>

                            <form wire:submit.prevent="simpanPenyesuaian" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Perubahan</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button type="button" wire:click="$set('jenisPenyesuaian', 'masuk')" class="py-2 px-3 text-sm font-bold rounded-lg border {{ $jenisPenyesuaian === 'masuk' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                                            + Barang Masuk
                                        </button>
                                        <button type="button" wire:click="$set('jenisPenyesuaian', 'keluar')" class="py-2 px-3 text-sm font-bold rounded-lg border {{ $jenisPenyesuaian === 'keluar' ? 'bg-red-100 border-red-500 text-red-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                                            - Barang Keluar
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                    <input type="number" wire:model="jumlahPenyesuaian" min="1" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                                    @error('jumlahPenyesuaian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                    <textarea wire:model="keteranganPenyesuaian" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Stok Opname, Barang Rusak, dll"></textarea>
                                    @error('keteranganPenyesuaian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                @error('stok_error')
                                    <div class="bg-red-50 text-red-600 text-xs p-3 rounded-lg">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow transition">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Daftar Stok Produk -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50">
                        <input type="text" wire:model.live.debounce.300ms="cari" class="w-full pl-4 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 text-sm" placeholder="Cari produk...">
                    </div>
                    <ul class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto">
                        @forelse($stokProduk as $produk)
                            <li class="p-4 hover:bg-gray-50 transition flex justify-between items-center group">
                                <div>
                                    <div class="text-sm font-bold text-gray-900 line-clamp-1" title="{{ $produk->nama }}">{{ $produk->nama }}</div>
                                    <div class="text-xs text-gray-500">{{ $produk->kategori->nama }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-bold {{ $produk->stok < 5 ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $produk->stok }} Unit
                                    </div>
                                    <button wire:click="pilihProduk({{ $produk->id }})" class="text-xs text-blue-600 hover:underline opacity-0 group-hover:opacity-100 transition">
                                        Sesuaikan
                                    </button>
                                </div>
                            </li>
                        @empty
                            <li class="p-8 text-center text-gray-500 text-sm">Produk tidak ditemukan.</li>
                        @endforelse
                    </ul>
                    <div class="p-4 border-t border-gray-100">
                        {{ $stokProduk->links() }}
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Riwayat Pergerakan Stok -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-800">Riwayat Pergerakan Stok</h3>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">Real-time Log</span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Sisa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($riwayatStok as $riwayat)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                            {{ $riwayat->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900 max-w-[150px] truncate" title="{{ $riwayat->produk->nama }}">
                                                {{ $riwayat->produk->nama }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-full {{ $riwayat->jenis == 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $riwayat->jenis }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-800">
                                            {{ $riwayat->jenis == 'masuk' ? '+' : '-' }}{{ $riwayat->jumlah }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $riwayat->keterangan }}</div>
                                            <div class="text-xs text-gray-400">{{ $riwayat->pengguna ? 'Oleh: ' . $riwayat->pengguna->nama : 'Sistem' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                                            {{ $riwayat->stok_akhir }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            Belum ada riwayat stok.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $riwayatStok->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast Notification (Reuse) -->
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
        <span class="font-medium" x-text="message"></span>
    </div>
</div>
