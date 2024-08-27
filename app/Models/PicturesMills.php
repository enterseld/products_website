<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesMills extends Model
{
    protected $table = 'pictures_mills';  // Your table name

    public function product()
    {
        return $this->belongsTo(Mills::class);
    }
}
