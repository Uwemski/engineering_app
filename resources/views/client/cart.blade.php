<x-guest-layout>
    <x-slot name="header">
        <h1>View Cart</h1>
    </x-slot-header>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                <div class="card-body">
                    <div class="row">
                        @if(session('cart'))
                            <table border='1' class='table table-hover'>
                                <tr>
                                    <th>Picture</th>
                                    <th>Prod</th>
                                    <th>Price(&#8358;)</th>
                                    <th>quantity</th>
                                    <th>SubTotal(&#8358;)</th>
                                    <th>Delete</th>
                                </tr>
                                
                                <tbody>
                                    <?php
                                        $total = 0;
                                    ?>
                                @foreach(session('cart') as $key => $data )
                                    
                                    <?php
                                        $total += $data['price'] * $data['quantity']; 
                                    ?>
                                    <tr data-id= {{$key}}>
                                        <td><img src="{{asset('storage/' . $data['image'])}}" alt="product-image" style="max-width: 60px; height: 60px"></td>
                                        <td>{{$data['name']}}</td>
                                        <td>{{$data['price']}}</td>
                                        <td>
                                            <input type="number" name="quantity" value="{{$data['quantity']}}" min="1" class="form-control quantity">
                                        </td>
                                        <td>{{$data['price'] * $data['quantity']}}</td>
                                        <td class="text-danger">
                                            <form action="{{route('cart.delete', $key)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button>
                                                    <i class=" fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan= "5" class="text-end"><strong>Total </strong>: &#8358;{{$total}}</td>
                                        <td class="p-2">
                                            @if(Auth::check())
                                            <form action="{{route('cart.checkout')}}" method='GET'>
                                                <button class="btn btn-success"><strong>Checkout</strong></button>
                                            </form>
                                            @else
                                            <a href="/login" class="btn btn-warning">Login to checkout</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
<script>
    $('body').on('change', '.quantity', function(e){
    //    alert();
     var elem = $(this);

     $.ajax({
        
        url: "{{route('cart.update')}}",
        method: "POST",
        data: {
            _token: "{{csrf_token() }}",
            product_id: elem.parents('tr').attr('data-id'),
            quantity: elem.val()
        },
        success:  function (response) {
            console.log(response);
        }
     })

    //  $.ajax({
    //     url: "{{route('cart.delete', $key)}}",
    //     method: "DELETE",
    //     data: {
    //         _token: "{{csrf_token() }}",
    //         product_id: elem.parents('tr').attr('data-id') 
    //     },
    //     success: function (response) {
    //         console.log(response);
    //     }
    //  })

    });
</script>