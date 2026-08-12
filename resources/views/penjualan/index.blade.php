@extends('layouts.app')

@section('title', 'Penjualan')

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
        
        /* Variabel tambahan selaras dengan halaman users */
        --lux-primary: #8e5b42;
        --lux-gold-light: #fbf6ee;
    }

    /* Typography & Core */
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

    /* Summary Mini Cards */
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

    /* Advanced Search Bar */
    .pro-search-wrapper {
        position: relative;
    }

    .pro-search-input {
        background-color: var(--maison-brown-soft);
        border: 1px solid var(--maison-border);
        border-radius: 14px;
        padding: 12px 16px 12px 48px;
        font-size: 0.9rem;
        color: var(--maison-text-main);
        transition: all 0.25s ease;
    }

    .pro-search-input:focus {
        background-color: #ffffff;
        border-color: var(--maison-brown);
        box-shadow: 0 0 0 4px rgba(162, 107, 78, 0.12);
    }

    .pro-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--maison-brown);
        font-size: 1.1rem;
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

    /* Teks Bersih Tanpa Style Button/Badge */
    .clean-text-status {
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
    }

    .clean-text-method {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--maison-brown-dark);
    }

    /* Tombol Aksi */
    .btn-lux-view {
        background-color: #faf6f0;
        color: var(--maison-brown);
        border: 1px solid #ebd6b5;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-lux-view:hover {
        background-color: var(--maison-brown);
        color: #ffffff;
        border-color: var(--maison-brown);
    }

    /* Tombol Edit disamakan dengan style halaman users (Luxury Gold/Brown Soft) */
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

    .btn-lux-locked {
        background-color: #f1f5f9;
        color: #94a3b8;
        border: 1px solid #e2e8f0;
        font-weight: 600;
        cursor: not-allowed;
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    
    <!-- Top Header Layout -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="badge bg-light text-muted border px-3 py-1 rounded-pill mb-2 fw-semibold" style="font-size: 11px;">
                <i class="bi bi-shield-check text-success me-1"></i> Point of Sales Management
            </span>
            <h2 class="page-title mb-0">
                <i class="bi bi-receipt-cutoff me-2"></i>Halaman Penjualan
            </h2>
            <p class="text-muted small mb-0">Pantau transaksi real-time, status pembayaran, dan rekapitulasi kasir.</p>
        </div>

        @can('create', App\Models\Penjualan::class)
            <a href="{{ route('penjualan.create') }}" class="btn btn-maison-pro d-inline-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-plus-circle-fill fs-5"></i> 
                <span>Tambah Transaksi Baru</span>
            </a>
        @endcan
    </div>

    @php
        $completedCount = $sales->filter(fn($s) => strtolower($s->status) === 'completed')->count();
        $openCount = $sales->filter(fn($s) => strtolower($s->status) === 'pending' || strtolower($s->status) === 'open')->count();
    @endphp

    <!-- Quick Insights Mini Cards Grid -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Transaksi Selesai</span>
                    <h4 class="fw-bold mb-0 text-success">{{ $completedCount }} Data</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background-color: #fffbeb; color: #d97706;">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <span class="text-muted small d-block">Transaksi Open / Pending</span>
                    <h4 class="fw-bold mb-0 text-warning">{{ $openCount }} Data</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card Container -->
    <div class="maison-pro-card">
        
        <!-- Search & Control Toolbar -->
        <div class="p-4 border-bottom border-light bg-white">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="row align-items-center justify-content-between g-3">
                    <div class="col-md-6 col-lg-5">
                        <div class="pro-search-wrapper">
                            <i class="bi bi-search pro-search-icon"></i>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                class="form-control pro-search-input shadow-none" 
                                placeholder="Cari kode transaksi, kasir, atau data lain..."
                            >
                        </div>
                    </div>
                    <div class="col-md-auto d-flex gap-2">
                        <button type="submit" class="btn btn-dark px-4 rounded-3 fw-semibold py-2" style="background: var(--maison-brown-dark); border:none;">
                            Filter Data
                        </button>
                        @if(request('search'))
                            <a href="{{ route('penjualan.index') }}" class="btn btn-light border px-3 rounded-3 py-2 text-muted" title="Reset Pencarian">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Professional Data Table -->
        <div class="table-responsive m-0">
            <table class="table mb-0 align-middle">
                <thead class="table-pro-header">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Waktu Transaksi</th>
                        <th>Kasir Bertugas</th>
                        <th>Total Pembayaran</th>
                        <th>Metode Bayar</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr class="table-pro-row">
                            <td class="ps-4 text-muted fw-bold">
                                {{ ($sales->firstItem() + $loop->index) }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark">
                                    {{ $sale->created_at->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-muted d-flex align-items-center gap-1 mt-0.5" style="font-size: 11.5px;">
                                    <i class="bi bi-clock"></i> 
                                    <span>{{ $sale->created_at->translatedFormat('H:i:s') }} WIB</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 bg-light border rounded-pill text-dark small">
                                    <div class="rounded-circle bg-white border d-flex align-items-center justify-content-center" style="width: 22px; height: 22px;">
                                        <i class="bi bi-person text-secondary" style="font-size: 11px;"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $sale->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-extrabold fs-6 text-success" style="font-family: monospace; letter-spacing: -0.5px;">
                                    Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="clean-text-method text-uppercase">
                                    {{ $sale->metode_pembayaran }}
                                </span>
                            </td>
                            <td>
                                @if(strtolower($sale->status) === 'pending' || strtolower($sale->status) === 'open')
                                    <span class="clean-text-status text-warning">
                                        OPEN
                                    </span>
                                @else
                                    <span class="clean-text-status text-success">
                                        COMPLETED
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex justify-content-end align-items-center gap-2">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-lux-view btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" title="Lihat Detail Transaksi">
                                        <i class="bi bi-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    {{-- Tombol Edit --}}
                                    @can('update', $sale)
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-lux-edit btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>Edit</span>
                                        </a>
                                    @endcan

                                    {{-- Tombol Hapus dengan SweetAlert2 --}}
                                    @can('delete', $sale)
                                        @if(strtolower($sale->status) === 'pending' || strtolower($sale->status) === 'open')
                                            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" id="delete-sale-form-{{ $sale->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-lux-delete btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm border-0" onclick="confirmDeleteSale({{ $sale->id }})" title="Hapus Transaksi">
                                                    <i class="bi bi-trash3"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-lux-locked btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm"
                                                    onclick="Swal.fire({ title: 'Akses Dibatasi', text: 'Transaksi sudah selesai (COMPLETED) dan dikunci dari sistem keamanan.', icon: 'info', confirmButtonColor: '#8e5b42', customClass: { popup: 'rounded-4 shadow-lg border-0' } })" title="Terkunci">
                                                <i class="bi bi-lock-fill"></i>
                                                <span>Terkunci</span>
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-5">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: var(--maison-brown-soft);">
                                            <i class="bi bi-inbox fs-1" style="color: var(--maison-brown);"></i>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-dark">Arsip Transaksi Kosong</h4>
                                    <p class="text-muted small mb-0">Belum ada data penjualan tercatat atau kriteria pencarian tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modern Pagination Footer -->
        @if($sales->hasPages())
            <div class="p-4 bg-white border-top border-light d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="text-muted small">
                    Menampilkan halaman transaksi secara berkala
                </div>
                <div>
                    {{ $sales->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- SweetAlert2 CDN & Script Konfirmasi Custom Card untuk Penjualan --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDeleteSale(id) {
    Swal.fire({
        title: 'Hapus Transaksi?',
        text: 'Apakah Anda yakin ingin menghapus transaksi penjualan ini secara permanen?',
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
            document.getElementById('delete-sale-form-' + id).submit();
        }
    });
}
</script>
@endsection