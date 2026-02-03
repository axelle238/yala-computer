<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalPengguna) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.251l4.125 5.25m-4.125-5.25L7.875 16.001M6 6.75h12m-6-3.75a3 3 0 0 1 3 3h-6a3 3 0 0 1 3-3Zm0 6.75v5.25m6-5.25v5.25" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalProduk) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalPesanan) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($pendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Aktivitas & Recent Orders -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Log Aktivitas -->
            <div class="lg:col-span-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Log Aktivitas Terbaru
                    </h3>
                    <span class="text-xs text-gray-500">Real-time update</span>
                </div>
                <div class="p-0">
                    <div class="divide-y divide-gray-100">
                        @forelse($logTerbaru as $log)
                            <div class="p-4 hover:bg-gray-50 transition flex items-start gap-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                                        {{ $log->pengguna ? $log->pengguna->inisial() : '?' }}
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold">{{ $log->pengguna ? $log->pengguna->nama : 'Sistem' }}</span>
                                        <span class="text-gray-600">{{ $log->pesan }}</span>
                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[10px] rounded uppercase tracking-wider">{{ $log->aksi }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500 text-sm">
                                Belum ada aktivitas tercatat.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Action / Info -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg shadow-xl text-white p-6 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-2">Selamat Datang, Admin!</h3>
                    <p class="text-blue-100 text-sm mb-6">Kelola toko komputer Anda dengan mudah, cepat, dan efisien. Pantau semua aktivitas di sini.</p>
                    
                    <div class="space-y-3">
                        <button class="w-full py-2 px-4 bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg text-sm font-semibold transition text-left flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Produk Baru
                        </button>
                        <button class="w-full py-2 px-4 bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg text-sm font-semibold transition text-left flex items-center gap-3">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            Laporan Penjualan
                        </button>
                    </div>
                </div>
                
                <!-- Decorative Circles -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 bg-blue-400/20 rounded-full blur-xl"></div>
            </div>
        </div>
    </div>
</div>
