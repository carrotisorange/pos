@section('title','Add New Inventory')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Inventory
        </h2>   
      
    </x-slot>
   
    
    <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-8 mx-auto">
                <form id="inventoryform" action="/item/store" method="POST">
                @csrf
                </form>
                <br>
               <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name of the item')" />

                <x-input form="inventoryform" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <br>
            <!-- Brand -->
         <div>
             <x-label for="brand" :value="__('Brand')" />

             <x-input form="inventoryform" id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" required autofocus />
         </div>

         <br>
         <!-- Price -->
      <div>
          <x-label for="price" :value="__('Price')" />

          <x-input form="inventoryform" id="price" class="block mt-1 w-full" type="number" step="0.001" min="1" name="price" :value="old('price')" required autofocus />
      </div>
      <br>
       <!-- Quantity -->
       <div>
        <x-label for="qty" :value="__('Quantity')" />

        <x-input form="inventoryform" id="qty" class="block mt-1 w-full" type="number" min="1" name="qty" :value="old('qty')" required autofocus />
    </div>
    <br>
    <!-- Quantity -->
    <div>

    <p class="text-right">
        <x-button form="inventoryform" >Add Item</x-button>
    </p>
 </div>

            </div>
  
          </div>
        </div>
      </div>
      
</x-app-layout>
