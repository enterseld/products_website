<?php

namespace App\Http\Controllers;
use App\Models\Mills;
use App\Models\PicturesMills;
use Illuminate\Http\Request;

class MillsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all products with their images
        $products = Mills::with('images')->get();
        return view('products.Mills.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.Mills.create');
    }

    public function store(Request $request)
    {
        // Validate and save the new product
        $product = Mills::create($request->all());

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                PicturesMills::create([
                    'id' => (int)$product->id,
                    'vendor_code' => (int)$product->vendorCode,
                    'picture' => (string)$path,
                ]);
            }
        }

        return redirect()->route('products.Mills.index');
    }

    public function show($id)
    {
        $product = Mills::with('images')->findOrFail($id);
        return view('products.Mills.show', compact('product'));
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
