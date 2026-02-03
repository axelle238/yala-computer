# YALA COMPUTER - Sistem Toko Komputer Modern

![Yala Computer](https://placehold.co/1200x400/2563eb/ffffff?text=YALA+COMPUTER+SYSTEM)

Sistem Informasi Toko Komputer berbasis **Laravel 12** dan **Livewire 4**, dirancang untuk performa tinggi, tampilan modern, dan kepatuhan penuh terhadap standar pengembangan enterprise Indonesia.

## 🚀 Fitur Utama

### 🛍️ Frontend Pelanggan (SPA)
- **Katalog Produk Real-time**: Jelajahi produk tanpa refresh halaman.
- **Pencarian Global**: Cari produk, kategori, dan transaksi dengan cepat.
- **Keranjang Belanja Live**: Update jumlah dan harga secara instan.
- **Checkout Mulus**: Proses pemesanan sederhana dan cepat.
- **Riwayat Pesanan**: Pantau status pesanan dan rincian transaksi.
- **SEO Optimized**: Sitemap otomatis, JSON-LD, dan Meta Tags dinamis.

### 🏢 Dashboard Admin
- **Manajemen Produk**: CRUD lengkap dengan log aktivitas.
- **Manajemen Kategori**: Edit inline tanpa modal.
- **Manajemen Pesanan**: Update status dengan notifikasi dan kontrol stok otomatis.
- **Manajemen Stok**: Audit trail pergerakan barang (Masuk/Keluar).
- **Log Aktivitas**: Pantau setiap tindakan pengguna dalam sistem.

## 🛠️ Teknologi

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Livewire 4, Blade, Tailwind CSS v4
- **Database**: MySQL / MariaDB
- **Keamanan**: Laravel Fortify (Otentikasi Aman)

## 📦 Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/axelle238/yala-computer.git
   cd yala-computer
   ```

2. **Instal Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin `.env.example` ke `.env` dan sesuaikan konfigurasi database.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database & Seeding**
   ```bash
   php artisan migrate --seed
   ```

5. **Jalankan Aplikasi**
   ```bash
   npm run dev
   # Terminal terpisah:
   php artisan serve
   ```

## 📚 Dokumentasi

Dokumentasi sistem hidup tersedia di `storage/dokumentasi/dokumentasi_sistem.json`.
Untuk memperbarui dokumentasi secara otomatis sesuai perubahan kode:

```bash
php artisan dokumentasi:generate
```

## 📝 Lisensi

Hak Cipta © 2026 Yala Computer. Dilindungi Undang-Undang.
