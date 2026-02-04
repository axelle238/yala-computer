<div 
    x-data="{ 
        tampil: false, 
        pesan: '', 
        tipe: 'sukses',
        timer: null
    }"
    x-on:notifikasi.window="
        tampil = true; 
        pesan = $event.detail.pesan; 
        tipe = $event.detail.tipe; 
        if (timer) clearTimeout(timer);
        timer = setTimeout(() => tampil = false, 5000)
    "
    class="fixed bottom-10 right-10 z-[100] flex flex-col gap-4"
>
    <template x-if="tampil">
        <div 
            x-show="tampil"
            x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
            x-transition:enter-start="opacity-0 translate-y-10 scale-90 blur-xl"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100 blur-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95 blur-lg"
            :class="{
                'border-emerald-500/30 bg-[#0B1120]/90 shadow-emerald-500/20': tipe === 'sukses',
                'border-blue-500/30 bg-[#0B1120]/90 shadow-blue-500/20': tipe === 'info',
                'border-orange-500/30 bg-[#0B1120]/90 shadow-orange-500/20': tipe === 'peringatan',
                'border-red-500/30 bg-[#0B1120]/90 shadow-red-500/20': tipe === 'bahaya'
            }" 
            class="min-w-[350px] max-w-md backdrop-blur-2xl rounded-[2rem] shadow-2xl border p-6 flex items-start gap-5 relative overflow-hidden group"
        >
            <!-- Background Glow -->
            <div :class="{
                'bg-emerald-500/5': tipe === 'sukses',
                'bg-blue-500/5': tipe === 'info',
                'bg-orange-500/5': tipe === 'peringatan',
                'bg-red-500/5': tipe === 'bahaya'
            }" class="absolute inset-0 transition-colors"></div>

            <!-- Icon -->
            <div :class="{
                'bg-emerald-500/10 text-emerald-500': tipe === 'sukses',
                'bg-blue-500/10 text-blue-500': tipe === 'info',
                'bg-orange-500/10 text-orange-500': tipe === 'peringatan',
                'bg-red-500/10 text-red-500': tipe === 'bahaya'
            }" class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-inner relative z-10 border border-white/5">
                <i :class="{
                    'fas fa-circle-check text-xl': tipe === 'sukses',
                    'fas fa-circle-info text-xl': tipe === 'info',
                    'fas fa-triangle-exclamation text-xl': tipe === 'peringatan',
                    'fas fa-radiation text-xl': tipe === 'bahaya'
                }"></i>
            </div>

            <!-- Content -->
            <div class="flex-1 relative z-10 py-1">
                <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-1" x-text="tipe === 'bahaya' ? 'SYSTEM_ALERT' : 'SIGNAL_RECEIVE'"></p>
                <p class="text-sm font-bold text-white leading-relaxed tracking-tight" x-text="pesan"></p>
            </div>

            <!-- Close Button -->
            <button @click="tampil = false" class="text-gray-600 hover:text-white transition-colors relative z-10 mt-1">
                <i class="fas fa-circle-xmark text-lg"></i>
            </button>

            <!-- Loading Bar -->
            <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r" 
                 :class="{
                    'from-emerald-500/50 to-emerald-500': tipe === 'sukses',
                    'from-blue-500/50 to-blue-500': tipe === 'info',
                    'from-orange-500/50 to-orange-500': tipe === 'peringatan',
                    'from-red-500/50 to-red-500': tipe === 'bahaya'
                 }"
                 style="width: 100%; transition: width 5s linear;"
                 x-init="$watch('tampil', value => { if(value) { $el.style.width = '100%'; setTimeout(() => $el.style.width = '0%', 10); } })"
            ></div>
        </div>
    </template>
</div>