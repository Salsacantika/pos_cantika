@extends('layouts.app')

@section('title', 'Riwayat Penjualan Harian')

@section('content')
<div class="container-fluid py-4 px-lg-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="color: #6e4631;"><i class="bi bi-calendar-day me-2"></i>Riwayat Penjualan Harian</h2>
            <p class="text-muted small mb-0">Daftar transaksi berdasarkan tanggal spesifik.</p>
        </div>
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Penjualan
        </a>
    </div>

    <!-- Filter Form -->
    <div class="card border-0 shadow-sm p-4 mb-4 rounded-4">
        <form action="{{ route('penjualan.riwayat.harian') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Pilih Tanggal</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control rounded-3">
            </div>
            <div class="col-md-auto d-flex align-items-end mt-auto pt-2">
                <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: #a26b4e;">Filter</button>
            </div>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Waktu</th>
                        <th>Kasir</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $loop->iteration }}</td>
                            <td>{{ $sale->created_at->format('H:i:s') }} WIB</td>
                            <td>{{ $sale->user->name ?? '-' }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                            <td><span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">{{ $sale->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada transaksi pada tanggal ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $sales->withQueryString()->links() }}</div>
    </div>
</div>
@endsection