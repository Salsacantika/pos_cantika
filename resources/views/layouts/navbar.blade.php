{{-- CDN Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- Sidebar Container --}}
<aside class="sidebar-maison d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm">
    
    {{-- Brand / Logo --}}
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 me-md-auto text-decoration-none px-2 pt-2">
        <span class="brand-text fs-4 fw-bold">Maison</span>
        <span class="brand-sub fs-5 ms-1 fw-normal">POS</span>
    </a>

    <hr class="my-2 border-secondary-subtle">

    {{-- Nav Links --}}
    <ul class="nav nav-pills flex-column mb-auto gap-1 mt-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link py-2 px-3 rounded-3 fw-medium d-flex align-items-center {{ Request::is('dashboard*') ? 'active-link' : 'custom-link' }}">
                <i class="bi bi-grid-1x2-fill me-2 fs-5"></i> Dashboard
            </a>
        </li>

        @can('viewAny', App\Models\User::class)
        <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link py-2 px-3 rounded-3 fw-medium d-flex align-items-center {{ Request::is('admin/users*') ? 'active-link' : 'custom-link' }}">
                <i class="bi bi-people-fill me-2 fs-5"></i> Users
            </a>
        </li>
        @endcan

        <li class="nav-item">
            <a href="{{ route('produk.index') }}" class="nav-link py-2 px-3 rounded-3 fw-medium d-flex align-items-center {{ Request::is('produk*') ? 'active-link' : 'custom-link' }}">
                <i class="bi bi-box-seam-fill me-2 fs-5"></i> Produk
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('penjualan.index') }}" class="nav-link py-2 px-3 rounded-3 fw-medium d-flex align-items-center {{ Request::is('penjualan*') ? 'active-link' : 'custom-link' }}">
                <i class="bi bi-receipt me-2 fs-5"></i> Penjualan
            </a>
        </li>
    </ul>

    <hr class="my-3 border-secondary-subtle">

    {{-- User Profile & Logout (Bottom) --}}
    <div class="pt-2">
        @auth
            <div class="mb-3 px-2">
                <div class="fw-semibold user-name small">{{ Auth::user()->name }}</div>
                <div class="user-role" style="font-size: 0.75rem;">
                    {{ is_string(Auth::user()->role) ? Auth::user()->role : (Auth::user()->role->name ?? 'Staff') }}
                </div>
            </div>
        @endauth

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-logout w-100 py-2 rounded-3 text-center d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- Styling Khusus Sidebar --}}
<style>
    /* Ukuran Fix Sidebar untuk Layar Laptop/Desktop */
    .sidebar-maison {
        width: 260px;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    /* Brand Style */
    .brand-text {
        color: #332b27;
        font-family: serif, 'Playfair Display', system-ui;
    }
    .brand-sub {
        color: #b37456;
    }

    /* Link Style */
    .custom-link {
        color: #6e645e !important;
        transition: all 0.2s ease;
    }
    .custom-link:hover {
        color: #332b27 !important;
        background-color: #faf5f0;
    }

    /* Active Link (Accent Warm Brown) */
    .active-link {
        background-color: #b37456 !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    /* User Profile Text */
    .user-name {
        color: #332b27;
    }
    .user-role {
        color: #8c8078;
    }

    /* Logout Button */
    .btn-logout {
        border: 1px solid #d4c5bb;
        color: #6e645e;
        background-color: #ffffff;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-logout:hover {
        background-color: #faf5f0;
        color: #b37456;
        border-color: #b37456;
    }

    /* Responsif untuk Layar HP/Tablet (<992px) */
    @media (max-width: 991.98px) {
        .sidebar-maison {
            width: 100%;
            position: relative;
            min-height: auto;
        }
    }
</style>