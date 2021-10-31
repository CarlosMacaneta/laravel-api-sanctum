<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json(['products' => $products], 200);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        Product::create($request->all());

        return response()->json(['message' => 'Product added successfully.'], 200);
    }
}
