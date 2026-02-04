<div class="space-y-10">
    
    <!-- Header Command Center -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#0B1120]/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-purple-600/10 rounded-[1.5rem] flex items-center justify-center text-purple-500 shadow-[inset_0_0_20px_rgba(168,85,247,0.1)]">
                <i class="fas fa-tags text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">SECTOR CLASSIFICATION</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-purple-500 shadow-[0_0_10px_#a855f7]"></span>
                    <p class="text-[10px] text-purple-400 font-black uppercase tracking-[0.3em]">Mapping Nodes: Active</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-80 group">
                <input wire:model.live="cari" type="text" placeholder="Scanning sector names..." class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-purple-500/50 outline-none transition-all group-hover:border-white/20">
                <i class="fas fa-microscope absolute left-6 top-4.5 text-gray-500 group-hover:text-purple-500 transition-colors"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-10 items-start">
        
        <!-- Data Stream Grid -->
        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($daftar_kategori as $kategori)
                <div class="bg-[#0B1120]/50 backdrop-blur-xl rounded-[2rem] border border-white/5 p-8 shadow-xl hover:border-purple-500/30 transition-all group relative overflow-hidden {{ $id_kategori_diedit == $kategori->id ? 'border-purple-500 bg-purple-500/5 shadow-[0_0_30px_rgba(168,85,247,0.1)]' : '' }}">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-600/5 rounded-full blur-3xl group-hover:bg-purple-600/10 transition-all"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex items-start justify-between mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-500 text-2xl group-hover:scale-110 transition-all shadow-lg">
                                <i class="{{ $kategori->ikon }}"></i>
                            </div>
                            <div class="text-right">
                                <span class="px-4 py-1.5 rounded-full bg-black/40 border border-white/10 text-[9px] font-black text-gray-400 uppercase tracking-widest">Sector Node</span>
                                <p class="text-[9px] font-mono text-gray-600 mt-2 italic uppercase">UID: {{ $kategori->slug }}</p>
                            </div>
                        </div>

                        <div class="flex-1 space-y-2">
                            <h3 class="text-xl font-black text-white tracking-tight group-hover:text-purple-400 transition-colors uppercase italic">{{ $kategori->nama }}</h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 italic opacity-80">"{{ $kategori->deskripsi ?? 'No metadata provided for this sector node.' }}"</p>
                        </div>

                        <div class="mt-10 pt-6 border-t border-white/5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></div>
                                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ $kategori->produk_count }} ACTIVE RESOURCES</span>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="edit({{ $kategori->id }})" class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-500 border border-purple-500/20 hover:bg-purple-500 hover:text-white transition-all">
                                    <i class="fas fa-bolt-lightning text-xs"></i>
                                </button>
                                <button 
                                    wire:click="hapus({{ $kategori->id }})"
                                    wire:confirm="Initiate sector termination? Linked resources may be disconnected."
                                    class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all"
                                >
                                    <i class="fas fa-power-off text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 p-20 text-center">
                    <i class="fas fa-atom text-white/5 text-7xl mb-6 animate-spin-slow"></i>
                    <p class="text-gray-600 font-mono italic tracking-[0.2em]">No classification nodes detected in the current sector.</p>
                </div>
            @endforelse
            <div class="col-span-full pt-10">
                {{ $daftar_kategori->links() }}
            </div>
        </div>

        <!-- Registry Control Panel (Sticky) -->
        <div class="w-full lg:w-[450px] flex-shrink-0 animate-fade-in-right">
            <div class="bg-[#0B1120]/80 backdrop-blur-3xl rounded-[3rem] border border-purple-500/30 shadow-2xl shadow-purple-900/20 sticky top-28 overflow-hidden">
                <div class="p-10 border-b border-white/5 bg-gradient-to-r from-purple-600/20 to-transparent flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-white tracking-tighter text-lg uppercase italic">
                            {{ $mode == 'tambah' ? 'Register New Node' : 'Overwrite Node Data' }}
                        </h3>
                        <p class="text-[9px] text-purple-400 font-black tracking-[0.4em] mt-1 uppercase">Node Protocol v2.1</p>
                    </div>
                    @if($mode == 'edit')
                        <button wire:click="resetForm" class="w-10 h-10 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all">
                            <i class="fas fa-xmark"></i>
                        </button>
                    @endif
                </div>
                
                <form wire:submit="simpan" class="p-10 space-y-10">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Node Designation</label>
                            <input wire:model="nama" type="text" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-purple-500/50 outline-none transition-all" placeholder="Enter Sector Name">
                            @error('nama') <span class="text-red-500 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Vivid Icon Identification</label>
                            <div class="relative group">
                                <input wire:model="ikon" type="text" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 pl-16 text-sm text-white focus:ring-2 focus:ring-purple-500/50 outline-none transition-all" placeholder="fas fa-microchip">
                                <div class="absolute left-6 top-3.5 w-8 h-8 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-500 shadow-lg group-hover:scale-110 transition-transform">
                                    @if($ikon) <i class="{{ $ikon }}"></i> @else <i class="fas fa-atom"></i> @endif
                                </div>
                            </div>
                            <p class="text-[9px] text-gray-600 mt-2 font-mono italic tracking-tight">System requires FontAwesome 6 glyph identification code.</p>
                            @error('ikon') <span class="text-red-500 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Sector Metadata</label>
                            <textarea wire:model="deskripsi" rows="4" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-gray-400 focus:ring-2 focus:ring-purple-500/50 outline-none transition-all" placeholder="Describe the purpose of this data node..."></textarea>
                            @error('deskripsi') <span class="text-red-500 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-black py-5 rounded-[1.5rem] text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-purple-900/30 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4">
                        <i class="fas fa-fingerprint text-lg"></i>
                        <span>{{ $mode == 'tambah' ? 'EXECUTE REGISTRATION' : 'REPROGRAM NODE' }}</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>