@extends('layouts.app')

@section('title', 'Pusat Riwayat Penjualan')

@section('content')
<div class="container-fluid py-4 px-lg-5">
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #6e4631;"><i class="bi bi-clock-history me-2"></i>Pusat Riwayat Penjualan</h2>
        <p class="text-muted small mb-0">Pilih kategori periode riwayat transaksi yang ingin Anda pantau.</p>
    </div>

    <div class="row g-4">
        <!-- Menu Harian -->
        <div class="col-md-4">
            <a href="{{ route('penjualan.riwayat.harian') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 transition-hover">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3 bg-primary-subtle text-primary fs-4">
                            <i class="bi bi-calendar-day"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Riwayat Harian</h5>
                            <p class="text-muted small mb-0">Lihat rekapitulasi transaksi berdasarkan tanggal.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Menu Bulanan -->
        <div class="col-md-4">
            <a href="{{ route('penjualan.riwayat.bulanan') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 transition-hover">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3 bg-success-subtle text-success fs-4">
                            <i class="bi bi-calendar-month"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Riwayat Bulanan</h5>
                            <p class="text-muted small mb-0">Lihat rekapitulasi transaksi dalam satu bulan penuh.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Menu Tahunan -->
        <div class="col-md-4">
            <a href="{{ route('penjualan.riwayat.tahunan') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 transition-hover">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3 bg-warning-subtle text-warning fs-4">
                            <i class="bi bi-calendar-range"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Riwayat Tahunan</h5>
                            <p class="text-muted small mb-0">Lihat rekapitulasi performa penjualan tahunan.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection