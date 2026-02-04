<div class="space-y-10">
    
    <!-- Top Command Hub -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl relative overflow-hidden">
        <div class="absolute right-0 top-0 p-10 opacity-5">
            <i class="fas fa-warehouse text-9xl text-slate-900"></i>
        </div>
        
        <div class="flex items-center gap-6 w-full lg:w-auto relative z-10">
            <div class="w-16 h-16 bg-blue-50 rounded-[1.5rem] flex items-center justify-center text-blue-600 shadow-inner border border-blue-100">
                <i class="fas fa-boxes-stacked text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Stock Intelligence</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                    <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.3em]">Logistics Terminal: Online</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 relative z-10">
            <div class="px-6 py-3 bg-slate-50 border border-slate-200 rounded-2xl flex flex-col items-end">
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Global Stock Value</span>
                <span class="text-xl font-black text-slate-900 font-mono tracking-tighter">
                    {{ number_format(\App\Models\Stok::sum('jumlah')) }} <span class="text-[10px] text-blue-600">UNITS</span>
                </span>
            </div>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Action Deck: Product Scanner -->
        <div class="w-full xl:w-[450px] flex-shrink-0 space-y-8">
            <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-xl overflow-hidden p-10">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                    <i class="fas fa-barcode text-blue-600"></i> 1. Select Resource Node
                </h3>
                
                <div class="relative group mb-8">
                    <input wire:model.live.debounce.300ms="cari_produk" type="text" placeholder="Search product alias..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 italic shadow-inner">
                    <i class="fas fa-search absolute left-6 top-4.5 text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                </div>

                <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($daftar_produk as $prod)
                        <button 
                            wire:click="pilihProduk({{ $prod->id }})"
                            class="w-full flex items-center gap-4 p-4 rounded-2xl border transition-all text-left group {{ $produk_dipilih && $produk_dipilih->id == $prod->id ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-slate-50 border-slate-100 hover:bg-white hover:border-blue-300' }}"
                        >
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs {{ $produk_dipilih && $produk_dipilih->id == $prod->id ? 'bg-white/20 text-white' : 'bg-white text-blue-600 shadow-sm' }}">
                                {{ substr($prod->nama, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-black uppercase truncate tracking-tight">{{ $prod->nama }}</p>
                                <p class="text-[9px] font-bold opacity-60 uppercase">{{ $prod->kategori->nama }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-black font-mono">{{ $prod->jumlah_stok }}</p>
                                <p class="text-[8px] font-bold uppercase opacity-60 tracking-tighter">Stock</p>
                            </div>
                        </button>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $daftar_produk->links() }}
                </div>
            </div>

            <!-- Mutasi Form Panel -->
            @if($produk_dipilih)
                <div class="bg-white rounded-[3rem] border-t-8 border-t-blue-600 border border-slate-200/60 shadow-2xl p-10 animate-fade-in-up">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                        <i class="fas fa-sliders-h text-blue-600"></i> 2. Mutation Execution
                    </h3>

                    <form wire:submit="eksekusiMutasi" class="space-y-8">
                        <div class="flex gap-4 p-2 bg-slate-100 rounded-2xl">
                            <button type="button" wire:click="$set('jenis_aksi', 'masuk')" class="flex-1 py-3 rounded-xl text-[10px] font-black uppercase transition-all {{ $jenis_aksi === 'masuk' ? 'bg-emerald-500 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Stock In</button>
                            <button type="button" wire:click="$set('jenis_aksi', 'keluar')" class="flex-1 py-3 rounded-xl text-[10px] font-black uppercase transition-all {{ $jenis_aksi === 'keluar' ? 'bg-rose-500 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Stock Out</button>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Allocation Count</label>
                            <div class="relative group">
                                <input wire:model="jumlah" type="number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-16 text-sm text-slate-900 font-black focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                <i class="fas fa-calculator absolute left-6 top-4.5 text-blue-500 group-focus-within:animate-bounce"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Mission Metadata (Notes)</label>
                            <textarea wire:model="keterangan" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-600 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all italic" placeholder="Reason for mutation..."></textarea>
                        </div>

                        <div class="pt-4 flex gap-4">
                            <button type="button" wire:click="resetForm" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all">Abort</button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1">Execute Hub</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

        <!-- Ledger View: Inventory Stream -->
        <div class="flex-1 w-full bg-white rounded-[3.5rem] border border-slate-200/60 overflow-hidden shadow-2xl relative">
            <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tighter uppercase italic">Inventory Ledger Stream</h3>
                </div>
                <div class="flex items-center gap-2 text-slate-400 font-mono text-[9px] font-bold">
                    <i class="fas fa-signal-stream"></i> SYNCED_UTC: {{ now()->format('H:i') }}
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Time Index</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Resource Node</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Type</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Delta Matrix</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-widest">Auth Tech</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($riwayat_mutasi as $mutasi)
                            <tr class="hover:bg-slate-50/80 transition-all group">
                                <td class="px-10 py-8">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-xs font-black text-slate-900 font-mono tracking-tighter">{{ $mutasi->waktu->format('H:i:s') }}</p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase">{{ $mutasi->waktu->format('d.M.Y') }}</p>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-sm font-black text-slate-900 tracking-tight italic uppercase">{{ $mutasi->produk->nama ?? 'DELETED_NODE' }}</p>
                                    <p class="text-[9px] text-slate-400 font-medium line-clamp-1 max-w-[200px]">"{{ $mutasi->keterangan }}"</p>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    @php
                                        $style = [
                                            'masuk' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'keluar' => 'bg-rose-50 text-rose-600 border-rose-100',
                                            'penjualan' => 'bg-blue-50 text-blue-600 border-blue-100'
                                        ][$mutasi->jenis] ?? 'bg-slate-50 text-slate-500 border-slate-100';
                                    @endphp
                                    <span class="px-4 py-1.5 rounded-xl border text-[9px] font-black uppercase tracking-widest shadow-sm {{ $style }}">
                                        {{ $mutasi->jenis }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="flex flex-col items-end">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">{{ $mutasi->jumlah_awal }}</span>
                                            <span class="text-xs font-black {{ $mutasi->perubahan > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $mutasi->perubahan > 0 ? '+' : '' }}{{ $mutasi->perubahan }}
                                            </span>
                                        </div>
                                        <i class="fas fa-arrow-right-long text-slate-200"></i>
                                        <span class="text-sm font-black text-slate-900 font-mono tracking-tighter">{{ $mutasi->jumlah_akhir }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center text-white text-[10px] font-black shadow-md">
                                            {{ substr($mutasi->operator->nama ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="text-[9px] font-black text-slate-500 uppercase italic">{{ $mutasi->operator->nama ?? 'AUTO_BOT' }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-40 text-center bg-slate-50/20">
                                    <i class="fas fa-book-medical text-slate-100 text-8xl mb-8"></i>
                                    <p class="text-slate-400 font-black uppercase tracking-[0.3em] italic">No mutation records found in ledger.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10 border-t border-slate-100 bg-slate-50/50">
                {{ $riwayat_mutasi->links() }}
            </div>
        </div>

    </div>
</div>
