<?php

namespace App\Http\Controllers;
use App\Models\FlexiblePolishingPads;
use App\Models\PicturesFlexiblePolishingPads;
use Illuminate\Http\Request;

class FlexiblePolishingPadsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = FlexiblePolishingPads::with('images')->get();
        return view('products.FlexiblePolishingPads.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.FlexiblePolishingPads.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = FlexiblePolishingPads::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesFlexiblePolishingPads::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.FlexiblePolishingPads.index');
    }

    public function show($id)
    {
        $product = FlexiblePolishingPads::with('images')->findOrFail($id);
        return view('products.FlexiblePolishingPads.show', compact('product'));
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
