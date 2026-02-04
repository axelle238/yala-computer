<div class="space-y-8 relative before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-slate-100">
    @forelse($logs as $log)
        <div class="relative pl-10 group animate-fade-in">
            <!-- Action Node -->
            <div class="absolute left-0 top-1 w-8 h-8 rounded-xl bg-white border border-slate-200 flex items-center justify-center transition-all group-hover:border-blue-500 group-hover:shadow-[0_0_15px_rgba(37,99,235,0.15)] group-hover:scale-110 z-10 shadow-sm">
                <div class="w-1.5 h-1.5 rounded-full {{ str_contains($log->aksi, 'tambah') ? 'bg-emerald-500' : (str_contains($log->aksi, 'update') ? 'bg-blue-500' : 'bg-rose-500') }} shadow-[0_0_8px] {{ str_contains($log->aksi, 'tambah') ? 'shadow-emerald-500/50' : (str_contains($log->aksi, 'update') ? 'shadow-blue-500/50' : 'shadow-rose-500/50') }}"></div>
            </div>
            <div class="flex items-center justify-between mb-1">
                <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ $log->aksi }} {{ $log->target }}</p>
                <span class="text-[9px] font-mono text-slate-400 font-bold uppercase tracking-tighter">{{ $log->waktu->diffForHumans() }}</span>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed font-medium italic mb-3">"{{ $log->pesan_naratif }}"</p>
            <div class="flex items-center gap-2">
                <div class="w-4 h-px bg-slate-100"></div>
                <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest italic opacity-80">Credential: {{ $log->pengguna->nama ?? 'SYSTEM_KERNEL' }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-24">
            <i class="fas fa-tower-broadcast text-slate-100 text-6xl mb-6"></i>
            <p class="text-xs text-slate-400 font-black uppercase tracking-[0.3em] italic">Awaiting System Pulse...</p>
        </div>
    @endforelse
</div>
