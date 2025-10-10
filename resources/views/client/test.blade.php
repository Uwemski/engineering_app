<x-guest-layout>
    <x-slot name="header">
        <h1>Products for guest</h1>
    </x-slot>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-md-3">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{asset('storage/'. $product->image)}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h1 style='font-size: 1.5rem; font-weight: 600'>{{$product->name}}</h1><hr>
                                            <p class="card-text">{{$product->description}}</p>
                                            <hr>
                                            <p style='font-weight: 500'><strong>&#8358;</strong>{{$product->price}}</p>
                                            <a href="{{route('add.to.cart', $product->id)}}" class="btn btn-warning">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
            

       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    
    </div>



</x-guest-layout>