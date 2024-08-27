<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiamondDrills extends Migration
{
    public function up()
    {
        Schema::create('diamond_drills', function (Blueprint $table) {
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
            $table->string('vendor_mark', 15);
            $table->string('barcode', 25) -> nullable();
            $table->string('code_uktzed', 25);
            $table->string('guarantee', 250);
            $table->string('drill_type', 50);
            $table->string('work_materials', 200);
            $table->double('drill_diameter')->nullable();
            $table->string('compatibility', 150);
            $table->string('end_type', 50)->nullable();
            $table->double('mass_without_package');
            $table->double('mass_in_package');
            $table->string('height_without_package', 50)->nullable();
            $table->double('height_in_package')->nullable();
            $table->double('length')->nullable();
            $table->double('number_of_segments')->nullable();
            $table->boolean('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diamond_drills');
    }
}