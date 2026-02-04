<div class="space-y-8">
    <!-- Header Controls -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Analitik Penjualan</h2>
            <p class="text-xs text-gray-500">Ringkasan performa bisnis Yala Computer</p>
        </div>
        <div class="flex items-center gap-3">
            <select wire:model.live="periode" class="bg-gray-50 border-none rounded-xl py-2 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500 cursor-pointer">
                <option value="bulan_ini">Bulan Ini</option>
                <option value="bulan_lalu">Bulan Lalu</option>
                <option value="tahun_ini">Tahun Ini</option>
            </select>
            <button wire:click="unduhLaporan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center gap-2 text-sm">
                <i class="fas fa-download"></i>
                <span>EKSPOR CSV</span>
            </button>
        </div>
    </div>

    <!-- Ringkasan Kartu -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-8 rounded-3xl text-white shadow-xl shadow-blue-900/20 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full translate-x-10 -translate-y-10"></div>
            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mb-1">Total Pendapatan ({{ str_replace('_', ' ', $periode) }})</p>
            <h3 class="text-3xl font-black">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
        </div>
        
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total Transaksi Sukses</p>
                <h3 class="text-3xl font-black text-gray-900">{{ number_format($total_transaksi) }}</h3>
            </div>
            <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-green-500 text-2xl">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Grafik Penjualan (Visual Bar Sederhana) -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-6">Tren Penjualan Harian</h3>
            <div class="h-64 flex items-end gap-2 overflow-x-auto pb-2 custom-scrollbar">
                @if($chart_data->count() > 0)
                    @php $max = $chart_data->max('total'); @endphp
                    @foreach($chart_data as $data)
                        <div class="flex flex-col items-center group flex-shrink-0 w-12">
                            <div class="w-full bg-blue-100 rounded-t-lg relative group-hover:bg-blue-600 transition-colors" style="height: {{ ($data->total / $max) * 100 }}%">
                                <div class="opacity-0 group-hover:opacity-100 absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] py-1 px-2 rounded whitespace-nowrap transition-opacity z-10">
                                    Rp {{ number_format($data->total, 0, ',', '.') }}
                                </div>
                            </div>
                            <span class="text-[10px] text-gray-400 mt-2 rotate-45 origin-left">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M') }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300 italic">
                        Belum ada data penjualan pada periode ini.
                    </div>
                @endif
            </div>
        </div>

        <!-- Produk Terlaris -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-6">Produk Terlaris</h3>
            <div class="space-y-6">
                @forelse($produk_terlaris as $index => $item)
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500 font-bold text-xs">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $item->produk->nama ?? 'Produk Dihapus' }}</p>
                            <p class="text-[10px] text-gray-400">{{ $item->produk->kategori->nama ?? '-' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-blue-600">{{ $item->total_jual }}</p>
                            <p class="text-[9px] text-gray-400 uppercase">Terjual</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-400 text-xs italic py-10">Belum ada data penjualan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
