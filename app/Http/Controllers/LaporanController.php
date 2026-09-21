<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'harian');

        $query = Penjualan::where('status', 'completed');

        if ($filter == 'harian') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter == 'mingguan') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'bulanan') {
            $query->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
        }

        // Ambil transaksi beserta rincian item dan produknya
        $laporans = $query->with('user', 'itemPenjualan.produk')->latest()->get();
        $totalPendapatan = $laporans->sum('total_pembayaran');

        return view('laporan.index', compact('laporans', 'filter', 'totalPendapatan'));
    }
}