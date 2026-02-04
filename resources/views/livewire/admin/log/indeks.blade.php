<div class="space-y-10">
    
    <!-- Surveillance Control Hub -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#0B1120]/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-red-600/10 rounded-[1.5rem] flex items-center justify-center text-red-500 shadow-[inset_0_0_20px_rgba(220,38,38,0.1)]">
                <i class="fas fa-user-shield text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">AUDIT TRAIL TERMINAL</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_#dc2626]"></span>
                    <p class="text-[10px] text-red-400 font-black uppercase tracking-[0.3em]">Surveillance: ACTIVE</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning system event logs..." class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-red-500/50 outline-none transition-all font-mono italic">
                <i class="fas fa-tower-observation absolute left-6 top-4.5 text-gray-500 group-hover:text-red-500 transition-colors"></i>
            </div>
            <select wire:model.live="filter_aksi" class="bg-[#0B1120] border border-white/10 rounded-2xl py-4 px-6 text-xs font-black text-gray-400 focus:ring-2 focus:ring-red-500/50 outline-none cursor-pointer hover:bg-white/5 transition-all uppercase tracking-widest">
                <option value="">ALL PROTOCOLS</option>
                <option value="tambah">RESOURCES_ADD</option>
                <option value="update">CONFIG_UPDATE</option>
                <option value="hapus">DATA_PURGE</option>
                <option value="login">AUTH_ACCESS</option>
            </select>
        </div>
    </div>

    <!-- Live Event Stream -->
    <div class="bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl p-12">
        <div class="relative before:absolute before:left-[23px] before:top-4 before:bottom-4 before:w-px before:bg-white/5">
            @forelse($daftar_log as $log)
                <div class="relative pl-16 mb-12 last:mb-0 group animate-fade-in">
                    <!-- Protocol Indicator -->
                    <div class="absolute left-0 top-1 w-12 h-12 rounded-2xl bg-[#020617] border border-white/10 flex items-center justify-center transition-all group-hover:scale-110 z-10 shadow-2xl {{ str_contains($log->aksi, 'tambah') ? 'border-emerald-500/30 text-emerald-500 shadow-emerald-500/10' : (str_contains($log->aksi, 'update') ? 'border-blue-500/30 text-blue-500 shadow-blue-500/10' : (str_contains($log->aksi, 'hapus') ? 'border-red-500/30 text-red-500 shadow-red-500/10' : 'border-purple-500/30 text-purple-500 shadow-purple-500/10')) }}">
                        <i class="{{ str_contains($log->aksi, 'tambah') ? 'fas fa-plus-circle' : (str_contains($log->aksi, 'update') ? 'fas fa-arrows-rotate' : (str_contains($log->aksi, 'hapus') ? 'fas fa-trash-arrow-up' : 'fas fa-user-lock')) }} text-sm"></i>
                    </div>

                    <div class="bg-white/2 p-8 rounded-[2.5rem] border border-transparent group-hover:border-white/10 group-hover:bg-white/5 transition-all relative overflow-hidden">
                        <div class="absolute right-0 top-0 p-6 opacity-5 pointer-events-none">
                            <i class="fas fa-shield text-8xl"></i>
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                            <div class="flex items-center gap-4">
                                <span class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest {{ str_contains($log->aksi, 'tambah') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : (str_contains($log->aksi, 'update') ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : (str_contains($log->aksi, 'hapus') ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 'bg-purple-500/10 text-purple-400 border border-purple-500/20')) }}">
                                    PROTOCOL_{{ strtoupper($log->aksi) }}
                                </span>
                                <h4 class="text-sm font-black text-white tracking-widest uppercase italic group-hover:text-red-400 transition-colors">{{ $log->target ?? 'SYSTEM_KERNEL' }}</h4>
                            </div>
                            <div class="flex items-center gap-3 text-gray-500 font-mono text-[10px]">
                                <i class="far fa-clock text-red-500/50"></i>
                                <span>{{ $log->waktu->format('Y.m.d // H:i:s') }}</span>
                                <span class="text-gray-700">|</span>
                                <span class="italic text-gray-600">{{ $log->waktu->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-400 leading-relaxed mb-8 font-medium">
                            <span class="text-gray-600 font-mono mr-2">>>> </span>{{ $log->pesan_naratif }}
                        </p>

                        <div class="flex items-center justify-between pt-6 border-t border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-indigo-600 flex items-center justify-center text-white text-[10px] font-black border border-white/10 shadow-lg">
                                    {{ substr($log->pengguna->nama ?? 'S', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-gray-600 uppercase tracking-widest">Authorized Personnel</p>
                                    <p class="text-xs font-bold text-white tracking-wide uppercase">{{ $log->pengguna->nama ?? 'SYSTEM_AUTOMATION' }}</p>
                                </div>
                            </div>
                            @if($log->meta_json)
                                <button class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white px-6 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all border border-red-500/20">
                                    Analyze Data Packet
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-40">
                    <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-8 border border-white/5 animate-pulse">
                        <i class="fas fa-magnifying-glass-chart text-gray-700 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-white tracking-tighter uppercase mb-2">No Security Events Detected</h3>
                    <p class="text-gray-600 font-mono text-xs italic tracking-widest uppercase">Kernel is idle. Awaiting user interaction.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12 bg-black/20 p-8 rounded-[2rem] border border-white/5">
            {{ $daftar_log->links() }}
        </div>
    </div>
</div>