<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\ParameterApriori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilAnalisisController extends Controller
{
    public function index()
    {
        $rules = session('rules', []);
        $jumlahTransaksi = session('jumlahTransaksi', 0);
        $tanggalAwal = session('tanggal_awal');
        $tanggalAkhir = session('tanggal_akhir');

        return view('hasil-analisis.index', [
            'rules' => $rules,
            'jumlahTransaksi' => $jumlahTransaksi,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
        ]);
    }

    public function pdf()
    {
        $rules = session('rules', []);
        $parameter = ParameterApriori::first();

        $pdf = Pdf::loadView('hasil-analisis.pdf', [
            'rules' => $rules,
            'parameter' => $parameter,
        ]);

        return $pdf->download('Laporan-Hasil-Apriori.pdf');
    }
}