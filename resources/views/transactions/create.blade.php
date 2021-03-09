@section('title','Add New Transaction')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction #:{{ Session::get('order_identifier')}}, Cashier: {{ Auth::user()->name }}, <span class="text-right">Date: {{  Carbon\Carbon::now() }}</span><p class="text-right">
                <form id="transactionForm" action="/transaction/store" method="POST">
                    @csrf
                </form>
                <x-button form="transactionForm"> Checkout</x-button>
               </p>
        </h2>   
      
    </x-slot>
   
    
    <div class="content">
       
        <div class="container">
           
          <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                <form id="inventoryform" action="/item/store" method="POST">
                @csrf
                </form>
                <table class="table table-responsive table-bordered">
                    <thead border="1" width="183" style='table-layout:fixed'>
                        <?php $ctr=1; ?>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <td></td>
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
                                <td width="50">
                                    <form action="/order/{{ Session::get('order_identifier') }}/inventory/{{ $order->id }}/item/{{ $order->order_id }}/remove" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-input class="form-control" type="number" value="{{ $order->qty_total }}"/>
                                    </form>
                                </td>
                                <td>{{ number_format($order->price*$order->qty_total, 2) }}
                         
                                </td>
                                <td width="50">
                                  
                                        <x-button onclick="window.location.href='/order/{{ Session::get('order_identifier') }}/inventory/{{ $order->id }}/item/{{ $order->order_id }}/remove'"> 
                                            Remove
                                        </x-button>

                                </td>
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
                        <input form="transactionForm" type="hidden" name="amt" value="{{ $orders->sum('qty_total')*$orders->sum('price') }}">
                        <input form="transactionForm" type="hidden" name="type" value="cash">
                        <input form="transactionForm" type="hidden" name="usr_id" value="{{ Auth::user()->id }}">
                            </th>
                            <th></th>
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
                <form action="/order/{{ Session::get('order_identifier') }}" method="GET" >
                    @csrf
                    <div class="input-group">
                        <x-input type="text" class="form-control" name="item" placeholder="e.g., Eden Cheese" />
                        <div class="input-group-append">
                            <x-button onclick="window.location.href='/order/{{ Session::get('order_identifier') }}'"> 
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
                    
                        <td class="text-center" width="50">
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
