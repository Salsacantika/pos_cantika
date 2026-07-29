@extends('layouts.app')

@section('title', 'Manajemen Pengguna Eksekutif')

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

    /* Avatar Mewah */
    .lux-avatar {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--lux-gold-light) 0%, #f4ebd0 100%);
        color: var(--lux-primary);
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ebd6b5;
        box-shadow: 0 4px 10px rgba(197, 160, 89, 0.15);
    }

    /* Role Badge Eksklusif */
    .lux-role-badge {
        background-color: var(--lux-gold-light);
        color: var(--lux-primary);
        border: 1px solid #ebd6b5;
        font-size: 11px;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    /* Aksi Tombol */
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
</style>

<div class="container-fluid py-4 px-lg-4">
    
    {{-- Header Section --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="page-title mb-1 fw-bold m-0 fs-3" style="color: #a26b4e !important;">
                <i class="bi bi-people-fill me-2" style="color: #a26b4e;"></i>Manajemen Pengguna Eksekutif
            </h2>
            <p class="text-muted small m-0">Kelola akun pengguna, peran, dan hak akses tingkat lanjut dalam satu kendali.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            {{-- Fitur Jumlah User --}}
            <div class="bg-white border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2" style="border-color: var(--lux-border) !important;">
                <span class="badge rounded-circle p-2 d-flex align-items-center justify-content-center" style="background-color: var(--lux-gold-light); color: var(--lux-primary); width: 28px; height: 28px;">
                    <i class="bi bi-person-badge fs-6"></i>
                </span>
                <div style="font-size: 12px;" class="pe-1">
                    <span class="text-muted d-block" style="font-size: 10px; line-height: 1;">Total User</span>
                    <span class="fw-bold text-dark fs-6">{{ method_exists($users, 'total') ? $users->total() : $users->count() }}</span>
                </div>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-lux-primary px-4 py-2 rounded-pill d-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-person-plus-fill fs-5"></i>
                <span>Tambah Pengguna</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 py-3" role="alert" style="background-color: #f0fdf4; color: #166534; border-left: 5px solid #22c55e !important;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span class="fw-semibold">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 py-3" role="alert" style="background-color: #fef2f2; color: #991b1b; border-left: 5px solid #ef4444 !important;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <span class="fw-semibold">{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Main Container --}}
    <div class="card lux-master-frame">
        
        {{-- Filter & Search Header --}}
        <div class="card-header bg-white pt-4 pb-3 border-0 px-4">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    <div class="col-md-5 col-12">
                        <span class="fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px; color: var(--lux-primary);">
                            <i class="bi bi-shield-lock me-1"></i> Daftar Akses Pengguna Terdaftar
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
                                placeholder="Cari nama atau email..."
                                onkeyup="this.form.submit()"
                                style="font-size: 13.5px;"
                            >
                            @if(request('search'))
                                <a href="{{ route('admin.users') }}" class="btn btn-light border-0 d-flex align-items-center px-3 text-muted" title="Reset">
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
                        <th class="ps-4 py-3" style="width: 60px;">#</th>
                        <th class="py-3">Pengguna</th>
                        <th class="py-3">Email Sistem</th>
                        <th class="py-3">Peran Akses</th>
                        <th class="text-end pe-4 py-3" style="width: 180px;">Aksi Keamanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-4 text-muted fw-bold">{{ $users->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 py-1">
                                <div class="lux-avatar flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <span class="fw-bold text-dark text-truncate d-block">{{ $user->name }}</span>
                                    <span class="text-muted" style="font-size: 11.5px;">Terdaftar di sistem</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary fw-medium small">{{ $user->email }}</span>
                        </td>
                        <td>
                            @php
                                $roleName = is_string($user->role) ? $user->role : ($user->role->name ?? 'Staff');
                            @endphp
                            <span class="badge lux-role-badge rounded-pill px-3 py-2">
                                <i class="bi bi-shield-check me-1"></i> {{ ucfirst($roleName) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-lux-edit btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" title="Edit Akun">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit</span>
                                </a>
                                
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lux-delete btn-sm rounded-pill px-3 py-1 d-flex align-items-center gap-1 shadow-sm" onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')" title="Hapus User">
                                        <i class="bi bi-trash3"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <div class="my-5">
                                <i class="bi bi-people fs-1 text-secondary opacity-50 d-block mb-3"></i>
                                <h5 class="fw-bold text-secondary">Tidak Ada Data Pengguna</h5>
                                <p class="small text-muted mb-0">Belum ada akun pengguna yang sesuai dengan kriteria pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if($users->hasPages())
        <div class="card-footer bg-white py-3 border-0 d-flex justify-content-center" style="border-top: 1px solid var(--lux-border) !important;">
            {{ $users->links() }}
        </div>
        @endif

    </div>
</div>
@endsection