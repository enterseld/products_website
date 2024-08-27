<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesInstrumentsEquipment extends Model
{
    protected $table = 'pictures_instruments_equipment';  // Your table name

    public function product()
    {
        return $this->belongsTo(InstrumentsEquipment::class);
    }
}
