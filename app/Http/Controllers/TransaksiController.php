<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\MasterBarang;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{
    // tampilkan semua transaksi
    public function index()
    {
        // Mengambil transaksi berdasarkan tanggal dan nomor nota
        //$transaksis = Transaksi::with('detailTransaksis')
        //    ->orderBy('tanggal', 'asc')
        //    ->orderBy('no_nota', 'asc')
        //    ->get();

        //return view('transaksi.index', compact('transaksis'));

        $transaksis = Transaksi::with('detailTransaksis.barang')
                ->orderBy('tanggal', 'asc')
                ->paginate(20);

        return view('transaksi.index', compact('transaksis'));
    }

    // tampilkan form tambah transaksi
    public function create()
    {
        // ambil semua barang untuk pilihan di form
        $barangs = MasterBarang::all();

        return view('transaksi.create', compact('barangs'));
    }

    // simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'no_nota' => 'required|unique:transaksis,no_nota',
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:master_barangs,id',
        ]);

        // simpan data notanya dulu
        $transaksi = Transaksi::create([
            'no_nota' => $request->no_nota,
            'tanggal' => $request->tanggal,
        ]);

        // simpan barang-barang yang ada di nota
        foreach ($request->barang_id as $barangId) {
            $transaksi->detailTransaksis()->create([
                'barang_id' => $barangId,
            ]);
        }

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    // hapus transaksi beserta detail barangnya
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    // Menghapus semua transaksi dan detail transaksi
    public function destroyAll()
    {
        // Hapus semua detail transaksi terlebih dahulu
        DetailTransaksi::query()->delete();

        // Setelah detail dihapus, hapus semua transaksi
        Transaksi::query()->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Semua data transaksi berhasil dihapus.');
    }
}
    