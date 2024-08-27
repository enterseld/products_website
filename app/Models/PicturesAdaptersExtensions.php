<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturesAdaptersExtensions extends Model
{
    protected $table = 'pictures_adapters_extensions';  // Your table name

    public function product()
    {
        return $this->belongsTo(AdaptersExtensions::class);
    }
}
