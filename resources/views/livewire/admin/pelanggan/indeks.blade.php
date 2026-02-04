<div wire:poll.15s class="space-y-10">
    
    <!-- Header Identification Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#1E293B]/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-orange-600/10 rounded-[1.5rem] flex items-center justify-center text-orange-500 shadow-[inset_0_0_20px_rgba(249,115,22,0.1)]">
                <i class="fas fa-id-badge text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">ENTITY DATABASE</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_10px_#f97316]"></span>
                    <p class="text-[10px] text-orange-400 font-black uppercase tracking-[0.3em]">Scanner: Synchronized</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning entity biometrics (Name, Email, Tel)..." class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-300 focus:ring-2 focus:ring-orange-500/50 outline-none transition-all group-hover:border-white/20 font-mono italic placeholder-slate-600">
                <i class="fas fa-fingerprint absolute left-6 top-4.5 text-slate-500 group-hover:text-orange-500 transition-colors"></i>
            </div>
            <div class="flex flex-col items-end">
                <span class="text-[10px] font-black text-slate-500 tracking-widest uppercase mb-1">Active Nodes</span>
                <span class="text-xl font-black text-orange-500 font-mono tracking-tighter">{{ $daftar_pelanggan->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Entity Identification Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($daftar_pelanggan as $pel)
            <div class="bg-[#1E293B]/60 backdrop-blur-xl rounded-[2.5rem] border border-white/5 p-8 shadow-xl hover:border-orange-500/30 transition-all group relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-orange-600/5 rounded-full blur-3xl group-hover:bg-orange-600/10 transition-all"></div>
                
                <div class="relative z-10">
                    <!-- Identity Header -->
                    <div class="flex items-center gap-5 mb-8">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-orange-900/40 border border-white/10 group-hover:scale-110 transition-transform">
                                {{ substr($pel->nama, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-4 border-[#1E293B] shadow-[0_0_10px_#10b981]"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-black text-white tracking-tight truncate group-hover:text-orange-400 transition-colors uppercase italic">{{ $pel->nama }}</h3>
                            <p class="text-[9px] font-mono text-slate-500 uppercase tracking-tighter truncate">{{ $pel->surel }}</p>
                        </div>
                    </div>

                    <!-- Technical Specs -->
                    <div class="space-y-4 mb-8 bg-[#0F172A]/50 p-6 rounded-2xl border border-white/5">
                        <div class="flex items-center gap-4 text-[10px] font-mono">
                            <i class="fas fa-phone text-orange-500 w-4"></i>
                            <span class="text-slate-500">COM_PORT:</span>
                            <span class="text-slate-300 font-bold">{{ $pel->telepon ?? 'NOT_SET' }}</span>
                        </div>
                        <div class="flex items-start gap-4 text-[10px] font-mono">
                            <i class="fas fa-location-dot text-orange-500 w-4 mt-0.5"></i>
                            <span class="text-slate-500">LOC:</span>
                            <span class="text-slate-300 font-bold italic line-clamp-2 leading-relaxed">{{ $pel->alamat ?? 'GEO_DATA_NULL' }}</span>
                        </div>
                    </div>

                    <!-- Loyalty Index -->
                    <div class="flex items-center justify-between pt-6 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-1">Loyalty Index</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-black text-white font-mono tracking-tighter">{{ $pel->pesanan_count }}</span>
                                <span class="text-[9px] text-orange-500 font-bold uppercase">Packets</span>
                            </div>
                        </div>
                        <button class="bg-white/5 hover:bg-orange-600 text-slate-400 hover:text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all border border-white/5 hover:border-orange-500 shadow-lg">
                            Fetch Logs
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-[#1E293B]/60 backdrop-blur-xl rounded-[3rem] border border-white/5 p-32 text-center">
                <i class="fas fa-user-slash text-white/5 text-8xl mb-8"></i>
                <p class="text-slate-500 font-mono italic tracking-[0.3em] uppercase">No human entities detected in current database scan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination Terminal -->
    <div class="mt-12 bg-[#1E293B]/40 p-6 rounded-[2rem] border border-white/5 shadow-inner">
        {{ $daftar_pelanggan->links() }}
    </div>
</div>
