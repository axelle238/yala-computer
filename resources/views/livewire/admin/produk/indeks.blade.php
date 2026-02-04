<div wire:poll.10s class="space-y-8">
    
    <!-- Top Action Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#1E293B]/80 backdrop-blur-xl p-6 rounded-[2rem] border border-white/5 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-14 h-14 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-400 shadow-inner">
                <i class="fas fa-boxes-stacked text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-white tracking-tight">MANAJEMEN INVENTORI</h2>
                <p class="text-[10px] text-blue-400 font-bold uppercase tracking-[0.2em]">Logistik & Kendali Stok Real-time</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80">
                <input wire:model.live.debounce.300ms="cari" type="text" placeholder="Scanning database produk..." class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-3 px-5 pl-12 text-sm text-slate-300 focus:ring-2 focus:ring-blue-500/50 outline-none transition-all placeholder-slate-600">
                <i class="fas fa-barcode absolute left-4 top-3.5 text-slate-500"></i>
            </div>
            <select wire:model.live="filter_kategori" class="bg-[#0F172A] border border-white/10 rounded-2xl py-3 px-5 text-sm text-slate-400 focus:ring-2 focus:ring-blue-500/50 outline-none cursor-pointer">
                <option value="">Filter Kategori</option>
                @foreach($daftar_kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
            <button wire:click="tampilkanFormTambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3 px-8 rounded-2xl shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                <i class="fas fa-plus-circle"></i>
                <span class="text-xs uppercase tracking-widest">Registrasi Produk</span>
            </button>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-10">
        
        <!-- Main Data Terminal -->
        <div class="flex-1 space-y-6">
            <div class="bg-[#1E293B]/60 backdrop-blur-xl rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/2 border-b border-white/5">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Resource Name</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Core Class</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Valuation</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Inventory Status</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($daftar_produk as $produk)
                                <tr class="hover:bg-blue-600/5 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 bg-white/5 rounded-2xl border border-white/10 flex items-center justify-center text-slate-500 overflow-hidden relative">
                                                @if($produk->gambar_utama)
                                                    <img src="{{ asset('storage/'.$produk->gambar_utama) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                                @else
                                                    <i class="fas fa-microchip text-xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-white tracking-wide group-hover:text-blue-400 transition-colors">{{ $produk->nama }}</p>
                                                <p class="text-[9px] font-mono text-slate-500 mt-1 uppercase tracking-tighter">UUID: {{ $produk->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-4 py-1.5 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[9px] font-black uppercase tracking-widest">
                                            {{ $produk->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-black text-white">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                        <p class="text-[9px] text-slate-500 font-bold mt-1 uppercase">Price Point</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex justify-between items-center w-32">
                                                <span class="text-[10px] font-black {{ $produk->jumlah_stok <= 5 ? 'text-red-400' : 'text-emerald-400' }}">{{ $produk->jumlah_stok }} UNITS</span>
                                                <span class="text-[9px] text-slate-500 font-mono">{{ round(($produk->jumlah_stok / 100) * 100) }}%</span>
                                            </div>
                                            <div class="w-32 h-1.5 bg-white/5 rounded-full overflow-hidden">
                                                <div class="h-full {{ $produk->jumlah_stok <= 5 ? 'bg-red-500' : 'bg-emerald-500' }} shadow-[0_0_10px]" style="width: {{ min($produk->jumlah_stok, 100) }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center justify-center gap-3">
                                            <button wire:click="edit({{ $produk->id }})" class="w-10 h-10 rounded-xl bg-orange-500/10 text-orange-500 border border-orange-500/20 hover:bg-orange-500 hover:text-white transition-all">
                                                <i class="fas fa-bolt-lightning text-xs"></i>
                                            </button>
                                            <button wire:click="hapus({{ $produk->id }})" wire:confirm="Initiate resource deletion protocol?" class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all">
                                                <i class="fas fa-power-off text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-32 text-center">
                                        <i class="fas fa-satellite-dish text-white/5 text-6xl mb-6"></i>
                                        <p class="text-slate-500 font-mono italic">No data packets detected in inventory stream.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-8 border-t border-white/5 bg-white/2">
                    {{ $daftar_produk->links() }}
                </div>
            </div>
        </div>

        <!-- System Control Panel (Sticky) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full xl:w-[450px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-[#1E293B]/90 backdrop-blur-3xl rounded-[3rem] border border-blue-500/30 shadow-2xl shadow-blue-900/20 sticky top-28 overflow-hidden">
                    <div class="p-8 border-b border-white/5 bg-gradient-to-r from-blue-600/10 to-transparent flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-white tracking-tight uppercase">
                                {{ $apakah_menambah ? 'Data Input Protocol' : 'Update Resource Parameters' }}
                            </h3>
                            <p class="text-[9px] text-blue-400 font-bold tracking-[0.3em] mt-1">CORE COMMAND v4.0</p>
                        </div>
                        <button wire:click="batal" class="w-10 h-10 rounded-full hover:bg-white/5 text-slate-500 hover:text-white transition-all">
                            <i class="fas fa-circle-xmark"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-10 space-y-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Resource Identity</label>
                                <input wire:model="nama" type="text" class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none placeholder-slate-600" placeholder="Enter Product Name">
                                @error('nama') <span class="text-red-400 text-[9px] font-black mt-2 block tracking-widest uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Primary Signal</label>
                                    <div class="relative group h-24 bg-[#0F172A] border border-dashed border-white/10 rounded-2xl flex items-center justify-center overflow-hidden hover:border-blue-500/50 transition-colors">
                                        @if ($gambar_utama)
                                            <img src="{{ $gambar_utama->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-cloud-arrow-up text-slate-600 text-xl group-hover:text-blue-500 transition-colors"></i>
                                        @endif
                                        <input type="file" wire:model="gambar_utama" class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Satellite Gallery</label>
                                    <div class="relative group h-24 bg-[#0F172A] border border-dashed border-white/10 rounded-2xl flex items-center justify-center overflow-hidden hover:border-purple-500/50 transition-colors">
                                        <div class="flex flex-col items-center gap-1">
                                            <i class="fas fa-images text-slate-600 text-xl group-hover:text-purple-500 transition-colors"></i>
                                            <span class="text-[8px] text-slate-500 font-black uppercase">{{ count($galeri_baru) }} Nodes</span>
                                        </div>
                                        <input type="file" wire:model="galeri_baru" multiple class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Classification</label>
                                    <select wire:model="kategori_id" class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 text-sm text-slate-300 focus:ring-2 focus:ring-blue-500/50 outline-none">
                                        <option value="">Select Sector</option>
                                        @foreach($daftar_kategori as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Credits (IDR)</label>
                                    <input wire:model="harga" type="number" class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Inventory Allocation</label>
                                <div class="relative">
                                    <input wire:model="stok_awal" type="number" class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none pl-14">
                                    <i class="fas fa-warehouse absolute left-6 top-4.5 text-blue-500"></i>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Resource Specs</label>
                                <textarea wire:model="deskripsi" rows="5" class="w-full bg-[#0F172A] border border-white/10 rounded-2xl py-4 px-6 text-sm text-slate-300 focus:ring-2 focus:ring-blue-500/50 outline-none" placeholder="Provide technical documentation..."></textarea>
                            </div>

                            <div class="flex items-center gap-10 pt-4">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" wire:model="apakah_aktif" class="w-5 h-5 rounded-lg border-white/10 bg-[#0F172A] text-blue-600 focus:ring-blue-500/50">
                                    <span class="text-[10px] font-black text-slate-500 group-hover:text-blue-400 uppercase tracking-widest">Active Node</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" wire:model="apakah_unggulan" class="w-5 h-5 rounded-lg border-white/10 bg-[#0F172A] text-orange-600 focus:ring-orange-500/50">
                                    <span class="text-[10px] font-black text-slate-500 group-hover:text-orange-400 uppercase tracking-widest">Priority Entity</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-10 flex gap-4">
                            <button type="button" wire:click="batal" class="flex-1 bg-white/5 hover:bg-white/10 text-slate-400 font-black py-4 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] transition-all border border-white/5">
                                Abort
                            </button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 transition-all transform hover:-translate-y-1 active:scale-95">
                                Execute Operation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>