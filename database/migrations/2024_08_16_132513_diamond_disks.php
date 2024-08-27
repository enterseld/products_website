<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiamondDisks extends Migration
{
    public function up()
    {
        Schema::create('diamond_disks', function (Blueprint $table) {
            $table->id(); // Automatically increments
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
            $table->string('barcode', 25);
            $table->string('code_uktzed', 25);
            $table->string('guarantee', 250);
            $table->string('disk_type', 50);
            $table->string('work_materials', 200);
            $table->double('diameter_of_disk')->nullable();
            $table->double('diameter_of_fit')->nullable();
            $table->string('compatibility', 100)->nullable();
            $table->string('type_of_segments', 50)->nullable();
            $table->double('mass_without_package');
            $table->double('mass_in_package');
            $table->string('height_without_package', 50)->nullable();
            $table->double('height_in_package')->nullable();
            $table->double('diamond_layer_height')->nullable();
            $table->double('diamond_layer_width')->nullable();
            $table->boolean('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diamond_disks');
    }
}