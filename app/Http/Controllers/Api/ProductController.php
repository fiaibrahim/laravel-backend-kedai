<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products
        $products = Product::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:food,drink,snack',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        // Define a unique filename
        $filename = time() . '.' . $request->image->extension();

        // Store image and handle upload failure
        if ($request->file('image')->storeAs('public/products', $filename)) {
            // Create the product
            $product = Product::create([
                'name' => $request->name,
                'price' => (int) $request->price,
                'stock' => (int) $request->stock,
                'category' => $request->category,
                'image' => $filename,
                'is_favorite' => $request->is_favorite ?? false, // default to false if not set
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product Created',
                'data' => $product
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve product by ID
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic for updating a product can go here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic for deleting a product can go here
    }
}
