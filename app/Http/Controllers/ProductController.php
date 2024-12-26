<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $query = Product::query();

        return inertia('Inventory/Product/Index', [
            'products' => $query->search($request->search)
                ->latest()
                ->paginate(5)
                ->onEachSide(0)
                ->withQueryString(),

            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Inventory/Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['nullable'],
            'code' => ['required'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'lifting_price' => ['nullable'],
            'face_value' => ['required'],
            'offer' => ['nullable'],
        ]);

        Product::create($attributes);

        return to_route('product.index')->with('msg', 'New product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        return Inertia::render('Inventory/Product/Edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['nullable'],
            'code' => ['required'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'lifting_price' => ['nullable'],
            'face_value' => ['required'],
            'offer' => ['nullable'],
        ]);

        $product->update($attributes);

        return to_route('product.index')->with('msg', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return to_route('product.index')->with('msg', 'Product deleted successfully.');
    }
}
