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

class MainPageController extends Controller
{
    // Show all categories on the main page
    public function index()
    {
        $categories = [// Fetch a few sample products from each category
            
            'AnyAdjustment' => AnyAdjustment::with('images')->take(4)->where('available', '!=', 0)->get(),      
            'AdaptersExtensions' => AdaptersExtensions::with('images')->take(4)->where('available', '!=', 0)->get(),
            'DiamondDisks' => DiamondDisks::with('images')->take(4)->where('available', '!=', 0)->get(),
            'DiamondDrills' => DiamondDrills::with('images')->take(4)->where('available', '!=', 0)->get(),   
            'DrillsAdjustment' => DrillsAdjustment::with('images')->take(4)->where('available', '!=', 0)->get(),
            'FlexiblePolishingPads' => FlexiblePolishingPads::with('images')->take(4)->where('available', '!=', 0)->get(),
            'InstrumentsEquipment' => InstrumentsEquipment::with('images')->take(4)->where('available', '!=', 0)->get(),
            'Mills' => Mills::with('images')->take(4)->where('available', '!=', 0)->get(),   
            'PolishingInstruments' => PolishingInstruments::with('images')->take(4)->where('available', '!=', 0)->get(),  
        ];
        
        $products = collect($categories)->flatten(1);

        return response()->json($products);
    }

}