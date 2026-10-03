<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-light">

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="bg-success text-white vh-100 p-3" style="width:250px;">

        <h4 class="fw-bold text-center">TOKO PANORAMA</h4>
        <p class="text-center small">Apriori Analysis</p>

        <hr>

        {{-- Semua Role --}}
        <a href="{{ route('dashboard') }}"
           class="d-flex align-items-center text-white text-decoration-none mb-3">
            <i class="bi bi-house me-2"></i> Dashboard
        </a>

        {{-- Menu khusus OWNER --}}
        @if(Auth::user()->role == 'owner')

            <a href="{{ route('master-barang.index') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-box me-2"></i> Master Barang
            </a>

            <a href="{{ route('transaksi.import') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-upload me-2"></i> Import Data
            </a>

            <a href="{{ route('transaksi.index') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-receipt me-2"></i> Data Transaksi
            </a>

            <a href="{{ route('parameter-apriori.index') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-sliders me-2"></i> Parameter Apriori
            </a>

            <a href="{{ route('apriori.proses') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-cpu me-2"></i> Proses Apriori
            </a>

            <a href="{{ route('user.index') }}"
               class="d-flex align-items-center text-white text-decoration-none mb-3">
                <i class="bi bi-people me-2"></i> Kelola User
            </a>

        @endif

        {{-- Semua Role --}}
        <a href="{{ route('hasil.index') }}"
           class="d-flex align-items-center text-white text-decoration-none mb-3">
            <i class="bi bi-bar-chart me-2"></i> Hasil Analisis
        </a>

        <a href="{{ route('profile.edit') }}"
           class="d-flex align-items-center text-white text-decoration-none mb-3">
            <i class="bi bi-person me-2"></i> Profil
        </a>

        <hr>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-light btn-sm w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>

    </div>

    {{-- CONTENT --}}
    <div class="flex-grow-1">

        <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">
            <div>
                <h5 class="mb-0 fw-bold">Dashboard</h5>
                <small class="text-muted">
                    Sistem Analisis Pola Pembelian Barang
                </small>
            </div>

            <div class="ms-auto">
                <span class="fw-semibold">
                    Halo, {{ Auth::user()->name }}

                    @if(Auth::user()->role == 'owner')
                        <span class="badge bg-success ms-1">Owner</span>
                    @else
                        <span class="badge bg-primary ms-1">User</span>
                    @endif
                </span>
            </div>
        </nav>

        <div class="p-4">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>