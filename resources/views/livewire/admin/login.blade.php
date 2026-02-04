<div class="min-h-screen flex items-center justify-center bg-[#020617] relative overflow-hidden -m-8">
    <!-- Ambient Background -->
    <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-blue-600/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md bg-[#0F172A]/80 backdrop-blur-2xl p-10 rounded-[2.5rem] shadow-2xl border border-white/10 relative z-10">
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-blue-600 rounded-[1.5rem] flex items-center justify-center text-white shadow-[0_0_30px_rgba(37,99,235,0.5)] mx-auto mb-6 rotate-3 border border-white/20">
                <i class="fas fa-microchip text-4xl animate-pulse"></i>
            </div>
            <h2 class="text-3xl font-black text-white mb-2 tracking-tight uppercase italic">YALACORE ACCESS</h2>
            <p class="text-slate-400 text-xs font-mono tracking-widest uppercase">Secure Enterprise Gateway</p>
        </div>

        <form wire:submit="masuk" class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Identity Protocol (Email)</label>
                <div class="relative group">
                    <input wire:model="surel" type="email" class="w-full bg-[#1E293B] border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none transition-all placeholder-slate-600 font-mono" placeholder="admin@yalacore.net">
                    <i class="fas fa-fingerprint absolute left-5 top-4.5 text-slate-500 group-hover:text-blue-500 transition-colors"></i>
                </div>
                @error('surel') <span class="text-red-500 text-[9px] font-black mt-2 block tracking-widest uppercase">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Security Key</label>
                <div class="relative group">
                    <input wire:model="kata_sandi" type="password" class="w-full bg-[#1E293B] border border-white/10 rounded-2xl py-4 px-6 pl-14 text-sm text-white focus:ring-2 focus:ring-blue-500/50 outline-none transition-all placeholder-slate-600 font-mono" placeholder="••••••••">
                    <i class="fas fa-shield-halved absolute left-5 top-4.5 text-slate-500 group-hover:text-blue-500 transition-colors"></i>
                </div>
                @error('kata_sandi') <span class="text-red-500 text-[9px] font-black mt-2 block tracking-widest uppercase">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" wire:model="ingat_saya" class="w-4 h-4 rounded bg-[#1E293B] border-white/10 text-blue-600 focus:ring-blue-500/50">
                    <span class="text-[10px] font-bold text-slate-500 group-hover:text-white transition-colors uppercase tracking-wider">Remember Session</span>
                </label>
                <a href="#" class="text-[10px] font-bold text-blue-500 hover:text-blue-400 uppercase tracking-wider">Reset Credentials?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-[0_0_20px_rgba(37,99,235,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 border border-white/10">
                <i class="fas fa-unlock-keyhole"></i>
                <span class="text-xs uppercase tracking-[0.2em]">Initiate Session</span>
            </button>
        </form>

        <div class="mt-10 pt-10 border-t border-white/5 text-center">
            <p class="text-[9px] font-black text-slate-600 uppercase tracking-[0.3em]">Yala Computer System v4.0</p>
        </div>
    </div>
</div>