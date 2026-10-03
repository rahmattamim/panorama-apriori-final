<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;

class MasterBarang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori'
    ];

    // satu barang bisa muncul di banyak transaksi
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_id');
    }
}
