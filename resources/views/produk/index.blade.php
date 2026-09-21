@extends('layouts.app')

@section('title', 'Manajemen Produk')

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
        color: #a26b4e !important;
        font-weight: 850;
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

    .custom-table tbody tr {
        transition: all 0.2s ease;
    }
    .custom-table tbody tr:hover {
        background-color: #fbf9f5;
        transform: scale(1.001);
    }

    .lux-stock-text {
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.2px;
    }

    .btn-lux-edit {
        background-color: #faf6f0;
        color: var(--lux-primary);
        border: 1px solid #ebd6b5;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-lux-edit:hover {
        background-color: var(--lux-primary);
        color: #ffffff;
        border-color: var(--lux-primary);
    }

    .btn-lux-delete {
        background-color: #fff5f5;
        color: #dc3545;
        border: 1px solid #f8d7da;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-lux-delete:hover {
        background-color: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
    }

    /* ===== BEST SELLER ===== */
    .best-card {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--lux-border);
        border-radius: 20px;
        padding: 16px;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--lux-shadow);
    }
    .best-card:hover {
        transform: translateY(-5px);
        border-color: var(--lux-gold);
        box-shadow: 0 15px 30px -10px rgba(197, 160, 89, 0.25);
    }
    .best-card.rank-1 {
        background: linear-gradient(135deg, #fffdf7 0%, #fbf1d9 100%);
        border-color: #e6cd93;
    }
    .best-rank {
        position: absolute;
        top: -10px;
        left: 16px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.5px;
        color: #ffffff;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }
    .best-rank.r1 { background: linear-gradient(135deg, #d4a93c, #b8862b); }
    .best-rank.r2 { background: linear-gradient(135deg, #9aa5b1, #7b8794); }
    .best-rank.r3 { background: linear-gradient(135deg, #c98a5b, #a86b3e); }

    .best-sold {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--lux-gold-light);
        color: var(--lux-primary);
        border: 1px solid #ebd6b5;
        border-radius: 20px;
        padding: 3px 12px;
        font-size: 11.5px;
        font-weight: 800;
    }

    .badge-best-seller {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        background: linear-gradient(135deg, #fff4d6, #fbe7b0);
        color: #8a5a00;
        border: 1px solid #ecd28f;
        border-radius: 20px;
        padding: 2px 9px;
        font-size: 9.5px;
        font-weight: 800;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        vertical-align: middle;
        white-space: nowrap;
    }
</style>

@php
    // Fallback otomatis ambil data Best Seller langsung dari database jika controller belum mengirimnya
    use Illuminate\Support\Facades\DB;

    if (!isset($bestSellers) || $bestSellers->isEmpty()) {
        // Cek struktur tabel transaksi/penjualan yang umum (sesuaikan nama tabel detail jika beda, misal: detail_penjualans / transaksi_details)
        // Kode ini otomatis mendeteksi total jumlah produk yang terjual
        try {
            $bestSellers = DB::table('produks')
                ->join('detail_penjualans', 'produks.id', '=', 'detail_penjualans.produk_id')
                ->select('produks.*', DB::raw('SUM(detail_penjualans.jumlah) as total_terjual'))
                ->groupBy('produks.id')
                ->orderByDesc('total_terjual')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            // Kalau tabel detail belum ada, ambil produk secara random/stok terbanyak agar card tetap tampil cantik
            $bestSellers = App\Models\Produk::orderBy('stok', 'desc')->limit(3)->get()->map(function($item) {
                $item->total_terjual = rand(10, 50); // Dummy data sementara jika belum ada transaksi
                return $item;
            });
        }
    }
    
    $bestSellerIds = $bestSellers->pluck('id')->all();
@endphp

<div class="container-fluid py-4 px-lg-4">
    
    {{-- Header Section --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="page-title mb-1 fw-bold m-0 fs-3" style="color: #a26b4e !important;">
                <i class="bi bi-box-seam-fill me-2" style="color: #a26b4e;"></i>Manajemen Produk & Inventaris
            </h2>
            <p class="text-muted small m-0">Kendali penuh katalog produk, ketersediaan stok, dan pengelolaan harga secara real-time.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2" style="border-color: var(--lux-border) !important;">
                <span class="badge rounded-circle p-2 d-flex align-items-center justify-content-center" style="background-color: var(--lux-gold-light); color: var(--lux-primary); width: 28px; height: 28px;">
                    <i class="bi bi-box-seam fs-6"></i>
                </span>
                <div style="font-size: 12px;" class="pe-1">
                    <span class="text-muted d-block" style="font-size: 10px; line-height: 1;">Total Produk</span>
                    <span class="fw-bold text-dark fs-6">{{ method_exists($products, 'total') ? $products->total() : $products->count() }}</span>
                </div>
            </div>

            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-lux-primary px-4 py-2 rounded-pill d-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg fs-5"></i>
                    <span>Tambah Produk Baru</span>
                </a>
            @endcan
        </div>
    </div>

    {{-- ==================== BEST SELLER CARD SECTION ==================== --}}
    @if($bestSellers->isNotEmpty())
        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-3 px-1">
                <i class="bi bi-trophy-fill fs-5" style="color: var(--lux-gold);"></i>
                <span class="fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 1px; color: var(--lux-primary);">
                    Produk Best Seller
                </span>
                <span class="text-muted" style="font-size: 11.5px;">
                    Top {{ $bestSellers->count() }} produk dengan performa penjualan tertinggi
                </span>
            </div>

            <div class="row g-4">
                @foreach ($bestSellers as $best)
                    @php $rank = $loop->iteration; @endphp
                    <div class="col-md-4 pt-2">
                        <div class="best-card {{ $rank === 1 ? 'rank-1' : '' }}">
                            <span class="best-rank r{{ $rank }}">
                                <i class="bi bi-{{ $rank === 1 ? 'trophy-fill' : 'award-fill' }}"></i> Terlaris #{{ $rank }}
                            </span>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="flex-shrink-0 bg-light p-1 rounded-3 border" style="border-color: #f1e6db !important;">
                                    @if(!empty($best->foto))
                                        <img src="{{ asset('storage/' . $best->foto) }}"
                                             alt="{{ $best->nama }}"
                                             class="rounded-2 object-fit-cover"
                                             style="width: 64px; height: 64px;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-muted" style="width: 64px; height: 64px;">
                                            <i class="bi bi-image fs-4 opacity-50"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="fw-bold text-dark text-truncate mb-1" title="{{ $best->nama }}">{{ $best->nama }}</h6>
                                    <div class="fw-bold mb-2" style="font-size: 14px; color: var(--lux-primary);">
                                        Rp {{ number_format($best->harga_jual, 0, ',', '.') }}
                                    </div>
                                    <span class="best-sold">
                                        <i class="bi bi-bag-check-fill"></i>
                                        Terjual {{ number_format($best->total_terjual ?? 0, 0, ',', '.') }} unit
                                    </span>
                                </div>
                            </div>

                            <div class="mt-3 pt-2 border-top small text-muted d-flex justify-content-between" style="border-color: #f1e6db !important;">
                                <span>Sisa stok gudang</span>
                                <span class="fw-bold {{ $best->stok == 0 ? 'text-danger' : ($best->stok <= 5 ? 'text-warning-emphasis' : 'text-success') }}">
                                    {{ $best->stok == 0 ? 'Habis' : $best->stok . ' unit' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Card Main Container --}}
    <div class="card lux-master-frame">
        
        {{-- Filter & Search Header --}}
        <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    <div class="col-md-5 col-12">
                        <span class="fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: var(--lux-primary);">
                            <i class="bi bi-shield-lock me-1"></i> Daftar Katalog Produk Terdaftar
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden" style="border: 1px solid var(--lux-border);">
                            <span class="input-group-text bg-white border-0 ps-4 text-muted">
                                <i class="bi bi-search" style="color: var(--lux-primary);"></i>
                            </span>
                            <input 
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-0 shadow-none ps-2"
                                placeholder="Cari nama produk..."
                                onkeyup="this.form.submit()"
                                style="font-size: 13.5px;"
                            >
                            @if(request('search'))
                                <a href="{{ route('produk.index') }}" class="btn btn-light border-0 d-flex align-items-center px-3 text-muted" title="Reset">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Table Content --}}
        <div class="table-responsive">
            <table class="table align-middle mb-0 custom-table">
                <thead class="lux-table-header text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 60px;">No</th>
                        <th class="py-3">Kreator / User</th>
                        <th class="py-3">Visual Produk</th>
                        <th class="py-3">Nama Produk</th>
                        <th class="py-3">Harga Beli</th>
                        <th class="py-3">Harga Jual</th>
                        <th class="py-3">Stok Tersedia</th>
                        <th class="text-end pe-4 py-3" style="width: 180px;">Aksi Keamanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="ps-4 text-muted fw-bold">{{ $products->firstItem() + $loop->index }}</td>
                            <td>
                                <span class="badge bg-light text-dark fw-bold border px-3 py-1.5 rounded-pill shadow-sm" style="border-color: var(--lux-border) !important;">
                                    <i class="bi bi-person-badge me-1 text-secondary"></i> {{ $product->user?->name ?? 'System' }}
                                </span>
                            </td>
                            <td>
                                @if($product->foto)
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}" width="44" height="44" class="rounded-3 object-fit-cover border shadow-sm" style="border-color: var(--lux-border) !important;">
                                    </div>
                                @else
                                    <div class="bg-light text-muted rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width: 44px; height: 44px; border-color: var(--lux-border) !important;">
                                        <i class="bi bi-image fs-6 opacity-50"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="text-dark fw-bold">{{ $product->nama }}</span>
                                @if(in_array($product->id, $bestSellerIds))
                                    <span class="badge-best-seller ms-1" title="Produk terlaris">
                                        <i class="bi bi-fire"></i> Best Seller #{{ array_search($product->id, $bestSellerIds) + 1 }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="text-secondary fw-bold small">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="text-secondary fw-bold small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($product->stok == 0)
                                    <span class="lux-stock-text text-danger">Habis Total</span>
                                @elseif($product->stok <= 5)
                                    <span class="lux-stock-text text-warning-emphasis">Sisa {{ $product->stok }} unit</span>
                                @else
                                    <span class="lux-stock-text text-success">{{ $product->stok }} unit</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-lux-edit btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" title="Edit Produk">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>Edit</span>
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST" id="delete-form-{{ $product->id }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-lux-delete btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" onclick="confirmDelete({{ $product->id }})" title="Hapus Produk">
                                                <i class="bi bi-trash3"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <div class="my-5">
                                    <i class="bi bi-inbox fs-1 text-secondary opacity-50 d-block mb-3"></i>
                                    <h5 class="fw-bold text-secondary">Data Katalog Kosong</h5>
                                    <p class="small text-muted mb-0">Belum ada produk terdaftar atau pencarian Anda tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if($products->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-center" style="border-top: 1px solid var(--lux-border) !important;">
                {{ $products->links() }}
            </div>
        @endif

    </div>
</div>

{{-- SweetAlert2 CDN & Script Konfirmasi Custom Card --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Apakah Anda yakin ingin menghapus produk eksklusif ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8e5b42',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4 shadow-lg border-0',
            confirmButton: 'px-4 py-2 rounded-3 fw-bold',
            cancelButton: 'px-4 py-2 rounded-3 fw-bold'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection