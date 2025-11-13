<x-guest-layout>
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
                        @foreach($orders as $d)
                        <tr>
                            <td>S/N</td> 
                            <td>@foreach($d->orderItems as $o)
                                    {{$o->product->name}}
                                    (x {{$o->quantity}})
                                @endforeach
                            </td>
                            <td>{{$d['total_amount']}}</td>
                            <td>{{$d['payment_status']}}</td>
                            <td>{{$d['status']}}</td>
                            <td>
                                <form action="{{route('order.update', $d->id)}}" method="post" class="d-flex">
                                    @csrf
                                    <select name="status" id="status" class="form-select">
                                        <option value="pending" {{$d->status == 'pending' ? 'selected' : ''  }}>PENDING</option>
                                        <option value="in_production" {{$d->status == 'in_production' ? 'selected' : ''  }}>IN_PRODUCTION</option>
                                        <option value="completed" {{$d->status == 'completed' ? 'selected' : ''  }}>COMPLETED</option>
                                        <option value="delivered" {{$d->status == 'delivered' ? 'selected' : ''  }}>DELIVERED</option>
                                    </select>

                                    <button class="btn btn-success">Update</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-guest-layout>