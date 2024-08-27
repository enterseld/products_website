<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesFlexiblePolishingPads extends Model
{
    protected $table = 'pictures_flexible_polishing_pads';  // Your table name

    public function product()
    {
        return $this->belongsTo(FlexiblePolishingPads::class);
    }
}
