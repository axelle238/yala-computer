<div class="space-y-6">
    <!-- Header & Filter -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Cari pesan log atau entitas..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-300"></i>
            </div>
            <select wire:model.live="filter_aksi" class="bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Aksi</option>
                <option value="tambah">Tambah</option>
                <option value="update">Update</option>
                <option value="hapus">Hapus</option>
                <option value="login">Login</option>
            </select>
        </div>
        <div class="text-xs text-gray-400 font-bold uppercase tracking-widest"> Jejak Audit Real-time </div>
    </div>

    <!-- Timeline Log -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="relative before:absolute before:left-[19px] before:top-2 before:bottom-2 before:w-0.5 before:bg-blue-50">
                @forelse($daftar_log as $log)
                    <div class="relative pl-12 mb-10 last:mb-0 group">
                        <!-- Dot Indicator -->
                        <div class="absolute left-0 top-1 w-10 h-10 rounded-2xl bg-white border-2 flex items-center justify-center transition-all group-hover:scale-110 z-10 {{ str_contains($log->aksi, 'tambah') ? 'border-green-100 text-green-500' : (str_contains($log->aksi, 'update') ? 'border-blue-100 text-blue-500' : (str_contains($log->aksi, 'hapus') ? 'border-red-100 text-red-500' : 'border-purple-100 text-purple-500')) }}">
                            <i class="{{ str_contains($log->aksi, 'tambah') ? 'fas fa-plus' : (str_contains($log->aksi, 'update') ? 'fas fa-pen' : (str_contains($log->aksi, 'hapus') ? 'fas fa-trash' : 'fas fa-user-shield')) }} text-xs"></i>
                        </div>

                        <div class="bg-gray-50/50 rounded-2xl p-6 border border-transparent group-hover:border-blue-100 group-hover:bg-white transition-all shadow-sm group-hover:shadow-lg group-hover:shadow-blue-900/5">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest {{ str_contains($log->aksi, 'tambah') ? 'bg-green-100 text-green-700' : (str_contains($log->aksi, 'update') ? 'bg-blue-100 text-blue-700' : (str_contains($log->aksi, 'hapus') ? 'bg-red-100 text-red-700' : 'bg-purple-100 text-purple-700')) }}">
                                        {{ $log->aksi }}
                                    </span>
                                    <span class="text-sm font-bold text-gray-900">{{ $log->target ?? 'Sistem' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-400 text-xs font-medium">
                                    <i class="far fa-clock"></i>
                                    {{ $log->waktu->format('d M Y, H:i:s') }} ({{ $log->waktu->diffForHumans() }})
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                {{ $log->pesan_naratif }}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] font-bold">
                                        {{ substr($log->pengguna->nama ?? 'S', 0, 1) }}
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">Dilakukan oleh <span class="text-gray-900 font-bold">{{ $log->pengguna->nama ?? 'Sistem Otomatis' }}</span></span>
                                </div>
                                @if($log->meta_json)
                                    <button class="text-[10px] font-bold text-blue-600 hover:underline">LIHAT DETAIL DATA</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-200">
                            <i class="fas fa-history text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Aktivitas</h3>
                        <p class="text-gray-500">Log aktivitas sistem akan muncul di sini saat ada aksi yang dilakukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="p-8 border-t border-gray-50 bg-gray-50/30">
            {{ $daftar_log->links() }}
        </div>
    </div>
</div>
