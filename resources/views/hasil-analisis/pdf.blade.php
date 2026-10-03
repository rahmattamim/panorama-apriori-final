<!DOCTYPE html>
<html>
<head>
    <style>
        body{font-family:DejaVu Sans;font-size:12px;}
        table{width:100%;border-collapse:collapse;}
        th,td{border:1px solid #000;padding:6px;}
        th{background:#2e8b57;color:white;}
    </style>
</head>
<body>

<h2 style="text-align:center;">LAPORAN HASIL ANALISIS APRIORI</h2>
<h4 style="text-align:center;">
TOKO PANORAMA
</h4>

<hr>

<p><b>Tanggal Cetak :</b> {{ date('d-m-Y') }}</p>
<p><b>Minimum Support :</b> {{ $parameter->min_support }}%</p>
<p><b>Minimum Confidence :</b> {{ $parameter->min_confidence }}%</p>

<h2>LAPORAN HASIL ANALISIS APRIORI</h2>

<p>
    Periode Transaksi:
    <strong>
        {{ \Carbon\Carbon::parse($tanggal_awal)->format('d-m-Y') }}
        sampai
        {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d-m-Y') }}
    </strong>
</p>

<p>Minimum Support : {{ $parameter->min_support }}%</p>
<p>Minimum Confidence : {{ $parameter->min_confidence }}%</p>

<table>
    <tr>
        <th>No</th>
        <th>Jika Membeli</th>
        <th>Maka Membeli</th>
        <th>Support</th>
        <th>Confidence</th>
    </tr>

    @foreach($rules as $i => $r)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ implode(', ', $r['antecedent']) }}</td>
        <td>{{ implode(', ', $r['consequent']) }}</td>
        <td>{{ number_format($r['support'], 2) }}%</td>
        <td>{{ number_format($r['confidence'], 2) }}%</td>
    </tr>
    @endforeach

</table>

<br><br>

<div style="width:100%; text-align:right;">
    Tangerang, {{ date('d-m-Y') }}<br><br><br><br>

    <b>Owner Toko Panorama</b>
</div>

</body>
</html>