<div wire:poll.10s class="space-y-10">
    
    <!-- Top Intelligence Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#0B1120]/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-emerald-600/10 rounded-[1.5rem] flex items-center justify-center text-emerald-500 shadow-[inset_0_0_20px_rgba(16,185,129,0.1)]">
                <i class="fas fa-satellite-dish text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic">TRANSACTION TERMINAL</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></span>
                    <p class="text-[10px] text-emerald-400 font-black uppercase tracking-[0.3em]">Operational Node: Active</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning invoice packets..." class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-emerald-500/50 outline-none transition-all group-hover:border-white/20">
                <i class="fas fa-search-dollar absolute left-6 top-4.5 text-gray-500 group-hover:text-emerald-500 transition-colors"></i>
            </div>
            <select wire:model.live="status_filter" class="bg-[#0B1120] border border-white/10 rounded-2xl py-4 px-6 text-sm text-gray-400 focus:ring-2 focus:ring-emerald-500/50 outline-none cursor-pointer hover:bg-white/5 transition-all font-black uppercase tracking-widest">
                <option value="">All Streams</option>
                <option value="baru">New Packet</option>
                <option value="diproses">Processing</option>
                <option value="dikirim">In Transit</option>
                <option value="selesai">Synchronized</option>
                <option value="batal">Aborted</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Live Data Stream -->
        <div class="flex-1 w-full bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/2 border-b border-white/5">
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Transaction ID</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Source Entity</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Valuation</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Workflow Phase</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] text-right">Ops</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/2">
                        @forelse($daftar_pesanan as $pesanan)
                            <tr class="hover:bg-emerald-600/5 transition-all group cursor-pointer {{ $pesanan_dipilih && $pesanan_dipilih->id == $pesanan->id ? 'bg-emerald-600/10 border-l-4 border-emerald-500' : '' }}" wire:click="lihatDetail({{ $pesanan->id }})">
                                <td class="px-10 py-8">
                                    <div class="flex flex-col gap-2">
                                        <span class="font-mono text-xs font-black text-emerald-400 bg-emerald-500/10 px-3 py-1.5 rounded-lg w-fit">#{{ $pesanan->nomor_invoice }}</span>
                                        <p class="text-[9px] text-gray-600 font-mono italic uppercase">{{ $pesanan->created_at->format('Y.m.d // H:i') }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-gray-800 to-black border border-white/10 flex items-center justify-center text-white font-black text-xs shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($pesanan->pelanggan->nama ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-white tracking-wide">{{ $pesanan->pelanggan->nama ?? 'Anonymous Node' }}</p>
                                            <p class="text-[10px] text-gray-500 font-mono tracking-tighter">{{ $pesanan->pelanggan->surel ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-sm font-black text-white">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                    @php
                                        $warnaBayar = [
                                            'pending' => 'text-orange-500',
                                            'lunas' => 'text-emerald-500',
                                            'gagal' => 'text-red-500'
                                        ][$pesanan->status_pembayaran] ?? 'text-gray-500';
                                    @endphp
                                    <p class="text-[9px] font-black uppercase mt-1 {{ $warnaBayar }} tracking-widest">{{ $pesanan->status_pembayaran }}</p>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $warnaStatus = [
                                            'baru' => 'border-blue-500/50 text-blue-400 bg-blue-500/10',
                                            'diproses' => 'border-orange-500/50 text-orange-400 bg-orange-500/10',
                                            'dikirim' => 'border-purple-500/50 text-purple-400 bg-purple-500/10',
                                            'selesai' => 'border-emerald-500/50 text-emerald-400 bg-emerald-500/10',
                                            'batal' => 'border-red-500/50 text-red-400 bg-red-500/10'
                                        ][$pesanan->status_pesanan] ?? 'border-gray-500 text-gray-500';
                                    @endphp
                                    <div class="flex items-center gap-3">
                                        <span class="px-4 py-2 rounded-xl border text-[9px] font-black uppercase tracking-[0.2em] {{ $warnaStatus }}">
                                            {{ $pesanan->status_pesanan }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-500 group-hover:text-emerald-500 transition-all">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-40 text-center">
                                    <i class="fas fa-radar text-white/5 text-7xl mb-6"></i>
                                    <p class="text-gray-600 font-mono italic tracking-widest">No transaction packets detected in current orbit.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10 border-t border-white/5 bg-white/2">
                {{ $daftar_pesanan->links() }}
            </div>
        </div>

        <!-- Intelligence Data HUD (Sticky) -->
        @if($pesanan_dipilih)
            <div class="w-full xl:w-[500px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-[#0B1120]/90 backdrop-blur-3xl rounded-[3rem] border border-emerald-500/30 shadow-2xl shadow-emerald-900/20 sticky top-28 overflow-hidden">
                    
                    <!-- HUD Header -->
                    <div class="p-10 border-b border-white/5 bg-gradient-to-r from-emerald-600/20 to-transparent flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></span>
                                <h3 class="font-black text-white tracking-tighter text-xl uppercase">DATA ANALYSIS</h3>
                            </div>
                            <p class="text-[9px] text-emerald-400 font-mono tracking-[0.4em]">PACKET ID: {{ $pesanan_dipilih->nomor_invoice }}</p>
                        </div>
                        <button wire:click="tutupDetail" class="w-12 h-12 rounded-2xl hover:bg-white/5 text-gray-500 hover:text-white transition-all border border-white/10">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>

                    <div class="p-10 space-y-10 max-h-[70vh] overflow-y-auto custom-scrollbar">
                        
                        <!-- Control Interface -->
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-black/40 p-6 rounded-3xl border border-white/5">
                                <label class="block text-[9px] font-black text-gray-500 uppercase tracking-widest mb-4">Payment Matrix</label>
                                <select wire:change="updateStatus('pembayaran', $event.target.value)" class="w-full bg-transparent border-none text-emerald-400 font-black text-xs p-0 focus:ring-0 cursor-pointer">
                                    <option value="pending" class="bg-[#0B1120]" {{ $pesanan_dipilih->status_pembayaran == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="lunas" class="bg-[#0B1120]" {{ $pesanan_dipilih->status_pembayaran == 'lunas' ? 'selected' : '' }}>SYNCHRONIZED</option>
                                    <option value="gagal" class="bg-[#0B1120]" {{ $pesanan_dipilih->status_pembayaran == 'gagal' ? 'selected' : '' }}>ABORTED</option>
                                </select>
                            </div>
                            <div class="bg-black/40 p-6 rounded-3xl border border-white/5">
                                <label class="block text-[9px] font-black text-gray-500 uppercase tracking-widest mb-4">Workflow Control</label>
                                <select wire:change="updateStatus('pesanan', $event.target.value)" class="w-full bg-transparent border-none text-blue-400 font-black text-xs p-0 focus:ring-0 cursor-pointer">
                                    @foreach(['baru', 'diproses', 'dikirim', 'selesai', 'batal'] as $st)
                                        <option value="{{ $st }}" class="bg-[#0B1120]" {{ $pesanan_dipilih->status_pesanan == $st ? 'selected' : '' }}>{{ strtoupper($st) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Entity Identification -->
                        <div class="bg-white/2 p-8 rounded-[2rem] border border-white/5 relative overflow-hidden">
                            <div class="absolute right-0 top-0 p-4 opacity-10">
                                <i class="fas fa-id-card-clip text-6xl"></i>
                            </div>
                            <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 flex items-center gap-3">
                                <i class="fas fa-user-gear text-emerald-500"></i> Entity Identification
                            </h4>
                            <div class="space-y-4 font-mono text-xs">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ALIAS:</span>
                                    <span class="text-white font-bold">{{ $pesanan_dipilih->pelanggan->nama }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">COM_PORT:</span>
                                    <span class="text-white font-bold">{{ $pesanan_dipilih->pelanggan->telepon }}</span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-gray-600">GEO_LOCATION:</span>
                                    <span class="text-white font-bold italic leading-relaxed">{{ $pesanan_dipilih->pelanggan->alamat }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Resource Allocation (Items) -->
                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest flex items-center gap-3">
                                <i class="fas fa-microchip text-emerald-500"></i> Resource Allocation
                            </h4>
                            <div class="space-y-4">
                                @foreach($pesanan_dipilih->item as $item)
                                    <div class="flex gap-5 items-center p-4 bg-white/2 rounded-2xl border border-white/5 hover:bg-white/5 transition-all">
                                        <div class="w-12 h-12 rounded-xl bg-black border border-white/10 flex items-center justify-center text-emerald-500 overflow-hidden">
                                            @if($item->produk && $item->produk->gambar_utama)
                                                <img src="{{ asset('storage/'.$item->produk->gambar_utama) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-cube"></i>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-black text-white truncate uppercase tracking-tighter">{{ $item->produk->nama ?? 'DELETED_CORE' }}</p>
                                            <div class="flex justify-between mt-2 font-mono text-[9px]">
                                                <span class="text-gray-500">QNT: {{ $item->kuantitas }}</span>
                                                <span class="text-emerald-400 font-black">VAL: {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Final Valuation -->
                        <div class="pt-10 border-t border-white/10">
                            <div class="flex justify-between items-center bg-emerald-500/10 p-8 rounded-3xl border border-emerald-500/20 shadow-[inset_0_0_30px_rgba(16,185,129,0.05)]">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Total Valuation</span>
                                    <span class="text-[9px] text-gray-600 font-mono mt-1 italic">Taxes Included</span>
                                </div>
                                <span class="text-3xl font-black text-white tracking-tighter shadow-emerald-500/20 drop-shadow-lg">
                                    Rp {{ number_format($pesanan_dipilih->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>