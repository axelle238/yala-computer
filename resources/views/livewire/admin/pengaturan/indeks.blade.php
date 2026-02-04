<div class="max-w-[1200px] mx-auto animate-fade-in-up">
    
    <!-- Mainframe Terminal Header -->
    <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-2xl mb-12 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-64 h-64 bg-blue-50 rounded-full blur-[100px] group-hover:scale-150 transition-transform duration-1000"></div>
        <div class="flex flex-col lg:flex-row items-center gap-10 relative z-10">
            <div class="w-24 h-24 bg-blue-50 rounded-[2.5rem] flex items-center justify-center text-blue-600 shadow-inner border border-blue-100 group-hover:rotate-12 transition-all">
                <i class="fas fa-sliders-h text-4xl animate-pulse"></i>
            </div>
            <div class="text-center lg:text-left flex-1">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Core System Mainframe</h2>
                <div class="flex items-center justify-center lg:justify-start gap-4 mt-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                        <p class="text-[10px] text-emerald-600 font-black uppercase tracking-[0.4em]">Node: Synchronized</p>
                    </div>
                    <span class="text-slate-200">|</span>
                    <p class="text-[10px] text-slate-400 font-mono font-bold italic uppercase">Registry Protocol v4.0.ALPHA</p>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit="simpan" class="space-y-10">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
            
            <!-- Parameters Deck -->
            <div class="xl:col-span-2 space-y-10">
                <!-- Global Metadata -->
                <div class="bg-white p-12 rounded-[3.5rem] border border-slate-200/60 shadow-2xl space-y-10 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full shadow-[0_0_10px_rgba(37,99,235,0.3)]"></div>
                        <h3 class="text-lg font-black text-slate-900 tracking-widest uppercase italic">Enterprise Identity</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4 group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2 group-focus-within:text-blue-600 transition-colors">Enterprise Alias</label>
                            <div class="relative">
                                <input wire:model="nama_toko" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-5 px-8 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all shadow-inner">
                                <i class="fas fa-terminal absolute right-6 top-5 text-slate-200 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4 group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2 group-focus-within:text-blue-600 transition-colors">Main Admin Endpoint</label>
                            <div class="relative">
                                <input wire:model="email_toko" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-5 px-8 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all shadow-inner">
                                <i class="fas fa-envelope absolute right-6 top-5 text-slate-200 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4 group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2 group-focus-within:text-blue-600 transition-colors">Comm Link Port</label>
                            <div class="relative">
                                <input wire:model="telepon_toko" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-5 px-8 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all shadow-inner">
                                <i class="fas fa-satellite absolute right-6 top-5 text-slate-200 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4 group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2 group-focus-within:text-blue-600 transition-colors">HQ Geo Coordinates</label>
                            <div class="relative">
                                <textarea wire:model="alamat_toko" rows="1" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-5 px-8 text-sm text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all resize-none shadow-inner"></textarea>
                                <i class="fas fa-map-location-dot absolute right-6 top-5 text-slate-200 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Sync Module -->
                <div class="bg-white p-12 rounded-[3.5rem] border border-slate-200/60 shadow-2xl space-y-8 relative overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div class="w-1.5 h-6 bg-orange-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.3)]"></div>
                        <h3 class="text-lg font-black text-slate-900 tracking-widest uppercase italic">Public Signal Matrix</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Public Frequency (Running Text)</label>
                        <textarea wire:model="running_text" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-[2rem] py-6 px-8 text-sm text-slate-600 font-bold focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all leading-relaxed shadow-inner italic" placeholder="Initiate public signal data packet..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Intelligence Hub Sidebar -->
            <div class="space-y-10">
                <!-- System Diagnostics -->
                <div class="bg-blue-600 p-10 rounded-[3rem] text-white shadow-2xl shadow-blue-200 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] mb-10 flex items-center gap-3">
                        <i class="fas fa-shield-check animate-pulse"></i> Diagnostic Report
                    </h3>
                    <div class="space-y-8">
                        <div class="flex items-center justify-between group/line">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-70 group-hover/line:opacity-100 transition-opacity">Kernel Core</span>
                            <span class="text-[10px] font-black uppercase font-mono bg-white/10 px-2 py-1 rounded">v12.49.0</span>
                        </div>
                        <div class="flex items-center justify-between group/line">
                            <span class="text-[10px] font-black uppercase tracking-widest opacity-70 group-hover/line:opacity-100 transition-opacity">Ui Engine</span>
                            <span class="text-[10px] font-black uppercase font-mono bg-white/10 px-2 py-1 rounded">Vivid_Light</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-[10px] font-black uppercase">
                                <span class="opacity-70">Efficiency</span>
                                <span class="text-white">98.4%</span>
                            </div>
                            <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden shadow-inner">
                                <div class="h-full bg-white shadow-[0_0_15px_white] w-[98%] transition-all duration-1000"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Execution Deck -->
                <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-xl space-y-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                        <i class="fas fa-bolt-auto text-6xl text-slate-900"></i>
                    </div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                        <i class="fas fa-power-off text-xs"></i> Execution Controller
                    </h3>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-6 rounded-[2rem] text-xs uppercase tracking-[0.4em] shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4 border-t border-white/20 group">
                        <i class="fas fa-sync-alt group-hover:rotate-180 transition-transform duration-700"></i>
                        <span>Sync Global Node</span>
                    </button>
                    
                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 border-dashed text-center">
                        <p class="text-[9px] text-slate-400 font-bold tracking-tight leading-relaxed uppercase">
                            Warning: Synchronization will propagate changes to all active client interfaces. Verified ID required.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
