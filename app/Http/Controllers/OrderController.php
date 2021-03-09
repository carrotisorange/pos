<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Inventory;
use DB;
use Session;

class OrderController extends Controller
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
    public function create(Request $request, $order_identifier)
    {
        
        $items = DB::table('inventories')
        ->whereRaw("name like '%$request->item%'")
        ->get();

        $orders = DB::table('orders')
        ->join('inventories', 'inv_id', 'inventories.id')
        ->selectRaw('*, (sum(orders.qty)) as qty_total, orders.qty as order_qty, inv_id, orders.id as order_id')
        ->where('order_identifier', Session::get('order_identifier'))
        ->groupBy('inv_id')
        ->get();

         return view('transactions.create', compact('items', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
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
    public function update(Request $request, $order_identifier, $inv_id, $item_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_identifier, $inv_id, $item_id)
    {
        $orders = DB::table('orders')
        ->join('inventories', 'inv_id', 'inventories.id')
        ->where('inv_id', $inv_id)
        ->sum('orders.qty');

        $item = Inventory::findOrFail($inv_id);
        $item->qty = $item->qty+$orders;
        $item->save();
          
        DB::table('orders')
         ->where('inv_id', $inv_id)
         ->delete();

        return back()->with('success', $item->name.' is removed successfully.');
    }
}
