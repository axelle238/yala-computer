<div>
    <!-- Header Kontrol -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Cari nama, email, atau telepon..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
            </div>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl text-blue-600 font-bold text-xs uppercase tracking-widest">
            <i class="fas fa-user-friends"></i>
            <span>{{ $daftar_pelanggan->total() }} Pelanggan</span>
        </div>
    </div>

    <!-- Grid Pelanggan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($daftar_pelanggan as $pel)
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-blue-200">
                            {{ substr($pel->nama, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 truncate group-hover:text-blue-600 transition-colors">{{ $pel->nama }}</h3>
                            <p class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter">{{ $pel->surel }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <i class="fas fa-phone-alt w-4 text-blue-400"></i>
                            <span>{{ $pel->telepon ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <i class="fas fa-map-marker-alt w-4 text-blue-400"></i>
                            <span class="truncate">{{ $pel->alamat ?? 'Alamat belum diisi' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                        <div class="text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Total Pesanan</p>
                            <p class="text-sm font-black text-gray-900">{{ $pel->pesanan_count }}</p>
                        </div>
                        <button class="bg-gray-50 hover:bg-blue-600 hover:text-white text-gray-400 px-4 py-2 rounded-xl text-[10px] font-extrabold uppercase transition-all">
                            Lihat Riwayat
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-200 text-center">
                <i class="fas fa-user-slash text-gray-100 text-6xl mb-4"></i>
                <p class="text-gray-400 italic">Tidak ada data pelanggan ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $daftar_pelanggan->links() }}
    </div>
</div>
