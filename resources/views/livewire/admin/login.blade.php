<div class="min-h-screen flex items-center justify-center bg-[#F1F5F9] relative overflow-hidden -m-8 font-['Plus_Jakarta_Sans']">
    <!-- Ambient Background Decorations (Light) -->
    <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-blue-400/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-400/10 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md bg-white/80 backdrop-blur-2xl p-12 rounded-[3.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white relative z-10 mx-4">
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-blue-600 rounded-[1.8rem] flex items-center justify-center text-white shadow-xl shadow-blue-200 mx-auto mb-8 rotate-3 border-4 border-white">
                <i class="fas fa-microchip text-4xl animate-pulse"></i>
            </div>
            <h2 class="text-3xl font-['Outfit'] font-black text-slate-900 mb-2 tracking-tight uppercase italic leading-none">YalaCore <span class="text-blue-600 font-light">Access</span></h2>
            <p class="text-slate-400 text-[10px] font-black tracking-[0.4em] uppercase mt-2">Enterprise Security Hub</p>
        </div>

        <form wire:submit="masuk" class="space-y-8">
            <div class="group">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-2 group-focus-within:text-blue-600 transition-colors">Digital Identity (Email)</label>
                <div class="relative">
                    <input wire:model="surel" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 font-mono shadow-inner" placeholder="alias@yalacore.net">
                    <i class="fas fa-fingerprint absolute left-5 top-4.5 text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                @error('surel') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
            </div>

            <div class="group">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-2 group-focus-within:text-blue-600 transition-colors">Security Key</label>
                <div class="relative">
                    <input wire:model="kata_sandi" type="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 pl-14 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder-slate-300 font-mono shadow-inner" placeholder="••••••••">
                    <i class="fas fa-shield-halved absolute left-5 top-4.5 text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                @error('kata_sandi') <span class="text-rose-600 text-[9px] font-black mt-2 block tracking-widest uppercase italic">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between px-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" wire:model="ingat_saya" class="sr-only peer">
                        <div class="w-9 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600 shadow-inner"></div>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 group-hover:text-slate-600 transition-colors uppercase tracking-widest">Keep Sync</span>
                </label>
                <a href="#" class="text-[10px] font-black text-blue-600 hover:text-blue-700 uppercase tracking-widest hover:underline decoration-2 underline-offset-4">Reset Key?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4 border-t border-white/20">
                <i class="fas fa-unlock-keyhole"></i>
                <span class="text-xs uppercase tracking-[0.3em]">Initialize Hub</span>
            </button>
        </form>

        <div class="mt-12 pt-10 border-t border-slate-100 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">System v4.0.9 // Secured</p>
            </div>
        </div>
    </div>
</div>
