<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiamondDrills extends Model
{
    protected $table = 'diamond_drills';  

    public function images()
    {
        return $this->hasMany(PicturesDiamondDrills::class);
    }
}
