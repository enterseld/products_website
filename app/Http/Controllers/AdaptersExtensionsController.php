<?php

namespace App\Http\Controllers;

use App\Models\AdaptersExtensions;
use App\Models\PicturesAdaptersExtensions;
use Illuminate\Http\Request;


class AdaptersExtensionsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = AdaptersExtensions::with('images')->get();
        return view('products.AdaptersExtensions.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.AdaptersExtensions.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = AdaptersExtensions::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesAdaptersExtensions::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.AdaptersExtensions.index');
    }

    public function show($vendor_code)
    {
        // Fetch the product by its ID
        $product = AdaptersExtensions::with('images')->where('vendor_code', $vendor_code)->firstOrFail();

        // Pass the product to the view
        return view('products.show', compact('product'));
    }

    public function getProduct($id) {
        $product = AdaptersExtensions::findOrFail($id); // Or other models based on type
        $product->images = $product->pictures;   // Assuming you have a relation for images
        return response()->json($product);
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
