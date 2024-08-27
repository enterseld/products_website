<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesDiamondDrills extends Model
{
    protected $table = 'pictures_diamond_drills';  // Your table name

    public function product()
    {
        return $this->belongsTo(DiamondDrills::class);
    }
}
