<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Maison POS')</title>

    {{-- Bootstrap Icons (Untuk Icon Menu Sidebar) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- SweetAlert2 CDN untuk Notifikasi AI / Custom Modal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <div class="d-flex flex-column flex-lg-row min-vh-100">
        {{-- Panggil Sidebar --}}
        @include('layouts.navbar')

        {{-- Konten Utama dengan Margin Kiri untuk Menyesuaikan Sidebar --}}
        <main class="main-content flex-grow-1 p-3 p-md-4">
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <style>
        /* Margin Kiri Khusus Layar Laptop/Desktop */
        @media (min-width: 992px) {
            .main-content {
                margin-left: 260px; /* Samakan dengan lebar .sidebar-maison */
            }
        }
    </style>
    <!-- Menu Dropdown Riwayat di Navbar -->
    {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarRiwayatDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-clock-history me-1"></i> Riwayat Penjualan
        </a>
        <ul class="dropdown-menu shadow-sm border-0 rounded-3 py-2" aria-labelledby="navbarRiwayatDropdown">
            <li>
                <a class="dropdown-item py-2 px-3 d-flex align-items-center gap-2" href="{{ route('penjualan.riwayat.harian') }}">
                    <i class="bi bi-calendar-day text-primary"></i> <span>Riwayat Harian</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item py-2 px-3 d-flex align-items-center gap-2" href="{{ route('penjualan.riwayat.bulanan') }}">
                    <i class="bi bi-calendar-month text-success"></i> <span>Riwayat Bulanan</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item py-2 px-3 d-flex align-items-center gap-2" href="{{ route('penjualan.riwayat.tahunan') }}">
                    <i class="bi bi-calendar-range text-warning"></i> <span>Riwayat Tahunan</span>
                </a>
        </li>
    </ul>
</li> --}}
  
</body>
</html>