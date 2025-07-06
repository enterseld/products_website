<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdaptersExtensionsController;
use App\Http\Controllers\AnyAdjustmentController;
use App\Http\Controllers\DiamondDisksController;
use App\Http\Controllers\DiamondDrillsController;
use App\Http\Controllers\DrillsAdjustmentController;
use App\Http\Controllers\FlexiblePolishingPadsController;
use App\Http\Controllers\InstrumentsEquipmentController;
use App\Http\Controllers\MillsController;
use App\Http\Controllers\PolishingInstrumentsController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {return view('welcome');});
Route::get('/catalog', function () {return view('catalog');});
Route::get('/product/{vendor_code}/{product_type}', function ($vendor_code, $product_type) {
    $category_id = $product_type;
    return view('product', compact('vendor_code', 'category_id'));
});

Route::get('/api/products', [MainPageController::class, 'index']);
Route::get('/api/catalog', [CatalogController::class, 'index']);
Route::get('/api/product/{vendor_code}/{product_type}', [ProductController::class, 'show']);


