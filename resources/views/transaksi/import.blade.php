@extends('layouts.dashboard')

@section('content')

<h2>Import Data Transaksi</h2>

<p class="text-muted">
    Masukkan file Excel yang berisi data transaksi dari nota.
</p>

{{-- Menampilkan pesan error --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form upload Excel --}}
<form action="{{ route('transaksi.import.proses') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label class="form-label">File Excel</label>

        <input
            type="file"
            name="file"
            class="form-control"
            accept=".xlsx,.xls"
            required
        >

        <small class="text-muted">
            Format yang diperbolehkan: .xlsx atau .xls
        </small>
    </div>

    <button type="submit" class="btn btn-success">
        Import Data
    </button>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection