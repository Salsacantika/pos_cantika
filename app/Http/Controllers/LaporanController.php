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

        if (!in_array($filter, ['harian', 'mingguan', 'bulanan'])) {
            $filter = 'harian';
        }

        // Tanggal acuan periode (opsional). Kalau tidak ada, pakai hari ini.
        $tanggalInput = $request->get('tanggal');

        try {
            $tanggal = $tanggalInput ? Carbon::parse($tanggalInput) : Carbon::today();
        } catch (\Exception $e) {
            $tanggalInput = null;
            $tanggal = Carbon::today();
        }

        // BULANAN: hanya bulan yang sudah selesai (bulan berjalan belum masuk).
        // Data bulan ini baru muncul di laporan bulanan setelah ganti bulan.
        if ($filter == 'bulanan') {
            $awalBulanIni = Carbon::now()->startOfMonth();

            if (!$tanggalInput || $tanggal->gte($awalBulanIni)) {
                $tanggal = Carbon::now()->subMonthNoOverflow();
            }
        }

        [$mulai, $selesai] = $this->rentang($filter, $tanggal);

        // HARIAN & MINGGUAN: kalau periode sekarang kosong dan user belum memilih periode,
        // otomatis tampilkan periode terakhir yang ada transaksinya.
        if (!$tanggalInput && $filter != 'bulanan') {
            $adaData = Penjualan::where('status', 'completed')
                ->whereBetween('created_at', [$mulai, $selesai])
                ->exists();

            if (!$adaData) {
                $terakhir = Penjualan::where('status', 'completed')->latest()->first();

                if ($terakhir) {
                    $tanggal = $terakhir->created_at->copy();
                    [$mulai, $selesai] = $this->rentang($filter, $tanggal);
                }
            }
        }

        $query = Penjualan::where('status', 'completed')
            ->whereBetween('created_at', [$mulai, $selesai]);

        // Ambil transaksi beserta rincian item dan produknya
        $laporans = $query->with('user', 'itemPenjualan.produk')->latest()->get();
        $totalPendapatan = $laporans->sum('total_pembayaran');

        // Label periode & navigasi sebelumnya / berikutnya
        $periodeLabel = $this->label($filter, $mulai, $selesai);

        $prevTanggal = $this->geser($filter, $tanggal, -1);
        $nextTanggal = $this->geser($filter, $tanggal, 1);

        $prevUrl = $request->url() . '?' . http_build_query([
            'filter'  => $filter,
            'tanggal' => $prevTanggal->toDateString(),
        ]);

        // Tombol "berikutnya" hanya muncul kalau periode berikutnya sudah boleh ditampilkan
        if ($filter == 'bulanan') {
            [, $akhirNext] = $this->rentang('bulanan', $nextTanggal);
            $bolehNext = $akhirNext->lt(Carbon::now()->startOfMonth());
        } else {
            $bolehNext = $selesai->lt(Carbon::now());
        }

        $nextUrl = $bolehNext
            ? $request->url() . '?' . http_build_query([
                'filter'  => $filter,
                'tanggal' => $nextTanggal->toDateString(),
            ])
            : null;

        return view('laporan.index', compact(
            'laporans',
            'filter',
            'totalPendapatan',
            'periodeLabel',
            'prevUrl',
            'nextUrl'
        ));
    }

    /**
     * Hitung awal & akhir periode berdasarkan filter.
     */
    private function rentang(string $filter, Carbon $tanggal): array
    {
        $t = $tanggal->copy();

        return match ($filter) {
            'mingguan' => [$t->copy()->startOfWeek()->startOfDay(), $t->copy()->endOfWeek()->endOfDay()],
            'bulanan'  => [$t->copy()->startOfMonth()->startOfDay(), $t->copy()->endOfMonth()->endOfDay()],
            default    => [$t->copy()->startOfDay(), $t->copy()->endOfDay()],
        };
    }

    /**
     * Geser tanggal acuan ke periode sebelumnya (-1) atau berikutnya (+1).
     */
    private function geser(string $filter, Carbon $tanggal, int $arah): Carbon
    {
        $t = $tanggal->copy();

        return match ($filter) {
            'mingguan' => $arah < 0 ? $t->subWeek() : $t->addWeek(),
            'bulanan'  => $arah < 0 ? $t->subMonthNoOverflow() : $t->addMonthNoOverflow(),
            default    => $arah < 0 ? $t->subDay() : $t->addDay(),
        };
    }

    /**
     * Teks label periode yang ditampilkan di halaman.
     */
    private function label(string $filter, Carbon $mulai, Carbon $selesai): string
    {
        $mulai = $mulai->copy()->locale('id');
        $selesai = $selesai->copy()->locale('id');

        return match ($filter) {
            'mingguan' => $mulai->translatedFormat('d M Y') . ' - ' . $selesai->translatedFormat('d M Y'),
            'bulanan'  => $mulai->translatedFormat('F Y'),
            default    => $mulai->translatedFormat('l, d F Y'),
        };
    }
}