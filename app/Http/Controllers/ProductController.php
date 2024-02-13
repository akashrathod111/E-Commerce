<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use App\Models\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with('category','vendor')->latest()->paginate(5);
        return view('product.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get()->pluck('name', 'id');
        $vendors = Vendor::get()->pluck('name', 'id');

        return view('product.create',compact('categories','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'vendor_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        Products::create($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        $product->with('category','vendor');
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $categories = Category::get()->pluck('name', 'id');
        $vendors = Vendor::get()->pluck('name', 'id');
        return view('product.edit',compact('product','categories','vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'cat_id' => 'required',
            'vendor_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
         
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
