<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mills extends Model
{
    protected $table = 'mills';  

    public function images()
    {
        return $this->hasMany(PicturesMills::class, 'vendor_code', 'vendor_code');
    }
}
