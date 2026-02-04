<div class="space-y-10">
    
    <!-- Surveillance Hub -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-rose-50 rounded-[1.5rem] flex items-center justify-center text-rose-600 shadow-inner border border-rose-100">
                <i class="fas fa-user-shield text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Audit Trail HUB</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-rose-500 shadow-[0_0_8px_#e11d48]"></span>
                    <p class="text-[10px] text-rose-600 font-black uppercase tracking-[0.3em]">Status: Scanning Logs</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning system event logs..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all font-mono italic">
                <i class="fas fa-tower-observation absolute left-6 top-4.5 text-slate-400 group-focus-within:text-rose-500 transition-colors"></i>
            </div>
            <select wire:model.live="filter_aksi" class="bg-slate-50 border border-white/10 rounded-2xl py-4 px-6 text-xs font-black text-slate-600 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none cursor-pointer hover:bg-white transition-all uppercase tracking-widest shadow-sm">
                <option value="">All Signals</option>
                <option value="tambah">Node_Created</option>
                <option value="update">Protocol_Update</option>
                <option value="hapus">Data_Purge</option>
                <option value="login">Secure_Access</option>
            </select>
        </div>
    </div>

    <!-- Live Event Feed -->
    <div class="bg-white rounded-[3rem] border border-slate-200/60 overflow-hidden shadow-2xl p-12 relative">
        <div class="absolute top-0 right-0 p-8 opacity-5 pointer-events-none">
            <i class="fas fa-fingerprint text-[150px] text-slate-900"></i>
        </div>

        <div class="relative before:absolute before:left-[23px] before:top-4 before:bottom-4 before:w-px before:bg-slate-100">
            @forelse($daftar_log as $log)
                <div class="relative pl-16 mb-12 last:mb-0 group animate-fade-in">
                    <!-- Event Node -->
                    <div class="absolute left-0 top-1 w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center transition-all group-hover:scale-110 z-10 shadow-sm {{ str_contains($log->aksi, 'tambah') ? 'border-emerald-200 text-emerald-500' : (str_contains($log->aksi, 'update') ? 'border-blue-200 text-blue-500' : (str_contains($log->aksi, 'hapus') ? 'border-rose-200 text-rose-500' : 'border-purple-200 text-purple-500')) }}">
                        <i class="{{ str_contains($log->aksi, 'tambah') ? 'fas fa-plus-circle' : (str_contains($log->aksi, 'update') ? 'fas fa-arrows-rotate' : (str_contains($log->aksi, 'hapus') ? 'fas fa-trash-arrow-up' : 'fas fa-key-skeleton')) }} text-sm"></i>
                    </div>

                    <div class="bg-slate-50/50 p-8 rounded-[2.5rem] border border-transparent group-hover:border-slate-200 group-hover:bg-white transition-all relative overflow-hidden shadow-inner group-hover:shadow-md">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                            <div class="flex items-center gap-4">
                                <span class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ str_contains($log->aksi, 'tambah') ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : (str_contains($log->aksi, 'update') ? 'bg-blue-50 text-blue-600 border-blue-100' : (str_contains($log->aksi, 'hapus') ? 'bg-rose-50 text-rose-600 border-rose-100' : 'bg-purple-50 text-purple-600 border-purple-100')) }}">
                                    SYS_{{ strtoupper($log->aksi) }}_LOG
                                </span>
                                <h4 class="text-sm font-black text-slate-900 tracking-widest uppercase italic group-hover:text-blue-600 transition-colors">{{ $log->target ?? 'SYSTEM_KERNEL' }}</h4>
                            </div>
                            <div class="flex items-center gap-3 text-slate-400 font-mono text-[10px] font-bold">
                                <i class="far fa-clock"></i>
                                <span>{{ $log->waktu->format('Y.m.d // H:i:s') }}</span>
                                <span class="text-slate-200">|</span>
                                <span class="italic uppercase text-slate-500">{{ $log->waktu->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <p class="text-sm text-slate-600 leading-relaxed mb-8 font-medium italic">
                            <span class="text-slate-300 font-black mr-2 tracking-tighter">>>></span>{{ $log->pesan_naratif }}
                        </p>

                        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white text-[10px] font-black shadow-md">
                                    {{ substr($log->pengguna->nama ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Authority Personnel</p>
                                    <p class="text-xs font-black text-slate-900 tracking-wide uppercase">{{ $log->pengguna->nama ?? 'AUTO_BOT' }}</p>
                                </div>
                            </div>
                            @if($log->meta_json)
                                <button class="bg-white hover:bg-slate-900 hover:text-white px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all border border-slate-200 shadow-sm">
                                    Analyze Data Packet
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-40">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100 animate-pulse shadow-inner">
                        <i class="fas fa-shield-halved text-slate-200 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tighter uppercase mb-2">Logs Terminal Idle</h3>
                    <p class="text-slate-400 font-bold text-xs italic tracking-widest uppercase italic">Kernel standing by for activity signals.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12 bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 shadow-inner">
            {{ $daftar_log->links() }}
        </div>
    </div>
</div>
