<?php

namespace App\Http\Controllers;
use App\Models\DiamondDrills;
use App\Models\PicturesDiamondDrills;
use Illuminate\Http\Request;

class DiamondDrillsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = DiamondDrills::with('images')->get();
        return view('products.DiamondDrills.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.DiamondDrills.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = DiamondDrills::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesDiamondDrills::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.DiamondDrills.index');
    }

    public function show($id)
    {
        $product = DiamondDrills::with('images')->findOrFail($id);
        return view('products.DiamondDrills.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
