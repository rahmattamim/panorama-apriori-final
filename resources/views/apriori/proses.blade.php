@extends('layouts.dashboard')

@section('content')

<h2>Proses Apriori</h2>

<p class="text-muted">
    Jalankan proses analisis pola pembelian berdasarkan data transaksi.
</p>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-body">

        <h5>Parameter yang digunakan</h5>

        <table class="table table-bordered">
            <tr>
                <th width="250">Minimum Support</th>
                <td>{{ $parameter->min_support ?? 0 }}%</td>
            </tr>

            <tr>
                <th>Minimum Confidence</th>
                <td>{{ $parameter->min_confidence ?? 0 }}%</td>
            </tr>

            <tr>
                <th>Jumlah Transaksi</th>
                <td>{{ $jumlahTransaksi }} transaksi</td>
            </tr>
        </table>

        <hr>

        <h5>Pilih Data Transaksi</h5>

        <p class="text-muted">
            Pilih apakah analisis dilakukan pada seluruh transaksi atau
            berdasarkan rentang tanggal tertentu.
        </p>

        
        {{-- SEMUA TRANSAKSI --}}
        

        <div class="card mb-3">
            <div class="card-body">

                <h6 class="fw-bold">
                    Semua Transaksi
                </h6>

                <p class="text-muted mb-3">
                    Menganalisis seluruh data transaksi yang tersedia.
                </p>

                <form action="{{ route('apriori.proses.semua') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Proses Semua Transaksi
                    </button>
                </form>

            </div>
        </div>


        {{-- Per PERIODE --}}


        <div class="card">
            <div class="card-body">

                <h6 class="fw-bold">
                    Berdasarkan Periode
                </h6>

                <p class="text-muted mb-3">
                    Pilih rentang tanggal transaksi yang ingin dianalisis.
                </p>

                <form action="{{ route('apriori.proses') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-4">
                            <label class="form-label">
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal_awal"
                                class="form-control"
                                value="{{ $tanggal_awal }}"
                                required>
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal_akhir"
                                class="form-control"
                                value="{{ $tanggal_akhir }}"
                                required>
                        </div>


                        <div class="col-md-4 d-flex align-items-end">

                            <button
                                type="submit"
                                class="btn btn-success w-100">
                                Proses Berdasarkan Periode
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection