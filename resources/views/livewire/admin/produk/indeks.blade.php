<div wire:poll.10s class="space-y-8">
    
    <!-- Intelligence Command Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-6 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-inner border border-blue-100">
                <i class="fas fa-boxes-stacked text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase italic">Inventory Assets</h2>
                <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em]">Logistics & Control Center</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80 group">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning resource ID..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-3 px-5 pl-12 text-sm text-slate-900 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400 font-bold">
                <i class="fas fa-search absolute left-4 top-3.5 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
            </div>
            <select wire:model.live="filter_kategori" class="bg-slate-50 border border-slate-200 rounded-2xl py-3 px-5 text-sm text-slate-600 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none cursor-pointer font-bold transition-all">
                <option value="">All Sectors</option>
                @foreach($daftar_kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
            <button wire:click="tampilkanFormTambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-2xl shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                <i class="fas fa-plus-circle"></i>
                <span class="text-xs uppercase tracking-[0.1em]">Deploy Resource</span>
            </button>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-10">
        
        <!-- Main Data Console -->
        <div class="flex-1 space-y-6">
            <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Resource Name</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Core Class</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Valuation</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Stock Status</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Admin Ops</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($daftar_produk as $produk)
                                <tr class="hover:bg-slate-50/80 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 bg-slate-100 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden relative shadow-inner">
                                                @if($produk->gambar_utama)
                                                    <img src="{{ asset('storage/'.$produk->gambar_utama) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                @else
                                                    <i class="fas fa-microchip text-xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-900 tracking-tight group-hover:text-blue-600 transition-colors uppercase italic">{{ $produk->nama }}</p>
                                                <p class="text-[9px] font-mono text-slate-400 mt-1 font-bold uppercase tracking-tighter">NODE_UID: {{ $produk->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-4 py-1.5 rounded-full bg-purple-50 border border-purple-100 text-purple-600 text-[9px] font-black uppercase tracking-widest shadow-sm">
                                            {{ $produk->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-black text-slate-900 tracking-tight">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                        <p class="text-[9px] text-slate-400 font-black mt-1 uppercase tracking-widest italic">Unit Price</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex justify-between items-center w-32">
                                                <span class="text-[10px] font-black {{ $produk->jumlah_stok <= 5 ? 'text-rose-600' : 'text-emerald-600' }}">{{ $produk->jumlah_stok }} UNITS</span>
                                                <span class="text-[9px] text-slate-400 font-mono font-bold">{{ round(($produk->jumlah_stok / 100) * 100) }}%</span>
                                            </div>
                                            <div class="w-32 h-1.5 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                                                <div class="h-full {{ $produk->jumlah_stok <= 5 ? 'bg-rose-500' : 'bg-emerald-500' }} shadow-[0_0_8px] {{ $produk->jumlah_stok <= 5 ? 'shadow-rose-500/50' : 'shadow-emerald-500/50' }} transition-all duration-1000" style="width: {{ min($produk->jumlah_stok, 100) }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-4 group-hover:translate-x-0">
                                            <button wire:click="edit({{ $produk->id }})" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-pen-nib text-xs"></i>
                                            </button>
                                            <button wire:click="hapus({{ $produk->id }})" wire:confirm="Initiate resource termination protocol?" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-32 text-center bg-slate-50/30">
                                        <i class="fas fa-satellite-dish text-slate-200 text-7xl mb-6"></i>
                                        <p class="text-slate-400 font-black uppercase tracking-[0.3em] italic">No active data packets detected in grid.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-10 border-t border-slate-100 bg-slate-50/50">
                    {{ $daftar_produk->links() }}
                </div>
            </div>
        </div>

        <!-- Registry Control Unit (Sticky) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full xl:w-[480px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-2xl sticky top-28 overflow-hidden border-t-8 border-t-blue-600">
                    <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-slate-900 tracking-tight uppercase italic text-lg">
                                {{ $apakah_menambah ? 'New Data Pipeline' : 'Reprogram Resource' }}
                            </h3>
                            <p class="text-[9px] text-blue-600 font-black tracking-[0.4em] mt-1 uppercase">Node Protocol v4.0</p>
                        </div>
                        <button wire:click="batal" class="w-12 h-12 rounded-2xl hover:bg-slate-100 text-slate-400 hover:text-slate-900 transition-all border border-slate-200 shadow-sm flex items-center justify-center">
                            <i class="fas fa-xmark text-xl"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-10 space-y-8 max-h-[70vh] overflow-y-auto custom-scrollbar">
                        <div class="space-y-8">
                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Resource Identity</label>
                                <input wire:model="nama" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300" placeholder="Product Alias">
                                @error('nama') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Primary Signal</label>
                                    <div class="relative group h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] flex items-center justify-center overflow-hidden hover:border-blue-500/50 transition-all shadow-inner">
                                        @if ($gambar_utama)
                                            <img src="{{ $gambar_utama->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="text-center group-hover:scale-110 transition-transform">
                                                <i class="fas fa-cloud-arrow-up text-slate-300 text-2xl mb-2"></i>
                                                <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Upload Visual</p>
                                            </div>
                                        @endif
                                        <input type="file" wire:model="gambar_utama" class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Satellite Gallery</label>
                                    <div class="relative group h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] flex items-center justify-center overflow-hidden hover:border-purple-500/50 transition-all shadow-inner">
                                        <div class="text-center group-hover:scale-110 transition-transform">
                                            <i class="fas fa-images text-slate-300 text-2xl mb-2"></i>
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">{{ count($galeri_baru) }} Selected</p>
                                        </div>
                                        <input type="file" wire:model="galeri_baru" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Sector</label>
                                    <select wire:model="kategori_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                        <option value="">Select Zone</option>
                                        @foreach($daftar_kategori as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Credits (IDR)</label>
                                    <input wire:model="harga" type="number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Initial Allocation</label>
                                <div class="relative group">
                                    <input wire:model="stok_awal" type="number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-16 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                    <i class="fas fa-boxes-packing absolute left-6 top-4.5 text-blue-500 group-focus-within:animate-bounce"></i>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Resource Matrix Specs</label>
                                <textarea wire:model="deskripsi" rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-[2rem] py-6 px-8 text-sm text-slate-600 font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all leading-relaxed" placeholder="Documentation..."></textarea>
                            </div>

                            <div class="flex items-center gap-10 p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" wire:model="apakah_aktif" class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500/20 shadow-sm transition-all">
                                    <span class="text-[10px] font-black text-slate-500 group-hover:text-blue-600 uppercase tracking-[0.1em]">Active Node</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" wire:model="apakah_unggulan" class="w-5 h-5 rounded-lg border-slate-300 text-purple-600 focus:ring-purple-500/20 shadow-sm transition-all">
                                    <span class="text-[10px] font-black text-slate-500 group-hover:text-purple-600 uppercase tracking-[0.1em]">Priority Entity</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-6 flex gap-4">
                            <button type="button" wire:click="batal" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all shadow-sm">
                                Abort
                            </button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 border-t border-white/20">
                                Synchronize Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
