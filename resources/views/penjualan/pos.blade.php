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

    /* Master Frame High-End */
    .lux-master-frame {
        border: 1px solid var(--lux-border);
        border-radius: 24px;
        box-shadow: var(--lux-shadow);
        background: var(--lux-card-bg);
        overflow: hidden;
    }

    /* Produk Luxury Card */
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

    /* Tombol Luxury Primary */
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

    /* Custom Header Tabel */
    .lux-table-header {
        background-color: #faf6f0;
        color: #734732;
        font-weight: 800;
        font-size: 10.5px;
        letter-spacing: 1px;
        border-bottom: 2px solid #f1e6db;
    }

    /* Struk Resi Preview Mewah */
    .lux-receipt-box {
        background: linear-gradient(135deg, #faf6f0 0%, #f4ebd0 100%);
        border: 1px solid #ebd6b5;
        border-radius: 18px;
    }

    /* Scrollbar Halus */
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
    
    <!-- Header Tanpa Statistik Card -->
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

    <!-- Layout Utama POS (Kiri: Katalog, Kanan: Keranjang) -->
    <div class="row g-4">
        
        {{-- ==================== KATALOG PRODUK (KIRI) ==================== --}}
        <div class="col-lg-7">
            <div class="card lux-master-frame h-100">
                <!-- Search Bar Mewah -->
                <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
                    <div class="d-flex flex-column gap-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden" style="border: 1px solid var(--lux-border);">
                                <span class="input-group-text bg-white border-0 ps-4 text-muted">
                                    <i class="bi bi-search" style="color: var(--lux-primary);"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control border-0 shadow-none ps-2"
                                       placeholder="Cari koleksi produk eksklusif..."
                                       onkeyup="this.form.submit()"
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

                <!-- Grid Katalog Produk -->
                <div class="card-body px-4 py-2 custom-scroll" style="max-height: 60vh; overflow-y: auto;">
                    <div class="row g-3">
                        @forelse ($products as $product)
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('itempenjualan.store') }}" class="lux-product-card p-3 h-100 d-flex flex-column justify-content-between">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <span class="lux-badge">Ready Stock</span>

                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="flex-shrink-0 bg-light p-1 rounded-3 border" style="border-color: #f1e6db !important;">
                                                <img src="{{ asset('storage/'.$product->foto) }}"
                                                     alt="{{ $product->nama }}"
                                                     class="rounded-2"
                                                     style="width: 58px; height: 58px; object-fit: cover;">
                                            </div>
                                            <div class="overflow-hidden pe-3">
                                                <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $product->nama }}">{{ $product->nama }}</h6>
                                                <div class="fw-bold" style="font-size: 14px; color: var(--lux-primary);">
                                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 pt-2 border-top" style="border-color: #f8fafc !important;">
                                        <div style="width: 75px;">
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="1" 
                                                   min="1"
                                                   class="form-control form-control-sm text-center fw-bold rounded-pill bg-light border-0"
                                                   {{ $sale->status === 'completed' ? 'readonly' : '' }}>
                                        </div>
                                        <div class="flex-grow-1">
                                            <button type="submit" 
                                                    class="btn btn-lux-primary btn-sm w-100 rounded-pill py-1 d-flex align-items-center justify-content-center gap-1 shadow-sm"
                                                    {{ $sale->status === 'completed' ? 'disabled' : '' }}
                                                    title="Tambah Item">
                                                <i class="bi bi-bag-plus-fill"></i> Tambah
                                            </button>
                                        </div>
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
                                                <img src="{{ asset('storage/'.$item->produk->foto) }}" alt="" class="rounded-2 border flex-shrink-0" style="width: 34px; height: 34px; object-fit: cover; border-color: #f1e6db !important;">
                                                <div class="overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate small" title="{{ $item->produk->nama }}">{{ $item->produk->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small text-muted">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" 
                                                       name="quantity"
                                                       value="{{ $item->kuantitas }}"
                                                       min="1"
                                                       class="form-control form-control-sm text-center fw-bold bg-light border-0 rounded-pill" 
                                                       onchange="this.form.submit()"
                                                       {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                                            </form>
                                        </td>
                                        <td class="fw-bold small" style="color: var(--lux-primary);">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-center pe-4">
                                            @can('delete', $item)
                                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm text-danger border-0 bg-transparent p-1" 
                                                            onclick="return confirm('Hapus item ini dari keranjang?')"
                                                            title="Hapus"
                                                            {{ $sale->status === 'completed' ? 'disabled' : '' }}>
                                                        <i class="bi bi-trash3 fs-6"></i>
                                                    </button>
                                                </form>
                                            @endcan
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

                {{-- Footer & Panel Kalkulasi Checkout Mewah --}}
                <div class="card-footer bg-white p-4 border-top" style="border-color: var(--lux-border) !important;">
                    
                    <!-- Panel Resi Tagihan -->
                    <div class="lux-receipt-box p-3 mb-3 d-flex justify-content-between align-items-center shadow-sm">
                        <div>
                            <span class="d-block small fw-bold text-uppercase tracking-wider mb-1" style="font-size: 10px; color: var(--lux-primary); letter-spacing: 0.8px;">TOTAL TAGIHAN PEMBAYARAN</span>
                            <span class="fw-bold fs-3 text-dark" id="total-tagihan-text">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-end bg-white p-2 rounded-3 border shadow-sm" style="border-color: #ebd6b5 !important;">
                            <i class="bi bi-receipt-cutoff fs-3" style="color: var(--lux-gold);"></i>
                        </div>
                    </div>

                    {{-- Form Checkout Selesai dengan ID untuk SweetAlert2 --}}
                    <form id="form-checkout" 
                          method="POST" 
                          action="{{ route('penjualan.update', $sale->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary mb-1">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select rounded-pill border shadow-none bg-light py-2" required {{ $sale->status === 'completed' ? 'disabled' : '' }} style="border-color: var(--lux-border) !important;">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="CASH">CASH (Tunai)</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        <button type="submit" id="btn-checkout" class="btn btn-lux-primary w-100 py-2 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 {{ $sale->status === 'completed' ? 'disabled' : '' }}">
                            <i class="bi bi-shield-check fs-5"></i> Selesaikan Transaksi (Checkout)
                        </button>
                    </form>

                    {{-- Form Pembatalan Transaksi --}}
                    @can('delete', $sale)
                        <form method="POST" action="{{ route('penjualan.destroy', $sale->id) }}" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm w-100 rounded-pill border-0 text-danger py-1 {{ $sale->status === 'completed' ? 'disabled' : '' }}" style="font-size: 12px;">
                                <i class="bi bi-x-circle me-1"></i> Batalkan Sesi Transaksi Ini
                            </button>
                        </form>
                    @endcan
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Script SweetAlert2 untuk Konfirmasi Checkout --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutForm = document.getElementById('form-checkout');
        
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah form langsung submit

                let totalTagihan = document.getElementById('total-tagihan-text').innerText;

                Swal.fire({
                    title: 'Konfirmasi Transaksi',
                    text: `Total tagihan pembayaran sebesar ${totalTagihan}. Lanjutkan proses checkout?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#8e5b42', // Warna cokelat khas Maison POS
                    cancelButtonColor: '#737373',
                    confirmButtonText: 'Ya, Selesaikan!',
                    cancelButtonText: 'Batal',
                    background: '#fcf8f5',
                    color: '#1e1e1e',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        checkoutForm.submit(); // Lanjutkan submit form jika dikonfirmasi
                    }
                });
            });
        }
    });
</script>
@endsection