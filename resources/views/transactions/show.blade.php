@section('title','Transactions')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction #:{{ $transaction->order_identifier }}, Cashier: {{ $transaction->id }}, <span class="text-right">Date: {{  Carbon\Carbon::parse($transaction->created_at)->format('M d, Y').','.Carbon\Carbon::parse($transaction->created_at)->toTimeString() }}</span><p class="text-right">
        </h2>   
    </x-slot>
   
    
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 mx-auto">
              <div class="card">
                {{-- <div class="card-header card-header-primary">
                  <h4 class="card-title ">Simple Table</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div> --}}
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <?php $ctr=1; ?>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th width="5">{{$ctr++ }}</th>
                                    <th width="50">{{ $order->inv_id }}
                                        <input form="transactionForm" type="hidden" name="inv_id" value="{{ $order->inv_id }}">
                                    </th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ number_format($order->price, 2) }}</td>
                                    <td>{{ $order->qty_total }}</td>
                                    <td>{{ number_format($order->price*$order->qty_total, 2) }}
                             
                                    </td>
                                   
                                </tr>
                            @endforeach
                            
                           
                            <tr>
                                <th>TOTAL</th>
                      
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            
                                <th>
                                 
                            {{ number_format($orders->sum('qty_total')*$orders->sum('price'), 2) }}
                 
                                </th>
                               
                            </tr>
                            
                           
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  
          </div>
        </div>
      </div>
      
</x-app-layout>
