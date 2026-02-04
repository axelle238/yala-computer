<div class="space-y-10">
    
    <!-- Header Command Center -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-purple-50 rounded-[1.5rem] flex items-center justify-center text-purple-600 shadow-inner border border-purple-100">
                <i class="fas fa-tags text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Sector Classification</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-purple-500 shadow-[0_0_10px_#a855f7]"></span>
                    <p class="text-[10px] text-purple-600 font-black uppercase tracking-[0.3em]">Mapping Nodes: Active</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80 group">
                <input wire:model.live="cari" type="text" placeholder="Scanning sector names..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 outline-none transition-all placeholder-slate-400 font-bold">
                <i class="fas fa-microscope absolute left-6 top-4.5 text-slate-400 group-focus-within:text-purple-500 transition-colors"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-10 items-start">
        
        <!-- Data Stream Grid -->
        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($daftar_kategori as $kategori)
                <div class="bg-white rounded-[2.5rem] border border-slate-200/60 p-8 shadow-lg hover:shadow-2xl transition-all group relative overflow-hidden {{ $id_kategori_diedit == $kategori->id ? 'ring-4 ring-purple-500/20 border-purple-500' : '' }}">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex items-start justify-between mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 text-2xl group-hover:bg-purple-600 group-hover:text-white transition-all shadow-sm">
                                <i class="{{ $kategori->ikon }}"></i>
                            </div>
                            <div class="text-right">
                                <span class="px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[9px] font-black text-slate-400 uppercase tracking-widest">Sector Node</span>
                                <p class="text-[9px] font-mono text-slate-400 mt-2 italic uppercase font-bold">UID: {{ $kategori->slug }}</p>
                            </div>
                        </div>

                        <div class="flex-1 space-y-2">
                            <h3 class="text-xl font-black text-slate-900 tracking-tight group-hover:text-purple-600 transition-colors uppercase italic">{{ $kategori->nama }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed line-clamp-2 font-medium italic">"{{ $kategori->deskripsi ?? 'No metadata provided for this node.' }}"</p>
                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></div>
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $kategori->produk_count }} ACTIVE ASSETS</span>
                            </div>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                <button wire:click="edit({{ $kategori->id }})" class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-100 hover:bg-purple-600 hover:text-white transition-all">
                                    <i class="fas fa-bolt-lightning text-xs"></i>
                                </button>
                                <button 
                                    wire:click="hapus({{ $kategori->id }})"
                                    wire:confirm="Initiate sector termination? Linked resources may be disconnected."
                                    class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all"
                                >
                                    <i class="fas fa-power-off text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-[3rem] border border-slate-200/60 p-20 text-center shadow-sm">
                    <i class="fas fa-atom text-slate-100 text-7xl mb-6 animate-spin-slow"></i>
                    <p class="text-slate-400 font-black uppercase tracking-[0.2em] italic">No classification nodes detected.</p>
                </div>
            @endforelse
            <div class="col-span-full pt-10">
                {{ $daftar_kategori->links() }}
            </div>
        </div>

        <!-- Registry Unit (Sticky) -->
        <div class="w-full lg:w-[450px] flex-shrink-0 animate-fade-in-right">
            <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-2xl sticky top-28 overflow-hidden border-t-8 border-t-purple-600">
                <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-900 tracking-tighter text-lg uppercase italic">
                            {{ $mode == 'tambah' ? 'Register New Node' : 'Reprogram Node' }}
                        </h3>
                        <p class="text-[9px] text-purple-600 font-black tracking-[0.4em] mt-1 uppercase text-xs">Node Protocol v2.1</p>
                    </div>
                    @if($mode == 'edit')
                        <button wire:click="resetForm" class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center">
                            <i class="fas fa-xmark"></i>
                        </button>
                    @endif
                </div>
                
                <form wire:submit="simpan" class="p-10 space-y-10">
                    <div class="space-y-8">
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-2">Node Designation</label>
                            <input wire:model="nama" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all placeholder-slate-300" placeholder="Enter Sector Name">
                            @error('nama') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                        </div>

                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-2">Glyph Identification</label>
                            <div class="relative">
                                <input wire:model="ikon" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-16 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all" placeholder="fas fa-microchip">
                                <div class="absolute left-6 top-3.5 w-8 h-8 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 shadow-sm group-hover:scale-110 transition-transform">
                                    @if($ikon) <i class="{{ $ikon }}"></i> @else <i class="fas fa-atom"></i> @endif
                                </div>
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2 font-mono italic font-bold">Requires FontAwesome 6 glyph protocol.</p>
                        </div>

                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-2">Sector Metadata</label>
                            <textarea wire:model="deskripsi" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-600 font-medium focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all" placeholder="Documentation..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-black py-5 rounded-[1.5rem] text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-purple-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4 border-t border-white/20">
                        <i class="fas fa-fingerprint text-lg"></i>
                        <span>{{ $mode == 'tambah' ? 'EXECUTE REGISTRATION' : 'REPROGRAM NODE' }}</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>