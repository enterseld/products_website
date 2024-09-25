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
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainPageController;

Route::get('/', [MainPageController::class, 'index'])->name('main.index');
// API route to fetch product data
Route::get('/products/{id}', [AdaptersExtensionsController::class, 'show'])->name('AdaptersExtensions.show');

use App\Http\Controllers\CatalogController;

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{vendor_code}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/catalog/category/{category_id}', [CatalogController::class, 'filterByCategory'])->name('catalog.filter');
