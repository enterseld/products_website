<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdaptersExtensions extends Model
{
    protected $table = 'adapters_extensions';  

    public function images()
    {
        return $this->hasMany(PicturesAdaptersExtensions::class, 'vendor_code', 'vendor_code');
    }
}
