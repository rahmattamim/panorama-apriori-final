<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\ParameterApriori;
use Illuminate\Http\Request;

class ProsesAprioriController extends Controller
{
    // Menampilkan halaman proses Apriori
    public function index()
    {
        $parameter = ParameterApriori::first();

        return view('apriori.proses', [
            'parameter' => $parameter,
            'jumlahTransaksi' => Transaksi::count(),
            'tanggal_awal' => null,
            'tanggal_akhir' => null,
        ]);
    }

    // Menjalankan proses Apriori
    public function proses(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        session([
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        session()->save();

        $parameter = ParameterApriori::first();

        if (!$parameter) {
            return redirect()
                ->route('apriori.index')
                ->with('error', 'Parameter Apriori belum diatur.');
        }

        $transaksi = Transaksi::with('detailTransaksis.barang')
            ->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ])
            ->get();

        if ($transaksi->isEmpty()) {
            return redirect()
                ->route('apriori.index')
                ->with('error', 'Tidak ada transaksi pada rentang tanggal tersebut.');
        }

        /*
         * Mengubah data transaksi menjadi bentuk:
         *
         * [
         *     ['Benang', 'Karet', 'Kancing'],
         *     ['Benang', 'Resleting biasa'],
         *     ...
         * ]
         */
        $dataTransaksi = [];

        foreach ($transaksi as $data) {

            $items = [];

            foreach ($data->detailTransaksis as $detail) {

                if ($detail->barang) {

                    // Rapikan nama barang sebelum masuk ke proses Apriori
                    $items[] = $this->normalisasiBarang(
                        $detail->barang->nama_barang
                    );
                }
            }

            // Satu barang tidak boleh dihitung dua kali dalam satu nota
            $items = array_values(array_unique($items));

            if (!empty($items)) {
                sort($items);
                $dataTransaksi[] = $items;
            }
        }

        $jumlahTransaksi = count($dataTransaksi);

        if ($jumlahTransaksi == 0) {
            return redirect()
                ->route('apriori.proses')
                ->with('error', 'Data transaksi belum memiliki detail barang.');
        }

        // Support persen diubah menjadi bentuk desimal
        $minSupport = $parameter->min_support / 100;

        // Minimal jumlah transaksi yang harus mengandung item
        $minSupportCount = ceil(
            $jumlahTransaksi * $minSupport
        );

        /*
         * ==========================================
         * FREQUENT 1-ITEMSET
         * ==========================================
         */

        $itemCount = [];

        foreach ($dataTransaksi as $items) {

            foreach ($items as $item) {

                if (!isset($itemCount[$item])) {
                    $itemCount[$item] = 0;
                }

                $itemCount[$item]++;
            }
        }

        $frequent = [];

        foreach ($itemCount as $item => $count) {

            if ($count >= $minSupportCount) {

                $frequent[] = [
                    'items' => [$item],
                    'count' => $count,
                    'support' => ($count / $jumlahTransaksi) * 100,
                ];
            }
        }

        // Simpan hasil semua level itemset
        $hasilItemset = [];

        if (!empty($frequent)) {
            $hasilItemset[1] = $frequent;
        }

        /*
         * ==========================================
         * PROSES APRIORI UNTUK ITEMSET BERIKUTNYA
         * ==========================================
         */

        $previousFrequent = $frequent;
        $k = 2;

        while (!empty($previousFrequent)) {

            // Membuat kandidat dari frequent itemset sebelumnya
            $candidates = $this->generateCandidates(
                $previousFrequent,
                $k
            );

            if (empty($candidates)) {
                break;
            }

            $frequentK = [];

            // Hitung kemunculan setiap kandidat
            foreach ($candidates as $candidate) {

                $count = 0;

                foreach ($dataTransaksi as $items) {

                    if (
                        count(
                            array_intersect($candidate, $items)
                        ) === $k
                    ) {
                        $count++;
                    }
                }

                // Kandidat hanya lolos jika memenuhi minimum support
                if ($count >= $minSupportCount) {

                    $frequentK[] = [
                        'items' => $candidate,
                        'count' => $count,
                        'support' => ($count / $jumlahTransaksi) * 100,
                    ];
                }
            }

            // Kalau tidak ada yang lolos, proses selesai
            if (empty($frequentK)) {
                break;
            }

            $hasilItemset[$k] = $frequentK;

            $previousFrequent = $frequentK;
            $k++;
        }

        /*
         * ==========================================
         * MEMBUAT DATA SUPPORT UNTUK CONFIDENCE
         * ==========================================
         */

        $supportMap = [];

        foreach ($hasilItemset as $level) {

            foreach ($level as $itemset) {

                $key = $this->itemsetKey($itemset['items']);

                $supportMap[$key] = [
                    'items' => $itemset['items'],
                    'count' => $itemset['count'],
                    'support' => $itemset['support'],
                ];
            }
        }

        /*
         * ==========================================
         * ASSOCIATION RULE
         * ==========================================
         */

        $rules = [];

        foreach ($hasilItemset as $level => $itemsets) {

            // Association rule hanya bisa dibuat dari
            // itemset yang mempunyai minimal 2 barang
            if ($level < 2) {
                continue;
            }

            foreach ($itemsets as $itemset) {

                $items = $itemset['items'];

                // Buat semua kemungkinan bagian kiri
                $subsets = $this->getSubsets($items);

                foreach ($subsets as $antecedent) {

                    // Consequent = barang yang tersisa
                    $consequent = array_values(
                        array_diff($items, $antecedent)
                    );

                    if (empty($consequent)) {
                        continue;
                    }

                    $antecedentKey = $this->itemsetKey($antecedent);

                    // Support antecedent harus tersedia
                    if (!isset($supportMap[$antecedentKey])) {
                        continue;
                    }

                    $antecedentSupport =
                        $supportMap[$antecedentKey]['count'];

                    $itemsetSupport = $itemset['count'];

                    // Rumus confidence
                    $confidence =
                        ($itemsetSupport / $antecedentSupport) * 100;

                    // Hanya rule yang memenuhi confidence
                    if (
                        $confidence >=
                        $parameter->min_confidence
                    ) {

                        $rules[] = [
                            'antecedent' => $antecedent,
                            'consequent' => $consequent,
                            'support' => $itemset['support'],
                            'confidence' => $confidence,
                        ];
                    }
                }
            }
        }

        // Urutkan rule berdasarkan confidence tertinggi
        usort($rules, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        session([
            'rules' => $rules,
            'hasilItemset' => $hasilItemset,
            'jumlahTransaksi' => $jumlahTransaksi,
            'minSupportCount' => $minSupportCount,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return view('apriori.hasil', [
            'parameter' => $parameter,
            'jumlahTransaksi' => $jumlahTransaksi,
            'minSupportCount' => $minSupportCount,
            'hasilItemset' => $hasilItemset,
            'rules' => $rules,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);
    }

    // Menjalankan proses Apriori untuk semua transaksi
    public function prosesSemua()
    {
        $tanggalAwal = Transaksi::min('tanggal');
        $tanggalAkhir = Transaksi::max('tanggal');

        if (!$tanggalAwal || !$tanggalAkhir) {
            return redirect()
                ->route('apriori.index')
                ->with('error', 'Belum ada data transaksi.');
        }

        // Buat request seolah-olah user memilih
        // tanggal transaksi paling awal sampai paling akhir
        $request = new Request([
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
        ]);

        return $this->proses($request);
    }

    // Membuat kandidat itemset baru
    private function generateCandidates($previousFrequent, $k)
    {
        $candidates = [];
        $jumlah = count($previousFrequent);

        for ($i = 0; $i < $jumlah; $i++) {

            for ($j = $i + 1; $j < $jumlah; $j++) {

                $gabungan = array_unique(
                    array_merge(
                        $previousFrequent[$i]['items'],
                        $previousFrequent[$j]['items']
                    )
                );

                sort($gabungan);

                // Kandidat harus mempunyai jumlah item sesuai k
                if (count($gabungan) !== $k) {
                    continue;
                }

                $key = $this->itemsetKey($gabungan);

                if (!isset($candidates[$key])) {
                    $candidates[$key] = $gabungan;
                }
            }
        }

        return array_values($candidates);
    }

    // Membuat key unik untuk itemset
    private function itemsetKey($items)
    {
        sort($items);

        return implode('|', $items);
    }

    // Membuat semua subset dari sebuah itemset
    private function getSubsets($items)
    {
        $result = [];
        $jumlah = count($items);

        for ($i = 1; $i < (1 << $jumlah) - 1; $i++) {

            $subset = [];

            for ($j = 0; $j < $jumlah; $j++) {

                if ($i & (1 << $j)) {
                    $subset[] = $items[$j];
                }
            }

            sort($subset);
            $result[] = $subset;
        }

        return $result;
    }

    // Merapikan nama barang sebelum diproses Apriori
    private function normalisasiBarang($nama)
    {
        // Hilangkan spasi yang tidak diperlukan
        $nama = trim($nama);

        // Ubah semua huruf menjadi kecil supaya
        // "Benang", "benang", dan "BENANG" dianggap sama
        $nama = mb_strtolower($nama);

        // Rapikan spasi ganda menjadi satu spasi
        $nama = preg_replace('/\s+/', ' ', $nama);

        // Nama barang yang memang punya penulisan khusus
        $khusus = [
            'ykk' => 'YKK',
            'db' => 'DB',
            'bh' => 'BH',
        ];

        // Ubah setiap kata menjadi huruf awal kapital
        $nama = mb_convert_case($nama, MB_CASE_TITLE, 'UTF-8');

        // Perbaiki penulisan singkatan yang harus tetap kapital
        foreach ($khusus as $kata => $hasil) {
            $nama = preg_replace(
                '/\b' . preg_quote(ucfirst($kata), '/') . '\b/i',
                $hasil,
                $nama
            );
        }

        return $nama;
    }
}