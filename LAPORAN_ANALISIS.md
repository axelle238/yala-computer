# LAPORAN ANALISIS & ARSITEKTUR SISTEM YALA COMPUTER

## 1. Status Proyek Saat Ini
- **Framework:** Laravel 12.0
- **Frontend Stack:** Livewire 4.0 + Alpine.js + Tailwind (via Flux/Standard)
- **Database:** SQLite (Default), belum ada tabel bisnis.
- **Otentikasi:** Laravel Fortify (Terinstal).
- **Kondisi:** Fresh starter kit, siap untuk perombakan total.

## 2. Kepatuhan Mandat (Absolut)
- **Bahasa:** Seluruh kode, database, dan komentar akan dikonversi ke Bahasa Indonesia.
- **UI/UX:** Single Page App (SPA) feel, TANPA MODAL. Interaksi inline atau halaman penuh.
- **Tema:** Light, Modern, High-Tech, Colorful.

## 3. Rencana Transformasi Database (Skema Indonesia)

Saya akan menghapus migrasi bawaan `users` dan menggantinya dengan struktur berikut:

### A. Tabel Utama
| Tabel Lama (Konsep) | Tabel Baru (Indonesia) | Keterangan |
|---------------------|------------------------|------------|
| users               | **pengguna**           | Akun admin & pelanggan |
| -                   | **kategori**           | Pengelompokan produk |
| products            | **produk**             | Data barang jual |
| orders              | **pesanan**            | Transaksi header |
| order_items         | **detail_pesanan**     | Transaksi detail |
| activity_log        | **log_aktivitas**      | Audit trail sistem |

### B. Detail Struktur Tabel

**1. pengguna**
- `id` (PK)
- `nama` (string)
- `email` (string, unique)
- `password` (string)
- `peran` (enum: 'admin', 'pelanggan')
- `nomor_telepon` (string, nullable)
- `alamat_lengkap` (text, nullable)
- `foto_profil` (string, nullable)
- `email_terverifikasi_pada` (timestamp)
- `ingat_token` (remember_token)
- `dibuat_pada`, `diupdate_pada`

**2. produk**
- `id` (PK)
- `kategori_id` (FK -> kategori.id)
- `nama` (string)
- `slug` (string, unique, index)
- `deskripsi_pendek` (text) - Untuk SEO meta
- `deskripsi_lengkap` (longtext) - Konten utama
- `harga_modal` (decimal) - Untuk laporan laba
- `harga_jual` (decimal)
- `stok` (integer)
- `berat_gram` (integer)
- `spesifikasi_json` (json) - Key-value spek teknis
- `status` (enum: 'aktif', 'arsip')
- `dibuat_pada`, `diupdate_pada`

**3. pesanan**
- `id` (PK)
- `nomor_invoice` (string, unique) - Contoh: INV/2026/02/001
- `pengguna_id` (FK -> pengguna.id)
- `total_barang` (decimal)
- `biaya_pengiriman` (decimal)
- `total_bayar` (decimal)
- `status` (enum: 'menunggu_pembayaran', 'diproses', 'dikirim', 'selesai', 'dibatalkan')
- `informasi_pengiriman_json` (json) - Alamat snapshot saat beli
- `dibuat_pada`, `diupdate_pada`

**4. log_aktivitas**
- `id` (PK)
- `pengguna_id` (FK -> pengguna.id, nullable)
- `aksi` (string) - Contoh: "TAMBAH_PRODUK"
- `target` (string) - Contoh: "Laptop Asus ROG"
- `pesan_naratif` (text) - Contoh: "Budi menambahkan produk baru Laptop Asus ROG"
- `waktu` (timestamp)

## 4. Rencana Implementasi

1.  **Refactoring Core:**
    - Hapus migrasi lama.
    - Buat migrasi baru bahasa Indonesia.
    - Ubah konfigurasi `auth.php` untuk menggunakan tabel `pengguna`.
    - Rename/Refactor Model `User` menjadi `Pengguna`.

2.  **Backend Development:**
    - Buat Model: `Produk`, `Kategori`, `Pesanan`, `LogAktivitas`.
    - Buat Service/Action untuk logika bisnis (CreateOrder, UpdateStock, dll).

3.  **Frontend (Livewire):**
    - Setup Layout Utama (Navbar, Sidebar, Footer) tanpa modal.
    - Halaman Depan (Katalog).
    - Halaman Detail Produk.
    - Keranjang & Checkout.
    - Dashboard Admin (Statistik & CRUD).

4.  **SEO & Polish:**
    - Implementasi Meta Tags dinamis.
    - Sitemap generation.
    - Testing & Log Aktivitas check.

## 5. Konfirmasi Tindakan Selanjutnya
Saya akan mulai mengeksekusi **Poin 1: Refactoring Core & Database**.
