@extends('layouts.app')

@section('title', 'Point of Sales - Beranda')

@section('content')
<style>
    :root {
        --lux-primary: #3D0D0D;
        --lux-primary-hover: #260808;
        --lux-accent: #3D0D0D;
        --lux-gold: #c5a059;
        --lux-gold-light: #fbf6ee;
        --lux-dark: #0f172a;
        --lux-card-bg: #ffffff;
        --lux-border: #eadbc8;
        --lux-shadow: 0 20px 40px -15px rgba(61, 13, 13, 0.08);
        --lux-shadow-hover: 0 25px 50px -12px rgba(61, 13, 13, 0.15);
    }

    body {
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    /* Page Header Typography */
    .page-title {
        color: var(--lux-accent);
        font-weight: 850;
        letter-spacing: -0.75px;
    }

    /* Ultra Luxury Cards */
    .lux-card {
        border: 1px solid var(--lux-border) !important;
        border-radius: 24px !important;
        box-shadow: var(--lux-shadow) !important;
        background: var(--lux-card-bg);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
    }
    .lux-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--lux-shadow-hover) !important;
        border-color: #d8c2ab !important;
    }

    /* Metric Icon Box with Soft Glow */
    .lux-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        transition: transform 0.3s ease;
    }
    .lux-card:hover .lux-icon-box {
        transform: scale(1.08);
    }

    /* Custom Modern Pills Tabs */
    .lux-tabs .nav-link {
        border: none;
        background: transparent;
        color: #64748b;
        font-weight: 700;
        font-size: 12.5px;
        padding: 10px 18px;
        border-radius: 14px;
        transition: all 0.25s ease;
    }
    .lux-tabs .nav-link.active {
        background: linear-gradient(135deg, var(--lux-gold-light) 0%, #f4ebd0 100%) !important;
        color: var(--lux-primary) !important;
        box-shadow: 0 4px 15px rgba(197, 160, 89, 0.2);
        border: 1px solid #ebd6b5;
    }

    /* Luxury Table Design */
    .lux-table thead th {
        background-color: #faf6f0;
        color: #3D0D0D;
        font-weight: 800;
        font-size: 10.5px;
        letter-spacing: 1.2px;
        border-bottom: 2px solid #f1e6db;
        text-transform: uppercase;
        padding-top: 14px;
        padding-bottom: 14px;
    }
    .lux-table tbody tr {
        transition: all 0.2s ease;
    }
    .lux-table tbody tr:hover {
        background-color: #fbf9f5;
    }

    /* Glassmorphism & Status Header */
    .lux-badge-pill {
        background: #ffffff;
        border: 1px solid var(--lux-border);
        box-shadow: 0 4px 12px rgba(61, 13, 13, 0.04);
        border-radius: 50rem;
    }

    .fs-7 { font-size: 0.75rem !important; }
    .fw-extrabold { font-weight: 850 !important; }
</style>

<div class="container-fluid py-4 px-lg-4" style="background-color: #ffffff;">
    
    {{-- Page Header & System Date Badge --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom" style="border-color: var(--lux-border) !important;">
        <div>
            <h2 class="page-title mb-1 fs-3">
                <i class="bi bi-cart-check-fill me-2" style="color: var(--lux-gold);"></i>Point of Sales - Beranda
            </h2>
            <p class="text-secondary small m-0">Kendali penuh performa finansial bisnis dan manajemen inventaris berbasis real-time.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
            <div class="lux-badge-pill px-3 py-2 d-inline-flex align-items-center">
                <i class="bi bi-calendar-event me-2" style="color: var(--lux-accent);"></i>
                <span class="fw-bold text-dark small">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="lux-badge-pill px-3 py-2 d-none d-lg-inline-flex align-items-center gap-2">
                <span class="status-dot rounded-circle bg-success shadow-sm" style="width: 8px; height: 8px;"></span>
                <span class="fw-bold text-secondary" style="font-size: 11.5px;">System Active</span>
            </div>
        </div>
    </div>

    {{-- ==================== METRIC CARDS (ADMIN ONLY) ==================== --}}
    @can('viewAny', App\Models\User::class)
        <div class="row g-3 mb-4">
            <!-- Total Penjualan -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card lux-card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-uppercase fs-7 fw-bold text-muted mb-1" style="letter-spacing: 0.5px;">Total Penjualan</p>
                                <h4 class="fw-extrabold text-dark mb-1 fs-4">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</h4>
                                <span class="badge bg-success-subtle text-success fw-bold px-2 py-0.5 rounded-pill" style="font-size: 10px;">
                                    <i class="bi bi-arrow-up-right me-0.5"></i> Realtime Revenue
                                </span>
                            </div>
                            <div class="lux-icon-box flex-shrink-0" style="background-color: #fbf6ee; color: var(--lux-accent); border: 1px solid #ebd6b5;">
                                <i class="bi bi-wallet2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card lux-card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-uppercase fs-7 fw-bold text-muted mb-1" style="letter-spacing: 0.5px;">Jumlah Transaksi</p>
                                <h4 class="fw-extrabold text-dark mb-1 fs-4">{{ number_format($ringkasan['total_transaksi']) }} <small class="fs-6 text-muted fw-normal">Trx</small></h4>
                                <span class="badge bg-info-subtle text-info fw-bold px-2 py-0.5 rounded-pill" style="font-size: 10px;">
                                    <i class="bi bi-activity me-0.5"></i> Volume Aktif
                                </span>
                            </div>
                            <div class="lux-icon-box flex-shrink-0" style="background-color: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd;">
                                <i class="bi bi-receipt-cutoff"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Tunai -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card lux-card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-uppercase fs-7 fw-bold text-muted mb-1" style="letter-spacing: 0.5px;">Pembayaran Tunai</p>
                                <h4 class="fw-extrabold text-success mb-1 fs-4">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h4>
                                <span class="badge bg-success-subtle text-success fw-bold px-2 py-0.5 rounded-pill" style="font-size: 10px;">
                                    <i class="bi bi-shield-check me-0.5"></i> Cash Flow
                                </span>
                            </div>
                            <div class="lux-icon-box flex-shrink-0" style="background-color: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0;">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Non-Tunai -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card lux-card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-uppercase fs-7 fw-bold text-muted mb-1" style="letter-spacing: 0.5px;">Non-Tunai / QRIS</p>
                                <h4 class="fw-extrabold text-primary mb-1 fs-4">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</h4>
                                <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-0.5 rounded-pill" style="font-size: 10px;">
                                    <i class="bi bi-lightning-charge me-0.5"></i> Digital Pay
                                </span>
                            </div>
                            <div class="lux-icon-box flex-shrink-0" style="background-color: #ede9fe; color: #7c3aed; border: 1px solid #ddd6fe;">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- ==================== MAIN CONTENT SECTION (2 COLUMNS) ==================== --}}
    <div class="row g-4">
        
        {{-- KOLOM KIRI: INVENTARIS KRITIS --}}
        <div class="col-lg-6">
            <div class="card lux-card border-0 h-100">
                <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">
                                <i class="bi bi-shield-exclamation text-warning me-2"></i>Peringatan Stok Barang
                            </h5>
                            <small class="text-muted">Produk yang membutuhkan perhatian & restok segera</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <!-- Nav Tabs Modern -->
                    <div class="px-4 pb-3">
                        <ul class="nav nav-pills lux-tabs gap-2 bg-light p-1.5 rounded-4 border" id="stockTab" role="tablist" style="border-color: var(--lux-border) !important;">
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link active w-100 py-2" id="low-stock-tab" data-bs-toggle="tab" data-bs-target="#low-stock" type="button" role="tab">
                                    Stok Menipis <span class="badge bg-warning text-dark ms-1 rounded-pill px-2 py-0.5">{{ $produkStokRendah->total() }}</span>
                                </button>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link w-100 py-2" id="out-stock-tab" data-bs-toggle="tab" data-bs-target="#out-stock" type="button" role="tab">
                                    Stok Habis <span class="badge bg-danger text-white ms-1 rounded-pill px-2 py-0.5">{{ $produkStokHabis->total() }}</span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content px-4 pb-4" id="stockTabContent">
                        <!-- TAB 1: STOK MENIPIS -->
                        <div class="tab-pane fade show active" id="low-stock" role="tabpanel">
                            @if($produkStokRendah->count() > 0)
                                <div class="table-responsive">
                                    <table class="table lux-table align-middle mb-0 rounded-4 overflow-hidden">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Nama Produk</th>
                                                <th class="text-end pe-3">Sisa Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produkStokRendah as $produk)
                                                <tr>
                                                    <td class="ps-3 fw-bold text-dark py-3">{{ $produk->nama }}</td>
                                                    <td class="text-end pe-3 py-3">
                                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-3 py-1.5 rounded-pill fw-extrabold">
                                                            {{ $produk->stok }} unit
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $produkStokRendah->links() }}
                                </div>
                            @else
                                <div class="text-center py-5 text-muted">
                                    <div class="my-4">
                                        <i class="bi bi-check-circle-fill text-success fs-1 d-block mb-2"></i>
                                        <h6 class="fw-bold text-dark">Inventaris Terkendali</h6>
                                        <span class="small text-muted">Semua produk berada dalam batas stok aman.</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- TAB 2: STOK HABIS -->
                        <div class="tab-pane fade" id="out-stock" role="tabpanel">
                            @if($produkStokHabis->count() > 0)
                                <div class="table-responsive">
                                    <table class="table lux-table align-middle mb-0 rounded-4 overflow-hidden">
                                        <thead>
                                            <tr>
                                                <th class="ps-3">Nama Produk</th>
                                                <th class="text-end pe-3">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produkStokHabis as $produk)
                                                <tr>
                                                    <td class="ps-3 fw-bold text-dark py-3">{{ $produk->nama }}</td>
                                                    <td class="text-end pe-3 py-3">
                                                        <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1.5 rounded-pill fw-extrabold">
                                                            Habis Total
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $produkStokHabis->links() }}
                                </div>
                            @else
                                <div class="text-center py-5 text-muted">
                                    <div class="my-4">
                                        <i class="bi bi-box-seam text-secondary fs-1 opacity-50 d-block mb-2"></i>
                                        <h6 class="fw-bold text-dark">Zero Out of Stock</h6>
                                        <span class="small text-muted">Tidak ada produk yang habis total saat ini.</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: PRODUK TERLARIS --}}
        <div class="col-lg-6">
            <div class="card lux-card border-0 h-100">
                <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">
                                <i class="bi bi-graph-up-arrow me-2" style="color: var(--lux-accent);"></i>Produk Terlaris Hari Ini
                            </h5>
                            <small class="text-muted">Performa produk berdasarkan kuantitas unit terjual</small>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 pb-4 pt-0">
                    <div class="table-responsive">
                        <table class="table lux-table align-middle mb-0 rounded-4 overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="ps-3">Produk</th>
                                    <th>Stok</th>
                                    <th class="pe-3 text-end">Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                    <tr>
                                        <td class="ps-3 py-3">
                                            <div class="fw-extrabold text-dark">{{ $produk->nama }}</div>
                                        </td>
                                        <td class="py-3">
                                            @if($produk->stok == 0)
                                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1 rounded-pill fw-bold">Habis</span>
                                            @elseif($produk->stok <= 5)
                                                <span class="badge bg-warning-subtle text-warning-emphasis px-2.5 py-1 rounded-pill fw-bold">Sisa {{ $produk->stok }}</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-pill fw-bold">{{ $produk->stok }} unit</span>
                                            @endif
                                        </td>
                                        <td class="pe-3 text-end fw-extrabold text-dark py-3">
                                            {{ number_format($produk->total_terjual) }} <span class="fs-7 text-muted fw-normal">pcs</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            <div class="my-4">
                                                <i class="bi bi-inbox fs-1 text-secondary opacity-50 d-block mb-2"></i>
                                                <h6 class="fw-bold text-secondary">Belum Ada Transaksi</h6>
                                                <p class="small text-muted mb-0">Belum ada data penjualan yang tercatat hari ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- Styling Tambahan Pendukung --}}
<style>
    .bg-primary-subtle { background-color: #e0f2fe !important; }
    .bg-success-subtle { background-color: #dcfce7 !important; }
    .bg-warning-subtle { background-color: #fef9c3 !important; }
    .bg-danger-subtle { background-color: #fee2e2 !important; }
    .bg-info-subtle { background-color: #e0f7fa !important; }
    .fw-extrabold { font-weight: 850 !important; }
</style>
@endsection