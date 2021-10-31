<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['products' =>  Product::all()], 200);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        Product::create($request->all());

        return response()->json(['message' => 'Product added successfully.'], 200);
    }

    public function show($id): JsonResponse
    {
        if (!$product = Product::find($id)){
            return response()->json(['message' => 'No product found'], 404);
        }
        return response()->json(['products' => $product], 200);
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        if (!$product = Product::find($id)){
            return response()->json(['message' => 'No product found'], 404);
        }
        $product->update($request->all());
        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function destroy($id): JsonResponse
    {
        if (!$product = Product::find($id)){
            return response()->json(['message' => 'No product found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
