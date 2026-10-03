@extends('layouts.dashboard')

@section('title','Edit Barang')

@section('content')

<h3 class="mb-4">Edit Barang</h3>

<div class="card shadow-sm">

    <div class="card-body">

        <form action="{{ route('master-barang.update',$masterBarang->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Kode Barang</label>

                <input type="text"
                       class="form-control"
                       name="kode_barang"
                       value="{{ $masterBarang->kode_barang }}">

            </div>

            <div class="mb-3">

                <label>Nama Barang</label>

                <input type="text"
                       class="form-control"
                       name="nama_barang"
                       value="{{ $masterBarang->nama_barang }}">

            </div>

            <div class="mb-3">

                <label>Kategori</label>

                <select class="form-select"
                        name="kategori">

                    <option value="Alat Jahit"
                        {{ $masterBarang->kategori=='Alat Jahit'?'selected':'' }}>
                        Alat Jahit
                    </option>

                    <option value="Seragam"
                        {{ $masterBarang->kategori=='Seragam'?'selected':'' }}>
                        Seragam
                    </option>

                </select>

            </div>

            <button class="btn btn-success">

                Update

            </button>

            <a href="{{ route('master-barang.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection