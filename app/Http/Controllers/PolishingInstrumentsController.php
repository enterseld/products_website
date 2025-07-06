<?php

namespace App\Http\Controllers;
use App\Models\PolishingInstruments;
use App\Models\PicturesPolishingInstruments;
use Illuminate\Http\Request;

class PolishingInstrumentsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = PolishingInstruments::with('images')->get();
        return view('products.PolishingInstruments.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.PolishingInstruments.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = PolishingInstruments::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesPolishingInstruments::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.PolishingInstruments.index');
    }

    public function show($id)
    {
        $product = PolishingInstruments::with('images')->findOrFail($id);
        return view('products.PolishingInstruments.show', compact('product'));
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
