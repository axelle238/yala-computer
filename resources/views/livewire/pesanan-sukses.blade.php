<div class="min-h-screen bg-gray-50 py-12 flex flex-col items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-lg w-full text-center border border-gray-100">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 text-green-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h1>
        <p class="text-gray-500 mb-6">Terima kasih telah berbelanja di Yala Computer. Pesanan Anda sedang kami proses.</p>

        <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
            <div class="flex justify-between mb-2">
                <span class="text-gray-500 text-sm">Nomor Invoice</span>
                <span class="font-mono font-bold text-gray-900">{{ $pesanan->nomor_invoice }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-500 text-sm">Total Pembayaran</span>
                <span class="font-bold text-blue-600">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Metode Pembayaran</span>
                <span class="font-medium text-gray-900">Transfer Bank (Manual)</span>
            </div>
        </div>

        <div class="space-y-3">
            <a href="{{ route('dashboard') }}" class="block w-full py-3 px-4 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-lg transition">
                Lihat Riwayat Pesanan
            </a>
            <a href="/" class="block w-full py-3 px-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-lg border border-gray-200 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
