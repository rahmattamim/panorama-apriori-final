@extends('layouts.dashboard')

@section('content')

<h2>Hasil Proses Apriori</h2>

@if(isset($tanggal_awal) && isset($tanggal_akhir))
<div class="alert alert-success mt-3">
    <strong>Periode Analisis :</strong><br>
    {{ \Carbon\Carbon::parse($tanggal_awal)->format('d F Y') }}
    s/d
    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d F Y') }}
</div>
@endif

<p><strong>Jumlah Transaksi :</strong> {{ $jumlahTransaksi }} transaksi</p>

@if(isset($tanggal_awal))
<p><strong>Data yang Diproses :</strong>
    {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }}
    -
    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
</p>
@endif

<p>
    Minimum Support:
    <strong>{{ $parameter->min_support }}%</strong>
</p>

<p>
    Minimum Confidence:
    <strong>{{ $parameter->min_confidence }}%</strong>
</p>

<p>
    Minimal jumlah transaksi:
    <strong>{{ $minSupportCount }}</strong>
</p>

<hr>

<h4>Frequent Itemset</h4>

@foreach($hasilItemset as $level => $itemsets)

    <h5 class="mt-4">
        Frequent {{ $level }}-Itemset
    </h5>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Jumlah Transaksi</th>
                    <th>Support</th>
                </tr>
            </thead>

            <tbody>

                @php
                    $no = 1;
                @endphp

                @foreach($itemsets as $itemset)

                    <tr>

                        <td>
                            {{ $no++ }}
                        </td>

                        <td>
                            {{ implode(' , ', $itemset['items']) }}
                        </td>

                        <td>
                            {{ $itemset['count'] }}
                        </td>

                        <td>
                            {{ number_format($itemset['support'], 2) }}%
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endforeach

<hr>

<h4 class="mt-4">
    Association Rule
</h4>

@if(empty($rules))

    <div class="alert alert-warning">
        Belum ada association rule yang memenuhi
        minimum confidence {{ $parameter->min_confidence }}%.
    </div>

@else

    <div class="table-responsive">

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

                @php
                    $no = 1;
                @endphp

                @foreach($rules as $rule)

                    <tr>

                        <td>
                            {{ $no++ }}
                        </td>

                        <td>
                            {{ implode(' , ', $rule['antecedent']) }}
                        </td>

                        <td>
                            {{ implode(' , ', $rule['consequent']) }}
                        </td>

                        <td>
                            {{ number_format($rule['support'], 2) }}%
                        </td>

                        <td>
                            <strong>
                                {{ number_format($rule['confidence'], 2) }}%
                            </strong>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endif

<a href="{{ route('apriori.proses') }}"
   class="btn btn-secondary">

    Kembali

</a>

@endsection