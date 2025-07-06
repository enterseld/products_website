<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PicturesAdaptersExtensions extends Migration
{
    public function up()
    {
        Schema::create('pictures_adapters_extensions', function (Blueprint $table) {
            $table->id();
            $table->double('vendor_code');
            $table->string('picture', 255);
            $table->foreign('vendor_code')->references('vendor_code')->on('adapters_extensions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pictures_adapters_extensions');
    }
}