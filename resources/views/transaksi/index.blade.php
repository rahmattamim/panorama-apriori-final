@extends('layouts.dashboard')

@section('content')

<h2>Data Transaksi</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="mb-3">
    <a href="{{ route('transaksi.create') }}" class="btn btn-success">
        + Tambah Transaksi
    </a>
    
    <form action="{{ route('transaksi.destroyAll') }}"
      method="POST"
      style="display:inline;"
      onsubmit="return confirm('Yakin mau menghapus SEMUA data transaksi? Data yang sudah dihapus tidak bisa dikembalikan.');">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        Hapus Semua
    </button>

</form>
</div>


<table class="table table-bordered">

    <thead>
        <tr>
            <th>No</th>
            <th>No. Nota</th>
            <th>Tanggal</th>
            <th>Barang Dibeli</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($transaksis as $transaksi)

            <tr>
                
                <td>{{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $loop->iteration }}</td>

                <td>
                    {{ $transaksi->no_nota }}
                </td>

                <td>
                    {{ $transaksi->tanggal }}
                </td>

                <td>
                    @foreach($transaksi->detailTransaksis as $detail)
                        {{ $detail->barang->nama_barang }}

                        @if(!$loop->last)
                            , 
                        @endif
                    @endforeach
                </td>

                <td>
                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            Hapus
                        </button>

                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data transaksi.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

{{-- Pagination --}}
<div class="d-flex justify-content-between align-items-center mt-3">
    <small class="text-muted">
        Menampilkan {{ $transaksis->firstItem() }}–{{ $transaksis->lastItem() }}
        dari {{ $transaksis->total() }} transaksi
    </small>

    {{ $transaksis->links('pagination::bootstrap-5') }}
</div>


@endsection