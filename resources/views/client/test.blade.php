<x-guest-layout>
    <x-slot name="header">
        <h1>Products for guest</h1>
    </x-slot>


    <div class="container">
        @foreach($products as $product)

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{asset('storage/uploads'. $product->image)}}" alt="Card image cap">
            <div class="card-body">
                <p>{{$product->name}}</p>
                <p class="card-text">{{$product->description}}</p>
                <hr>
                <p>{{$product->price}}</p>
            </div>
        </div>
        @endforeach
    
    </div>



</x-guest-layout>