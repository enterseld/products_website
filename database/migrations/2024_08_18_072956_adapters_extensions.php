<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdaptersExtensions extends Migration
{
    public function up()
    {
        Schema::create('adapters_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('name_product');
            $table->string('name_ua');
            $table->string('meashure', 50);
            $table->double('price', 10, 2);
            $table->string('currency_id', 10);
            $table->unsignedBigInteger('category_id');
            $table->double('vendor_code')->unique();
            $table->string('country', 15);
            $table->string('vendor', 15);
            $table->string('keywords', 255)->nullable();
            $table->string('keywords_ua', 255)->nullable();
            $table->string('product_description', 1500);
            $table->string('description_ua', 1500);
            $table->string('vendor_mark', 30);
            $table->string('barcode', 25)->nullable();
            $table->string('code_uktzed', 25);
            $table->string('guarantee', 250);
            $table->string('material', 200)->nullable();
            $table->double('mass_without_package');
            $table->double('mass_in_package');
            $table->string('height_without_package', 50)->nullable();
            $table->double('height_in_package')->nullable();
            $table->double('length')->nullable();
            $table->boolean('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adapters_extensions');
    }
}