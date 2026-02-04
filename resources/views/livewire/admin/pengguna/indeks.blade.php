<div class="space-y-10">
    
    <!-- Authority Identification Bar -->
    <div class="flex flex-col lg:flex-row gap-6 items-center justify-between bg-[#0B1120]/50 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
        <div class="flex items-center gap-6 w-full lg:w-auto">
            <div class="w-16 h-16 bg-blue-500/10 rounded-[1.5rem] flex items-center justify-center text-blue-500 shadow-[inset_0_0_20px_rgba(59,130,246,0.1)]">
                <i class="fas fa-shield-halved text-2xl animate-pulse"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tighter italic uppercase">AUTH ACCESS CONTROL</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span>
                    <p class="text-[10px] text-blue-400 font-black uppercase tracking-[0.3em]">Root Nodes: Active</p>
                </div>
            </div>
        </div>

        <button wire:click="tambah" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-10 rounded-[1.5rem] shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
            <i class="fas fa-user-shield"></i>
            <span class="text-[10px] uppercase tracking-widest">Register Authority</span>
        </button>
    </div>

    <div class="flex flex-col xl:flex-row gap-10 items-start">
        
        <!-- Authority Grid -->
        <div class="flex-1 w-full bg-[#0B1120]/50 backdrop-blur-xl rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/2 border-b border-white/5">
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Personnel ID</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Access Level</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Registry Date</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] text-center">Ops</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/2">
                        @foreach($daftar_admin as $admin)
                            <tr class="hover:bg-blue-500/5 transition-all group {{ $id_dipilih == $admin->id ? 'bg-blue-500/10' : '' }}">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-900 border border-white/10 flex items-center justify-center text-white text-xl font-black shadow-lg">
                                            {{ substr($admin->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-white tracking-wide uppercase italic">{{ $admin->nama }}</p>
                                            <p class="text-[9px] font-mono text-gray-500 mt-1 uppercase tracking-tighter">{{ $admin->surel }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <span class="px-4 py-1.5 rounded-full border border-blue-500/30 bg-blue-500/10 text-[9px] font-black text-blue-400 uppercase tracking-widest">
                                        {{ $admin->id === 1 ? 'Root Administrator' : 'Access Node' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-xs font-bold text-gray-400">{{ $admin->created_at->format('Y.m.d') }}</p>
                                    <p class="text-[9px] text-gray-600 font-mono mt-1 italic uppercase">{{ $admin->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center justify-center gap-4">
                                        <button wire:click="edit({{ $admin->id }})" class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 border border-blue-500/20 hover:bg-blue-500 hover:text-white transition-all">
                                            <i class="fas fa-fingerprint text-xs"></i>
                                        </button>
                                        @if($admin->id !== auth()->id())
                                            <button wire:click="hapus({{ $admin->id }})" wire:confirm="Execute access termination protocol?" class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all">
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

        <!-- Registry Control (Sticky) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full xl:w-[450px] flex-shrink-0 animate-fade-in-right">
                <div class="bg-[#0B1120]/80 backdrop-blur-3xl rounded-[3rem] border border-blue-500/30 shadow-2xl sticky top-28 overflow-hidden">
                    <div class="p-8 border-b border-white/5 bg-gradient-to-r from-blue-600/20 to-transparent flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-white tracking-tight uppercase italic">
                                {{ $apakah_menambah ? 'Access Registration' : 'Credential Overwrite' }}
                            </h3>
                            <p class="text-[9px] text-blue-400 font-black tracking-[0.4em] mt-1 uppercase">Protocol v4.0.9</p>
                        </div>
                        <button wire:click="batal" class="w-10 h-10 rounded-full hover:bg-white/5 text-gray-500 hover:text-white transition-all">
                            <i class="fas fa-circle-xmark"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-10 space-y-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Personnel Name</label>
                                <input wire:model="nama" type="text" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none" placeholder="Enter Full Name">
                                @error('nama') <span class="text-red-500 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Auth Email (Endpoint)</label>
                                <input wire:model="surel" type="email" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none" placeholder="staff@yalacore.net">
                                @error('surel') <span class="text-red-500 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">{{ $apakah_mengedit ? 'New Password (Optional)' : 'Access Password' }}</label>
                                <input wire:model="kata_sandi" type="password" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none" placeholder="••••••••">
                                @error('kata_sandi') <span class="text-red-500 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-3">Verify Credentials</label>
                                <input wire:model="konfirmasi_kata_sandi" type="password" class="w-full bg-white/2 border border-white/10 rounded-2xl py-4 px-6 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none" placeholder="••••••••">
                                @error('konfirmasi_kata_sandi') <span class="text-red-500 text-[9px] font-black mt-2 block italic uppercase">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="pt-10 flex gap-4">
                            <button type="button" wire:click="batal" class="flex-1 bg-white/5 hover:bg-white/10 text-gray-400 font-black py-4 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] transition-all">
                                Abort
                            </button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-[1.5rem] text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 transition-all transform hover:-translate-y-1 active:scale-95">
                                Authorize Node
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
