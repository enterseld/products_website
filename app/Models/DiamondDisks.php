<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiamondDisks extends Model
{
    protected $table = 'diamond_disks';  

    public function images()
    {
        return $this->hasMany(PicturesDiamondDisks::class, 'vendor_code', 'vendor_code');
    }
}
