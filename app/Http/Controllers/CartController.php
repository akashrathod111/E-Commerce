<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Products $product)
    {
        $existingCartItem = Cart::where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + 1,
            ]);
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1, 
                'price' => $product->price,
            ]);
        }
        return redirect()->route('frontend.index')
            ->with('success', 'Product added to cart successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
