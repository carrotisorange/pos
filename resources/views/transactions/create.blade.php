@section('title','Add New Transaction')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Transaction
        </h2>   
      
    </x-slot>
   
    
    <div class="content">
       
        <div class="container">
            <br>
           <p class="text-right">
            <x-button onclick="window.location.href='/transaction/store'"> Checkout</x-button>
           </p>
          <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                <form id="inventoryform" action="/item/store" method="POST">
                @csrf
                </form>
                <table class="table table-responsive table-bordered">
                    <thead>
                        <?php $ctr=1; ?>
                        <tr>
                            <th>#</th>
                            <th>Item ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th>{{$ctr++ }}</th>
                                <th>{{ $order->inv_id }}</th>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->qty_total }}</td>
                                <td>{{ number_format($order->price*$order->qty_total, 2) }}</td>
                            </tr>
                        @endforeach
                        @if($orders->count()<=0)
                         <tr>
                            <th colspan="7" class="text-center text-danger">
                                No added items to the cart.
                            </th>
                            </tr>
                        @else
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
                        @endif
                       
                    </tbody>
                </table>
            
            </div>
        </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                <form action="/transaction/add" method="GET" >
                    @csrf
                    <div class="input-group">
                        <x-input type="text" class="form-control" name="item" placeholder="e.g., Eden Cheese" />
                        <div class="input-group-append">
                            <x-button onclick="window.location.href='/transaction/add'"> 
                                Clear
                            </x-button>
                          <x-button type="submit">
                           Search
                          </x-button>
                        </div>
                    </div>
                </form>
                <br>
                <p class="text-center">Showing <b>{{ $items->count() }}</b> item/s.</p>
                <br>
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>   
                        <td>{{ number_format($item->price, 2) }}</td>  
                        <td>
                        @if($item->qty <=0 )
                        <span class="text-danger">Out of stock</span> 
                        @else
                        {{ $item->qty }}
                        @endif
                        </td>    
                    
                        <td class="text-center">
                        @if($item->qty <=0 )
                        <x-button class="text-center" disabled onclick="window.location.href='/item/{{ $item->id }}/add'"> Add</x-button>
                        @else
                        <x-button class="text-center" onclick="window.location.href='/item/{{ $item->id }}/add'"> Add</x-button>
                        @endif   
                    </td>
                    </tr> 
                    @endforeach
                    </tbody>
                  
                </table>
            </div>
        </div>
          </div>
          </div>
        </div>
      </div>
      
</x-app-layout>
