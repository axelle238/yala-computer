<div class="space-y-6 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
    @forelse($logs as $log)
        <div class="relative pl-8">
            <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-white border-4 border-gray-50 flex items-center justify-center">
                <div class="w-2 h-2 rounded-full {{ str_contains($log->aksi, 'tambah') ? 'bg-green-500' : (str_contains($log->aksi, 'update') ? 'bg-blue-500' : 'bg-orange-500') }}"></div>
            </div>
            <p class="text-xs font-bold text-gray-900 mb-1 capitalize">{{ $log->aksi }} {{ $log->target }}</p>
            <p class="text-[10px] text-gray-500 mb-2 leading-relaxed">{{ $log->pesan_naratif }}</p>
            <div class="flex items-center gap-2">
                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">{{ $log->waktu->diffForHumans() }}</span>
                <span class="text-[9px] text-gray-300">•</span>
                <span class="text-[9px] font-medium text-gray-400 italic">Oleh {{ $log->pengguna->nama ?? 'Sistem' }}</span>
            </div>
        </div>
    @empty
        <div class="text-center py-10">
            <i class="fas fa-stream text-gray-100 text-4xl mb-4"></i>
            <p class="text-xs text-gray-400 italic">Belum ada aktivitas tercatat.</p>
        </div>
    @endforelse
</div>
