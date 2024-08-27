<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesDrillsAdjustment extends Model
{
    protected $table = 'pictures_drills_adjustment';  // Your table name

    public function product()
    {
        return $this->belongsTo(DrillsAdjustment::class);
    }
}
