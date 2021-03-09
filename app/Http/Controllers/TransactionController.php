<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Str;
use Auth;

class TransactionController extends Controller
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
    public function create(Request $request)
    {
        Session::put('current_nav', 'transactions');

        if(!Session::get('order_identifier')){
            Session::put('order_identifier',Str::random(8));
        }

        $items = Inventory::all();

        $orders = DB::table('orders')
        ->join('inventories', 'inv_id', 'orders.id')
        ->select('*', 'orders.qty as order_qty')
        ->where('order_identifier', Session::get('order_identifier'))
        ->get();


        return view('transactions.create', compact('items','orders'));
    }

    public function add($item_id)
    {
        Session::put('current_nav', 'transactions');

        $item = Inventory::findOrFail($item_id);
        $item->qty = $item->qty-1;
        $item->save();

        $order = new Order();
        $order->inv_id = $item->id;
        $order->qty = 1;
        $order->usr_id = Auth::user()->id;
        $order->order_identifier =  Session::get('order_identifier');
        $order->save();

        return redirect('/order/'.Session::get('order_identifier'))->with('success', $item->name.' is added to the cart.');

      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->type = $request->type;
        $transaction->amt = $request->amt;
        $transaction->inv_id = $request->inv_id;
        $transaction->order_identifier =  Session::get('order_identifier');
        $transaction->save();

        Session::forget('order_identifier');

        return redirect('/transaction/add')->with('success', 'Transaction is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transaction_id, $order_identifier)
    {
        $orders = DB::table('orders')
        ->join('inventories', 'inv_id', 'inventories.id')
        ->selectRaw('*, (sum(orders.qty)) as qty_total, orders.qty as order_qty, inv_id, orders.id as order_id')
        ->where('order_identifier', $order_identifier)
        ->groupBy('inv_id')
        ->get();

        $transaction = Transaction::findOrFail($transaction_id);

        return view('transactions.show', compact('orders','transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
