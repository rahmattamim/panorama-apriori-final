<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\ParameterApriori;
use App\Models\MasterBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = MasterBarang::count();
        $totalTransaksi = Transaksi::count();

        $parameter = ParameterApriori::first();

        // rule terbaik (sementara dihitung sederhana)
        $ruleTerbaik = [
            'jika' => '-',
            'maka' => '-',
            'confidence' => 0
        ];

        return view('dashboard', compact(
            'totalBarang',
            'totalTransaksi',
            'parameter',
            'ruleTerbaik'
        ));
    }
}