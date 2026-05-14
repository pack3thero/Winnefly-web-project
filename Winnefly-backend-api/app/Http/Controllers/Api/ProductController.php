<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()
        ->paginate(10)
        ->withQueryString();

        return new ProductCollection($products);

        
    }

    public function store (ProductRequest $request) {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        return (new ProductResource($product))->response()->setStatusCode(201);
    }

  public function show(Product $product)
        {
            $product->load('category');

            return (new ProductResource($product))->additional([
                'status' => true,
                'message' => 'Product retrieved successfully',
            ]);
        }

    public function update (ProductRequest $request, Product $product){
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
                $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return (new ProductResource($product))->additional([
            'status' => true,
            'message' => 'Product updated successfully',
        ]);
    }

    public function destroy (Product $product) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
