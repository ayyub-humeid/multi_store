<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductApiResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth:sanctum')->expect('index','show');
    }
    public function index(Request $request)
    {
        $products = Product::filter($request->query())->with('category:id,name','store:id,name','tags:id,name')->paginate();
        return ProductApiResource::collection($products);
        // return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'category_id'=> 'required|exists:categories,id',
            'status' ,'in:active,inactive',
            'price'=> 'required|numeric|min:0',
            'compare_price'=> 'nullable|numeric|gt:price',
        ]);
        $product = Product::create($request->all());
        return response()->json($product,201,[
            'location'=> route('dashboard.products.show',$product->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::findOrFail($id)->load(['category:id,name','store:id,name']);
        $product = Product::findOrFail($id);
        return new ProductApiResource($product);
        // return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'sometimes|required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'category_id'=> 'sometimes|required|exists:categories,id',
            'status' ,'in:active,inactive',
            'price'=> 'sometimes|required|numeric|min:0',
            'compare_price'=> 'nullable|numeric|gt:price',
        ]);

        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json(null,204);
    }
}
