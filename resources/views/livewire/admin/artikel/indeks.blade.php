<div class="space-y-10">
    @if(!$apakah_menambah && !$apakah_mengedit)
        <!-- Transmission Center -->
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
            <div class="flex items-center gap-6 w-full lg:w-auto">
                <div class="w-16 h-16 bg-blue-50 rounded-[1.5rem] flex items-center justify-center text-blue-600 shadow-inner border border-blue-100">
                    <i class="fas fa-newspaper text-2xl animate-pulse"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase">Content Transmission</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6]"></span>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.3em]">Status: Broadcasting</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-1 lg:w-96 group">
                    <input wire:model.live="cari" type="text" placeholder="Scanning content headlines..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all placeholder-slate-400">
                    <i class="fas fa-radar absolute left-6 top-4.5 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <button wire:click="tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-10 rounded-[1.5rem] shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i>
                    <span class="text-[10px] uppercase tracking-widest">New Transmission</span>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] border border-slate-200/60 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Headline Packet</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Channel</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Originator</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Status Matrix</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Admin Ops</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($daftar_artikel as $art)
                            <tr class="hover:bg-slate-50 transition-all group">
                                <td class="px-10 py-8">
                                    <p class="text-sm font-black text-slate-900 tracking-tight group-hover:text-blue-600 transition-colors italic uppercase">{{ $art->judul }}</p>
                                    <p class="text-[9px] font-mono text-slate-400 mt-2 font-bold uppercase tracking-widest">ENDPOINT: /{{ $art->slug }}</p>
                                </td>
                                <td class="px-10 py-8">
                                    <span class="px-4 py-1.5 rounded-lg bg-blue-50 border border-blue-100 text-[9px] font-black text-blue-600 uppercase tracking-widest shadow-sm">{{ $art->kategori }}</span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-black text-[10px] border border-slate-200">
                                            {{ substr($art->penulis->nama ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-500 uppercase tracking-tighter">{{ $art->penulis->nama ?? 'SYSTEM_CORE' }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $neon = $art->apakah_diterbitkan ? 'bg-emerald-50 border-emerald-200 text-emerald-600 shadow-sm' : 'bg-orange-50 border-orange-200 text-orange-600';
                                    @endphp
                                    <span class="px-4 py-2 rounded-full border text-[9px] font-black uppercase tracking-[0.2em] {{ $neon }}">
                                        {{ $art->apakah_diterbitkan ? 'Synchronized' : 'Draft Protocol' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                        <button wire:click="edit({{ $art->id }})" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-pen-nib text-xs"></i>
                                        </button>
                                        <button class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-40 text-center bg-slate-50/20">
                                    <i class="fas fa-tower-broadcast text-slate-100 text-8xl mb-8"></i>
                                    <p class="text-slate-400 font-black uppercase tracking-[0.2em] italic">Scan Error: No Transmission Detected.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10 border-t border-slate-100 bg-slate-50/50">
                {{ $daftar_artikel->links() }}
            </div>
        </div>
    @else
        <!-- Transmission Editor Console -->
        <div class="max-w-[1400px] mx-auto animate-fade-in-up">
            <div class="bg-white rounded-[4rem] border border-slate-200/60 shadow-2xl overflow-hidden border-t-8 border-t-blue-600">
                <div class="p-12 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 bg-blue-600 rounded-[2rem] flex items-center justify-center text-white text-3xl shadow-xl shadow-blue-200 border border-white/20">
                            <i class="fas fa-feather-pointed"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">{{ $apakah_menambah ? 'New Signal Packet' : 'Edit Transmission' }}</h2>
                            <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.5em] mt-2 italic">Broadcasting Node v4.08</p>
                        </div>
                    </div>
                    <button wire:click="batal" class="w-16 h-16 rounded-[1.5rem] bg-white border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-200 transition-all flex items-center justify-center text-2xl shadow-sm hover:shadow-md">
                        <i class="fas fa-power-off text-xl"></i>
                    </button>
                </div>

                <form wire:submit="simpan" class="p-16 space-y-12">
                    <div class="grid grid-cols-1 xl:grid-cols-4 gap-16">
                        
                        <!-- Main Deck -->
                        <div class="xl:col-span-3 space-y-10">
                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4 ml-2">Headline Identification</label>
                                <input wire:model="judul" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-[2rem] py-6 px-10 text-2xl font-black text-slate-900 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 italic uppercase tracking-tight" placeholder="PROTOCOL TITLE...">
                                @error('judul') <span class="text-rose-600 text-[10px] font-black mt-4 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4 ml-2">Content Matrix Stream</label>
                                <textarea wire:model="konten" rows="18" class="w-full bg-slate-50 border border-slate-200 rounded-[2.5rem] py-8 px-10 text-sm text-slate-600 font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all leading-relaxed font-mono" placeholder="// Initiate content stream here..."></textarea>
                                @error('konten') <span class="text-rose-600 text-[10px] font-black mt-4 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Panel Side HUD -->
                        <div class="space-y-10">
                            <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-200 shadow-inner space-y-8">
                                <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                                    <i class="fas fa-sliders text-xs"></i> Channel Control
                                </h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[9px] font-black text-slate-400 mb-3 uppercase tracking-widest">Frequency Channel</label>
                                        <select wire:model="kategori" class="w-full bg-white border border-slate-200 rounded-xl py-4 px-6 text-xs text-slate-900 font-bold outline-none focus:ring-2 focus:ring-blue-500/20 transition-all cursor-pointer shadow-sm">
                                            <option value="Berita">BROADCAST</option>
                                            <option value="Tutorial">HANDBOOK</option>
                                            <option value="Review">ANALYSIS</option>
                                            <option value="Tips">INSIGHTS</option>
                                        </select>
                                    </div>

                                    <div class="pt-4">
                                        <label class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-200 cursor-pointer group hover:bg-slate-50 transition-all shadow-sm">
                                            <span class="text-[10px] font-black text-slate-500 group-hover:text-emerald-600 uppercase tracking-widest transition-colors">Global Sync</span>
                                            <div class="relative">
                                                <input type="checkbox" wire:model="apakah_diterbitkan" class="sr-only peer">
                                                <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-inner"></div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-600 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-blue-200 relative overflow-hidden group">
                                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                                    <i class="fas fa-tower-cell animate-pulse"></i> Transmission Tip
                                </h3>
                                <p class="text-[10px] leading-relaxed opacity-90 font-bold uppercase tracking-tight italic">
                                    "Optimize keywords within the first 160 characters to maximize global indexing reach."
                                </p>
                            </div>

                            <div class="pt-10 space-y-4">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-6 rounded-[2rem] text-xs uppercase tracking-[0.4em] shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 border-t border-white/20">
                                    <i class="fas fa-broadcast-tower"></i>
                                    <span>Sync Signals</span>
                                </button>
                                <button type="button" wire:click="batal" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-5 rounded-[2rem] text-[10px] uppercase tracking-[0.3em] transition-all shadow-sm">
                                    Abort Packet
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>