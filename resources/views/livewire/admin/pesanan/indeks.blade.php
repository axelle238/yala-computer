<div wire:poll.10s class="space-y-10">
    
    <!-- Top Transaction Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-emerald-50 rounded-[1.5rem] flex items-center justify-center text-emerald-600 shadow-inner border border-emerald-100">
                <i class="fas fa-cash-register text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Transaction Terminal</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                    <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.3em]">Processing Node: Active</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-96 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning invoice packets..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all placeholder-slate-400">
                <i class="fas fa-search-dollar absolute left-6 top-4.5 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
            </div>
            <select wire:model.live="status_filter" class="bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-black text-slate-600 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none cursor-pointer hover:bg-slate-100 transition-all uppercase tracking-widest">
                <option value="">All Cycles</option>
                <option value="baru">New Inbound</option>
                <option value="diproses">Processing</option>
                <option value="dikirim">Dispatched</option>
                <option value="selesai">Synchronized</option>
                <option value="batal">Aborted</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Live Data Stream -->
        <div class="flex-1 w-full bg-white rounded-[3rem] border border-slate-200/60 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Transaction ID</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Source Entity</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Valuation</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Matrix Status</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($daftar_pesanan as $pesanan)
                            <tr class="hover:bg-slate-50 transition-all group cursor-pointer {{ $pesanan_dipilih && $pesanan_dipilih->id == $pesanan->id ? 'bg-blue-50/50 border-l-4 border-blue-500' : '' }}" wire:click="lihatDetail({{ $pesanan->id }})">
                                <td class="px-10 py-8">
                                    <div class="flex flex-col gap-2">
                                        <span class="font-mono text-xs font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg w-fit border border-blue-100 uppercase">#{{ $pesanan->nomor_invoice }}</span>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">{{ $pesanan->created_at->format('d.M.Y // H:i') }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-black text-xs shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all">
                                            {{ substr($pesanan->pelanggan->nama ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900 tracking-tight">{{ $pesanan->pelanggan->nama ?? 'Anonymous Entity' }}</p>
                                            <p class="text-[10px] text-slate-400 font-medium italic tracking-tighter">{{ $pesanan->pelanggan->surel ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-sm font-black text-slate-900">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                    @php
                                        $warnaBayar = [
                                            'pending' => 'text-orange-600 bg-orange-50 border-orange-100',
                                            'lunas' => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                            'gagal' => 'text-rose-600 bg-rose-50 border-rose-100'
                                        ][$pesanan->status_pembayaran] ?? 'text-slate-500 bg-slate-50 border-slate-100';
                                    @endphp
                                    <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase border mt-1 inline-block tracking-tighter {{ $warnaBayar }}">{{ $pesanan->status_pembayaran }}</span>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $warnaStatus = [
                                            'baru' => 'border-blue-200 text-blue-600 bg-blue-50',
                                            'diproses' => 'border-orange-200 text-orange-600 bg-orange-50',
                                            'dikirim' => 'border-purple-200 text-purple-600 bg-purple-50',
                                            'selesai' => 'border-emerald-200 text-emerald-600 bg-emerald-50',
                                            'batal' => 'border-rose-200 text-rose-600 bg-rose-50'
                                        ][$pesanan->status_pesanan] ?? 'border-slate-200 text-slate-500 bg-slate-50';
                                    @endphp
                                    <span class="px-4 py-2 rounded-xl border text-[9px] font-black uppercase tracking-[0.2em] shadow-sm {{ $warnaStatus }}">
                                        {{ $pesanan->status_pesanan }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300 group-hover:text-blue-600 group-hover:border-blue-200 transition-all shadow-sm">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-40 text-center bg-slate-50/20">
                                    <i class="fas fa-radar text-slate-100 text-7xl mb-6"></i>
                                    <p class="text-slate-400 font-black uppercase tracking-[0.3em] italic">No transaction streams detected.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10 border-t border-slate-100 bg-slate-50/50">
                {{ $daftar_pesanan->links() }}
            </div>
        </div>

        <!-- Detail HUD (Sticky) -->
        @if($pesanan_dipilih)
            <div class="w-full xl:w-[500px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-2xl sticky top-28 overflow-hidden border-t-8 border-t-emerald-500">
                    
                    <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></span>
                                <h3 class="font-black text-slate-900 tracking-tighter text-xl uppercase italic">Data Analysis</h3>
                            </div>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.4em]">Packet: {{ $pesanan_dipilih->nomor_invoice }}</p>
                        </div>
                        <button wire:click="tutupDetail" class="w-12 h-12 rounded-2xl bg-white hover:bg-slate-50 text-slate-400 hover:text-slate-900 transition-all border border-slate-200 shadow-sm flex items-center justify-center">
                            <i class="fas fa-xmark text-xl"></i>
                        </button>
                    </div>

                    <div class="p-10 space-y-10 max-h-[70vh] overflow-y-auto custom-scrollbar">
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 shadow-sm">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Payment Matrix</label>
                                <select wire:change="updateStatus('pembayaran', $event.target.value)" class="w-full bg-transparent border-none text-emerald-600 font-black text-xs p-0 focus:ring-0 cursor-pointer">
                                    <option value="pending" {{ $pesanan_dipilih->status_pembayaran == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="lunas" {{ $pesanan_dipilih->status_pembayaran == 'lunas' ? 'selected' : '' }}>SYNCHRONIZED</option>
                                    <option value="gagal" {{ $pesanan_dipilih->status_pembayaran == 'gagal' ? 'selected' : '' }}>ABORTED</option>
                                </select>
                            </div>
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 shadow-sm">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Flow Control</label>
                                <select wire:change="updateStatus('pesanan', $event.target.value)" class="w-full bg-transparent border-none text-blue-600 font-black text-xs p-0 focus:ring-0 cursor-pointer">
                                    @foreach(['baru', 'diproses', 'dikirim', 'selesai', 'batal'] as $st)
                                        <option value="{{ $st }}" {{ $pesanan_dipilih->status_pesanan == $st ? 'selected' : '' }}>{{ strtoupper($st) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-inner relative overflow-hidden">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-3">
                                <i class="fas fa-id-card-clip text-emerald-500"></i> Entity Credentials
                            </h4>
                            <div class="space-y-4 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-400 font-bold uppercase tracking-tighter">Identity:</span>
                                    <span class="text-slate-900 font-black uppercase">{{ $pesanan_dipilih->pelanggan->nama }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400 font-bold uppercase tracking-tighter">COM_PORT:</span>
                                    <span class="text-slate-900 font-black">{{ $pesanan_dipilih->pelanggan->telepon }}</span>
                                </div>
                                <div class="pt-2">
                                    <span class="text-slate-400 font-bold uppercase tracking-tighter block mb-2">Location Node:</span>
                                    <span class="text-slate-600 font-medium italic leading-relaxed block bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $pesanan_dipilih->pelanggan->alamat }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-3">
                                <i class="fas fa-microchip text-emerald-500"></i> Allocated Resources
                            </h4>
                            <div class="space-y-4">
                                @foreach($pesanan_dipilih->item as $item)
                                    <div class="flex gap-5 items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-white hover:shadow-md transition-all">
                                        <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-600 overflow-hidden shadow-sm">
                                            @if($item->produk && $item->produk->gambar_utama)
                                                <img src="{{ asset('storage/'.$item->produk->gambar_utama) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-cube"></i>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-black text-slate-900 truncate uppercase tracking-tighter">{{ $item->produk->nama ?? 'DELETED_CORE' }}</p>
                                            <div class="flex justify-between mt-2 text-[9px] font-bold">
                                                <span class="text-slate-400">QNT: {{ $item->kuantitas }}</span>
                                                <span class="text-emerald-600 font-black">VAL: Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-10 border-t border-slate-100">
                            <div class="flex justify-between items-center bg-blue-600 p-8 rounded-[2rem] text-white shadow-xl shadow-blue-200 transition-all group hover:scale-[1.02]">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black uppercase tracking-widest opacity-80">Final Valuation</span>
                                    <span class="text-[9px] font-bold opacity-60 mt-1 italic uppercase">Protocol Validated</span>
                                </div>
                                <span class="text-3xl font-black tracking-tighter">
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