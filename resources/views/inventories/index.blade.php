@section('title','Inventories')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-button onclick="window.location.href='/item/add'"> Add New Item</x-button>
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
                          Name
                        </th>
                        <th>
                          Brand
                        </th>
                        <th>
                          Qty
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Updated on
                        </th>
                        <th></th>
                      </thead>
                      <tbody>
                        @foreach ($items as $item)
                        <tr>
                          <td>
                            {{ $item->id }}
                          </td>
                          <td>
                            {{ $item->name }}
                          </td>
                          <td>
                            {{ $item->brand }}
                          </td>
                          <td>
                            {{ $item->qty }}
                          </td>
                          <td>
                            {{ number_format($item->price,2) }}
                          </td>
                          <td>
                            {{ Carbon\Carbon::parse($item->updated_at)->format('M d, Y') }}
                          </td>
                          <td>
                            <x-button onclick="window.location.href='/item/{{ $item->id }}/edit'">View</x-button>
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
      </div>
      
</x-app-layout>
