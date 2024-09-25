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

class CatalogController extends Controller
{
    // Show all products
    public function index(Request $request)
    {
        // Fetch products, you can add pagination if needed
        $products = AdaptersExtensions::with('images')->paginate(10); // Adjust per page count as needed

        return view('catalog.index', compact('products'));
    }

    // Show a single product by vendor code
    public function show($vendor_code)
    {
        $product = AdaptersExtensions::with('images')->where('vendor_code', $vendor_code)->firstOrFail();

        return view('catalog.show', compact('product'));
    }

    // Filter products by category
    public function filterByCategory($category_id)
    {
        $products = AdaptersExtensions::with('images')->where('category_id', $category_id)->paginate(10);

        return view('catalog.index', compact('products'));
    }
}
