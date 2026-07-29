@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<style>
    :root {
        --lux-primary: #8e5b42;
        --lux-primary-hover: #734732;
        --lux-accent: #a26b4e;
        --lux-gold: #c5a059;
        --lux-gold-light: #fbf6ee;
        --lux-dark: #0f172a;
        --lux-card-bg: #ffffff;
        --lux-border: #eadbc8;
        --lux-shadow: 0 20px 40px -15px rgba(142, 91, 66, 0.08);
        --lux-shadow-hover: 0 25px 50px -12px rgba(142, 91, 66, 0.15);
    }

    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

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

    /* Luxury Table Design */
    .lux-table thead th {
        background-color: #faf6f0;
        color: #734732;
        font-weight: 800;
        font-size: 10.5px;
        letter-spacing: 1.2px;
        border-bottom: 2px solid #f1e6db;
        text-transform: uppercase;
        padding-top: 16px;
        padding-bottom: 16px;
    }
    .lux-table tbody tr {
        transition: all 0.2s ease;
    }
    .lux-table tbody tr:hover {
        background-color: #fbf9f5;
    }

    /* Luxury Input Group & Search */
    .lux-search-input {
        border-radius: 14px 0 0 14px !important;
        border: 1px solid var(--lux-border) !important;
        padding: 12px 18px !important;
        font-size: 13.5px;
        background-color: #fbf9f5 !important;
    }
    .lux-search-input:focus {
        background-color: #ffffff !important;
        border-color: var(--lux-accent) !important;
        box-shadow: 0 0 0 4px rgba(162, 107, 78, 0.1) !important;
    }
    .lux-search-btn {
        border-radius: 0 14px 14px 0 !important;
        background-color: var(--lux-accent) !important;
        border: 1px solid var(--lux-accent) !important;
        padding: 0 24px !important;
        font-weight: 700;
        font-size: 13.5px;
        transition: all 0.2s ease;
    }
    .lux-search-btn:hover {
        background-color: var(--lux-primary-hover) !important;
    }

    /* Action Buttons */
    .lux-btn-primary {
        background: linear-gradient(135deg, var(--lux-accent) 0%, var(--lux-primary-hover) 100%);
        border: none;
        border-radius: 14px;
        padding: 12px 24px;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(162, 107, 78, 0.25);
        transition: all 0.3s ease;
    }
    .lux-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(162, 107, 78, 0.35);
        color: #fff;
    }

    .lux-badge-pill {
        background: #ffffff;
        border: 1px solid var(--lux-border);
        box-shadow: 0 4px 12px rgba(142, 91, 66, 0.04);
        border-radius: 50rem;
    }

    .fw-extrabold { font-weight: 850 !important; }
    .fs-7 { font-size: 0.75rem !important; }
</style>

<div class="container-fluid py-4 px-lg-4">
    
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom" style="border-color: var(--lux-border) !important;">
        <div>
            <h2 class="page-title mb-1 fs-3">
                <i class="bi bi-box-seam-fill me-2" style="color: var(--lux-gold);"></i>Manajemen Produk & Inventaris
            </h2>
            <p class="text-secondary small m-0">Kendali penuh katalog produk, ketersediaan stok, dan pengelolaan harga secara real-time.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center gap-3">
            <div class="lux-badge-pill px-3 py-2 d-none d-sm-inline-flex align-items-center">
                <i class="bi bi-calendar-event me-2" style="color: var(--lux-accent);"></i>
                <span class="fw-bold text-dark small">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
            
            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn lux-btn-primary text-white d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg fs-6"></i> <span>Tambah Produk Baru</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card lux-card border-0 mb-4">
        
        <!-- Search Bar Header -->
        <div class="card-header bg-white p-4 border-0 pb-0">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group shadow-sm rounded-4 overflow-hidden" style="border: 1px solid var(--lux-border);">
                    <span class="input-group-text bg-white border-0 ps-4 text-muted">
                        <i class="bi bi-search fs-5"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 shadow-none lux-search-input"
                        placeholder="Cari nama produk berdasarkan katalog..."
                    >
                    <button class="btn lux-search-btn text-white" type="submit">
                        Cari Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Content -->
        <div class="card-body px-0 pt-4 pb-0">
            <div class="table-responsive">
                <table class="table lux-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">No</th>
                            <th scope="col">Kreator / User</th>
                            <th scope="col">Visual Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Stok Tersedia</th>
                            <th scope="col" class="text-center pe-4">Aksi Kontrol</th>
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
                                            <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}" width="52" height="52" class="rounded-4 object-fit-cover border shadow-sm" style="border-color: var(--lux-border) !important;">
                                        </div>
                                    @else
                                        <div class="bg-light text-muted rounded-4 d-flex align-items-center justify-content-center border shadow-sm" style="width: 52px; height: 52px; border-color: var(--lux-border) !important;">
                                            <i class="bi bi-image fs-5 opacity-50"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-extrabold text-dark fs-6">{{ $product->nama }}</div>
                                </td>
                                <td>
                                    <span class="text-secondary fw-semibold">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    <span class="fw-extrabold text-success fs-6">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    @if($product->stok == 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1.5 rounded-pill fw-extrabold">
                                            Habis Total
                                        </span>
                                    @elseif($product->stok <= 5)
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-3 py-1.5 rounded-pill fw-extrabold">
                                            Sisa {{ $product->stok }} unit
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success px-3 py-1.5 rounded-pill fw-extrabold">
                                            {{ $product->stok }} unit
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        @can('update', $product)
                                            <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm px-3 py-1.5 rounded-3 fw-bold border-0 shadow-sm" style="background-color: #fef9c3; color: #854d0e; transition: all 0.2s;">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm px-3 py-1.5 rounded-3 fw-bold border-0 shadow-sm" style="background-color: #fee2e2; color: #991b1b; transition: all 0.2s;" onclick="return confirm('Apakah Anda yakin ingin menghapus produk eksklusif ini?')">
                                                    <i class="bi bi-trash3 me-1"></i> Hapus
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
                                        <div class="lux-icon-box mx-auto mb-3" style="width: 70px; height: 70px; background-color: var(--lux-gold-light); color: var(--lux-accent); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; border: 1px solid #ebd6b5;">
                                            <i class="bi bi-inbox-fill"></i>
                                        </div>
                                        <h5 class="fw-extrabold text-dark">Data Katalog Kosong</h5>
                                        <p class="small text-muted mb-0">Belum ada produk terdaftar atau pencarian Anda tidak ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Footer -->
        @if($products->hasPages())
            <div class="card-footer bg-white py-4 px-4 border-0" style="border-top: 1px solid #f1e6db !important;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .bg-success-subtle { background-color: #dcfce7 !important; }
    .bg-warning-subtle { background-color: #fef9c3 !important; }
    .bg-danger-subtle { background-color: #fee2e2 !important; }
</style>
@endsection