<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrillsAdjustment extends Model
{
    protected $table = 'drills_adjustment';  

    public function images()
    {
        return $this->hasMany(PicturesDrillsAdjustment::class, 'vendor_code', 'vendor_code');
    }
}
