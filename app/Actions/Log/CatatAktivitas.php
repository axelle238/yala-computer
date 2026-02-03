<?php

namespace App\Actions\Log;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class CatatAktivitas
{
    /**
     * Mencatat aktivitas pengguna ke database.
     *
     * @param string $aksi Kode aksi (misal: LOGIN, TAMBAH_PRODUK)
     * @param string $target Target objek (misal: Nama Produk, No Invoice)
     * @param string $pesanNaratif Pesan yang mudah dibaca manusia
     * @param array $metaJson Data teknis tambahan (opsional)
     * @param int|null $penggunaId ID Pengguna (opsional, default: Auth::id())
     * @return LogAktivitas
     */
    public static function catat(string $aksi, string $target, string $pesanNaratif, array $metaJson = [], ?int $penggunaId = null): LogAktivitas
    {
        return LogAktivitas::create([
            'pengguna_id' => $penggunaId ?? Auth::id(),
            'aksi' => $aksi,
            'target' => $target,
            'pesan_naratif' => $pesanNaratif,
            'meta_json' => $metaJson,
            'waktu' => now(),
        ]);
    }
}
