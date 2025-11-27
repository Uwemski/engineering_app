<x-admin-layout>
    <x-slot name="header">
        View Orders
    </x-slot-header>

    <div class="container">
        <div class="row">
            <div class="text-center b-3">
                <h1 class="h1 mb-3">All orders</h1> 
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @else()
                <div class="alert alert-error">{{session('error')}}</div>
            @endif
            <div class="row">
                <table border='1' class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Product name</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Order status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $serial_no= 1 ?>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$serial_no}}</td> 
                            <td>@foreach($order->orderItems as $o)
                                    {{$o->product->name}}
                                    (x {{$o->quantity}})
                                @endforeach
                            </td>
                            <td>{{$order['total_amount']}}</td>
                            <td>{{$order['payment_status']}}</td>
                            <td>{{$order['status']}}</td>
                            <td>
                                <form action="{{route('order.update', $order->id)}}" method="post" class="d-flex">
                                    @csrf
                                    <select name="status" id="status" class="form-select">
                                        <option value="pending" {{$order->status == 'pending' ? 'selected' : ''  }}>PENDING</option>
                                        <option value="in_production" {{$order->status == 'in_production' ? 'selected' : ''  }}>IN_PRODUCTION</option>
                                        <option value="completed" {{$order->status == 'completed' ? 'selected' : ''  }}>COMPLETED</option>
                                        <option value="delivered" {{$order->status == 'delivered' ? 'selected' : ''  }}>DELIVERED</option>
                                    </select>

                                    <button class="btn btn-success">Update</button>
                                </form>
                            </td>
                        </tr> 
                        <?php $serial_no ++?>
                        @endforeach
                    </tbody>
                </table>
                {{$orders->links()}}
            </div>
        </div>
    </div>

</x-admin-layout>