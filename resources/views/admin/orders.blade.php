<x-guest-layout>
    <x-slot name="header">
        View Orders
    </x-slot-header>

    <div class="container">
        <div class="row">
            <div class="text-center b-3">
                <h1 class="h1">All orders</h1> 
            </div>
            <div class="row">
                <table border='1' class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Product name</th>
                            <th>Total</th>
                            <th>Payment Status</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-guest-layout>