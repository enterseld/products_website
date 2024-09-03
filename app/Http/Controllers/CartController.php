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

class CartController extends Controller
{
    // Display the cart
    public function index()
    {
        $cart = session()->get('cart', []);  // Fetch cart from session
        return view('cart.index', compact('cart'));
    }

    // Add a product to the cart
    public function add(Request $request)
    {

        $vendor_code = $request->input('vendor_code');
        $productType = $request->input('product_type');
        
        switch ($productType) {
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
                $product = InstrumentsEquipment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            case '141':
                $product = InstrumentsEquipment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            case '181':
                $product = InstrumentsEquipment::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            case '41':
                $product = Mills::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            case '122':
                $product = PolishingInstruments::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            case '142':
                $product = PolishingInstruments::with('images')->where('vendor_code', $vendor_code)->firstOrFail();
                break;
            // Add more cases as needed for different product types
            default:
                return redirect()->back()->withErrors('Invalid product type.');
        }
        

        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->vendor_code])) {
            $cart[$product->vendor_code]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$product->vendor_code] = [
                'name' => $product->name_product,
                'price' => $product->price,
                'vendor_code' => $product->vendor_code,
                'quantity' => 1,
                'picture' => $product->images->first()->picture ?? null  // Use first image if available
            ];
        }

        // Store cart in session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Remove a product from the cart
    public function remove($vendor_code)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$vendor_code])) {
            if($cart[$vendor_code]['quantity']>1){
            $cart[$vendor_code]['quantity']--;
            }
            else{
                unset($cart[$vendor_code]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
