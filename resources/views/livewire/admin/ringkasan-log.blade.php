<div class="space-y-8 relative before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-white/5">
    @forelse($logs as $log)
        <div class="relative pl-10 group">
            <div class="absolute left-0 top-1 w-8 h-8 rounded-xl bg-[#0B1120] border border-white/10 flex items-center justify-center transition-all group-hover:border-blue-500/50 group-hover:scale-110 z-10">
                <div class="w-1.5 h-1.5 rounded-full shadow-[0_0_10px] {{ str_contains($log->aksi, 'tambah') ? 'bg-emerald-500 shadow-emerald-500' : (str_contains($log->aksi, 'update') ? 'bg-blue-500 shadow-blue-500' : 'bg-orange-500 shadow-orange-500') }}"></div>
            </div>
            <div class="flex items-center justify-between mb-1">
                <p class="text-[10px] font-black text-white uppercase tracking-widest">{{ $log->aksi }} {{ $log->target }}</p>
                <span class="text-[9px] font-mono text-gray-600 uppercase">{{ $log->waktu->diffForHumans() }}</span>
            </div>
            <p class="text-xs text-gray-500 leading-relaxed italic mb-3">"{{ $log->pesan_naratif }}"</p>
            <div class="flex items-center gap-2">
                <div class="w-4 h-px bg-white/5"></div>
                <span class="text-[9px] font-black text-blue-500 uppercase tracking-tighter">Auth: {{ $log->pengguna->nama ?? 'SYSTEM_CORE' }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-20">
            <i class="fas fa-tower-broadcast text-white/5 text-5xl mb-4"></i>
            <p class="text-xs text-gray-600 font-mono italic tracking-tight">Listening for system events...</p>
        </div>
    @endforelse
</div>
