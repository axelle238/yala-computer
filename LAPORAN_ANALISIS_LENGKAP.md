# LAPORAN ANALISIS SISTEM YALA COMPUTER (REVISI TOTAL)

## 1. Identifikasi Pelanggaran Aturan (Bahasa & Modal)

Berdasarkan pemindaian sistem, ditemukan beberapa elemen yang masih melanggar aturan **100% Bahasa Indonesia** dan **Tanpa Modal**:

### A. Penamaan File & Folder (Bahasa Inggris)
- `app/Livewire/Dashboard.php` -> Harus menjadi `Dasbor.php`
- `app/Livewire/GlobalSearch.php` -> Harus menjadi `PencarianGlobal.php`
- `app/Livewire/Checkout.php` -> Harus menjadi `Pemesanan.php` atau `Kasir.php`
- `app/Livewire/PesananSukses.php` -> (Sudah Indonesia, tapi konsistensi perlu dicek)
- `resources/views/dashboard.blade.php` -> Harus menjadi `dasbor.blade.php`
- `app/Actions/Fortify/...` -> (Bawaan Laravel, perlu penyesuaian namespace/wrapper jika memungkinkan)
- `app/Models/User.php` -> (Sudah diubah ke `Pengguna.php` namun perlu verifikasi relasi)

### B. Komponen UI & Logika
- Penggunaan `latest('waktu')` sebelumnya salah karena kolom di migrasi adalah `created_at`.
- Beberapa view masih menggunakan istilah "Dashboard", "Checkout", "Search".
- Struktur folder `resources/views/livewire/admin/stok` (Sudah lumayan baik).

## 2. Rencana Perbaikan Arsitektur (Tahap 1)

### A. Konversi Nama File & Class
Saya akan melakukan penggantian nama (rename) massal untuk memastikan kepatuhan 100% Bahasa Indonesia.

| File/Folder Lama | Nama Baru (Indonesia) |
|------------------|-----------------------|
| `Dashboard.php` | `Dasbor.php` |
| `GlobalSearch.php` | `PencarianGlobal.php` |
| `Checkout.php` | `Pemesanan.php` |
| `KeranjangBadge.php` | `LencanaKeranjang.php`|
| `Detail.php` (Produk) | `Rincian.php` |

### B. Penyempurnaan Database
Tabel `log_aktivitas` akan dipastikan memiliki kolom:
- `pengguna_id`
- `aksi`
- `target`
- `pesan_naratif`
- `meta_json` (pengganti `meta_data`)
- `created_at` (sebagai `waktu`)

### C. Penghapusan Modal
Seluruh interaksi yang menggunakan modal (jika ada) akan diganti dengan:
- **Slide-over panel** (menggunakan Livewire)
- **Inline expansion**
- **Halaman terpisah**

## 3. Dokumentasi Sistem (Otomatis)
Saya akan segera membuat `/storage/dokumentasi/dokumentasi_sistem.json` dan perintah artisan untuk memperbaruinya.

---
**Status Analisis:** SELESAI
**Tindakan Berikutnya:** Eksekusi penggantian nama file dan update database.