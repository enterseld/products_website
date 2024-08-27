<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesDiamondDisks extends Model
{
    protected $table = 'pictures_diamond_disks';  // Your table name

    public function product()
    {
        return $this->belongsTo(DiamondDisks::class);
    }
}
