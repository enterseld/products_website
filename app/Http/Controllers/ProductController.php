<?php

namespace App\Http\Controllers;

use App\Models\AdaptersExtensions;
use App\Models\AnyAdjustment;
use App\Models\DiamondDisks;
use App\Models\DiamondDrills;
use App\Models\DrillsAdjustment;
use App\Models\FlexiblePolishingPads;
use App\Models\InstrumentsEquipment;
use App\Models\Mills;
use App\Models\PolishingInstruments;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Fetch the product based on vendor_code and product_type
    public function show($vendor_code, $product_type)
{
    Log::info("Vendor Code: $vendor_code, Product Type: $product_type");

    switch ($product_type) {
        case '121':
            $product = AdaptersExtensions::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '221':
            $product = AdaptersExtensions::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '102':
            $product = AnyAdjustment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '2':
            $product = DiamondDisks::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '21':
            $product = DiamondDrills::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '101':
            $product = DrillsAdjustment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '81':
            $product = FlexiblePolishingPads::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '143':
        case '141':
        case '181':
            $product = InstrumentsEquipment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '41':
            $product = Mills::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        case '122':
        case '142':
            $product = PolishingInstruments::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
            break;
        default:
            return response()->json(['error' => 'Invalid product type.'], 400);
    }

    return response()->json($product);
}

}
