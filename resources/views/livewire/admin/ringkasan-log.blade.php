<div class="space-y-8 relative before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-white/5">
    @forelse($logs as $log)
        <div class="relative pl-10 group">
            <div class="absolute left-0 top-1 w-8 h-8 rounded-xl bg-[#1E293B] border border-white/10 flex items-center justify-center transition-all group-hover:border-blue-500/50 group-hover:scale-110 z-10 shadow-lg">
                <div class="w-1.5 h-1.5 rounded-full shadow-[0_0_10px] {{ str_contains($log->aksi, 'tambah') ? 'bg-emerald-400 shadow-emerald-400' : (str_contains($log->aksi, 'update') ? 'bg-blue-400 shadow-blue-400' : 'bg-orange-400 shadow-orange-400') }}"></div>
            </div>
            <div class="flex items-center justify-between mb-1">
                <p class="text-[10px] font-black text-white uppercase tracking-widest">{{ $log->aksi }} {{ $log->target }}</p>
                <span class="text-[9px] font-mono text-slate-500 uppercase">{{ $log->waktu->diffForHumans() }}</span>
            </div>
            <p class="text-xs text-slate-400 leading-relaxed italic mb-3">"{{ $log->pesan_naratif }}"</p>
            <div class="flex items-center gap-2">
                <div class="w-4 h-px bg-white/5"></div>
                <span class="text-[9px] font-black text-blue-400 uppercase tracking-tighter">Auth: {{ $log->pengguna->nama ?? 'SYSTEM_CORE' }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-20">
            <i class="fas fa-tower-broadcast text-white/5 text-5xl mb-4"></i>
            <p class="text-xs text-slate-500 font-mono italic tracking-tight">Listening for system events...</p>
        </div>
    @endforelse
</div>