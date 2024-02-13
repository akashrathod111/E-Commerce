<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $cartData = Cart::with('product')->get();

        $cartCount = $cartData->count();
        $cartItems = $cartData->all();
        
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->product->price * $cartItem->quantity;
        }
        return view('frontend.cart.checkout',['cartItems' => $cartItems,'cartCount'=> $cartCount,'totalPrice' => $totalPrice,]);
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
    public function store(Request $request)
    {
        $cartData = Cart::with('product')->get();
        $cartItemsProductIds = $cartData->pluck('product_id')->toArray();
        $cartItemsIds = $cartData->pluck('id')->toArray();

        $totalPrice = $cartData->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $selectedProductIds = $cartItemsProductIds;

        $params = [
            'total_amount' => $totalPrice,
            'payment_method' => 'cod',
        ];

        $order = Checkout::create($params);

        // also store the product_orders table data
        if (is_array($selectedProductIds)) {
            $order->products()->attach($selectedProductIds);
        }

        // after successfully order places then delete cart records
        // also we can remove items as user_id wise but in our case we did not use user_id because we not use client frountside auth 
        Cart::whereIn('id', $cartItemsIds)->delete();

        return redirect()->route('thank-you')->with('success', 'Order placed successfully. We will contact you for payment.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
