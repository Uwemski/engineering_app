<x-app-layout>
    <x-slot name="header">
        View Product
    </x-slot>

    <div class="max-w-3xl mt-10 bg-white shadow-md rounded-2xl p-8 ml-15">
        
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Create Product</h2>

        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif

        <!-- table -->
        <table border="1" class="table-auto">

            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $serial_no=1?>
                @foreach($product as $pro)
                <tr>
                    <td>{{$serial_no}}</td>
                    <td>{{$pro->name}}</td>
                    <td>{{$pro->description}}</td>
                    <td>{{$pro->price}}</td>
                    <td>{{$pro->stock_quantity}}</td>
                    <td>
                        <form action="{{route('product.edit', $pro->id)}}" method="POST">
                            @csrf
                            <button>Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('product.delete', $pro->id)}}" method="POST">
                            @csrf
                            <button>Delete</button>
                        </form>
                    </td>
                    <?php $serial_no++ ?>
                </tr>
                    
                @endforeach
            </tbody>

        </table>

    </div>
</x-app-layout>