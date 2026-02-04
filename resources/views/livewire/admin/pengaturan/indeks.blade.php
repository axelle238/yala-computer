<div class="max-w-[1200px] mx-auto animate-fade-in-up">
    
    <!-- Mainframe Header -->
    <div class="bg-[#0B1120]/50 backdrop-blur-xl p-10 rounded-[3rem] border border-white/5 shadow-2xl mb-12 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-64 h-64 bg-blue-600/5 rounded-full blur-[100px]"></div>
        <div class="flex flex-col lg:flex-row items-center gap-10 relative z-10">
            <div class="w-24 h-24 bg-blue-600/10 rounded-[2.5rem] flex items-center justify-center text-blue-500 shadow-[inset_0_0_30px_rgba(37,99,235,0.1)] border border-blue-500/20 group-hover:scale-110 transition-all duration-500">
                <i class="fas fa-sliders-h text-4xl animate-pulse"></i>
            </div>
            <div class="text-center lg:text-left flex-1">
                <h2 class="text-3xl font-black text-white tracking-tighter italic uppercase">CORE SYSTEM PARAMETERS</h2>
                <div class="flex items-center justify-center lg:justify-start gap-4 mt-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_#3b82f6]"></span>
                        <p class="text-[10px] text-blue-400 font-black uppercase tracking-[0.4em]">Mainframe: Online</p>
                    </div>
                    <span class="text-gray-700">|</span>
                    <p class="text-[10px] text-gray-500 font-mono italic">Protocol Version: 4.0.ALPHA</p>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit="simpan" class="space-y-10">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
            
            <!-- Information Node -->
            <div class="xl:col-span-2 space-y-10">
                <!-- Identity Matrix -->
                <div class="bg-[#0B1120]/50 backdrop-blur-xl p-12 rounded-[3.5rem] border border-white/5 shadow-2xl space-y-10 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                        <h3 class="text-lg font-black text-white tracking-widest uppercase italic">Identity Matrix</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-2">Digital Alias (Shop Name)</label>
                            <div class="relative group">
                                <input wire:model="nama_toko" type="text" class="w-full bg-white/2 border border-white/10 rounded-2xl py-5 px-8 text-sm text-white font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                <i class="fas fa-microchip absolute right-6 top-5 text-blue-500/30 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-2">Central Auth Email</label>
                            <div class="relative group">
                                <input wire:model="email_toko" type="email" class="w-full bg-white/2 border border-white/10 rounded-2xl py-5 px-8 text-sm text-white font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                <i class="fas fa-envelope absolute right-6 top-5 text-blue-500/30 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-2">Communication Link (WA)</label>
                            <div class="relative group">
                                <input wire:model="telepon_toko" type="text" class="w-full bg-white/2 border border-white/10 rounded-2xl py-5 px-8 text-sm text-white font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                <i class="fas fa-headset absolute right-6 top-5 text-blue-500/30 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-2">Geo Location Data</label>
                            <div class="relative group">
                                <textarea wire:model="alamat_toko" rows="1" class="w-full bg-white/2 border border-white/10 rounded-2xl py-5 px-8 text-sm text-white font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all resize-none"></textarea>
                                <i class="fas fa-location-crosshairs absolute right-6 top-5 text-blue-500/30 group-hover:text-blue-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Broadcast Feed -->
                <div class="bg-[#0B1120]/50 backdrop-blur-xl p-12 rounded-[3.5rem] border border-white/5 shadow-2xl space-y-8 relative overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div class="w-1.5 h-6 bg-orange-500 rounded-full shadow-[0_0_15px_#f97316]"></div>
                        <h3 class="text-lg font-black text-white tracking-widest uppercase italic">Global Broadcast Feed</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] ml-2">Public Signal (Running Text)</label>
                        <textarea wire:model="running_text" rows="3" class="w-full bg-white/2 border border-white/10 rounded-[2rem] py-6 px-8 text-sm text-gray-400 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all leading-relaxed italic" placeholder="Initiate public signal data packet..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Side Intelligence Panel -->
            <div class="space-y-10">
                <!-- System Integrity Card -->
                <div class="bg-blue-600 p-10 rounded-[3rem] text-white shadow-2xl shadow-blue-900/40 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] mb-8 flex items-center gap-3">
                        <i class="fas fa-shield-halved animate-pulse"></i> Integrity Check
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest opacity-70">Core Engine</span>
                            <span class="text-[10px] font-black uppercase">v12.49.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest opacity-70">UI Framework</span>
                            <span class="text-[10px] font-black uppercase">Tailwind v4</span>
                        </div>
                        <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden mt-4">
                            <div class="h-full bg-white shadow-[0_0_10px_white] w-[98%]"></div>
                        </div>
                        <p class="text-[9px] font-mono italic opacity-60">System running at 98% efficiency capacity.</p>
                    </div>
                </div>

                <!-- Execution Center -->
                <div class="bg-black/40 p-10 rounded-[3rem] border border-white/5 shadow-2xl space-y-6">
                    <h3 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                        <i class="fas fa-terminal"></i> Execution Center
                    </h3>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-6 rounded-[2rem] text-xs uppercase tracking-[0.4em] shadow-xl shadow-blue-900/40 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4 border-t border-white/20">
                        <i class="fas fa-save text-lg"></i>
                        <span>Sync Parameters</span>
                    </button>
                    
                    <p class="text-center text-[9px] text-gray-600 font-mono tracking-tighter leading-relaxed">
                        WARNING: Executing synchronization will overwrite primary system registry values across all active nodes.
                    </p>
                </div>

                <!-- Intelligence Panel -->
                <div class="p-8 bg-orange-500/5 rounded-[2.5rem] border border-orange-500/10 border-dashed">
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fas fa-circle-info text-orange-500"></i>
                        <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest text-lg italic">SECURITY PROTOCOL</span>
                    </div>
                    <p class="text-[10px] text-gray-500 leading-relaxed font-bold uppercase tracking-tighter italic">
                        Data packets entered here will be broadcasted to global header/footer interfaces. Verify credentials before commit.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>