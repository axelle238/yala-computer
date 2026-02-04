<div class="bg-gray-50 min-h-screen py-20 flex items-center justify-center">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-2xl p-12 text-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center text-green-600 mx-auto mb-8 shadow-lg shadow-green-100 animate-bounce">
                <i class="fas fa-check text-4xl"></i>
            </div>
            
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Terima Kasih!</h1>
            <p class="text-lg text-gray-500 mb-10 leading-relaxed">Pesanan Anda telah berhasil dibuat. Silakan selesaikan pembayaran agar kami dapat segera memproses kiriman Anda.</p>
            
            <div class="bg-blue-50 rounded-3xl p-8 mb-10 text-left border border-blue-100">
                <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6 pb-6 border-b border-blue-100">
                    <div>
                        <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest mb-1">Nomor Invoice</p>
                        <p class="text-xl font-bold text-blue-900">#{{ $data_order['invoice'] }}</p>
                    </div>
                    <div class="sm:text-right">
                        <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest mb-1">Total Tagihan</p>
                        <p class="text-xl font-bold text-orange-600">Rp {{ number_format($data_order['total'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-sm font-bold text-blue-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-university"></i>
                        Instruksi Transfer Bank:
                    </p>
                    <div class="flex items-center justify-between p-4 bg-white rounded-2xl">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Bank BCA</p>
                            <p class="text-sm font-bold text-gray-900">1234 5678 90</p>
                            <p class="text-[10px] text-gray-500">A.N. Yala Computer Indonesia</p>
                        </div>
                        <button class="text-blue-600 text-xs font-bold hover:underline">SALIN</button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('beranda') }}" wire:navigate class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 px-8 rounded-2xl transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-home"></i>
                    <span>KEMBALI KE BERANDA</span>
                </a>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>KONFIRMASI VIA WA</span>
                </a>
            </div>
            
            <p class="mt-12 text-[10px] text-gray-400 font-medium">Batas waktu pembayaran adalah 24 jam setelah pesanan dibuat.</p>
        </div>
    </div>
</div>
