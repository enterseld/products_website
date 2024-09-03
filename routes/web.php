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


Route::get('/AdaptersExtensions/{id}', [AdaptersExtensionsController::class, 'show'])->name('AdaptersExtensions');

Route::get('/shop/AnyAdjustmentController', [AnyAdjustmentController::class, 'index'])->name('shop.category2');
Route::get('/shop/AnyAdjustmentController/{id}', [AnyAdjustmentController::class, 'show'])->name('shop.category2.show');
Route::get('/shop/DiamondDisksController', [DiamondDisksController::class, 'index'])->name('shop.category1');
Route::get('/shop/DiamondDisksController/{id}', [DiamondDisksController::class, 'show'])->name('shop.category1.show');
Route::get('/shop/DrillsAdjustmentController', [DrillsAdjustmentController::class, 'index'])->name('shop.category2');
Route::get('/shop/DrillsAdjustmentController/{id}', [DrillsAdjustmentController::class, 'show'])->name('shop.category2.show');
Route::get('/shop/FlexiblePolishingPadsController', [FlexiblePolishingPadsController::class, 'index'])->name('shop.category2');
Route::get('/shop/FlexiblePolishingPadsController/{id}', [FlexiblePolishingPadsController::class, 'show'])->name('shop.category2.show');
Route::get('/shop/InstrumentsEquipmentController', [InstrumentsEquipmentController::class, 'index'])->name('shop.category2');
Route::get('/shop/InstrumentsEquipmentController/{id}', [InstrumentsEquipmentController::class, 'show'])->name('shop.category2.show');
Route::get('/shop/MillsController', [MillsController::class, 'index'])->name('shop.category2');
Route::get('/shop/MillsController/{id}', [MillsController::class, 'show'])->name('shop.category2.show');
Route::get('/shop/PolishingInstrumentsController', [PolishingInstrumentsController::class, 'index'])->name('shop.category2');
Route::get('/shop/PolishingInstrumentsController/{id}', [PolishingInstrumentsController::class, 'show'])->name('shop.category2.show');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
