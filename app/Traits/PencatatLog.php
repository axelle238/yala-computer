<?php

/**
 * Trait: PencatatLog
 * Peran: Menyediakan fungsi pembantu untuk mencatat aktivitas sistem secara naratif
 */

namespace App\Traits;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

trait PencatatLog
{
    /**
     * Catat aktivitas ke database.
     *
     * @param  string  $aksi  Jenis tindakan (tambah, perbarui, hapus, login, dll)
     * @param  string  $target  Nama entitas yang dipengaruhi (Produk, Pesanan, dll)
     * @param  string  $pesan  Pesan naratif yang manusiawi
     * @param  array|null  $meta  Data tambahan dalam format array
     */
    public function catatAktivitas(string $aksi, string $target, string $pesan, ?array $meta = null): void
    {
        LogAktivitas::create([
            'pengguna_id' => Auth::id(),
            'aksi' => $aksi,
            'target' => $target,
            'pesan_naratif' => $pesan,
            'meta_json' => $meta,
            'waktu' => now(),
        ]);
    }
}
