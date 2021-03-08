@section('title','Transactions')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-button onclick="window.location.href='/transaction/add'"> Add New Transaction</x-button>
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
                      <thead class=" text-dark">
                        <th>
                          #
                        </th>
                        <th>
                          Item ID
                        </th>
                        <th>
                          Amount
                        </th>
                        <th>
                          Payment
                        </th>
                        <th>
                          Date
                        </th>
                        {{-- <th>
                          Updated on
                        </th>
                        <th>Option</th> --}}
                      </thead>
                      <tbody>
                        @foreach ($transactions as $item)
                        <tr>
                          <td>
                            {{ $item->id }}
                          </td>
                          <td>
                            {{ $item->inv_id }}
                          </td>
                          <td>
                            {{ number_format($item->amt,2) }}
                          </td>
                          <td>
                            {{ $item->type }}
                          </td>
                          <td>
                            {{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                          </td>
                          {{-- <td>
                            {{ number_format($item->price,2) }}
                          </td>
                          <td>
                            {{ Carbon\Carbon::parse($item->updated_on)->format('M d, Y') }}
                          </td>
                          <td>
                            <x-button onclick="window.location.href='/item/{{ $item->id }}/edit'">View</x-button>
                          </td> --}}
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
      </div>
      
</x-app-layout>
