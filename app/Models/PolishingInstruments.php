<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolishingInstruments extends Model
{
    protected $table = 'polishing_instruments';  

    public function images()
    {
        return $this->hasMany(PicturesPolishingInstruments::class);
    }
}
