@extends('layouts.app')

@section('title', 'Detail Transaksi Penjualan')

@section('content')
<style>
    :root {
        --maison-brown: #a26b4e;
        --maison-brown-hover: #8c5a40;
        --maison-brown-dark: #6e4631;
        --maison-brown-soft: #fcf8f5;
        --maison-brown-light: #f3eae3;
        --maison-border: #ede4dc;
        --maison-text-main: #1e1e1e;
        --maison-text-muted: #737373;
        
        --lux-primary: #8e5b42;
        --lux-gold-light: #fbf6ee;
    }

    .page-title {
        color: var(--maison-brown-dark);
        font-weight: 800;
        letter-spacing: -0.75px;
    }

    /* Luxury Glass/Card Container */
    .maison-pro-card {
        background: #ffffff;
        border: 1px solid var(--maison-border);
        border-radius: 20px;
        box-shadow: 0 20px 40px -15px rgba(162, 107, 78, 0.07);
        overflow: hidden;
    }

    /* Stat Mini Cards */
    .stat-card {
        background: #ffffff;
        border: 1px solid var(--maison-border);
        border-radius: 16px;
        padding: 20px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px -10px rgba(162, 107, 78, 0.12);
        border-color: var(--maison-brown);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--maison-brown-soft);
        color: var(--maison-brown);
        font-size: 1.25rem;
    }

    /* Primary Pro Button */
    .btn-maison-pro {
        background: linear-gradient(135deg, var(--maison-brown) 0%, var(--maison-brown-hover) 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        border-radius: 14px;
        padding: 12px 24px;
        box-shadow: 0 8px 20px -6px rgba(162, 107, 78, 0.4);
        transition: all 0.3s ease;
    }

    .btn-maison-pro:hover {
        background: linear-gradient(135deg, var(--maison-brown-hover) 0%, var(--maison-brown-dark) 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -6px rgba(162, 107, 78, 0.5);
        color: #ffffff;
    }

    /* Modern Table Header & Rows */
    .table-pro-header th {
        background-color: var(--maison-brown-soft);
        color: var(--maison-brown-dark);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
        padding: 16px 20px;
        border-bottom: 2px solid var(--maison-border);
        border-top: none;
    }

    .table-pro-row {
        transition: all 0.2s ease;
    }

    .table-pro-row td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid var(--maison-border);
    }

    .table-pro-row:hover {
        background-color: var(--maison-brown-soft);
    }

    /* Executive Badges */
    .badge-pro-open {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        font-weight: 700;
        font-size: 0.7rem;
        padding: 6px 12px;
        border-radius: 30px;
        letter-spacing: 0.5px;
    }

    .badge-pro-completed {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
        font-weight: 700;
        font-size: 0.7rem;
        padding: 6px 12px;
        border-radius: 30px;
        letter-spacing: 0.5px;
    }

    .badge-pro-method {
        background-color: var(--maison-brown-light);
        color: var(--maison-brown-dark);
        font-weight: 600;
        font-size: 0.7rem;
        padding: 6px 12px;
        border-radius: 30px;
        letter-spacing: 0.5px;
    }

    /* Print Optimization CSS */
    @media print {
        body {
            background-color: #ffffff !important;
        }
        .no-print {
            display: none !important;
        }
        .maison-pro-card {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0 !important;
        }
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    
    <!-- Top Header Layout & Back/Print Controls -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 no-print">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('penjualan.index') }}" class="btn btn-light border p-2.5 rounded-3 text-secondary shadow-sm" title="Kembali ke Daftar">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <span class="badge bg-light text-muted border px-3 py-1 rounded-pill mb-1 fw-semibold" style="font-size: 11px;">
                    <i class="bi bi-receipt text-warning me-1"></i> Point of Sales Management
                </span>
                <h2 class="page-title mb-0">
                    Detail Transaksi <span class="text-muted fw-normal fs-5">#{{ $penjualan->nomor_faktur ?? $penjualan->kode_transaksi ?? $penjualan->id }}</span>
                </h2>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button onclick="window.print()" class="btn btn-maison-pro d-inline-flex align-items-center gap-2">
                <i class="bi bi-printer-fill fs-5"></i>
                <span>Cetak Struk / Faktur</span>
            </button>
        </div>
    </div>

    <!-- Main Invoice Card Container -->
    <div class="maison-pro-card mb-4">
        
        <!-- Header Faktur dengan Tema Maison Brown -->
        <div class="p-4 p-md-5 text-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4" style="background: linear-gradient(135deg, var(--maison-brown-dark) 0%, var(--maison-brown) 100%);">
            <div>
                <div class="mb-2">
                    @if(strtolower($penjualan->status ?? 'completed') === 'pending' || strtolower($penjualan->status ?? '') === 'open')
                        <span class="badge-pro-open bg-white text-warning">
                            <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> OPEN
                        </span>
                    @else
                        <span class="badge bg-white text-success px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                            <i class="bi bi-check-circle-fill me-1"></i> COMPLETED
                        </span>
                    @endif
                </div>
                <h3 class="fw-bold mb-1 text-white">FAKTUR PENJUALAN</h3>
                <p class="text-white-50 small mb-0 font-monospace">No. Referensi: #{{ $penjualan->nomor_faktur ?? $penjualan->kode_transaksi ?? $penjualan->id }}</p>
            </div>
            <div class="text-md-end border-top border-white-50 pt-3 pt-md-0">
                <span class="text-white-50 small text-uppercase fw-semibold d-block mb-1">Total Pembayaran</span>
                <h2 class="fw-extrabold text-white mb-0 font-monospace" style="letter-spacing: -0.5px;">
                    Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <!-- Meta Information Cards Grid -->
        <div class="p-4 p-md-5 bg-white border-bottom border-light">
            <div class="row g-4">
                <!-- Tanggal & Waktu -->
                <div class="col-md-4">
                    <div class="stat-card h-100 d-flex align-items-start gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Tanggal & Waktu</span>
                            <span class="fw-bold text-dark">
                                {{ isset($penjualan->created_at) ? \Carbon\Carbon::parse($penjualan->created_at)->translatedFormat('d M Y, H:i') : '-' }} WIB
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kasir Bertugas -->
                <div class="col-md-4">
                    <div class="stat-card h-100 d-flex align-items-start gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Kasir Bertugas</span>
                            <span class="fw-bold text-dark">
                                {{ $penjualan->user->name ?? $penjualan->kasir->name ?? 'Kasir System' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="col-md-4">
                    <div class="stat-card h-100 d-flex align-items-start gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Metode Pembayaran</span>
                            <span class="badge-pro-method text-uppercase d-inline-block mt-1">
                                {{ $penjualan->metode_pembayaran ?? 'CASH' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Data Table for Items -->
        <div class="table-responsive m-0">
            <table class="table mb-0 align-middle">
                <thead class="table-pro-header">
                    <tr>
                        <th class="ps-4 text-center" style="width: 60px;">No</th>
                        <th>Deskripsi Produk</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-center" style="width: 100px;">QTY</th>
                        <th class="text-end pe-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualan->itemPenjualan ?? $penjualan->details ?? [] as $index => $item)
                        <tr class="table-pro-row">
                            <td class="ps-4 text-center text-muted fw-bold font-monospace">
                                {{ $index + 1 }}
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block">
                                    {{ $item->produk->nama ?? $item->produk->nama_produk ?? $item->produk->nama_barang ?? $item->nama_produk ?? 'Produk Dihapus' }}
                                </span>
                                @if(isset($item->produk->kode_produk) || isset($item->kode_produk))
                                    <span class="text-muted small font-monospace">
                                        SKU: {{ $item->produk->kode_produk ?? $item->kode_produk }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-end font-monospace text-secondary">
                                Rp {{ number_format($item->harga_satuan ?? $item->harga ?? $item->harga_jual ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <span class="badge px-3 py-1.5 rounded-pill fw-bold" style="background-color: var(--maison-brown-light); color: var(--maison-brown-dark);">
                                    {{ $item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0 }}
                                </span>
                            </td>
                            <td class="text-end pe-4 font-monospace fw-bold text-dark">
                                Rp {{ number_format($item->subtotal ?? (($item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0) * ($item->harga_satuan ?? $item->harga ?? 0)), 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-box-seam fs-1 text-muted opacity-50 mb-2 d-block"></i>
                                    <p class="text-muted small mb-0">Tidak ada detail item transaksi ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Summary / Footer Breakdown -->
        <div class="p-4 p-md-5 bg-white border-top border-light d-flex flex-column flex-md-row justify-content-between align-items-start gap-4">
            <div class="text-muted small max-w-sm">
                <p class="fw-bold text-dark mb-1"><i class="bi bi-info-circle me-1"></i> Catatan Transaksi:</p>
                <p class="mb-0">Terima kasih atas kunjungan Anda. Faktur ini merupakan bukti transaksi yang sah dan dicetak secara otomatis oleh sistem keamanan Maison.</p>
            </div>

            <div class="w-100" style="max-width: 360px;">
                <div class="p-4 rounded-3 border bg-light">
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>Subtotal Produk</span>
                        <span class="font-monospace fw-semibold text-dark">
                            Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    @if(isset($penjualan->bayar))
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Tunai / Bayar</span>
                            <span class="font-monospace fw-semibold text-dark">
                                Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    @if(isset($penjualan->kembali))
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Kembalian</span>
                            <span class="font-monospace fw-semibold text-dark">
                                Rp {{ number_format($penjualan->kembali, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold text-dark">Total Akhir</span>
                        <span class="fs-5 fw-extrabold font-monospace text-success">
                            Rp {{ number_format($penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection