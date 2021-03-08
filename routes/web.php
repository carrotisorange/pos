<?php

use Illuminate\Support\Facades\Route;
use App\Models\Inventory;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//routes for dashboard
Route::get('/dashboard', function () {
    Session::put('current_nav', 'dashboard');
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//routes for inventories
Route::get('/inventories', function () {
    Session::put('current_nav', 'inventories');

    $items = Inventory::all();

    return view('inventories.index', compact('items'));

})->middleware(['auth'])->name('inventories');

Route::get('/item/add', 'InventoryController@create')->middleware(['auth']);
Route::post('/item/store', 'InventoryController@store')->middleware(['auth']);
Route::get('/item/{edit_id}/edit', 'InventoryController@edit')->middleware(['auth']);
Route::put('/item/{edit_id}/update', 'InventoryController@update')->middleware(['auth']);
Route::get('/items/search/', 'InventoryController@search')->middleware(['auth']);

//routes for transactions
Route::get('/transactions', function () {
    Session::put('current_nav', 'transactions');

    $transactions = Transaction::all();

    // $transactions = DB::table('transactions')
    // ->join('inventories', 'inv_id', 'inventories.id')
    // ->orderBy('transactions.created_at')
    // ->get();

    return view('transactions.index', compact('transactions'));

})->middleware(['auth'])->name('transactions');


Route::get('/transaction/add', 'TransactionController@create')->middleware(['auth']);
Route::post('/transaction/add', 'TransactionController@create')->middleware(['auth']);
Route::get('/item/{item_id}/add', 'TransactionController@add')->middleware(['auth']);
Route::post('/transaction/store', 'TransactionController@store')->middleware(['auth']);
Route::get('/transaction/{edit_id}/edit', 'TransactionController@edit')->middleware(['auth']);
Route::put('/transaction/{edit_id}/update', 'TransactionController@update')->middleware(['auth']);

//routes for customers
Route::get('/customers', function () {
    Session::put('current_nav', 'customers');

    return view('customers.index');

})->middleware(['auth'])->name('customers');

Route::get('/', function () {
  
    return view('auth.login');
})->middleware(['auth']);

require __DIR__.'/auth.php';

// Route::get('/asa', function(){
//     return Session::get('current_nav');
// });