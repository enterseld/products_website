<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesAnyAdjustment extends Model
{
    protected $table = 'pictures_any_adjustment';  // Your table name

    public function product()
    {
        return $this->belongsTo(AnyAdjustment::class);
    }
}
