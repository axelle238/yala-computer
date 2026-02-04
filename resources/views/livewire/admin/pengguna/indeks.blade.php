<div class="space-y-10">
    
    <!-- Authority Header -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-slate-200/60 shadow-xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-blue-50 rounded-[1.5rem] flex items-center justify-center text-blue-600 shadow-inner border border-blue-100">
                <i class="fas fa-shield-halved text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">Authority Protocol</h2>
                <div class="flex items-center gap-2 mt-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                    <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.3em]">Access Gates: Secured</p>
                </div>
            </div>
        </div>

        <button wire:click="tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-10 rounded-[1.5rem] shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
            <i class="fas fa-user-shield"></i>
            <span class="text-[10px] uppercase tracking-widest">Register Otoritas</span>
        </button>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Authorized Personnel Grid -->
        <div class="flex-1 w-full bg-white rounded-[3rem] border border-slate-200/60 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Personnel Identity</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Matrix Level</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Service Cycle</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Admin Ops</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($daftar_admin as $admin)
                            <tr class="hover:bg-slate-50 transition-all group {{ $id_dipilih == $admin->id ? 'bg-blue-50/50' : '' }}">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($admin->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900 tracking-tight uppercase italic group-hover:text-blue-600 transition-colors">{{ $admin->nama }}</p>
                                            <p class="text-[9px] font-mono text-slate-400 mt-1 font-bold uppercase tracking-widest">{{ $admin->surel }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <span class="px-4 py-1.5 rounded-full border border-blue-100 bg-blue-50 text-[9px] font-black text-blue-600 uppercase tracking-[0.2em] shadow-sm">
                                        {{ $admin->id === 1 ? 'Root Authority' : 'Node Operator' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-xs font-black text-slate-900 tracking-tighter uppercase">{{ $admin->created_at->format('Y.m.d') }}</p>
                                    <p class="text-[9px] text-slate-400 font-bold mt-1 uppercase tracking-tighter italic">{{ $admin->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                        <button wire:click="edit({{ $admin->id }})" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-fingerprint text-xs"></i>
                                        </button>
                                        @if($admin->id !== auth()->id())
                                            <button wire:click="hapus({{ $admin->id }})" wire:confirm="Execute credential purge protocol?" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-power-off text-xs"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Otoritas Config (Sticky) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full xl:w-[480px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-white rounded-[3rem] border border-slate-200/60 shadow-2xl sticky top-28 overflow-hidden border-t-8 border-t-blue-600">
                    <div class="p-10 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-slate-900 tracking-tighter text-lg uppercase italic leading-none">
                                {{ $apakah_menambah ? 'New Auth Link' : 'Sync Credentials' }}
                            </h3>
                            <p class="text-[9px] text-blue-600 font-black tracking-[0.4em] mt-2 uppercase">Protocol v4.0.9</p>
                        </div>
                        <button wire:click="batal" class="w-12 h-12 rounded-2xl bg-white hover:bg-slate-50 text-slate-400 hover:text-slate-900 transition-all border border-slate-200 shadow-sm flex items-center justify-center">
                            <i class="fas fa-xmark text-xl"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-10 space-y-10">
                        <div class="space-y-8">
                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Personnel Designation</label>
                                <input wire:model="nama" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-black focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 italic" placeholder="Enter Full Name">
                                @error('nama') <span class="text-rose-600 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Endpoint Alias (Email)</label>
                                <input wire:model="surel" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-black focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 font-mono" placeholder="alias@yalacore.net">
                                @error('surel') <span class="text-rose-600 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">{{ $apakah_mengedit ? 'Overwriting Key (Optional)' : 'Secret Entry Key' }}</label>
                                <input wire:model="kata_sandi" type="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-black focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300" placeholder="••••••••">
                                @error('kata_sandi') <span class="text-rose-600 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div class="relative group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Confirm Linkage</label>
                                <input wire:model="konfirmasi_kata_sandi" type="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-sm text-slate-900 font-black focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="pt-6 flex gap-4">
                            <button type="button" wire:click="batal" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all">
                                Abort
                            </button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 border-t border-white/20">
                                Authorize Node
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>