<div class="space-y-10">
    
    <!-- Analysis Control Center -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#1E293B]/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-blue-600/10 rounded-[1.5rem] flex items-center justify-center text-blue-500 shadow-[inset_0_0_20px_rgba(37,99,235,0.1)]">
                <i class="fas fa-chart-line text-2xl animate-bounce"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">FINANCIAL INTELLIGENCE</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span>
                    <p class="text-[10px] text-blue-400 font-black uppercase tracking-[0.3em]">Analysis Node: Online</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative group">
                <select wire:model.live="periode" class="bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-10 text-xs font-black text-blue-400 focus:ring-2 focus:ring-blue-500/50 outline-none cursor-pointer hover:bg-white/5 transition-all uppercase tracking-widest appearance-none">
                    <option value="bulan_ini">Current Month Cycle</option>
                    <option value="bulan_lalu">Previous Cycle</option>
                    <option value="tahun_ini">Annual Projection</option>
                </select>
                <i class="fas fa-calendar-alt absolute left-4 top-4 text-blue-500"></i>
                <i class="fas fa-chevron-down absolute right-4 top-4.5 text-[10px] text-blue-500"></i>
            </div>
            <button wire:click="unduhLaporan" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-8 rounded-2xl shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                <i class="fas fa-file-export"></i>
                <span class="text-[10px] uppercase tracking-[0.2em]">Execute Data Dump (CSV)</span>
            </button>
        </div>
    </div>

    <!-- Macro Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Revenue Card -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-900 p-10 rounded-[3rem] text-white shadow-2xl shadow-blue-900/40 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-[100px] translate-x-32 -translate-y-32 group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-10">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg border border-white/10">
                        <i class="fas fa-vault"></i>
                    </div>
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-black tracking-widest uppercase">Validated Assets</span>
                </div>
                <div>
                    <p class="text-blue-200 text-xs font-black uppercase tracking-[0.3em] mb-3">Total Gross Revenue ({{ str_replace('_', ' ', $periode) }})</p>
                    <h3 class="text-5xl font-black tracking-tighter drop-shadow-lg">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Transaction Node Count -->
        <div class="bg-[#1E293B]/60 backdrop-blur-xl p-10 rounded-[3rem] border border-white/5 shadow-2xl flex items-center justify-between group overflow-hidden relative">
            <div class="absolute inset-0 bg-emerald-600/2 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <p class="text-slate-500 text-xs font-black uppercase tracking-[0.3em] mb-3">Synchronized Transactions</p>
                <div class="flex items-baseline gap-4">
                    <h3 class="text-6xl font-black text-white tracking-tighter font-mono">{{ number_format($total_transaksi) }}</h3>
                    <span class="text-emerald-500 font-black text-xs uppercase tracking-widest">Successful Nodes</span>
                </div>
            </div>
            <div class="w-24 h-24 bg-emerald-500/10 rounded-[2rem] flex items-center justify-center text-emerald-500 text-4xl border border-emerald-500/20 shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-check-double animate-pulse"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Live Sales Matrix (Visual Bar) -->
        <div class="lg:col-span-2 bg-[#1E293B]/60 backdrop-blur-xl p-10 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-6 bg-blue-500 rounded-full"></div>
                    <h3 class="text-lg font-black text-white tracking-tight uppercase italic">Live Sales Matrix</h3>
                </div>
                <div class="flex items-center gap-2 text-slate-500 font-mono text-[9px]">
                    <i class="fas fa-wave-square"></i> STREAMING DATA...
                </div>
            </div>

            <div class="h-[350px] flex items-end gap-4 overflow-x-auto pb-10 custom-scrollbar relative">
                <!-- Data Grid Lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-5">
                    @foreach(range(1, 5) as $i)
                        <div class="w-full h-px bg-white"></div>
                    @endforeach
                </div>

                @if($chart_data->count() > 0)
                    @php $max = $chart_data->max('total'); @endphp
                    @foreach($chart_data as $data)
                        <div class="flex flex-col items-center group flex-shrink-0 w-16">
                            <div class="w-full bg-blue-600/20 rounded-t-[1rem] border-t border-x border-blue-500/30 relative group-hover:bg-blue-600/40 group-hover:border-blue-400 transition-all duration-500" style="height: {{ ($data->total / $max) * 100 }}%">
                                <div class="opacity-0 group-hover:opacity-100 absolute -top-14 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[9px] font-black py-2 px-4 rounded-xl whitespace-nowrap shadow-2xl transition-all z-20 border border-white/20">
                                    Rp {{ number_format($data->total, 0, ',', '.') }}
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-blue-600 rotate-45 border-b border-r border-white/20"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-600/40 to-transparent"></div>
                            </div>
                            <span class="text-[9px] font-mono text-slate-500 mt-4 font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($data->tanggal)->format('d.M') }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-500 italic gap-4">
                        <i class="fas fa-circle-nodes text-4xl animate-pulse"></i>
                        <p class="font-mono text-xs tracking-[0.2em] uppercase">No active transaction packets in current cycle.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Top Performing Nodes -->
        <div class="bg-[#1E293B]/60 backdrop-blur-xl p-10 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/5 rounded-full blur-3xl"></div>
            <h3 class="text-lg font-black text-white tracking-tight uppercase mb-10 italic flex items-center gap-4">
                <i class="fas fa-trophy text-orange-500"></i> Top Nodes
            </h3>
            <div class="space-y-8 relative z-10">
                @forelse($produk_terlaris as $index => $item)
                    <div class="flex items-center gap-6 group">
                        <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white/5 border border-white/10 text-slate-500 font-mono text-sm font-black group-hover:border-blue-500/50 group-hover:text-blue-400 transition-all">
                            #0{{ $index + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-black text-white truncate group-hover:text-blue-400 transition-colors uppercase italic tracking-tighter">{{ $item->produk->nama ?? 'DELETED_RESOURCE' }}</p>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">{{ $item->produk->kategori->nama ?? 'UNCLASSIFIED' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-black text-blue-500 font-mono tracking-tighter">{{ $item->total_jual }}</p>
                            <p class="text-[8px] font-black text-slate-500 uppercase tracking-tighter">Units Dispatched</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <i class="fas fa-box-open text-white/5 text-5xl mb-4"></i>
                        <p class="text-slate-500 font-mono italic text-xs uppercase">No resource performance data.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12 p-6 bg-blue-500/5 border border-blue-500/10 rounded-2xl">
                <p class="text-[9px] font-black text-blue-400 leading-relaxed uppercase tracking-widest">Data synchronized from Core Financial Hub. Cycle: {{ now()->format('Y.m.d') }}</p>
            </div>
        </div>
    </div>
</div>
