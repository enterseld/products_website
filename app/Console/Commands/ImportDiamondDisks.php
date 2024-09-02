<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class ImportDiamondDisks extends Command
{
    protected $signature = 'import:products {xmlFile}';

    protected $description = 'Import products and pictures from XML file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::delete('delete from pictures_diamond_disks;');
        DB::delete('delete from diamond_disks;');
        DB::delete('delete from pictures_drills_adjustment;');
        DB::delete('delete from drills_adjustment;');
        DB::delete('delete from pictures_any_adjustment;');
        DB::delete('delete from any_adjustment;');
        DB::delete('delete from pictures_mills;');
        DB::delete('delete from mills;');
        DB::delete('delete from pictures_diamond_drills;');
        DB::delete('delete from diamond_drills;');
        DB::delete('delete from pictures_flexible_polishing_pads;');
        DB::delete('delete from flexible_polishing_pads;');
        DB::delete('delete from pictures_adapters_extensions;');
        DB::delete('delete from adapters_extensions;');
        DB::delete('delete from pictures_polishing_instruments;');
        DB::delete('delete from polishing_instruments;');
        DB::delete('delete from pictures_instruments_equipment;');
        DB::delete('delete from instruments_equipment;');
        
        $xmlUrl = 'https://distarimport.distar.com.ua/import2/content_dst.xml';
        $xml = simplexml_load_file($xmlUrl);

        $idDiamondDisks = 1;
        $idDrillsAdjustment = 1;
        $idAnyAdjustment = 1;
        $idMills = 1;
        $idDiamondDrills = 1;
        $idFlexiblePolish = 1;
        $idAdapters = 1;
        $idPolishing = 1;
        $idInstruments = 1;
        $idDiamondDisksPictures = 1;
        $idDrillsAdjustmentPictures = 1;
        $idAnyAdjustmentPictures = 1;
        $idMillsPictures = 1;
        $idDiamondDrillsPictures = 1;
        $idFlexiblePolishPictures = 1;
        $idAdaptersPictures = 1;
        $idPolishingPictures = 1;
        $idInstrumentsPictures = 1;
        $checker = 0;

        foreach ($xml->shop->offers->offer as $product) {
            if ((int)$product->categoryId == 2) {
                $productDataDiamondDisks = [
                    'id' => (int)$idDiamondDisks,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0],
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    'disk_type' => (string)$product->xpath("param[@name='Вид диска']")[0],
                    'work_materials' => (string)$product->xpath("param[@name='Робочий матеріал']")[0],
                    'diameter_of_disk' => (int)$product->xpath("param[@name='Діаметр, мм']")[0],
                    'diameter_of_fit' => isset($product->xpath("param[@name='Діаметр посадкового отвору, мм']")[0]) ? (int)$product->xpath("param[@name='Діаметр посадкового отвору, мм']")[0] : null,
                    'compatibility' => (string)$product->xpath("param[@name='Сумісність із яким інструментом']")[0],
                    'type_of_segments' => (string)$product->xpath("param[@name='Тип']")[0],
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'diamond_layer_height' => isset($product->xpath("param[@name='Висота алмазного шару, мм']")[0]) ? (double)$product->xpath("param[@name='Висота алмазного шару, мм']")[0] : null,
                    'diamond_layer_width' => isset($product->xpath("param[@name='Товщина алмазного шару, мм']")[0]) ? (double)$product->xpath("param[@name='Товщина алмазного шару, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idDiamondDisks+=1;
                // Insert the product into the diamondDisks table
                DB::table('diamond_disks')->insert($productDataDiamondDisks);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_diamond_disks')->insert([
                        'id' => (int)$idDiamondDisksPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idDiamondDisksPictures+=1;
                }
            }
            if ((int)$product->categoryId == 101) {
                $productDataDrillsAdjustment = [
                    'id' => (int)$idDrillsAdjustment,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0],
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    
                    'work_materials' => (string)$product->xpath("param[@name='Робочий матеріал']")[0],
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idDrillsAdjustment+=1;
                // Insert the product into the diamondDisks table
                DB::table('drills_adjustment')->insert($productDataDrillsAdjustment);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_drills_adjustment')->insert([
                        'id' => (int)$idDrillsAdjustmentPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idDrillsAdjustmentPictures+=1;
                }
            }

            if ((int)$product->categoryId == 102) {
                $productDataAnyAdjustment = [
                    'id' => (int)$idAnyAdjustment,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0],
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    
                    'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idAnyAdjustment+=1;
                // Insert the product into the diamondDisks table
                DB::table('any_adjustment')->insert($productDataAnyAdjustment);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_any_adjustment')->insert([
                        'id' => (int)$idAnyAdjustmentPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idAnyAdjustmentPictures+=1;
                }
            }
            
            if ((int)$product->categoryId == 41) {
                $productMills = [
                    'id' => (int)$idMills,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0],
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    
                    'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'diameter' => (double)$product->xpath("param[@name='Діаметр, мм']")[0],
                    'compatibility' => (string)$product->xpath("param[@name='Сумісність із яким інструментом']")[0],
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'number_of_segments' => isset($product->xpath("param[@name='Кількість сегментів, шт']")[0]) ? (string)$product->xpath("param[@name='Кількість сегментів, шт']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idMills+=1;
                // Insert the product into the diamondDisks table
                DB::table('mills')->insert($productMills);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_mills')->insert([
                        'id' => (int)$idMillsPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idMillsPictures+=1;
                }
            }
            
            if ((int)$product->categoryId == 21) {
                if ((int)$product->vendorCode == 10170085518) {
                    $checker = 1;
                };
                if ((int)$product->vendorCode == 10170085518 && $checker == 1) {}
                else {
                    $productDiamondDrills = [
                    'id' => (int)$idDiamondDrills,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => isset($product->xpath("param[@name='Код ЕАН (штрих-код)']")[0]) ? (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0] : null,
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],

                    'drill_type' => isset($product->xpath("param[@name='Вид свердла']")[0]) ? (string)$product->xpath("param[@name='Вид свердла']")[0] : null,
                    'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'drill_diameter' => isset($product->xpath("param[@name='Діаметр свердла, мм']")[0]) ? (double)$product->xpath("param[@name='Діаметр свердла, мм']")[0] : null,
                    'compatibility' => (string)$product->xpath("param[@name='Сумісність із яким інструментом']")[0],
                    'end_type' => isset($product->xpath("param[@name='Тип хвостовика']")[0]) ? (double)$product->xpath("param[@name='Тип хвостовика']")[0] : null,
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'length' => isset($product->xpath("param[@name='Довжина, мм']")[0]) ? (string)$product->xpath("param[@name='Довжина, мм']")[0] : null,
                    'number_of_segments' => isset($product->xpath("param[@name='Кількість сегментів, шт']")[0]) ? (string)$product->xpath("param[@name='Кількість сегментів, шт']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idDiamondDrills+=1;
                // Insert the product into the diamondDisks table
                DB::table('diamond_drills')->insert($productDiamondDrills);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_diamond_drills')->insert([
                        'id' => (int)$idDiamondDrillsPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idDiamondDrillsPictures+=1;
                }
            }
        }
            if ((int)$product->categoryId == 81) {
                    $productFlexiblePolish = [
                        'id' => (int)$idFlexiblePolish,
                        'name_product' => (string)$product->name,
                        'name_ua' => (string)$product->name_ua,
                        'meashure' => (string)$product->meashure,
                        'price' => (float)$product->price,
                        'currency_id' => (string)$product->currencyId,
                        'category_id' => (int)$product->categoryId,
                        'vendor_code' => (int)$product->vendorCode,
                        'country' => (string)$product->country,
                        'vendor' => (string)$product->vendor,
                        'keywords' => (string)$product->keywords,
                        'keywords_ua' => (string)$product->keywords_ua,
                        'product_description' => (string)$product->description,
                        'description_ua' => (string)$product->description_ua,
                        'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                        'barcode' => isset($product->xpath("param[@name='Код ЕАН (штрих-код)']")[0]) ? (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0] : null,
                        'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                        'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                        'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                        'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                        'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                        
                        'available' => (string)$product['available'] === "true",
                    ];
                    $idFlexiblePolish+=1;
                    // Insert the product into the diamondDisks table
                    DB::table('flexible_polishing_pads')->insert($productFlexiblePolish);
                    // Insert pictures into the pictures table
                    foreach ($product->picture as $picture) {
                        DB::table('pictures_flexible_polishing_pads')->insert([
                            'id' => (int)$idFlexiblePolishPictures,
                            'vendor_code' => (int)$product->vendorCode,
                            'picture' => (string)$picture,
                        ]);
                        $idFlexiblePolishPictures+=1;
                    }
                }
            if ((int)$product->categoryId == 121 || (int)$product->categoryId == 221) {
                $productAdapters = [
                    'id' => (int)$idAdapters,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => isset($product->xpath("param[@name='Код ЕАН (штрих-код)']")[0]) ? (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0] : null,
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    'material' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'length' => isset($product->xpath("param[@name='Довжина, мм']")[0]) ? (double)$product->xpath("param[@name='Довжина, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idAdapters+=1;
                // Insert the product into the diamondDisks table
                DB::table('adapters_extensions')->insert($productAdapters);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_adapters_extensions')->insert([
                        'id' => (int)$idAdaptersPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idAdaptersPictures+=1;
                }
            }
            if ((int)$product->categoryId == 142 || (int)$product->categoryId == 122) {
                $productPolishingInstruments = [
                    'id' => (int)$idPolishing,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => isset($product->xpath("param[@name='Код ЕАН (штрих-код)']")[0]) ? (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0] : null,
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idPolishing+=1;
                // Insert the product into the diamondDisks table
                DB::table('polishing_instruments')->insert($productPolishingInstruments);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_polishing_instruments')->insert([
                        'id' => (int)$idPolishingPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idPolishingPictures+=1;
                }
            }
            if ((int)$product->categoryId == 143 || (int)$product->categoryId == 181 || (int)$product->categoryId == 141) {
                $productInstrumentsEquipment = [
                    'id' => (int)$idInstruments,
                    'name_product' => (string)$product->name,
                    'name_ua' => (string)$product->name_ua,
                    'meashure' => (string)$product->meashure,
                    'price' => (float)$product->price,
                    'currency_id' => (string)$product->currencyId,
                    'category_id' => (int)$product->categoryId,
                    'vendor_code' => (int)$product->vendorCode,
                    'country' => (string)$product->country,
                    'vendor' => (string)$product->vendor,
                    'keywords' => (string)$product->keywords,
                    'keywords_ua' => (string)$product->keywords_ua,
                    'product_description' => (string)$product->description,
                    'description_ua' => (string)$product->description_ua,
                    'vendor_mark' => (string)$product->xpath("param[@name='Торгівельна марка']")[0],
                    'barcode' => isset($product->xpath("param[@name='Код ЕАН (штрих-код)']")[0]) ? (string)$product->xpath("param[@name='Код ЕАН (штрих-код)']")[0] : null,
                    'code_uktzed' => (string)$product->xpath("param[@name='Код УКТ ЗЭД']")[0],
                    'guarantee' => (string)$product->xpath("param[@name='Гарантія']")[0],
                    'work_materials' => isset($product->xpath("param[@name='Робочий матеріал']")[0]) ? (string)$product->xpath("param[@name='Робочий матеріал']")[0] : null,
                    'mass_without_package' => (double)$product->xpath("param[@name='Вага без упаковки, кг']")[0],
                    'mass_in_package' => (double)$product->xpath("param[@name='Вага в упаковці, кг']")[0],
                    'height_without_package' => isset($product->xpath("param[@name='Висота без упаковки, мм']")[0]) ? (string)$product->xpath("param[@name='Висота без упаковки, мм']")[0] : null,
                    'height_in_package' => isset($product->xpath("param[@name='Висота в упаковці, мм']")[0]) ? (double)$product->xpath("param[@name='Висота в упаковці, мм']")[0] : null,
                    'available' => (string)$product['available'] === "true",
                ];
                $idInstruments+=1;
                // Insert the product into the diamondDisks table
                DB::table('instruments_equipment')->insert($productInstrumentsEquipment);
                // Insert pictures into the pictures table
                foreach ($product->picture as $picture) {
                    DB::table('pictures_instruments_equipment')->insert([
                        'id' => (int)$idInstrumentsPictures,
                        'vendor_code' => (int)$product->vendorCode,
                        'picture' => (string)$picture,
                    ]);
                    $idInstrumentsPictures+=1;
                }
            }
        }
    }
}
