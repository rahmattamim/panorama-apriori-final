<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterApriori extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = [
        'min_support',
        'min_confidence',
    ];
}
