<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = MasterBarang::latest()->get();

        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:master_barangs',
            'nama_barang' => 'required',
            'kategori' => 'required',
        ]);

        MasterBarang::create($request->all());

        return redirect()
            ->route('master-barang.index')
            ->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterBarang $masterBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterBarang $masterBarang)
    {
        return view('barang.edit', compact('masterBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterBarang $masterBarang)
    {
        $request->validate([
        'kode_barang' => 'required|unique:master_barangs,kode_barang,' . $masterBarang->id,
        'nama_barang' => 'required',
        'kategori' => 'required',
        ]);

        $masterBarang->update($request->all());

        return redirect()
            ->route('master-barang.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */

    //buat hapus semua data master barang
    /*
    public function destroy(MasterBarang $masterBarang)
    {
        $masterBarang->delete();

            return redirect()
                ->route('master-barang.index')
                ->with('success', 'Data berhasil dihapus');
    }
    */
}
