<div 
    x-data="{ tampil: false, pesan: '', tipe: 'sukses' }"
    x-on:notifikasi.window="tampil = true; pesan = $event.detail.pesan; tipe = $event.detail.tipe; setTimeout(() => tampil = false, 3000)"
    class="fixed bottom-6 right-6 z-[100] flex flex-col gap-3"
>
    <template x-if="tampil">
        <div 
            x-show="tampil"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:translate-x-4"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="min-w-[300px] max-w-sm bg-white rounded-2xl shadow-2xl border border-gray-100 p-4 flex items-center gap-4"
        >
            <div :class="{
                'bg-green-100 text-green-600': tipe === 'sukses',
                'bg-blue-100 text-blue-600': tipe === 'info',
                'bg-orange-100 text-orange-600': tipe === 'peringatan',
                'bg-red-100 text-red-600': tipe === 'bahaya'
            }" class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                <i :class="{
                    'fas fa-check-circle': tipe === 'sukses',
                    'fas fa-info-circle': tipe === 'info',
                    'fas fa-exclamation-triangle': tipe === 'peringatan',
                    'fas fa-times-circle': tipe === 'bahaya'
                }"></i>
            </div>
            <div class="flex-1">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest" x-text="tipe"></p>
                <p class="text-sm font-bold text-gray-800" x-text="pesan"></p>
            </div>
            <button @click="tampil = false" class="text-gray-300 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </template>
</div>
