@extends('layouts.landing')

@section('title', 'Beranda')

@section('content')

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="#beranda">
            TOKO PANORAMA
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#fitur">Fitur</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#panduan">Panduan</a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="{{ route('login') }}" class="btn btn-success px-4">
                        Login
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Hero --}}
<section id="beranda" class="container py-5" style="margin-top:90px;">
    <div class="row align-items-center">

        <div class="col-lg-6">
            <span class="badge bg-success mb-3">
                Data Mining • Apriori
            </span>

            <h1 class="display-4 fw-bold">
                Sistem Analisis Pola Pembelian Barang
            </h1>

            <p class="lead text-secondary mt-3">
                Website ini membantu pemilik Toko Panorama menganalisis pola
                pembelian barang alat jahit dan kebutuhan sekolah menggunakan
                algoritma Apriori berdasarkan data transaksi Microsoft Excel.
            </p>

            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                    Mulai Analisis
                </a>

                <a href="#tentang" class="btn btn-outline-success btn-lg ms-2">
                    Pelajari
                </a>
            </div>
        </div>

        <div class="col-lg-6 text-center">
            <AsyncImage query="data analysis dashboard illustration flat green" aspectRatio="1:1" maxWidth="420px"/>
        </div>

    </div>
</section>

{{-- Tentang --}}
<section id="tentang" class="py-5 bg-light">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">

                <h2 class="fw-bold text-success mb-3">
                    Tentang Sistem
                </h2>

                <p class="text-muted mb-4">
                    Sistem analisis pola pembelian berbasis algoritma Apriori.
                </p>

                <p>
                    Sistem ini dirancang untuk membantu pemilik Toko Panorama
                    menemukan hubungan antar barang yang sering dibeli secara
                    bersamaan berdasarkan data transaksi penjualan.
                </p>

                <p>
                    Hasil analisis berupa nilai <b>Support</b> dan
                    <b>Confidence</b> dapat digunakan sebagai dasar pengambilan
                    keputusan dalam penyusunan stok maupun strategi penjualan.
                </p>

                <div class="row mt-4">
                    <div class="col-4">
                        <h3 class="text-success fw-bold">75+</h3>
                        <small>Transaksi</small>
                    </div>

                    <div class="col-4">
                        <h3 class="text-success fw-bold">50+</h3>
                        <small>Barang</small>
                    </div>

                    <div class="col-4">
                        <h3 class="text-success fw-bold">Apriori</h3>
                        <small>Algoritma</small>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- Fitur --}}
<section id="fitur" class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-success">Fitur Utama</h2>
        <p class="text-muted">
            Seluruh proses analisis dilakukan secara otomatis.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-file-earmark-excel text-success fs-1"></i>
                </div>

                <h5>Import Excel</h5>

                <p class="text-muted">
                    Mengimpor data transaksi dari file Microsoft Excel dengan cepat.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-cpu text-success fs-1"></i>
                </div>

                <h5>Proses Apriori</h5>

                <p class="text-muted">
                    Menghitung Frequent Itemset serta Association Rule secara otomatis.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-bar-chart-line text-success fs-1"></i>
                </div>

                <h5>Hasil Analisis</h5>

                <p class="text-muted">
                    Menampilkan rekomendasi barang berdasarkan nilai Support dan Confidence.
                </p>
            </div>
        </div>

    </div>
</section>

{{-- Panduan --}}
<section id="panduan" class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-success">Panduan Penggunaan</h2>
            <p class="text-muted">
                Lima langkah sederhana menggunakan sistem.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <h1 class="text-success">1</h1>
                    <h5>Login</h5>
                    <p class="text-muted">Masuk menggunakan akun Owner atau User.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <h1 class="text-success">2</h1>
                    <h5>Import Data</h5>
                    <p class="text-muted">Unggah file transaksi Microsoft Excel.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <h1 class="text-success">3</h1>
                    <h5>Atur Parameter</h5>
                    <p class="text-muted">Masukkan nilai minimum Support dan Confidence.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <h1 class="text-success">4</h1>
                    <h5>Proses Apriori</h5>
                    <p class="text-muted">Jalankan algoritma untuk menghasilkan pola pembelian.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <h1 class="text-success">5</h1>
                    <h5>Lihat & Cetak Hasil</h5>
                    <p class="text-muted">Analisis rule terbaik dan unduh laporan PDF.</p>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- Footer --}}
<footer class="bg-success text-white py-3">
    <div class="container text-center">
        <small>
            © {{ date('Y') }} Toko Panorama | Rahmat Tamim • Sistem Analisis Apriori
        </small>
    </div>
</footer>

@endsection