<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AnyAdjustment;
use App\Models\PicturesAnyAdjustment;

class AnyAdjustmentController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = AnyAdjustment::with('images')->get();
        return view('products.AnyAdjustment.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.AnyAdjustment.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = AnyAdjustment::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesAnyAdjustment::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.anyAdjustment.index');
    }

    public function show($id)
    {
        $product = AnyAdjustment::with('images')->findOrFail($id);
        return view('products.anyAdjustment.show', compact('product'));
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
