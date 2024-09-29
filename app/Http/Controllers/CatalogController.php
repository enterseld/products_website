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
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogController extends Controller {
    public function index(Request $request)
    {
    // Fetch products from all categories
    $categories = [
        'AnyAdjustment' => AnyAdjustment::with('images')->where('available', '!=', 0),
        'AdaptersExtensions' => AdaptersExtensions::with('images')->where('available', '!=', 0),
        'DiamondDisks' => DiamondDisks::with('images')->where('available', '!=', 0),
        'DiamondDrills' => DiamondDrills::with('images')->where('available', '!=', 0),
        'DrillsAdjustment' => DrillsAdjustment::with('images')->where('available', '!=', 0),
        'FlexiblePolishingPads' => FlexiblePolishingPads::with('images')->where('available', '!=', 0),
        'InstrumentsEquipment' => InstrumentsEquipment::with('images')->where('available', '!=', 0),
        'Mills' => Mills::with('images')->where('available', '!=', 0),
        'PolishingInstruments' => PolishingInstruments::with('images')->where('available', '!=', 0),
    ];

    // Combine all products into one collection
    $allProducts = collect();
    foreach ($categories as $category) {
        $allProducts = $allProducts->merge($category->get());
    }

    // Paginate the combined dataset
    $perPage = 30; // Items per page
    $currentPage = $request->input('page', 1); // Get the current page from the request
    $currentItems = $allProducts->slice(($currentPage - 1) * $perPage, $perPage)->values()->all();

    // Create a paginator instance
    $paginatedProducts = new LengthAwarePaginator(
        $currentItems,
        $allProducts->count(), // Total count for pagination
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return response()->json($paginatedProducts);
    }
    

}