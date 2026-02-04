<div class="space-y-10">
    
    <!-- Intelligence Control Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-blue-50 rounded-[1.5rem] flex items-center justify-center text-blue-600 shadow-inner border border-blue-100">
                <i class="fas fa-chart-line-up text-2xl animate-bounce"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Financial Intelligence</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6]"></span>
                    <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.3em]">Analysis Node: Synchronized</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative group">
                <select wire:model.live="periode" class="bg-slate-50 border border-slate-200 rounded-2xl py-4 px-10 text-xs font-black text-blue-600 focus:ring-4 focus:ring-blue-500/10 outline-none cursor-pointer hover:bg-white transition-all uppercase tracking-widest appearance-none shadow-sm">
                    <option value="bulan_ini">Current Cycle</option>
                    <option value="bulan_lalu">Previous Cycle</option>
                    <option value="tahun_ini">Annual Matrix</option>
                </select>
                <i class="fas fa-calendar-day absolute left-4 top-4 text-blue-400"></i>
                <i class="fas fa-chevron-down absolute right-4 top-4.5 text-[10px] text-blue-400"></i>
            </div>
            <button wire:click="unduhLaporan" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-8 rounded-2xl shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                <i class="fas fa-file-export"></i>
                <span class="text-[10px] uppercase tracking-[0.2em]">Execute CSV Dump</span>
            </button>
        </div>
    </div>

    <!-- Macro Metrics Deck -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Revenue Asset -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-10 rounded-[3rem] text-white shadow-2xl shadow-blue-200 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-[100px] translate-x-32 -translate-y-32 group-hover:scale-110 transition-transform duration-1000"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center justify-between mb-12">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg border border-white/20">
                        <i class="fas fa-vault"></i>
                    </div>
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-black tracking-widest uppercase border border-white/10">Validated Assets</span>
                </div>
                <div>
                    <p class="text-blue-100 text-xs font-black uppercase tracking-[0.3em] mb-3">Total Gross Revenue ({{ str_replace('_', ' ', $periode) }})</p>
                    <h3 class="text-5xl font-black tracking-tighter drop-shadow-xl">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Transaction Metrics -->
        <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-xl flex items-center justify-between group overflow-hidden relative">
            <div class="absolute inset-0 bg-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <p class="text-slate-400 text-xs font-black uppercase tracking-[0.3em] mb-3">Synchronized Transactions</p>
                <div class="flex items-baseline gap-4">
                    <h3 class="text-6xl font-black text-slate-900 tracking-tighter font-mono">{{ number_format($total_transaksi) }}</h3>
                    <span class="text-emerald-600 font-black text-xs uppercase tracking-widest italic">Validated Nodes</span>
                </div>
            </div>
            <div class="w-24 h-24 bg-emerald-50 rounded-[2rem] flex items-center justify-center text-emerald-600 text-4xl border border-emerald-100 shadow-sm group-hover:rotate-12 transition-all">
                <i class="fas fa-microchip-ai"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Visualization Matrix (Custom Bar Chart) -->
        <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-6 bg-blue-600 rounded-full shadow-[0_0_10px_#3b82f6]"></div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase italic">Live Sales Stream</h3>
                </div>
                <div class="flex items-center gap-2 text-slate-400 font-mono text-[9px] font-bold">
                    <i class="fas fa-signal-stream"></i> PACKET_LOSS: 0%
                </div>
            </div>

            <div class="h-[350px] flex items-end gap-4 overflow-x-auto pb-10 custom-scrollbar relative">
                <!-- Visual Grid -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-[0.03]">
                    @foreach(range(1, 5) as $i)
                        <div class="w-full h-px bg-slate-900"></div>
                    @endforeach
                </div>

                @if($chart_data->count() > 0)
                    @php $max = $chart_data->max('total'); @endphp
                    @foreach($chart_data as $data)
                        <div class="flex flex-col items-center group flex-shrink-0 w-16">
                            <div class="w-full bg-blue-50 rounded-t-[1rem] border-t border-x border-blue-100 relative group-hover:bg-blue-600 transition-all duration-500 shadow-inner" style="height: {{ ($data->total / $max) * 100 }}%">
                                <div class="opacity-0 group-hover:opacity-100 absolute -top-14 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] font-black py-2 px-4 rounded-xl whitespace-nowrap shadow-2xl transition-all z-20">
                                    Rp {{ number_format($data->total, 0, ',', '.') }}
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900 rotate-45"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-500/10 to-transparent"></div>
                            </div>
                            <span class="text-[9px] font-mono text-slate-400 mt-4 font-black uppercase tracking-widest italic">{{ \Carbon\Carbon::parse($data->tanggal)->format('d.M') }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-200 italic gap-4">
                        <i class="fas fa-radar text-5xl"></i>
                        <p class="font-black text-xs tracking-widest uppercase">Kernel: No Data Packet Found</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Performance Index (Top Nodes) -->
        <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-xl relative overflow-hidden border-t-8 border-t-blue-600">
            <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase mb-10 italic flex items-center gap-4">
                <i class="fas fa-ranking-star text-blue-600"></i> Top Performers
            </h3>
            <div class="space-y-8 relative z-10">
                @forelse($produk_terlaris as $index => $item)
                    <div class="flex items-center gap-6 group cursor-pointer p-4 rounded-3xl hover:bg-slate-50 transition-all">
                        <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-slate-100 border border-slate-200 text-slate-400 font-mono text-sm font-black group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all shadow-sm">
                            #0{{ $index + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-black text-slate-900 truncate group-hover:text-blue-600 transition-colors uppercase italic tracking-tighter">{{ $item->produk->nama ?? 'DELETED_NODE' }}</p>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">{{ $item->produk->kategori->nama ?? 'SYSTEM' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-black text-blue-600 font-mono tracking-tighter">{{ $item->total_jual }}</p>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter italic">Dispatched</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                        <i class="fas fa-box-open text-slate-200 text-5xl mb-4"></i>
                        <p class="text-slate-400 font-black uppercase tracking-widest text-[10px]">No Ranking Data</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12 p-6 bg-blue-50 rounded-[2rem] border border-blue-100 flex items-center gap-4">
                <i class="fas fa-info-circle text-blue-600"></i>
                <p class="text-[9px] font-bold text-blue-800 leading-relaxed uppercase tracking-tighter italic">Data synchronized from Core Financial Node. Verified Cycle: {{ now()->format('Y.m.d') }}</p>
            </div>
        </div>
    </div>
</div>