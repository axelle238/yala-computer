<div wire:poll.15s class="space-y-10">
    
    <!-- Header Identification Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-rose-50 rounded-[1.5rem] flex items-center justify-center text-rose-600 shadow-inner border border-rose-100">
                <i class="fas fa-user-astronaut text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Entity Database</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                    <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.3em]">Synced: Real-time</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning identity metrics..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all font-mono italic">
                <i class="fas fa-fingerprint absolute left-6 top-4.5 text-slate-400 group-focus-within:text-rose-500 transition-colors"></i>
            </div>
            <div class="flex flex-col items-end px-6 border-l border-slate-100 hidden sm:flex">
                <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase mb-1">Active Nodes</span>
                <span class="text-2xl font-black text-rose-600 font-mono tracking-tighter">{{ $daftar_pelanggan->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Entity Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($daftar_pelanggan as $pel)
            <div class="bg-white rounded-[3rem] border border-slate-200/60 p-8 shadow-lg hover:shadow-2xl transition-all group relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-rose-50 rounded-full blur-2xl group-hover:scale-125 transition-transform"></div>
                
                <div class="relative z-10">
                    <!-- Identity Header -->
                    <div class="flex items-center gap-5 mb-8">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-rose-200 border border-white/20">
                                {{ substr($pel->nama, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-4 border-white shadow-sm"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-black text-slate-900 tracking-tight truncate group-hover:text-rose-600 transition-colors uppercase italic">{{ $pel->nama }}</h3>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter truncate">{{ $pel->surel }}</p>
                        </div>
                    </div>

                    <!-- Specs Panel -->
                    <div class="space-y-4 mb-8 bg-slate-50 p-6 rounded-3xl border border-slate-100 shadow-inner">
                        <div class="flex items-center gap-4 text-[10px] font-bold">
                            <i class="fas fa-phone text-rose-500 w-4"></i>
                            <span class="text-slate-400 uppercase">Port:</span>
                            <span class="text-slate-900 uppercase tracking-tighter">{{ $pel->telepon ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-start gap-4 text-[10px] font-bold">
                            <i class="fas fa-location-dot text-rose-500 w-4 mt-0.5"></i>
                            <span class="text-slate-400 uppercase">Loc:</span>
                            <span class="text-slate-600 italic line-clamp-2 leading-relaxed uppercase tracking-tighter">{{ $pel->alamat ?? 'NULL_SECTOR' }}</span>
                        </div>
                    </div>

                    <!-- Engagement Matrix -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Packet Cycle</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-black text-slate-900 font-mono tracking-tighter">{{ $pel->pesanan_count }}</span>
                                <span class="text-[9px] text-rose-500 font-black uppercase">Orders</span>
                            </div>
                        </div>
                        <button class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 text-slate-400 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm flex items-center justify-center">
                            <i class="fas fa-satellite-dish text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-[3rem] border border-slate-200/60 p-32 text-center shadow-sm">
                <i class="fas fa-user-slash text-slate-100 text-8xl mb-8"></i>
                <p class="text-slate-400 font-black uppercase tracking-[0.3em] italic">Database scan: Zero entities detected.</p>
            </div>
        @endforelse
    </div>

    <!-- Interface Pagination -->
    <div class="mt-12 bg-white/50 p-6 rounded-[2rem] border border-slate-200/60 shadow-sm">
        {{ $daftar_pelanggan->links() }}
    </div>
</div>