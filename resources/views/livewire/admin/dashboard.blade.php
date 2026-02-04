<div wire:poll.5s class="space-y-10">
    
    <!-- Hero Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Total Inventori -->
        <div class="bg-[#0B1120] p-8 rounded-[2.5rem] border border-white/5 shadow-xl hover:border-blue-500/30 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl group-hover:bg-blue-600/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-500 shadow-inner">
                        <i class="fas fa-microchip text-2xl"></i>
                    </div>
                    @if($produk_stok_tipis > 0)
                        <div class="px-3 py-1 bg-red-500/10 border border-red-500/20 rounded-full flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                            <span class="text-[9px] font-black text-red-500 tracking-widest">{{ $produk_stok_tipis }} LOW STOCK</span>
                        </div>
                    @endif
                </div>
                <h3 class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Total Inventori</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-white tracking-tighter">{{ number_format($total_produk) }}</p>
                    <span class="text-xs font-bold text-gray-500">Unit</span>
                </div>
            </div>
        </div>

        <!-- Arus Kas -->
        <div class="bg-[#0B1120] p-8 rounded-[2.5rem] border border-white/5 shadow-xl hover:border-emerald-500/30 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-600/10 rounded-full blur-3xl group-hover:bg-emerald-600/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-emerald-600/10 rounded-2xl flex items-center justify-center text-emerald-500 shadow-inner">
                        <i class="fas fa-vault text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-trend-up text-emerald-500 text-sm"></i>
                </div>
                <h3 class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Total Pendapatan</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-black text-white tracking-tighter">Rp {{ number_format($total_pendapatan / 1000000, 1) }}<span class="text-lg">M</span></p>
                </div>
            </div>
        </div>

        <!-- Node Pesanan -->
        <div class="bg-[#0B1120] p-8 rounded-[2.5rem] border border-white/5 shadow-xl hover:border-purple-500/30 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-32 h-32 bg-purple-600/10 rounded-full blur-3xl group-hover:bg-purple-600/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-purple-600/10 rounded-2xl flex items-center justify-center text-purple-500 shadow-inner">
                        <i class="fas fa-satellite-dish text-2xl"></i>
                    </div>
                    <span class="px-2 py-1 bg-purple-500/10 text-purple-500 text-[9px] font-black rounded-lg">ACTIVE HUB</span>
                </div>
                <h3 class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Pesanan Masuk</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-white tracking-tighter">{{ number_format($total_pesanan) }}</p>
                    <span class="text-xs font-bold text-gray-500">Antrean</span>
                </div>
            </div>
        </div>

        <!-- User Metrics -->
        <div class="bg-[#0B1120] p-8 rounded-[2.5rem] border border-white/5 shadow-xl hover:border-orange-500/30 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-32 h-32 bg-orange-600/10 rounded-full blur-3xl group-hover:bg-orange-600/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-14 h-14 bg-orange-600/10 rounded-2xl flex items-center justify-center text-orange-500 shadow-inner">
                        <i class="fas fa-users-viewfinder text-2xl"></i>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-6 h-6 rounded-full border-2 border-[#0B1120] bg-gray-700"></div>
                        <div class="w-6 h-6 rounded-full border-2 border-[#0B1120] bg-blue-600"></div>
                    </div>
                </div>
                <h3 class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-1">Basis Pelanggan</h3>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-white tracking-tighter">{{ number_format($total_pelanggan) }}</p>
                    <span class="text-xs font-bold text-gray-500">Jiwa</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Operational Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
        
        <!-- Live Transaction Feed -->
        <div class="xl:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-blue-600 rounded-full shadow-[0_0_15px_#2563eb]"></div>
                    <h3 class="text-xl font-black text-white tracking-tight italic">LIVE TRANSACTION STREAM</h3>
                </div>
                <a href="{{ route('admin.pesanan') }}" wire:navigate class="text-[10px] font-black text-blue-500 hover:text-blue-400 uppercase tracking-widest flex items-center gap-2">
                    Visualisasikan Semua <i class="fas fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 bg-white/2">
                                <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Digital ID</th>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Entity</th>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-widest">Status Matrix</th>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">Credit/Debit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/2">
                            @forelse($pesanan_terbaru as $pesanan)
                                <tr class="hover:bg-blue-600/5 transition-all cursor-pointer">
                                    <td class="px-8 py-6">
                                        <span class="font-mono text-xs font-bold text-blue-500 bg-blue-500/10 px-3 py-1 rounded-lg">#{{ $pesanan->nomor_invoice }}</span>
                                        <p class="text-[9px] text-gray-600 font-mono mt-2">{{ $pesanan->created_at->format('Y.m.d // H:i:s') }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center text-white font-black text-[10px] border border-white/10">
                                                {{ substr($pesanan->pelanggan->nama ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-white tracking-wide">{{ $pesanan->pelanggan->nama ?? 'Anonymous Entity' }}</p>
                                                <p class="text-[10px] text-gray-500 italic">{{ $pesanan->pelanggan->surel ?? 'guest@yalacore.net' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $matrix = [
                                                'baru' => 'border-blue-500/50 text-blue-500 bg-blue-500/10',
                                                'diproses' => 'border-orange-500/50 text-orange-500 bg-orange-500/10',
                                                'selesai' => 'border-emerald-500/50 text-emerald-500 bg-emerald-500/10',
                                                'batal' => 'border-red-500/50 text-red-500 bg-red-500/10'
                                            ][$pesanan->status_pesanan] ?? 'border-gray-500 text-gray-500';
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-full border text-[9px] font-black uppercase tracking-widest {{ $matrix }}">
                                            {{ $pesanan->status_pesanan }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <p class="text-sm font-black text-white">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                        <p class="text-[9px] text-emerald-500 font-bold mt-1 tracking-widest">+ DEBITED</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center text-gray-600 italic font-mono text-xs">
                                        No active data streams found in current node.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Audit Trail Stream -->
        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-red-600 rounded-full shadow-[0_0_15px_#dc2626]"></div>
                    <h3 class="text-xl font-black text-white tracking-tight italic">AUDIT LOGS</h3>
                </div>
            </div>
            
            <div class="bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 p-8 shadow-2xl min-h-[600px]">
                <livewire:admin.ringkasan-log />
            </div>
        </div>
    </div>
</div>