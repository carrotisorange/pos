@section('title',$item->name)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $item->name }}
        </h2>   
      
    </x-slot>
   
    
    <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-8 mx-auto">
                <form id="inventoryform" action="/item/{{ $item->id }}/update" method="POST">
                @csrf
                @method('PUT')
                </form>
                <br>
               <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name of the item')" />

                <x-input form="inventoryform" id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $item->name }}" required autofocus />
            </div>
            <br>
            <!-- Brand -->
         <div>
             <x-label for="brand" :value="__('Brand')" />

             <x-input form="inventoryform" id="brand" class="block mt-1 w-full" type="text" name="brand" value="{{ $item->brand }}" required autofocus />
         </div>

         <br>
         <!-- Price -->
      <div>
          <x-label for="price" :value="__('Price')" />

          <x-input form="inventoryform" id="price" class="block mt-1 w-full" type="number" step="0.001" min="1" name="price" value="{{ $item->price }}" required autofocus />
      </div>
      <br>
       <!-- Quantity -->
       <div>
        <x-label for="qty" :value="__('Quantity')" />

        <x-input form="inventoryform" id="qty" class="block mt-1 w-full" type="number" min="1" name="qty" value="{{ $item->qty }}" required autofocus />
    </div>
    <br>
    <!-- Quantity -->
    <div>
    <p class="text-right">
        <x-button onclick="window.location.href='/item/add'">Add Another Item</x-button>
        <x-button form="inventoryform" >Update Item</x-button>
    </p>
 </div>

            </div>
  
          </div>
        </div>
      </div>
      
</x-app-layout>
