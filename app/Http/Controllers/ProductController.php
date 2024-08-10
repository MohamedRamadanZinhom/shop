<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);
        // Paginate results for performance
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created   
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'stock' => 'required|integer|min:0' 
        ]);

        if ($validator->fails()) {
            return redirect('product/create')
                ->withErrors($validator)
                ->withInput();
        }

        Product::create($request->all());

        return redirect('products')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'stock' => 'required|integer|min:0' 
        ]);

        if ($validator->fails()) {
            return redirect('product/' . $product->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $product->update($request->all());

        return redirect('products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.   

     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products')->with('success', 'Product deleted successfully');
    }
}
