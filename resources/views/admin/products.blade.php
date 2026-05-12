<x-admin-layout>
    <x-slot name="header">
        View Product
    </x-slot>

    <div class="max-w-3xl mt-10 bg-white shadow-md rounded-2xl p-8 ml-15">
        
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Create Product</h2>

        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif

        @if(session('empty'))
            <div>{{session('empty')}}</div>
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
                <tr id="pro-{{$pro->id}}">
                    <td>{{$serial_no}}</td>
                    <td>{{$pro->name}}</td>
                    <td>{{$pro->description}}</td>
                    <td>{{$pro->price}}</td>
                    <td>{{$pro->stock_quantity}}</td>
                    <td>
                        <button id="Form" onclick="editForm({{$pro->id}})">Edit</button>
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
        <form id="productEditForm" style='display:none; margin-top:1.5rem' 
            method="POST" 
            enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="mb-3">
                <!-- <img src="storage/app/"> -->
                <input type="hidden" id="productId">
            </div>
            <div class="mb-3">
                <label for="productName">Name</label>
                <input type="text" name="name" id="productName" class="form-control">
            </div>
            <div class="mb-3">
                <label for="productDescription">Description</label>
                <input type="text" name="description" id="productDescription" class="form-control">
            </div>
            <div class="mb-3">
                <label for="productPrice">Price</label>
                <input type="number" name="price" min='1' id="productPrice" class="form-control">
            </div>
            <div class="mb-3">
                <label for="productStockQuantity">Quantity</label>
                <input type="text" name="stock_quantity" id="productStockQuantity" class="form-control">
            </div>

            <button type='submit'>Submit</button>

            <button type='button' onclick="removeForm()">Cancel</button>
        </form>
        <div id='resultDiv'></div>
    </div>
    <script>
        const resultDiv = document.getElementById('resultDiv');
        
        function editForm(proId) {
            document.getElementById('productEditForm').style.display = 'block';
            // const resultDiv = document.getElementById('resultDiv');
            const productId = document.getElementById('productId')
            const productName = document.getElementById('productName')
            const productDescription = document.getElementById('productDescription')
            const productPrice = document.getElementById('productPrice')
            const productStockQuantity = document.getElementById('productStockQuantity')

            fetch(`{{ url('/product/edit') }}/${proId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    productId.value = data.data.id;
                    productName = data.data.name;
                    productDescription.value = data.data.description;
                    productPrice.value = data.data.price;
                    productStockQuantity.value = data.data.stock_quantity;

                    console.log(data)
                }else{
                    resultDiv.innerHTML = `<p style='color: red'>${data.error}</p>`
                }
                
            })
            .catch(error => console.log(error) )
        }

        document.getElementById('productEditForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const productId = document.getElementById('productId').value;

            const formData = new FormData(this);
            formData.append('_method', 'PUT');
            
            fetch(`{{ url('product/update') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                    'Accept': 'application/json',
                    // DO NOT set Content-Type - browser sets it automatically for FormData
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if(data.success) {
                    resultDiv.innerHTML = `<p style='color:green'>${data.message}</p>`;
                    
                    // Update the table row without page reload
                    const row = document.querySelector(`#pro-${productId}`);
                    if(row) {
                        const cells = row.querySelectorAll('td');
                        cells[1].textContent = document.getElementById('productName').value;
                        cells[2].textContent = document.getElementById('productDescription').value;
                        cells[3].textContent = document.getElementById('productPrice').value;
                        cells[4].textContent = document.getElementById('productStockQuantity').value;
                    }
                    
                    document.getElementById('productEditForm').reset();
                    document.getElementById('productEditForm').style.display = 'none';
                } else {
                    resultDiv.innerHTML = `<p style='color:red'>${data.error || 'Update failed'}</p>`;
                }
            })
            .catch(error => {
                console.log(error);
                resultDiv.innerHTML = `<p style='color:red'>Something went wrong</p>`;
            });
        });

        function removeForm() {
            document.getElementById('productEditForm').style.display = 'none';
        }
    </script>
</x-admin-layout>