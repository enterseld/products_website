<?php

namespace App\Http\Controllers;
use App\Models\InstrumentsEquipment;
use App\Models\PicturesInstrumentsEquipment;
use Illuminate\Http\Request;

class InstrumentsEquipmentController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = InstrumentsEquipment::with('images')->get();
        return view('products.InstrumentsEquipment.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.InstrumentsEquipment.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = InstrumentsEquipment::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesInstrumentsEquipment::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.InstrumentsEquipment.index');
    }

    public function show($id)
    {
        $product = InstrumentsEquipment::with('images')->findOrFail($id);
        return view('products.InstrumentsEquipment.show', compact('product'));
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
