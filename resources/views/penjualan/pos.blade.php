@extends('layouts.app')

@section('title', 'POS - Luxury Boutique Enterprise')

@section('content')
<style>
    :root {
        --lux-primary: #8e5b42;
        --lux-primary-hover: #734732;
        --lux-gold: #c5a059;
        --lux-gold-light: #fbf6ee;
        --lux-dark: #0f172a;
        --lux-card-bg: #ffffff;
        --lux-border: #eadbc8;
        --lux-shadow: 0 20px 40px -15px rgba(142, 91, 66, 0.08);
    }

    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .page-title {
        color: var(--lux-dark);
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .lux-master-frame {
        border: 1px solid var(--lux-border);
        border-radius: 24px;
        box-shadow: var(--lux-shadow);
        background: var(--lux-card-bg);
        overflow: hidden;
    }

    .lux-product-card {
        background: #ffffff;
        border: 1px solid #f1e6db;
        border-radius: 18px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .lux-product-card:hover {
        border-color: var(--lux-gold);
        transform: translateY(-6px);
        box-shadow: 0 15px 30px -10px rgba(197, 160, 89, 0.2);
    }
    .lux-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 9px;
        background: var(--lux-gold-light);
        color: var(--lux-primary);
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: 1px solid #ebd6b5;
    }
    .lux-badge-warning {
        background: #fff7e6;
        color: #a15c00;
        border: 1px solid #ffe1a3;
    }
    .lux-badge-danger {
        background: #fdecec;
        color: #b42318;
        border: 1px solid #f8c9c5;
    }
    .lux-product-card.is-out-of-stock {
        opacity: 0.65;
    }
    .lux-stock-note {
        font-size: 10.5px;
        font-weight: 700;
    }

    /* ===== VALIDASI STOK ===== */
    .qty-invalid {
        border: 1px solid #b42318 !important;
        background-color: #fdecec !important;
        color: #b42318 !important;
    }
    .stock-warning-row td {
        background: #fdecec;
        border-top: 0 !important;
        color: #b42318;
        font-size: 11px;
        font-weight: 700;
    }
    .catalog-warning {
        font-size: 10.5px;
        font-weight: 700;
        color: #b42318;
    }

    .btn-lux-primary {
        background: linear-gradient(135deg, #8e5b42 0%, #6d432f 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 0.3px;
        transition: all 0.25s ease;
    }
    .btn-lux-primary:hover {
        background: linear-gradient(135deg, #734732 0%, #523122 100%);
        color: #ffffff;
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(142, 91, 66, 0.25);
    }
    .btn-lux-primary:disabled {
        opacity: 0.55;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-lux-delete {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 50%;
        border: 1px solid #f8c9c5;
        background: #fdecec;
        color: #b42318;
        transition: all 0.2s ease;
    }
    .btn-lux-delete:hover:not(:disabled) {
        background: #b42318;
        color: #ffffff;
        border-color: #b42318;
    }
    .btn-lux-delete:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .lux-table-header {
        background-color: #faf6f0;
        color: #734732;
        font-weight: 800;
        font-size: 10.5px;
        letter-spacing: 1px;
        border-bottom: 2px solid #f1e6db;
    }

    .lux-receipt-box {
        background: linear-gradient(135deg, #faf6f0 0%, #f4ebd0 100%);
        border: 1px solid #ebd6b5;
        border-radius: 18px;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: #faf6f0;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background: #d4b595;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: var(--lux-primary);
    }
</style>

<div class="container-fluid py-4 px-lg-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="page-title mb-1 fs-3">
                <i class="bi bi-shop-window me-2" style="color: var(--lux-gold);"></i>Terminal Kasir Eksklusif
            </h2>
            <p class="text-muted small m-0">Sistem transaksi butik tingkat lanjut dengan keamanan dan presisi tinggi.</p>
        </div>
        <div>
            @if($sale->status === 'completed')
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-4 py-2 rounded-pill fw-bold">
                    <i class="bi bi-patch-check-fill me-1"></i> Transaksi Selesai (Secured)
                </span>
            @else
                <span class="badge px-4 py-2 rounded-pill fw-bold" style="background-color: var(--lux-gold-light); color: var(--lux-primary); border: 1px solid #ebd6b5;">
                    <i class="bi bi-shield-lock-fill me-1"></i> Status: Sesi Aktif (Boutique Open)
                </span>
            @endif
        </div>
    </div>

    <!-- Layout Utama POS -->
    <div class="row g-4">

        {{-- ==================== KATALOG PRODUK (KIRI) ==================== --}}
        <div class="col-lg-7">
            <div class="card lux-master-frame h-100">
                <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
                    <div class="d-flex flex-column gap-3">
                        <form method="GET" action="{{ route('penjualan.create') }}" id="form-search">
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden" style="border: 1px solid var(--lux-border);">
                                <span class="input-group-text bg-white border-0 ps-4 text-muted">
                                    <i class="bi bi-search" style="color: var(--lux-primary);"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       id="search-input"
                                       value="{{ request('search') }}"
                                       class="form-control border-0 shadow-none ps-2"
                                       placeholder="Cari koleksi produk eksklusif..."
                                       autocomplete="off"
                                       style="font-size: 14px;">
                                @if(request('search'))
                                    <a href="{{ route('penjualan.create') }}" class="btn btn-light border-0 d-flex align-items-center px-3 text-muted" title="Reset">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </form>

                        <div class="d-flex justify-content-between align-items-center px-1">
                            <span class="fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: var(--lux-primary);">
                                <i class="bi bi-collection me-1"></i> Katalog Koleksi Produk
                            </span>
                            <span class="text-muted" style="font-size: 11.5px;">Pilih kuantitas dan tambahkan ke keranjang</span>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 py-2 custom-scroll" style="max-height: 60vh; overflow-y: auto;">
                    <div class="row g-3">
                        @php
                            // Ambang batas "stok menipis"
                            $lowStockThreshold = 5;
                        @endphp
                        @forelse ($products as $product)
                            @php
                                $isOutOfStock = $product->stok <= 0;
                                $isLowStock = !$isOutOfStock && $product->stok <= $lowStockThreshold;
                            @endphp
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('itempenjualan.store') }}" class="lux-product-card p-3 h-100 d-flex flex-column justify-content-between {{ $isOutOfStock ? 'is-out-of-stock' : '' }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    @if ($isOutOfStock)
                                        <span class="lux-badge lux-badge-danger">Stok Habis</span>
                                    @elseif ($isLowStock)
                                        <span class="lux-badge lux-badge-warning">Stok Menipis</span>
                                    @else
                                        <span class="lux-badge">Ready Stock</span>
                                    @endif

                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="flex-shrink-0 bg-light p-1 rounded-3 border" style="border-color: #f1e6db !important;">
                                                <img src="{{ asset('storage/' . $product->foto) }}"
                                                     alt="{{ $product->nama }}"
                                                     class="rounded-2"
                                                     style="width: 58px; height: 58px; object-fit: cover;">
                                            </div>
                                            <div class="overflow-hidden pe-3">
                                                <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $product->nama }}">{{ $product->nama }}</h6>
                                                <div class="fw-bold" style="font-size: 14px; color: var(--lux-primary);">
                                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                                </div>
                                                @if ($isOutOfStock)
                                                    <div class="lux-stock-note text-danger mt-1">Stok: 0</div>
                                                @elseif ($isLowStock)
                                                    <div class="lux-stock-note" style="color: #a15c00;">Sisa stok: {{ $product->stok }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-center gap-2 pt-2 border-top" style="border-color: #f8fafc !important;">
                                            <div style="width: 75px;">
                                                {{-- VALIDASI STOK: data-stok dipakai JS untuk cek qty --}}
                                                <input type="number"
                                                       name="quantity"
                                                       value="1"
                                                       min="1"
                                                       data-stok="{{ $product->stok }}"
                                                       class="qty-catalog-input form-control form-control-sm text-center fw-bold rounded-pill bg-light border-0"
                                                       {{ ($sale->status === 'completed' || $isOutOfStock) ? 'readonly' : '' }}>
                                            </div>
                                            <div class="flex-grow-1">
                                                <button type="submit"
                                                        class="btn btn-lux-primary btn-sm w-100 rounded-pill py-1 d-flex align-items-center justify-content-center gap-1 shadow-sm"
                                                        {{ ($sale->status === 'completed' || $isOutOfStock) ? 'disabled' : '' }}
                                                        title="Tambah Item">
                                                    <i class="bi bi-bag-plus-fill"></i> {{ $isOutOfStock ? 'Habis' : 'Tambah' }}
                                                </button>
                                            </div>
                                        </div>
                                        {{-- Pesan peringatan stok (muncul lewat JS) --}}
                                        <div class="catalog-warning d-none mt-1 ps-1"></div>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="my-5">
                                    <i class="bi bi-inbox fs-1 text-secondary opacity-50 d-block mb-3"></i>
                                    <h5 class="fw-bold text-secondary">Koleksi Tidak Ditemukan</h5>
                                    <p class="small text-muted mb-0">Coba kata kunci pencarian yang lain.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== KERANJANG BELANJA (KANAN) ==================== --}}
        <div class="col-lg-5">
            <div class="card lux-master-frame h-100 d-flex flex-column">

                <!-- Header Keranjang -->
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between" style="border-color: var(--lux-border) !important;">
                    <h5 class="m-0 fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-bag-check fs-5" style="color: var(--lux-primary);"></i> Keranjang Belanja
                    </h5>
                    <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: var(--lux-gold-light); color: var(--lux-primary); border: 1px solid #ebd6b5;">
                        {{ $sale->itemPenjualan->count() }} Jenis Item
                    </span>
                </div>

                {{-- Tabel Item Keranjang --}}
                <div class="card-body p-0 custom-scroll flex-grow-1" style="max-height: 38vh; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="lux-table-header text-uppercase">
                                <tr>
                                    <th scope="col" class="ps-4 py-2">Produk</th>
                                    <th scope="col" class="py-2">Harga</th>
                                    <th scope="col" class="py-2 text-center" style="width: 75px;">Qty</th>
                                    <th scope="col" class="py-2">Subtotal</th>
                                    <th scope="col" class="text-center pe-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sale->itemPenjualan as $item)
                                    <tr>
                                        <td class="ps-4 py-3" style="max-width: 120px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="" class="rounded-2 border flex-shrink-0" style="width: 34px; height: 34px; object-fit: cover; border-color: #f1e6db !important;">
                                                <div class="overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate small" title="{{ $item->produk->nama }}">{{ $item->produk->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small text-muted">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}" class="form-update-qty">
                                                @csrf
                                                @method('PUT')
                                                {{-- VALIDASI STOK: onchange submit diganti JS (cek stok dulu baru submit) --}}
                                                <input type="number"
                                                       name="quantity"
                                                       value="{{ $item->kuantitas }}"
                                                       min="1"
                                                       data-stok="{{ $item->produk->stok }}"
                                                       data-warn="warn-item-{{ $item->id }}"
                                                       class="qty-cart-input form-control form-control-sm text-center fw-bold bg-light border-0 rounded-pill"
                                                       {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                                            </form>
                                        </td>
                                        <td class="fw-bold small" style="color: var(--lux-primary);">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>

                                        {{-- KOLOM AKSI: TOMBOL DELETE (selalu tampil) --}}
                                        <td class="text-center pe-4">
                                            <form method="POST"
                                                  action="{{ route('itempenjualan.destroy', $item->id) }}"
                                                  class="d-inline form-hapus-item">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn-lux-delete"
                                                        title="Hapus item"
                                                        {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- BARIS PERINGATAN STOK (tersembunyi, muncul jika qty > stok) --}}
                                    <tr id="warn-item-{{ $item->id }}" class="stock-warning-row d-none">
                                        <td colspan="5" class="ps-4 py-1">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            <span class="warning-text"></span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <div class="my-4">
                                                <i class="bi bi-bag-x fs-1 text-secondary opacity-25 d-block mb-2"></i>
                                                <p class="small text-muted mb-1 fw-semibold">Keranjang Belanja Masih Kosong</p>
                                                <p class="text-muted" style="font-size: 11px;">Silakan pilih produk mewah dari katalog di sebelah kiri.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Footer & Panel Checkout --}}
                <div class="card-footer bg-white p-4 border-top" style="border-color: var(--lux-border) !important;">

                    <!-- Panel Total & Diskon Otomatis -->
                    @php
                        $subtotalBelanja = $sale->itemPenjualan->sum('subtotal');
                        $diskonNominal = $subtotalBelanja > 1000000 ? $subtotalBelanja * 0.10 : 0;
                        $totalAkhir = $subtotalBelanja - $diskonNominal;
                    @endphp
                    <div class="lux-receipt-box p-3 mb-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small text-secondary fw-semibold">Subtotal</span>
                            <span class="small fw-bold text-dark" id="subtotal-text" data-subtotal="{{ (int) $subtotalBelanja }}">
                                Rp {{ number_format($subtotalBelanja, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom" style="border-color: #ebd6b5 !important;">
                            <span class="small text-secondary fw-semibold">Diskon 10% {!! $subtotalBelanja > 1000000 ? '<span class="badge bg-success text-white ms-1" style="font-size: 9px;">Aktif</span>' : '' !!}</span>
                            <span class="small fw-bold text-danger" id="diskon-text" data-diskon="{{ (int) $diskonNominal }}">
                                - Rp {{ number_format($diskonNominal, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block small fw-bold text-uppercase mb-1" style="font-size: 10px; color: var(--lux-primary); letter-spacing: 0.8px;">TOTAL PEMBAYARAN</span>
                                <span class="fw-bold fs-3 text-dark" id="total-tagihan-text" data-total="{{ (int) $totalAkhir }}">
                                    Rp {{ number_format($totalAkhir, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-end bg-white p-2 rounded-3 border shadow-sm" style="border-color: #ebd6b5 !important;">
                                <i class="bi bi-receipt-cutoff fs-3" style="color: var(--lux-gold);"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Form Checkout --}}
                    <form id="form-checkout"
                          method="POST"
                          action="{{ route('penjualan.update', $sale->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Metode Pembayaran</label>
                            <select name="payment_method"
                                    id="paymentMethodSelect"
                                    class="form-select rounded-pill border shadow-none bg-light py-2"
                                    required
                                    {{ $sale->status === 'completed' ? 'disabled' : '' }}
                                    style="border-color: var(--lux-border) !important;">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="CASH">CASH (Tunai)</option>
                                <option value="QRIS">QRIS</option>
                            </select>

                            <!-- Khusus CASH -->
                            <div id="cashContainer" class="d-none mt-3 p-3 border rounded bg-white shadow-sm">
                                <div class="mb-2">
                                    <label class="form-label small fw-bold text-secondary">Uang Tunai dari Pembeli (Rp)</label>
                                    <input type="number"
                                           id="inputUangBayar"
                                           class="form-control form-control-sm"
                                           min="0"
                                           placeholder="Contoh: 5000000">
                                </div>
                                <div class="small">
                                    <span class="fw-bold text-secondary">Kembalian: </span>
                                    <span id="textKembalian" class="fw-bold text-success">Rp 0</span>
                                </div>
                            </div>

                            <!-- Khusus QRIS -->
                            <div id="qrisImageContainer" class="d-none mt-3 text-center p-3 border rounded bg-white shadow-sm">
                                <p class="small fw-bold text-secondary mb-2">Scan QRIS untuk Pembayaran:</p>
                                <img src="{{ asset('images/qr.jpg') }}"
                                     alt="QRIS Code"
                                     style="width: 100%; max-width: 400px; height: auto; object-fit: contain;"
                                     class="mx-auto d-block">
                            </div>
                        </div>

                        <button type="submit"
                                id="btn-checkout"
                                class="btn btn-lux-primary w-100 py-2 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 {{ $sale->status === 'completed' ? 'disabled' : '' }}"
                                {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                            <i class="bi bi-shield-check fs-5"></i> Selesaikan Transaksi (Checkout)
                        </button>
                    </form>

                    {{-- Form Pembatalan Transaksi --}}
                    @can('delete', $sale)
                        <form method="POST"
                              action="{{ route('penjualan.destroy', $sale->id) }}"
                              onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')"
                              class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm w-100 rounded-pill border-0 text-danger py-1 {{ $sale->status === 'completed' ? 'disabled' : '' }}"
                                    style="font-size: 12px;"
                                    {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                                <i class="bi bi-x-circle me-1"></i> Batalkan Sesi Transaksi Ini
                            </button>
                        </form>
                    @endcan
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---------- Elemen ----------
        const totalEl        = document.getElementById('total-tagihan-text');
        let totalBelanja     = parseInt(totalEl ? totalEl.dataset.total : 0, 10) || 0;
        const paymentSelect  = document.getElementById('paymentMethodSelect');
        const cashContainer  = document.getElementById('cashContainer');
        const qrisContainer  = document.getElementById('qrisImageContainer');
        const inputBayar     = document.getElementById('inputUangBayar');
        const textKembalian  = document.getElementById('textKembalian');
        const checkoutForm   = document.getElementById('form-checkout');
        const btnCheckout    = document.getElementById('btn-checkout');
        const searchInput    = document.getElementById('search-input');
        const searchForm     = document.getElementById('form-search');
        const sudahSelesai   = @json($sale->status === 'completed');

        const formatRp = (n) => 'Rp ' + n.toLocaleString('id-ID');
        const hasSwal  = typeof Swal !== 'undefined';

        // ---------- Pencarian (debounce, tidak reload tiap ketikan) ----------
        if (searchInput && searchForm) {
            if (searchInput.value) {
                searchInput.focus();
                const len = searchInput.value.length;
                searchInput.setSelectionRange(len, len);
            }
            let searchTimer;
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => searchForm.submit(), 500);
            });
        }

        // ==========================================================
        //  VALIDASI STOK
        // ==========================================================
        const pesanStok = (stok) => `Jumlah melebihi sisa stok (tersisa ${stok})`;

        // ----- 1) Katalog (kiri): qty yang mau ditambahkan -----
        document.querySelectorAll('.qty-catalog-input').forEach(function (input) {
            const stok = parseInt(input.dataset.stok, 10) || 0;
            const form = input.closest('form');
            const warn = form.querySelector('.catalog-warning');

            function cekKatalog() {
                const qty  = parseInt(input.value, 10) || 0;
                const over = stok > 0 && qty > stok;

                input.setCustomValidity(over ? pesanStok(stok) : '');
                input.classList.toggle('qty-invalid', over);

                if (warn) {
                    warn.textContent = over ? pesanStok(stok) : '';
                    warn.classList.toggle('d-none', !over);
                }
            }

            input.addEventListener('input', cekKatalog);
            cekKatalog();
        });

        // ----- 2) Keranjang (kanan): qty item yang sudah ada -----
        function cekItemKeranjang(input) {
            const stok = parseInt(input.dataset.stok, 10) || 0;
            const qty  = parseInt(input.value, 10) || 0;
            const over = qty > stok;
            const warnRow = document.getElementById(input.dataset.warn);

            input.classList.toggle('qty-invalid', over);

            if (warnRow) {
                warnRow.classList.toggle('d-none', !over);
                const teks = warnRow.querySelector('.warning-text');
                if (teks) teks.textContent = pesanStok(stok);
            }
            return !over; // true = aman
        }

        function updateTombolCheckout() {
            if (sudahSelesai || !btnCheckout) return;
            const adaMelebihi = document.querySelectorAll('.qty-cart-input.qty-invalid').length > 0;
            btnCheckout.disabled = adaMelebihi;
            btnCheckout.title = adaMelebihi ? 'Ada item yang jumlahnya melebihi sisa stok' : '';
        }

        document.querySelectorAll('.qty-cart-input').forEach(function (input) {
            const form = input.closest('form');

            cekItemKeranjang(input);            

            input.addEventListener('input', function () {
                cekItemKeranjang(input);
                updateTombolCheckout();
            });

            input.addEventListener('change', function () {
                if (!(parseInt(input.value, 10) >= 1)) input.value = 1;

                if (cekItemKeranjang(input)) {
                    form.submit();
                } else {
                    updateTombolCheckout();
                    const stok = parseInt(input.dataset.stok, 10) || 0;
                    if (hasSwal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stok tidak cukup',
                            text: pesanStok(stok),
                            confirmButtonColor: '#8e5b42'
                        });
                    }
                }
            });

            form.addEventListener('submit', function (e) {
                if (!cekItemKeranjang(input)) {
                    e.preventDefault();
                    updateTombolCheckout();
                }
            });
        });

        updateTombolCheckout();

        // ---------- Metode pembayaran ----------
        function hitungKembalian() {
            if (!inputBayar || !textKembalian) return;
            const uangBayar = parseFloat(inputBayar.value) || 0;
            const kembalian = uangBayar - totalBelanja;

            if (kembalian >= 0) {
                textKembalian.innerText = formatRp(kembalian);
                textKembalian.classList.remove('text-danger');
                textKembalian.classList.add('text-success');
            } else {
                textKembalian.innerText = 'Uang kurang (' + formatRp(Math.abs(kembalian)) + ')';
                textKembalian.classList.remove('text-success');
                textKembalian.classList.add('text-danger');
            }
        }

        function handlePaymentChange() {
            const value = paymentSelect.value;
            cashContainer.classList.toggle('d-none', value !== 'CASH');
            qrisContainer.classList.toggle('d-none', value !== 'QRIS');
            if (value === 'CASH') hitungKembalian();
        }

        if (paymentSelect) {
            paymentSelect.addEventListener('change', handlePaymentChange);
            handlePaymentChange();
        }
        if (inputBayar) {
            inputBayar.addEventListener('input', hitungKembalian);
        }

        // ---------- Konfirmasi hapus item ----------
        document.querySelectorAll('.form-hapus-item').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (hasSwal) {
                    Swal.fire({
                        title: 'Hapus item?',
                        text: 'Item ini akan dihapus dari keranjang.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#b42318',
                        cancelButtonColor: '#737373',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        background: '#fcf8f5',
                        customClass: { popup: 'rounded-4 shadow-lg border' }
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                } else if (confirm('Hapus item ini dari keranjang?')) {
                    form.submit();
                }
            });
        });

        // ---------- Konfirmasi checkout ----------
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Validasi stok: blokir checkout kalau ada qty melebihi stok
                if (document.querySelectorAll('.qty-cart-input.qty-invalid').length > 0) {
                    if (hasSwal) {
                        Swal.fire({ icon: 'error', title: 'Stok tidak cukup', text: 'Ada item yang jumlahnya melebihi sisa stok. Perbaiki dulu jumlahnya.', confirmButtonColor: '#8e5b42' });
                    } else {
                        alert('Ada item yang jumlahnya melebihi sisa stok. Perbaiki dulu jumlahnya.');
                    }
                    return;
                }

                // Validasi keranjang kosong
                if (totalBelanja <= 0) {
                    if (hasSwal) {
                        Swal.fire({ icon: 'warning', title: 'Keranjang kosong', text: 'Tambahkan produk terlebih dahulu.', confirmButtonColor: '#8e5b42' });
                    } else {
                        alert('Keranjang masih kosong.');
                    }
                    return;
                }

                // Validasi uang tunai
                if (paymentSelect.value === 'CASH') {
                    const uangBayar = parseFloat(inputBayar.value) || 0;
                    if (uangBayar < totalBelanja) {
                        if (hasSwal) {
                            Swal.fire({ icon: 'error', title: 'Uang kurang', text: 'Uang tunai kurang dari total tagihan.', confirmButtonColor: '#8e5b42' });
                        } else {
                            alert('Uang tunai kurang dari total tagihan.');
                        }
                        inputBayar.focus();
                        return;
                    }
                }

                const totalTagihan = totalEl.innerText.trim();

                if (hasSwal) {
                    Swal.fire({
                        title: 'Konfirmasi Transaksi',
                        text: `Total tagihan pembayaran sebesar ${totalTagihan}. Lanjutkan proses checkout?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#8e5b42',
                        cancelButtonColor: '#737373',
                        confirmButtonText: 'Ya, Selesaikan!',
                        cancelButtonText: 'Batal',
                        background: '#fcf8f5',
                        color: '#1e1e1e',
                        customClass: { popup: 'rounded-4 shadow-lg border' }
                    }).then((result) => {
                        if (result.isConfirmed) checkoutForm.submit();
                    });
                } else if (confirm(`Total tagihan ${totalTagihan}. Lanjutkan checkout?`)) {
                    checkoutForm.submit();
                }
            });
        }
    });
</script>
@endsection