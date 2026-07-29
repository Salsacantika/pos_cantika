<?php

namespace App\Http\Controllers;

use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
     public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
     ) {}

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();

        return view('dashboard', [
            'ringkasan' => $ringkasan,
            'produkTerlaris' => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis' => $this->stokService->produkStokHabis(),
            // PERBAIKAN: Menggunakan Carbon::now() tanpa angka 0
            'tanggalHariIni' => Carbon::now(), 
        ]);
    }
}
