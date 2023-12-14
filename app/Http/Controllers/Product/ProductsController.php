<?php

namespace App\Http\Controllers\Product;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Loaders\ProductLoaders;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(ProductFilters $filters)
    {
        return ProductResource::collection(Product::query()->myBusiness()->filter($filters));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        
        return new ProductResource($request->persist());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, ProductLoaders $loaders)
    {
        if ($product->business_id != Auth::user()->business_id) {
            abort(403);
        }

        return new ProductResource($product->filter($loaders));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        return new ProductResource($request->persist($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->business_id == Auth::user()->business_id) {
            $product->delete();

            return response()->json([], 204);
        }
        abort(403);
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()
            ->myBusiness()
            ->where('id', $id)
            ->first();

        if (empty($product)) {
            abort(403);
        }

        $product->restore();

        return new ProductResource($product->fresh());
    }
}
