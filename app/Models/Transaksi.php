<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = [
        'no_nota',
        'tanggal',
    ];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}