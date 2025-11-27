<x-client-layout>
    <x-slot name="header">
        <h1>View Orders</h1>
    </x-slot-header>

    <div class="container">
        <div class="row mt-3">
                <table border='1' class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Total Amount(&#8358;)</th>
                            <th>Payment Status</th>
                            <th>Transaction reference</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $serialNo = 1;?>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$serialNo}}</td>
                            <td>
                                @foreach($order->orderItems as $ord)
                                    {{$ord->product->name }}
                                @endforeach
                            </td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->total_amount}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->transaction_reference}}</td>
                            <td>{{$order->created_at->format('d/m/y')}}</td>
                        </tr>
                        <?php $serialNo ++;?>
                        @endforeach
                    </tbody>
                </table>
            
        </div>
    </div>

</x-client-layout>