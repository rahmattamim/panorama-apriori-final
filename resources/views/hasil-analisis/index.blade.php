@extends('layouts.dashboard')

@section('content')

<h2>Hasil Analisis Apriori</h2>

@if($tanggal_awal && $tanggal_akhir)
<div class="alert alert-info">
    <strong>Periode Analisis:</strong>
    {{ \Carbon\Carbon::parse($tanggal_awal)->format('d M Y') }}
    s/d
    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d M Y') }}
</div>
@endif

<div class="alert alert-info">
        Total transaksi yang dianalisis: <b>{{ $jumlahTransaksi }}</b>
    </div>

    @if(count($rules))

        @php
            $terbaik = $rules[0];
        @endphp

        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Rekomendasi Utama
            </div>

            <div class="card-body">

                <h4>
                    {{ implode(', ', $terbaik['antecedent']) }}
                    →
                    {{ implode(', ', $terbaik['consequent']) }}
                </h4>

                <p class="mb-1">
                    <b>Support :</b> {{ number_format($terbaik['support'], 2) }}%
                </p>

                <p class="mb-0">
                    <b>Confidence :</b> {{ number_format($terbaik['confidence'], 2) }}%
                </p>

            </div>
        </div>

        <div class="card mb-4">

        <div class="card-header bg-success text-white">
            Kekuatan Rule (Confidence)
        </div>

        <div class="card-body">

            @foreach($rules as $rule)

                <div class="mb-3">

                    <div class="d-flex justify-content-between">
                        <span>
                            {{ implode(', ', $rule['antecedent']) }}
                            →
                            {{ implode(', ', $rule['consequent']) }}
                        </span>
                        <b>{{ round($rule['confidence'], 2) }}%</b>
                    </div>

                    <div class="progress" style="height:10px;">
                        <div class="progress-bar bg-success"
                            role="progressbar"
                            style="width: {{ round($rule['confidence'], 2) }}%;">
                        </div>
                    </div>

                </div>

            @endforeach

        </div>

    </div>

    <h4>Semua Association Rule</h4>


    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Jika Membeli</th>
                <th>Maka Cenderung Membeli</th>
                <th>Support</th>
                <th>Confidence</th>
            </tr>
        </thead>

        <tbody>

        @foreach($rules as $rule)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ implode(', ', $rule['antecedent']) }}</td>
                <td>{{ implode(', ', $rule['consequent']) }}</td>
                <td>{{ round($rule['support'], 2) }}%</td>
                <td><b>{{ round($rule['confidence'], 2) }}%</b></td>
            </tr>

        @endforeach

        </tbody>

    </table>

    <div class="mb-3">
        <a href="{{ route('hasil.pdf') }}" class="btn btn-danger">
            🖨 Cetak PDF
        </a>
    </div>

@else

    <div class="alert alert-warning">
        Tidak ada association rule yang memenuhi parameter.
    </div>

@endif

@endsection