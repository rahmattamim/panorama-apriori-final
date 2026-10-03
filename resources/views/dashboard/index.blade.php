@extends('layouts.dashboard')

@section('title','Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-header mb-4">
    <h2>Dashboard</h2>
    <p>Ringkasan sistem analisis pola pembelian barang.</p>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-box-seam"></i>
            <span>Total Barang</span>
            <h3>{{ $totalBarang }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-receipt"></i>
            <span>Total Transaksi</span>
            <h3>{{ $totalTransaksi }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-percent"></i>
            <span>Min Support</span>
            <h3>{{ $parameter->min_support }}%</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-graph-up"></i>
            <span>Min Confidence</span>
            <h3>{{ $parameter->min_confidence }}%</h3>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-8 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Rule Terkuat
            </div>

            <div class="card-body">
                <h4 class="fw-bold">
                    {{ $ruleTerbaik['jika'] }} → {{ $ruleTerbaik['maka'] }}
                </h4>

                <p class="text-muted mb-4">
                    Pelanggan yang membeli <b>{{ $ruleTerbaik['jika'] }}</b>
                    cenderung membeli <b>{{ $ruleTerbaik['maka'] }}</b>.
                </p>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Support</span>
                    <b>{{ $ruleTerbaik['support'] }}%</b>
                </div>

                <div class="progress mb-3" style="height:8px;">
                    <div class="progress-bar bg-success"
                        style="width: {{ $ruleTerbaik['support'] }}%">
                    </div>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Confidence</span>
                    <b>{{ $ruleTerbaik['confidence'] }}%</b>
                </div>

                <div class="progress" style="height:8px;">
                    <div class="progress-bar bg-success"
                        style="width: {{ $ruleTerbaik['confidence'] }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Informasi
            </div>

            <div class="card-body">
                <p><b>User :</b> {{ Auth::user()->name }}</p>
                <p><b>Role :</b> {{ ucfirst(Auth::user()->role) }}</p>
                <hr>
                <p><b>Support :</b> {{ $parameter->min_support }}%</p>
                <p><b>Confidence :</b> {{ $parameter->min_confidence }}%</p>
            </div>
        </div>
    </div>

</div>
@endsection