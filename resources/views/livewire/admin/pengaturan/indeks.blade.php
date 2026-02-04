<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
        <div class="p-8 border-b border-gray-50 bg-blue-50/30 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-blue-900">Konfigurasi Umum</h2>
                <p class="text-xs text-blue-400 font-medium">Atur informasi dasar toko dan tampilan publik</p>
            </div>
            <i class="fas fa-sliders-h text-blue-200 text-2xl"></i>
        </div>

        <form wire:submit="simpan" class="p-8 space-y-8">
            <!-- Informasi Identitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Identitas Toko</h3>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Nama Aplikasi / Toko</label>
                        <input wire:model="nama_toko" type="text" class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Email Kontak</label>
                        <input wire:model="email_toko" type="email" class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Kontak & Lokasi</h3>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Nomor Telepon / WhatsApp</label>
                        <input wire:model="telepon_toko" type="text" class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Alamat Lengkap Toko</label>
                        <textarea wire:model="alamat_toko" rows="3" class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
                    </div>
                </div>
            </div>

            <hr class="border-gray-50">

            <!-- Informasi Tampilan -->
            <div class="space-y-6">
                <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Pengumuman & Teks Berjalan</h3>
                
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-2">Running Text (Header Publik)</label>
                    <textarea wire:model="running_text" rows="2" class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Teks yang akan muncul di bagian atas halaman publik..."></textarea>
                </div>
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-10 rounded-2xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                    <i class="fas fa-check-circle text-xs"></i>
                    <span>SIMPAN SEMUA PERUBAHAN</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Info Footer Panel -->
    <div class="mt-8 p-6 bg-orange-50 rounded-2xl border border-orange-100 flex items-start gap-4">
        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 flex-shrink-0">
            <i class="fas fa-lightbulb"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-orange-800 mb-1">Tips Keamanan</p>
            <p class="text-[10px] text-orange-600 leading-relaxed">Pastikan informasi kontak yang Anda masukkan benar, karena data ini akan ditampilkan di halaman publik (header & footer) dan digunakan pada invoice pelanggan.</p>
        </div>
    </div>
</div>
