<?php

namespace App\Actions\Log;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CatatAktivitas
{
    /**
     * Mencatat aktivitas pengguna ke database.
     *
     * @param string $aksi Kode aksi (misal: LOGIN, TAMBAH_PRODUK)
     * @param string $target Target objek (misal: Nama Produk, No Invoice)
     * @param string $pesan Pesan yang mudah dibaca manusia
     * @param string $tipe Tipe log (info, success, warning, danger)
     * @param array $metaData Data teknis tambahan (opsional)
     * @param int|null $penggunaId ID Pengguna (opsional, default: Auth::id())
     * @return LogAktivitas
     */
    public static function catat(
        string $aksi, 
        string $target, 
        string $pesan, 
        string $tipe = 'info', 
        array $metaData = [], 
        ?int $penggunaId = null
    ): LogAktivitas
    {
        return LogAktivitas::create([
            'pengguna_id' => $penggunaId ?? Auth::id(),
            'tipe' => $tipe,
            'aksi' => $aksi,
            'target' => $target,
            'pesan' => $pesan,
            'meta_data' => $metaData,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}