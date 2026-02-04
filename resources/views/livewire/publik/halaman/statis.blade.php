<div class="bg-white min-h-screen py-16">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl font-black text-gray-900 mb-8">{{ $judul }}</h1>
        
        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
            @if($halaman == 'tentang-kami')
                <p>Yala Computer adalah penyedia solusi teknologi terdepan yang didirikan dengan visi untuk mendemokratisasi akses terhadap perangkat komputer berkualitas tinggi di Indonesia. Sejak awal berdirinya, kami berkomitmen untuk menyediakan produk asli, bergaransi resmi, dan layanan purna jual yang tak tertandingi.</p>
                <h3>Visi Kami</h3>
                <p>Menjadi mitra teknologi terpercaya nomor satu di Indonesia.</p>
                <h3>Misi Kami</h3>
                <ul>
                    <li>Menyediakan produk IT terlengkap dan terkini.</li>
                    <li>Memberikan pelayanan pelanggan yang responsif dan solutif.</li>
                    <li>Membangun ekosistem belanja yang aman dan nyaman.</li>
                </ul>

            @elseif($halaman == 'kontak')
                <p>Kami siap membantu Anda. Jangan ragu untuk menghubungi tim kami melalui saluran berikut:</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-8 not-prose">
                    <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                        <h4 class="font-bold text-blue-900 mb-2">Layanan Pelanggan</h4>
                        <p class="text-sm text-blue-700 mb-1"><i class="fas fa-phone-alt mr-2"></i> {{ \App\Models\Pengaturan::ambil('telepon_toko') }}</p>
                        <p class="text-sm text-blue-700"><i class="fas fa-envelope mr-2"></i> {{ \App\Models\Pengaturan::ambil('email_toko') }}</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <h4 class="font-bold text-gray-900 mb-2">Lokasi Toko</h4>
                        <p class="text-sm text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i> {{ \App\Models\Pengaturan::ambil('alamat_toko') }}</p>
                    </div>
                </div>

            @elseif($halaman == 'cara-pemesanan')
                <ol>
                    <li>Cari produk yang Anda inginkan melalui fitur pencarian atau katalog.</li>
                    <li>Klik tombol "Beli Sekarang" atau "Tambah ke Keranjang".</li>
                    <li>Buka halaman Checkout dan isi data pengiriman dengan lengkap.</li>
                    <li>Pilih metode pembayaran dan selesaikan transaksi.</li>
                    <li>Konfirmasi pembayaran Anda dan tunggu barang dikirim!</li>
                </ol>

            @elseif($halaman == 'garansi')
                <p>Semua produk yang dijual di Yala Computer dijamin <strong>100% Original dan Bergaransi Resmi</strong> distributor Indonesia (Asus, HP, Lenovo, dll).</p>
                <h3>Ketentuan Klaim Garansi</h3>
                <ul>
                    <li>Menyertakan invoice pembelian asli.</li>
                    <li>Segel garansi tidak rusak.</li>
                    <li>Kerusakan bukan akibat kesalahan pengguna (jatuh, terkena air, dll).</li>
                </ul>

            @elseif($halaman == 'faq')
                <details class="mb-4 group">
                    <summary class="font-bold cursor-pointer list-none flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        Apakah produk ready stock?
                        <i class="fas fa-chevron-down transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="p-4 text-sm">Ya, status stok di website kami adalah real-time sesuai ketersediaan di gudang.</div>
                </details>
                <details class="mb-4 group">
                    <summary class="font-bold cursor-pointer list-none flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        Berapa lama pengiriman?
                        <i class="fas fa-chevron-down transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div class="p-4 text-sm">Untuk wilayah Jabodetabek 1-2 hari kerja, luar kota 2-5 hari kerja tergantung ekspedisi.</div>
                </details>
            @else
                <p>Halaman sedang dalam perbaikan.</p>
            @endif
        </div>
    </div>
</div>
