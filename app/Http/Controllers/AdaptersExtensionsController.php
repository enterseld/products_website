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
        return view('products.adaptersExtensions.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.adaptersExtensions.create');
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

        return redirect()->route('products.adaptersExtensions.index');
    }

    public function show($id)
    {
        $product = AdaptersExtensions::with('images')->findOrFail($id);
        return view('products.adaptersExtensions.show', compact('product'));
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
