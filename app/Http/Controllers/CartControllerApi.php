<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cart = Cart::all();
        $cart = Cart::join('products', 'products.id', '=', 'carts.product_id')->select('carts.*', 'products.name', 'products.price')->get();
        return $cart;
        return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->api_key == "1234") {
            $product = Product::where('id', $request->product_id)->first();
            $subtotal = $product->price * $request->quantity;
            $cart = Cart::all();
            foreach ($cart as $item) {
                if ($item->product_id == $request->product_id) {
                    Cart::where('id', $item->id)->update([
                        'quantity' => $item->quantity + $request->quantity,
                    ]);
                    return response()->json('yeyy berhasil!!!');
                }
            }

            $cart = Cart::create([
                'product_id' => $request->product_id,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'subtotal' => $subtotal,
            ]);
            return response()->json('yeyy berhasil!!!');
        } else {
            return response()->json('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->api_key == "1234") {
            $cart = Cart::where('id', $request->id)->first();
            if ($cart->quantity > 1) {
                Cart::where('id', $cart->id)->update([
                    'quantity' => $cart->quantity - 1
                ]);
                return response()->json('oke');
            }
            Cart::destroy($request->id);
            return response()->json('oke');
        } else {
            return response()->json('no');
        }
    }
}
