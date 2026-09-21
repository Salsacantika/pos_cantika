@extends('layouts.app')

@section('title', 'Laporan Penjualan - Luxury Boutique Enterprise')

@section('content')
<div class="container-fluid py-4 px-lg-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="bi bi-file-earmark-text me-2" style="color: #c5a059;"></i>Laporan Penjualan Toko
            </h2>
            <p class="text-muted small m-0">Rekapitulasi transaksi lengkap dengan rincian produk yang terjual.</p>
        </div>
        
        <!-- Filter Tombol Periode -->
        <div class="btn-group shadow-sm rounded-pill overflow-hidden border">
            <a href="{{ route('laporan.index', ['filter' => 'harian']) }}" class="btn {{ $filter == 'harian' ? 'btn-dark' : 'btn-light' }} btn-sm px-3 fw-bold">Harian</a>
            <a href="{{ route('laporan.index', ['filter' => 'mingguan']) }}" class="btn {{ $filter == 'mingguan' ? 'btn-dark' : 'btn-light' }} btn-sm px-3 fw-bold">Mingguan</a>
            <a href="{{ route('laporan.index', ['filter' => 'bulanan']) }}" class="btn {{ $filter == 'bulanan' ? 'btn-dark' : 'btn-light' }} btn-sm px-3 fw-bold">Bulanan</a>
        </div>
    </div>

    <!-- Kartu Total Pendapatan -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #8e5b42 0%, #6d432f 100%);">
                <span class="small text-uppercase tracking-wider fw-bold opacity-75">Total Pendapatan ({{ ucfirst($filter) }})</span>
                <h3 class="fw-bold mt-2 mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <span class="small mt-2 d-block opacity-75">Dari {{ count($laporans) }} transaksi berhasil</span>
            </div>
        </div>
    </div>

    <!-- Tabel Data Laporan & Rincian Produk -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase text-secondary fw-bold" style="font-size: 11px;">
                        <tr>
                            <th class="ps-4 py-3">ID Transaksi & Waktu</th>
                            <th>Kasir / Pembayaran</th>
                            <th>Rincian Produk Terjual (Nama, Harga, Qty)</th>
                            <th class="text-end pe-4">Subtotal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $transaksi)
                            <tr>
                                <td class="ps-4 py-3">
                                    <span class="fw-bold text-dark d-block">#TRX-{{ $transaksi->id }}</span>
                                    <span class="small text-muted">{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
                                </td>
                                <td>
                                    <span class="d-block fw-semibold text-secondary">{{ $transaksi->user->name ?? 'Kasir' }}</span>
                                    <span class="badge bg-light text-dark border px-2 py-0 mt-1" style="font-size: 10px;">
                                        {{ $transaksi->metode_pembayaran ?? 'CASH' }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Daftar produk di dalam transaksi ini -->
                                    <ul class="list-unstyled m-0 small">
                                        @foreach($transaksi->itemPenjualan as $item)
                                            <li class="py-1 border-bottom border-light d-flex justify-content-between align-items-center">
                                                <span>
                                                    <i class="bi bi-box-seam me-1 text-muted"></i> 
                                                    <strong>{{ $item->produk->nama ?? 'Produk Dihapus' }}</strong> 
                                                    <span class="text-muted">(Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }} x {{ $item->kuantitas }})</span>
                                                </span>
                                                <span class="fw-bold text-dark ms-3">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-end pe-4 fw-bold text-success fs-6">
                                    Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder2-open fs-1 opacity-25 d-block mb-2"></i>
                                    Tidak ada data laporan penjualan untuk periode {{ $filter }} ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection