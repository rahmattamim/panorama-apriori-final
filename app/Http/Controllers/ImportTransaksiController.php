<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportTransaksiController extends Controller
{
    // tampilkan halaman import
    public function index()
    {
        return view('transaksi.import');
    }

    // proses file Excel yang diupload
    public function import(Request $request)
    {
        // cek file yang masuk
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        // ambil file Excel
        $file = $request->file('file');

        // baca isi Excel
        $spreadsheet = IOFactory::load($file->getPathname());

        // ambil sheet pertama
        $sheet = $spreadsheet->getActiveSheet();

        // ambil semua data dari Excel
        $rows = $sheet->toArray();

        // mulai dari baris kedua karena baris pertama adalah judul kolom
        $noNotaSebelumnya = null;

        DB::beginTransaction();

        try {

            foreach ($rows as $index => $row) {

                // lewati baris pertama
                if ($index === 0) {
                    continue;
                }

                $noNota = trim($row[0] ?? '');
                $tanggal = trim($row[1] ?? '');
                $namaBarang = trim($row[2] ?? '');

                // Mengubah tanggal Excel menjadi format YYYY-MM-DD
                if ($tanggal !== '') {

                    // Jika Excel memberikan tanggal sebagai objek DateTime
                    if ($tanggal instanceof \DateTimeInterface) {

                        $tanggal = $tanggal->format('Y-m-d');

                    // Jika Excel memberikan tanggal sebagai angka serial
                    } elseif (is_numeric($tanggal)) {

                        $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date
                            ::excelToDateTimeObject($tanggal)
                            ->format('Y-m-d');

                    // Jika tanggal terbaca sebagai teks
                    } else {

                        $tanggal = trim($tanggal);

                        // Format tanggal: bulan/tanggal/tahun
                        $tanggalObj = \DateTime::createFromFormat('m/d/Y', $tanggal);

                        if ($tanggalObj === false) {
                            throw new \Exception(
                                'Format tanggal tidak valid: ' . $tanggal
                            );
                        }

                        $tanggal = $tanggalObj->format('Y-m-d');
                    }
                }

                // kalau nomor nota kosong, pakai nomor nota sebelumnya
                if ($noNota === '') {
                    $noNota = $noNotaSebelumnya;
                }

                // simpan nomor nota terakhir
                $noNotaSebelumnya = $noNota;

                // kalau barisnya kosong, lewati
                if (!$noNota || !$tanggal || !$namaBarang) {
                    continue;
                }

                // cari barang berdasarkan nama
                $barang = MasterBarang::whereRaw(
                    'LOWER(nama_barang) = ?',
                    [strtolower($namaBarang)]
                )->first();

                // kalau barang belum ada, buat otomatis
                if (!$barang) {
                    $kodeBarang = 'BRG-' . strtoupper(substr(md5($namaBarang), 0, 6));

                    $barang = MasterBarang::create([
                        'kode_barang' => $kodeBarang,
                        'nama_barang' => $namaBarang,
                        'kategori' => 'Barang Jahit',
                    ]);
                }

                // cari transaksi berdasarkan nomor nota
                $transaksi = Transaksi::firstOrCreate(
                    [
                        'no_nota' => $noNota,
                    ],
                    [
                        'tanggal' => $tanggal,
                    ]
                );

                // jangan sampai barang yang sama masuk dua kali dalam satu nota
                $transaksi->detailTransaksis()->firstOrCreate([
                    'barang_id' => $barang->id,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('transaksi.index')
                ->with('success', 'Data transaksi berhasil diimport.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors([
                    'file' => 'Import gagal: ' . $e->getMessage()
                ]);
        }
    }
}