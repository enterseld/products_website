<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentsEquipment extends Model
{
    protected $table = 'instruments_equipment';  

    public function images()
    {
        return $this->hasMany(PicturesInstrumentsEquipment::class);
    }
}
