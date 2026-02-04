<div wire:poll.10s class="relative" x-data="{ buka: false }">
    <!-- Trigger Button -->
    <button 
        @click="buka = !buka"
        class="w-12 h-12 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl relative transition-all border border-white/5 group"
    >
        <i class="far fa-bell text-lg group-hover:rotate-12 transition-transform"></i>
        @if($jumlah_baru > 0)
            <span class="absolute top-3 right-3 w-2.5 h-2.5 bg-blue-500 rounded-full shadow-[0_0_15px_#3b82f6] border-2 border-[#0B1120]"></span>
        @endif
    </button>

    <!-- Dropdown Panel (Glassmorphism) -->
    <div 
        x-show="buka" 
        @click.outside="buka = false"
        x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        class="absolute right-0 mt-4 w-96 bg-[#0B1120]/95 backdrop-blur-2xl rounded-[2rem] border border-white/10 shadow-2xl shadow-black/50 z-[60] overflow-hidden"
        style="display: none;"
    >
        <!-- Header -->
        <div class="p-6 border-b border-white/5 flex items-center justify-between bg-gradient-to-br from-blue-600/10 to-transparent">
            <div>
                <h3 class="text-sm font-black text-white uppercase tracking-widest">Active Pulse</h3>
                <p class="text-[9px] text-blue-400 font-bold uppercase tracking-[0.2em] mt-1">System Wide Events</p>
            </div>
            <span class="px-3 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-black rounded-lg">{{ $daftar_notifikasi->count() }} EVENTS</span>
        </div>

        <!-- Notification List -->
        <div class="max-h-[450px] overflow-y-auto custom-scrollbar">
            @forelse($daftar_notifikasi as $notif)
                <div class="p-5 border-b border-white/5 hover:bg-white/2 transition-colors group cursor-pointer">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 border border-white/5 shadow-inner {{ $notif['warna'] }}">
                            <i class="{{ $notif['ikon'] }} text-xs group-hover:scale-110 transition-transform"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-xs font-black text-white truncate pr-2 uppercase italic tracking-tighter">{{ $notif['judul'] }}</p>
                                <span class="text-[8px] font-mono text-gray-600 uppercase">{{ $notif['waktu']->diffForHumans() }}</span>
                            </div>
                            <p class="text-[10px] text-gray-500 leading-relaxed line-clamp-2 italic">"{{ $notif['pesan'] }}"</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <i class="fas fa-satellite text-white/5 text-5xl mb-4"></i>
                    <p class="text-[10px] font-mono text-gray-600 uppercase tracking-widest italic">Monitoring for pulse activity...</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        <a href="{{ route('admin.log') }}" class="block p-4 text-center bg-white/2 hover:bg-white/5 text-[9px] font-black text-blue-500 uppercase tracking-[0.3em] transition-colors border-t border-white/5">
            Access Full Surveillance Log <i class="fas fa-chevron-right ml-2"></i>
        </a>
    </div>
</div>
