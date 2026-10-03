@extends('layouts.dashboard')

@section('title','Master Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Master Barang</h2>

    <div>
        <a href="{{ route('master-barang.create') }}" class="btn btn-success">
            + Tambah Barang
        </a>

        {{--
        <form action="{{ route('master-barang.destroyAll') }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus SEMUA data barang? Data yang sudah dihapus tidak dapat dikembalikan.')">
            
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Hapus Semua
            </button>
        </form>
        --}}
    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered table-hover">

            <thead class="table-success">

                <tr>
                    <th width="60">No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th width="180">Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($barang as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_barang }}</td>

                <td>{{ $item->nama_barang }}</td>

                <td>{{ $item->kategori }}</td>

                <td>

                    <a href="{{ route('master-barang.edit', $item->id) }}"
                        class="btn btn-warning btn-sm me-1">
                        Edit
                    </a>

                    <form action="{{ route('master-barang.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus barang ini?')">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

            <td colspan="4" class="text-center">

            Belum ada data.

            </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection