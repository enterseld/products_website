<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesPolishingInstruments extends Model
{
    protected $table = 'pictures_polishing_instruments';  // Your table name

    public function product()
    {
        return $this->belongsTo(PolishingInstruments::class);
    }
}
