<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->api_key == 'kjbfsvkjbvsnllssjnvlsncacjknfkfnvkkdhsfkk'){
            $keranjang = Cart::all();
            $invoice = "INV-" . rand(1, 99999). '-'. time();
            $total = 0;
            foreach($keranjang as $item){
                $tamp = $item->subtotal;
                $total += $tamp;
            }
                $order = Order::create([
                'customer_name' => $request->customer_name,
                'invoice' => $invoice,
                'total' => $total,
                'table_id' => $request -> table_id
            ]);
            foreach($keranjang as $item){
                DetailOrder::create([
                    'product_id' => $item -> product_id,
                    'description' => $item -> description,
                    'quantity' => $item -> quantity,
                    'table_id' => $request -> table_id,
                    'order_id' => $order->id,
                ]);
            }
            Cart::truncate();
            return response()->json('oke');
        }else{
            return response()->json('salah');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // return $order->table;
        return view('order/detailorder', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
