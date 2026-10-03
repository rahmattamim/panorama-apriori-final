@extends('layouts.dashboard')

@vite(['resources/css/app.css','resources/js/app.js'])

@section('content')

<h2 class="mb-4">
    <i class="bi bi-speedometer2 text-success"></i> Dashboard
</h2>

<div class="row g-3">

    {{-- Total Barang --}}
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-circle bg-success-subtle">
                    <i class="bi bi-box-seam fs-2 text-success"></i>
                </div>

                <p class="text-muted mb-1">Total Barang</p>
                <h2 class="fw-bold">{{ $totalBarang }}</h2>
                <small class="text-secondary">Item</small>
            </div>
        </div>
    </div>

    {{-- Total Transaksi --}}
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-circle bg-primary-subtle">
                    <i class="bi bi-receipt fs-2 text-primary"></i>
                </div>

                <p class="text-muted mb-1">Total Transaksi</p>
                <h2 class="fw-bold">{{ $totalTransaksi }}</h2>
                <small class="text-secondary">Nota</small>
            </div>
        </div>
    </div>

    {{-- Support --}}
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-circle bg-warning-subtle">
                    <i class="bi bi-percent fs-2 text-warning"></i>
                </div>

                <p class="text-muted mb-1">Minimum Support</p>
                <h2 class="fw-bold">{{ $parameter->min_support }}%</h2>
                <small class="text-secondary">Parameter</small>
            </div>
        </div>
    </div>

    {{-- Confidence --}}
    <div class="col-md-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="icon-circle bg-danger-subtle">
                    <i class="bi bi-shield-check fs-2 text-danger"></i>
                </div>

                <p class="text-muted mb-1">Minimum Confidence</p>
                <h2 class="fw-bold">{{ $parameter->min_confidence }}%</h2>
                <small class="text-secondary">Parameter</small>
            </div>
        </div>
    </div>

</div>

{{-- Informasi Sistem --}}
<div class="card mt-4 info-panel">
    <div class="card-header bg-success text-white fw-semibold">
        <i class="bi bi-info-circle me-2"></i> Informasi Sistem
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">
                <div class="info-item">
                    <i class="bi bi-box text-success"></i>
                    <div>
                        <small>Total Barang</small>
                        <h5>{{ $totalBarang }}</h5>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-receipt text-primary"></i>
                    <div>
                        <small>Total Transaksi</small>
                        <h5>{{ $totalTransaksi }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <i class="bi bi-percent text-warning"></i>
                    <div>
                        <small>Support Minimum</small>
                        <h5>{{ $parameter->min_support }}%</h5>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-shield-check text-danger"></i>
                    <div>
                        <small>Confidence Minimum</small>
                        <h5>{{ $parameter->min_confidence }}%</h5>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection