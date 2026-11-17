<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\DataService;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $stat = [
            'pelanggan'  => Pelanggan::count(),
            'kendaraan'  => Kendaraan::count(),
            'daftar'     => DaftarService::count(),
            'data'       => DataService::count(),
            'pembayaran' => Pembayaran::count(),
            'pendapatan' => (int) Pembayaran::sum('jumlah_biaya'),
        ];

        // jumlah kendaraan per jenis (doughnut)
        $jenis = Kendaraan::selectRaw('jenis_kendaraan, COUNT(*) as total')
            ->groupBy('jenis_kendaraan')
            ->pluck('total', 'jenis_kendaraan');

        // jumlah servis 6 bulan terakhir (bar)
        $bulan = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());
        $labels = $bulan->map(fn ($b) => $b->format('M Y'));
        $perBulan = $bulan->map(fn ($b) => DaftarService::whereYear('tanggal_servis', $b->year)
            ->whereMonth('tanggal_servis', $b->month)->count());

        $terbaru = DaftarService::with('pelanggan')->latest()->take(5)->get();

        return view('dashboard', compact('stat', 'jenis', 'labels', 'perBulan', 'terbaru'));
    }
}