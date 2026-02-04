<div class="space-y-10">
    
    <!-- Header Control -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-pink-50 rounded-[1.5rem] flex items-center justify-center text-pink-600 shadow-inner border border-pink-100">
                <i class="fas fa-bullhorn text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Marketing Displays</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-pink-500 shadow-[0_0_8px_#ec4899]"></span>
                    <p class="text-[10px] text-pink-600 font-black uppercase tracking-[0.3em]">Campaign: Active</p>
                </div>
            </div>
        </div>

        <button wire:click="tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-10 rounded-[1.5rem] shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
            <i class="fas fa-plus-circle"></i>
            <span class="text-[10px] uppercase tracking-widest">New Campaign</span>
        </button>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Banner Grid -->
        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($daftar_banner as $banner)
                <div class="bg-white rounded-[2.5rem] border border-slate-200/60 overflow-hidden shadow-lg hover:shadow-2xl transition-all group relative">
                    <div class="relative h-48 bg-slate-100">
                        <img src="{{ asset('storage/'.$banner->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-lg font-black text-white tracking-tight uppercase italic">{{ $banner->judul }}</h3>
                            <p class="text-[10px] text-slate-300 line-clamp-1 mt-1 font-mono">{{ $banner->deskripsi ?? 'No description' }}</p>
                        </div>
                    </div>
                    
                    <div class="p-6 flex items-center justify-between bg-slate-50/50">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $banner->apakah_aktif ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                                {{ $banner->apakah_aktif ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">SEQ: {{ $banner->urutan }}</span>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                            <button wire:click="edit({{ $banner->id }})" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button wire:click="hapus({{ $banner->id }})" class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border border-dashed border-slate-200">
                    <i class="fas fa-panorama text-slate-300 text-6xl mb-4"></i>
                    <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">No active campaigns detected.</p>
                </div>
            @endforelse
        </div>

        <!-- Editor Panel (Sticky) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full xl:w-[450px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-2xl sticky top-28 overflow-hidden border-t-8 border-t-pink-500">
                    <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-slate-900 tracking-tighter text-lg uppercase italic">
                                {{ $apakah_menambah ? 'Deploy Campaign' : 'Edit Campaign' }}
                            </h3>
                            <p class="text-[9px] text-pink-600 font-black tracking-[0.4em] mt-1 uppercase">Visual Module v2.0</p>
                        </div>
                        <button wire:click="batal" class="w-10 h-10 rounded-full hover:bg-slate-100 text-slate-400 hover:text-slate-900 transition-all">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-10 space-y-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Campaign Title</label>
                                <input wire:model="judul" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 outline-none transition-all placeholder-slate-300" placeholder="e.g. Ramadhan Sale">
                                @error('judul') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Visual Asset</label>
                                <div class="relative group h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] flex items-center justify-center overflow-hidden hover:border-pink-500/50 transition-all cursor-pointer">
                                    @if ($gambar)
                                        <img src="{{ $gambar->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-center">
                                            <i class="fas fa-image text-slate-300 text-2xl mb-2 group-hover:text-pink-500 transition-colors"></i>
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Upload (1920x600)</p>
                                        </div>
                                    @endif
                                    <input type="file" wire:model="gambar" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                                @error('gambar') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Target Link</label>
                                    <input wire:model="tautan_tombol" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs text-slate-900 font-bold focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 outline-none transition-all" placeholder="/katalog">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Button Label</label>
                                    <input wire:model="teks_tombol" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs text-slate-900 font-bold focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 outline-none transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Briefing (Description)</label>
                                <textarea wire:model="deskripsi" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs text-slate-600 font-medium focus:ring-4 focus:ring-pink-500/10 focus:border-pink-500 outline-none transition-all resize-none"></textarea>
                            </div>

                            <div class="flex items-center gap-8 pt-2">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" wire:model="apakah_aktif" class="w-5 h-5 rounded-lg border-slate-300 text-emerald-600 focus:ring-emerald-500/20 shadow-sm transition-all">
                                    <span class="text-[10px] font-black text-slate-500 group-hover:text-emerald-600 uppercase tracking-[0.1em]">Active Status</span>
                                </label>
                                <div class="flex items-center gap-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sequence:</label>
                                    <input wire:model="urutan" type="number" class="w-16 bg-slate-50 border border-slate-200 rounded-lg py-1 px-2 text-xs font-bold text-center focus:ring-2 focus:ring-pink-500/20 outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 flex gap-4">
                            <button type="button" wire:click="batal" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-5 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] transition-all">
                                Abort
                            </button>
                            <button type="submit" class="flex-[2] bg-pink-600 hover:bg-pink-700 text-white font-black py-5 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-pink-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                Launch Campaign
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
