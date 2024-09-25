<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlexiblePolishingPads extends Model
{
    protected $table = 'flexible_polishing_pads';

    public function images()
    {
        return $this->hasMany(PicturesFlexiblePolishingPads::class, 'vendor_code', 'vendor_code');
    }
}
