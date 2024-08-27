<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnyAdjustment extends Model
{
    protected $table = 'any_adjustment';  

    public function images()
    {
        return $this->hasMany(PicturesAnyAdjustment::class);
    }
}
