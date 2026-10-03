@extends('layouts.dashboard')

@section('title','Tambah Barang')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Tambah Barang</h3>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('master-barang.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="form-select"
                        required>

                        <option value="">-- Pilih --</option>

                        <option value="Alat Jahit">
                            Alat Jahit
                        </option>

                        <option value="Seragam">
                            Seragam
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        class="form-control"
                        placeholder="Contoh: BJ001"
                        required>

                </div>

                <button class="btn btn-success">

                    Simpan

                </button>

                <a href="{{ route('master-barang.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection