<?php

/**
 * Komponen: Admin\Laporan\Indeks
 * Peran: Menyajikan data statistik bisnis dan laporan penjualan dengan fitur ekspor
 */

namespace App\Livewire\Admin\Laporan;

use App\Models\Pesanan;
use App\Models\PesananItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Indeks extends Component
{
    public $periode = 'bulan_ini'; // bulan_ini, bulan_lalu, tahun_ini

    public $custom_start;

    public $custom_end;

    /**
     * Helper: Tentukan range tanggal berdasarkan periode.
     */
    private function getRangeTanggal()
    {
        switch ($this->periode) {
            case 'bulan_lalu':
                return [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()];
            case 'tahun_ini':
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()];
            default: // bulan_ini
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        }
    }

    /**
     * Hitung Pendapatan Harian untuk Grafik.
     */
    public function getChartDataProperty()
    {
        [$start, $end] = $this->getRangeTanggal();

        $data = Pesanan::selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->whereBetween('created_at', [$start, $end])
            ->where('status_pembayaran', 'lunas')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return $data;
    }

    /**
     * Download Laporan CSV.
     */
    public function unduhLaporan()
    {
        [$start, $end] = $this->getRangeTanggal();
        $fileName = 'laporan-penjualan-'.date('Ymd-His').'.csv';

        $pesanan = Pesanan::with(['pelanggan', 'item'])
            ->whereBetween('created_at', [$start, $end])
            ->where('status_pembayaran', 'lunas')
            ->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($pesanan) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Invoice', 'Tanggal', 'Pelanggan', 'Total Item', 'Total Harga', 'Status']);

            foreach ($pesanan as $row) {
                fputcsv($file, [
                    $row->nomor_invoice,
                    $row->created_at->format('Y-m-d H:i'),
                    $row->pelanggan->nama ?? 'Guest',
                    $row->item->sum('kuantitas'),
                    $row->total_harga,
                    $row->status_pesanan,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Render halaman laporan.
     */
    public function render()
    {
        [$start, $end] = $this->getRangeTanggal();

        // 1. Ringkasan Total
        $total_pendapatan = Pesanan::whereBetween('created_at', [$start, $end])
            ->where('status_pembayaran', 'lunas')
            ->sum('total_harga');

        $total_transaksi = Pesanan::whereBetween('created_at', [$start, $end])
            ->where('status_pembayaran', 'lunas')
            ->count();

        // 2. Produk Terlaris
        $produk_terlaris = PesananItem::select('produk_id', DB::raw('SUM(kuantitas) as total_jual'))
            ->whereHas('pesanan', function ($q) use ($start, $end) {
                $q->whereBetween('created_at', [$start, $end])
                    ->where('status_pembayaran', 'lunas');
            })
            ->with('produk')
            ->groupBy('produk_id')
            ->orderByDesc('total_jual')
            ->take(5)
            ->get();

        return view('livewire.admin.laporan.indeks', [
            'total_pendapatan' => $total_pendapatan,
            'total_transaksi' => $total_transaksi,
            'produk_terlaris' => $produk_terlaris,
            'chart_data' => $this->chartData,
        ])->layout('components.layouts.app', ['title' => 'Laporan & Analitik']);
    }
}
