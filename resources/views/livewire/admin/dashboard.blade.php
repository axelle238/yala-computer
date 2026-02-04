<div wire:poll.5s class="space-y-10">
    
    <!-- Hero Analytics Deck -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Inventory Node -->
        <div class="bg-white p-8 rounded-[2rem] border-b-4 border-blue-500 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-inner">
                        <i class="fas fa-boxes-stacked text-2xl"></i>
                    </div>
                    @if($produk_stok_tipis > 0)
                        <div class="px-3 py-1 bg-rose-50 border border-rose-100 rounded-full flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-ping"></span>
                            <span class="text-[9px] font-black text-rose-600 tracking-widest">{{ $produk_stok_tipis }} LOW_STOCK</span>
                        </div>
                    @endif
                </div>
                <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Stock Portfolio</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($total_produk) }}</p>
                    <span class="text-xs font-bold text-slate-400">SKU</span>
                </div>
            </div>
        </div>

        <!-- Revenue Matrix -->
        <div class="bg-white p-8 rounded-[2rem] border-b-4 border-emerald-500 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-inner">
                        <i class="fas fa-chart-line-up text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-trend-up text-emerald-500 text-sm"></i>
                </div>
                <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Total Valuation</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-black text-slate-900 tracking-tighter">Rp {{ number_format($total_pendapatan / 1000000, 1) }}<span class="text-lg text-emerald-600">M</span></p>
                </div>
            </div>
        </div>

        <!-- Hub Traffic -->
        <div class="bg-white p-8 rounded-[2rem] border-b-4 border-purple-500 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 shadow-inner">
                        <i class="fas fa-satellite-dish text-2xl"></i>
                    </div>
                    <span class="px-2 py-1 bg-purple-50 text-purple-600 text-[9px] font-black rounded-lg border border-purple-100 uppercase tracking-widest">Live Hub</span>
                </div>
                <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Active Transactions</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($total_pesanan) }}</p>
                    <span class="text-xs font-bold text-slate-400">Packets</span>
                </div>
            </div>
        </div>

        <!-- User Density -->
        <div class="bg-white p-8 rounded-[2rem] border-b-4 border-rose-500 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 shadow-inner">
                        <i class="fas fa-user-astronaut text-2xl"></i>
                    </div>
                    <div class="flex -space-x-3">
                        <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-200"></div>
                        <div class="w-7 h-7 rounded-full border-2 border-white bg-blue-500"></div>
                        <div class="w-7 h-7 rounded-full border-2 border-white bg-rose-500"></div>
                    </div>
                </div>
                <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Entity Base</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($total_pelanggan) }}</p>
                    <span class="text-xs font-bold text-slate-400">Nodes</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Operations Stream -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
        
        <!-- Data Packet Grid -->
        <div class="xl:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-blue-600 rounded-full shadow-[0_0_15px_rgba(37,99,235,0.4)]"></div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight italic uppercase">Transaction Stream</h3>
                </div>
                <a href="{{ route('admin.pesanan') }}" wire:navigate class="text-[10px] font-black text-blue-600 hover:text-blue-700 uppercase tracking-[0.2em] flex items-center gap-2 transition-all">
                    Full Spectrum <i class="fas fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl overflow-hidden relative">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Protocol ID</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Source Entity</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Matrix</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Valuation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($pesanan_terbaru as $pesanan)
                                <tr class="hover:bg-slate-50/80 transition-all cursor-pointer group">
                                    <td class="px-8 py-6">
                                        <span class="font-mono text-xs font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 shadow-sm uppercase">#{{ $pesanan->nomor_invoice }}</span>
                                        <p class="text-[9px] text-slate-400 font-bold mt-2 uppercase tracking-widest">{{ $pesanan->created_at->format('d.M.Y // H:i') }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-[10px] border border-slate-200 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                                                {{ substr($pesanan->pelanggan->nama ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-extrabold text-slate-900 tracking-tight">{{ $pesanan->pelanggan->nama ?? 'Unknown Node' }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium lowercase tracking-tighter italic">{{ $pesanan->pelanggan->surel ?? 'guest_access' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $matrix = [
                                                'baru' => 'border-blue-200 text-blue-600 bg-blue-50',
                                                'diproses' => 'border-orange-200 text-orange-600 bg-orange-50',
                                                'selesai' => 'border-emerald-200 text-emerald-600 bg-emerald-50',
                                                'batal' => 'border-rose-200 text-rose-600 bg-rose-50'
                                            ][$pesanan->status_pesanan] ?? 'border-slate-200 text-slate-500 bg-slate-50';
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-full border text-[9px] font-black uppercase tracking-widest shadow-sm {{ $matrix }}">
                                            {{ $pesanan->status_pesanan }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <p class="text-sm font-black text-slate-900 tracking-tight">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        <p class="text-[9px] text-emerald-600 font-black mt-1 tracking-widest uppercase italic">+ Synced</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center text-slate-400 italic font-mono text-xs uppercase tracking-widest bg-slate-50/30">
                                        Waiting for active data packets...
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Audit Trail HUB -->
        <div class="space-y-6">
            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-rose-600 rounded-full shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight italic uppercase">Security Audit</h3>
                </div>
            </div>
            
            <div class="bg-white rounded-[2.5rem] border border-slate-200/60 p-8 shadow-xl relative min-h-[600px] overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                    <i class="fas fa-shield-halved text-9xl"></i>
                </div>
                <livewire:admin.ringkasan-log />
            </div>
        </div>
    </div>
</div>