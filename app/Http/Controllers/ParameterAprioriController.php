<?php

namespace App\Http\Controllers;

use App\Models\ParameterApriori;
use Illuminate\Http\Request;

class ParameterAprioriController extends Controller
{
    // tampilkan halaman parameter
    public function index()
    {
        // ambil parameter yang sudah tersimpan
        $parameter = ParameterApriori::first();

        return view('parameter-apriori.index', compact('parameter'));
    }

    // simpan parameter
    public function update(Request $request)
    {
        // cek nilai yang dimasukkan
        $request->validate([
            'min_support' => 'required|numeric|min:0|max:100',
            'min_confidence' => 'required|numeric|min:0|max:100',
        ]);

        // ambil parameter yang pertama
        $parameter = ParameterApriori::first();

        // kalau belum ada, bikin baru
        if (!$parameter) {
            $parameter = new ParameterApriori();
        }

        // simpan nilai support dan confidence
        $parameter->min_support = $request->min_support;
        $parameter->min_confidence = $request->min_confidence;

        $parameter->save();

        return redirect()
            ->route('parameter-apriori.index')
            ->with('success', 'Parameter berhasil disimpan.');
    }
}
