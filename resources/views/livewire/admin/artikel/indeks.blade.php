<div class="space-y-10">
    @if(!$apakah_menambah && !$apakah_mengedit)
        <!-- Dashboard Publikasi -->
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#0B1120]/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
            <div class="flex items-center gap-6 w-full lg:w-auto">
                <div class="w-16 h-16 bg-blue-400/10 rounded-[1.5rem] flex items-center justify-center text-blue-400 shadow-[inset_0_0_20px_rgba(96,165,250,0.1)]">
                    <i class="fas fa-newspaper text-2xl animate-pulse"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">CONTENT TRANSMISSION</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-2 h-2 rounded-full bg-blue-400 shadow-[0_0_10px_#60a5fa]"></span>
                        <p class="text-[10px] text-blue-300 font-black uppercase tracking-[0.3em]">Protocol: Broadcasting</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-1 lg:w-96 group">
                    <input wire:model.live="cari" type="text" placeholder="Scanning content headlines..." class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-blue-400/50 outline-none transition-all">
                    <i class="fas fa-radar absolute left-6 top-4.5 text-gray-500 group-hover:text-blue-400"></i>
                </div>
                <button wire:click="tambah" class="bg-blue-500 hover:bg-blue-600 text-white font-black py-4 px-10 rounded-[1.5rem] shadow-[0_10px_20px_-5px_rgba(59,130,246,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i>
                    <span class="text-[10px] uppercase tracking-widest">Initiate Draft</span>
                </button>
            </div>
        </div>

        <div class="bg-[#0B1120]/50 backdrop-blur-xl rounded-[3.5rem] border border-white/5 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/2 border-b border-white/5">
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Headline Node</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Channel</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Auth User</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Broadcast Status</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] text-center">Ops</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/2">
                        @forelse($daftar_artikel as $art)
                            <tr class="hover:bg-blue-400/5 transition-all group">
                                <td class="px-10 py-8">
                                    <p class="text-sm font-black text-white tracking-wide group-hover:text-blue-400 transition-colors italic uppercase">{{ $art->judul }}</p>
                                    <p class="text-[9px] font-mono text-gray-600 mt-2 tracking-tighter">ENDPOINT: /{{ $art->slug }}</p>
                                </td>
                                <td class="px-10 py-8">
                                    <span class="px-4 py-1.5 rounded-lg bg-white/5 border border-white/10 text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $art->kategori }}</span>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 font-black text-[10px]">
                                            {{ substr($art->penulis->nama ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="text-xs font-bold text-gray-500">{{ $art->penulis->nama ?? 'SYSTEM_CORE' }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @php
                                        $neon = $art->apakah_diterbitkan ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)]' : 'bg-orange-500/10 border-orange-500/30 text-orange-400';
                                    @endphp
                                    <span class="px-4 py-2 rounded-full border text-[9px] font-black uppercase tracking-[0.2em] {{ $neon }}">
                                        {{ $art->apakah_diterbitkan ? 'Synchronized' : 'Draft Protocol' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex items-center justify-center gap-4">
                                        <button wire:click="edit({{ $art->id }})" class="w-10 h-10 rounded-xl bg-blue-400/10 text-blue-400 border border-blue-400/20 hover:bg-blue-400 hover:text-white transition-all">
                                            <i class="fas fa-microscope text-xs"></i>
                                        </button>
                                        <button class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all">
                                            <i class="fas fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-40 text-center">
                                    <i class="fas fa-tower-broadcast text-white/5 text-8xl mb-8"></i>
                                    <p class="text-gray-600 font-mono italic tracking-[0.2em]">Listening for transmission... No active signals detected.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10 border-t border-white/5 bg-white/2">
                {{ $daftar_artikel->links() }}
            </div>
        </div>
    @else
        <!-- Full-Screen Command Deck Editor -->
        <div class="max-w-[1400px] mx-auto animate-fade-in-up">
            <div class="bg-[#0B1120]/80 backdrop-blur-3xl rounded-[4rem] border border-blue-400/20 shadow-2xl overflow-hidden">
                <!-- Editor Header -->
                <div class="p-12 border-b border-white/5 bg-gradient-to-r from-blue-600/20 via-transparent to-transparent flex items-center justify-between">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 bg-blue-500 rounded-[2rem] flex items-center justify-center text-white text-3xl shadow-[0_0_30px_rgba(59,130,246,0.5)] border border-white/20">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-white tracking-tighter italic uppercase">{{ $apakah_menambah ? 'CREATE SIGNAL draft' : 'REWRITE TRANSMISSION' }}</h2>
                            <p class="text-[10px] text-blue-400 font-black uppercase tracking-[0.5em] mt-2">Publishing Node v4.08</p>
                        </div>
                    </div>
                    <button wire:click="batal" class="w-16 h-16 rounded-[1.5rem] bg-white/2 border border-white/10 text-gray-500 hover:text-red-500 hover:border-red-500/50 transition-all flex items-center justify-center text-2xl">
                        <i class="fas fa-power-off"></i>
                    </button>
                </div>

                <form wire:submit="simpan" class="p-16 space-y-12">
                    <div class="grid grid-cols-1 xl:grid-cols-4 gap-16">
                        
                        <!-- Input Section -->
                        <div class="xl:col-span-3 space-y-10">
                            <div class="relative group">
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 ml-2">Headline Identification</label>
                                <input wire:model="judul" type="text" class="w-full bg-white/2 border border-white/10 rounded-[2rem] py-6 px-10 text-2xl font-black text-white focus:ring-4 focus:ring-blue-500/20 outline-none transition-all placeholder-gray-700 italic uppercase tracking-tight" placeholder="PROTOCOL TITLE...">
                                @error('judul') <span class="text-red-500 text-[10px] font-black mt-4 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="relative group">
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4 ml-2">Content Matrix Data</label>
                                <textarea wire:model="konten" rows="18" class="w-full bg-white/2 border border-white/10 rounded-[2.5rem] py-8 px-10 text-sm text-gray-400 focus:ring-4 focus:ring-blue-500/20 outline-none transition-all leading-relaxed font-mono" placeholder="// Initiate content stream here..."></textarea>
                                @error('konten') <span class="text-red-500 text-[10px] font-black mt-4 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Panel Controls -->
                        <div class="space-y-10">
                            <!-- Config Hub -->
                            <div class="bg-black/40 p-8 rounded-[2.5rem] border border-white/5 space-y-8">
                                <h3 class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] mb-6">Config Hub</h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[9px] font-black text-gray-600 mb-3 uppercase tracking-widest">Frequency Channel</label>
                                        <select wire:model="kategori" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 px-6 text-xs text-white font-bold outline-none focus:ring-2 focus:ring-blue-500/50 transition-all cursor-pointer">
                                            <option value="Berita" class="bg-[#0B1120]">BROADCAST</option>
                                            <option value="Tutorial" class="bg-[#0B1120]">HANDBOOK</option>
                                            <option value="Review" class="bg-[#0B1120]">ANALYSIS</option>
                                            <option value="Tips" class="bg-[#0B1120]">INSIGHTS</option>
                                        </select>
                                    </div>

                                    <div class="pt-4">
                                        <label class="flex items-center justify-between p-4 bg-white/2 rounded-2xl border border-white/5 cursor-pointer group hover:bg-white/5 transition-all">
                                            <span class="text-[10px] font-black text-gray-500 group-hover:text-emerald-400 uppercase tracking-widest">Live Sync</span>
                                            <div class="relative">
                                                <input type="checkbox" wire:model="apakah_diterbitkan" class="sr-only peer">
                                                <div class="w-14 h-7 bg-gray-800 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-inner"></div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- System Status -->
                            <div class="bg-blue-600 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-blue-900/40 relative overflow-hidden group">
                                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                                    <i class="fas fa-tower-cell"></i> Broadcast Tip
                                </h3>
                                <p class="text-[10px] leading-relaxed opacity-90 font-bold uppercase tracking-tight italic">
                                    "Ensure headlines contain high-density keywords for optimal indexing within global search matrices."
                                </p>
                            </div>

                            <div class="pt-10 space-y-4">
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-black py-6 rounded-[2rem] text-xs uppercase tracking-[0.4em] shadow-2xl shadow-blue-900/40 transition-all transform hover:-translate-y-1 active:scale-95 border-t border-white/20">
                                    Execute Sync
                                </button>
                                <button type="button" wire:click="batal" class="w-full bg-white/2 hover:bg-white/5 text-gray-500 font-black py-5 rounded-[2rem] text-[10px] uppercase tracking-[0.3em] transition-all border border-white/5">
                                    Abort Process
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>