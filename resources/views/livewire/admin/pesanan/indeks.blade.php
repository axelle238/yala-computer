<div>
    <div class="flex flex-col xl:flex-row gap-8 items-start">
        
        <!-- Daftar Pesanan -->
        <div class="flex-1 w-full bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <!-- Header & Filter -->
            <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <input wire:model.live="cari" type="text" placeholder="Cari invoice atau pelanggan..." class="w-full bg-gray-50 border-none rounded-xl py-2 px-4 pl-10 text-sm focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                    </div>
                    <select wire:model.live="status_filter" class="bg-gray-50 border-none rounded-xl py-2 px-4 text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="baru">Baru</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Invoice</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Total</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status Pembayaran</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status Pesanan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($daftar_pesanan as $pesanan)
                            <tr class="hover:bg-gray-50/50 transition-colors {{ $pesanan_dipilih && $pesanan_dipilih->id == $pesanan->id ? 'bg-blue-50/50' : '' }}">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-blue-600 text-sm">#{{ $pesanan->nomor_invoice }}</span>
                                    <p class="text-[10px] text-gray-400">{{ $pesanan->created_at->format('d M Y H:i') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $pesanan->pelanggan->nama ?? 'Tamu / Terhapus' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $pesanan->pelanggan->surel ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $warnaBayar = [
                                            'pending' => 'bg-gray-100 text-gray-600',
                                            'lunas' => 'bg-green-100 text-green-700',
                                            'gagal' => 'bg-red-100 text-red-700'
                                        ][$pesanan->status_pembayaran] ?? 'bg-gray-100';
                                    @endphp
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $warnaBayar }}">
                                        {{ $pesanan->status_pembayaran }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $warnaStatus = [
                                            'baru' => 'bg-blue-100 text-blue-700',
                                            'diproses' => 'bg-orange-100 text-orange-700',
                                            'dikirim' => 'bg-purple-100 text-purple-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'batal' => 'bg-red-100 text-red-700'
                                        ][$pesanan->status_pesanan] ?? 'bg-gray-100';
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $warnaStatus }}">
                                        {{ $pesanan->status_pesanan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button wire:click="lihatDetail({{ $pesanan->id }})" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-gray-50">
                {{ $daftar_pesanan->links() }}
            </div>
        </div>

        <!-- Panel Detail (Side) -->
        @if($pesanan_dipilih)
            <div class="w-full xl:w-96 bg-white rounded-2xl border border-blue-100 shadow-xl shadow-blue-900/5 sticky top-24 overflow-hidden flex-shrink-0">
                <div class="p-4 border-b border-gray-50 bg-blue-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-blue-900">Detail Pesanan</h3>
                        <p class="text-xs text-blue-400">#{{ $pesanan_dipilih->nomor_invoice }}</p>
                    </div>
                    <button wire:click="tutupDetail" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="p-4 space-y-6 max-h-[80vh] overflow-y-auto">
                    <!-- Kontrol Status -->
                    <div class="space-y-3 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Status Pembayaran</label>
                            <select wire:change="updateStatus('pembayaran', $event.target.value)" class="w-full bg-white border-gray-200 rounded-lg text-xs">
                                <option value="pending" {{ $pesanan_dipilih->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="lunas" {{ $pesanan_dipilih->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="gagal" {{ $pesanan_dipilih->status_pembayaran == 'gagal' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Status Pesanan</label>
                            <select wire:change="updateStatus('pesanan', $event.target.value)" class="w-full bg-white border-gray-200 rounded-lg text-xs">
                                <option value="baru" {{ $pesanan_dipilih->status_pesanan == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ $pesanan_dipilih->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="dikirim" {{ $pesanan_dipilih->status_pesanan == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $pesanan_dipilih->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $pesanan_dipilih->status_pesanan == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Info Pelanggan -->
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 mb-2">Informasi Pelanggan</h4>
                        <div class="text-xs text-gray-600 space-y-1">
                            <p><span class="font-medium">Nama:</span> {{ $pesanan_dipilih->pelanggan->nama ?? '-' }}</p>
                            <p><span class="font-medium">Email:</span> {{ $pesanan_dipilih->pelanggan->surel ?? '-' }}</p>
                            <p><span class="font-medium">Telepon:</span> {{ $pesanan_dipilih->pelanggan->telepon ?? '-' }}</p>
                            <p><span class="font-medium">Alamat:</span> {{ $pesanan_dipilih->pelanggan->alamat ?? '-' }}</p>
                        </div>
                        @if($pesanan_dipilih->catatan_pembeli)
                            <div class="mt-2 p-2 bg-yellow-50 text-yellow-800 text-xs rounded border border-yellow-100">
                                <span class="font-bold">Catatan:</span> {{ $pesanan_dipilih->catatan_pembeli }}
                            </div>
                        @endif
                    </div>

                    <!-- Item Pesanan -->
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 mb-2">Item Produk</h4>
                        <div class="space-y-3">
                            @foreach($pesanan_dipilih->item as $item)
                                <div class="flex gap-3 items-start border-b border-gray-50 pb-3 last:border-0">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 flex-shrink-0 overflow-hidden">
                                        @if($item->produk && $item->produk->gambar_utama)
                                            <img src="{{ asset('storage/'.$item->produk->gambar_utama) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-box"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-gray-900 line-clamp-2">{{ $item->produk->nama ?? 'Produk Dihapus' }}</p>
                                        <div class="flex justify-between mt-1">
                                            <span class="text-[10px] text-gray-500">{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                                            <span class="text-[10px] font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Ringkasan Total -->
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex justify-between items-center text-sm font-bold text-gray-900">
                            <span>Total Tagihan</span>
                            <span class="text-blue-600">Rp {{ number_format($pesanan_dipilih->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
