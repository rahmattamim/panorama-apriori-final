@extends('layouts.dashboard')

@section('content')

<h2>Tambah Transaksi</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transaksi.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label>No. Nota</label>
        <input type="text"
               name="no_nota"
               class="form-control"
               value="{{ old('no_nota') }}"
               placeholder="Contoh: TRX001">
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date"
               name="tanggal"
               class="form-control"
               value="{{ old('tanggal') }}">
    </div>

    <div class="mb-3">
        <label>Barang yang Dibeli</label>

        <div class="border rounded p-3">

            @forelse($barangs as $barang)

                <div class="form-check mb-2">

                    <input class="form-check-input"
                           type="checkbox"
                           name="barang_id[]"
                           value="{{ $barang->id }}"
                           id="barang{{ $barang->id }}">

                    <label class="form-check-label"
                           for="barang{{ $barang->id }}">

                        {{ $barang->nama_barang }}

                    </label>

                </div>

            @empty

                <p class="text-muted mb-0">
                    Belum ada barang di Master Barang.
                </p>

            @endforelse

        </div>
    </div>

    <button type="submit" class="btn btn-success">
        Simpan Transaksi
    </button>

    <a href="{{ route('transaksi.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection