<x-app-layout>
    <x-slot name="header">
        Create Product
    </x-slot>

    <div class="max-w-3xl mt-10 bg-white shadow-md rounded-2xl p-8 ml-15">
        
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Create Product</h2>

        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif

        @if(session('success'))
            <div>{{session('success')}}</div>
        @endif

        <!-- Validation Errors  -->
        @if ($errors->any())
            <div class="mb-4 p-4 border-l-4 border-red-500 bg-red-50 text-red-700 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 

        <!-- Form  -->
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6 ml-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-600">Product Name</label>
                <input type="text" name="name" required id="name" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="Enter product name" value="{{ old('name') }}" required>
            </div>
            <!-- description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-600">Product Description</label>
                <input type="text" name="description" required id="description" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="Enter product name" value="{{ old('description') }}" required>
            </div>
            
            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                <input type="number" name="price" required id="price" step="0.01"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="Enter product price" value="{{ old('price') }}" required>
            </div>

            <!-- Quantity -->
            <div>
                <label for="stock_quantity" class="block text-sm font-medium text-gray-600">Quantity</label>
                <input type="number" name="stock_quantity" required id="stock_quantity" min="1"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                    placeholder="Enter quantity" value="{{ old('stock_quantity') }}" required>
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-600">Product Image</label>
                <input type="file" name="image" id="image" 
                    class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200" 
                    accept="image/*">
            </div>

            <!-- Submit -->
            <div class="mt-4 ">
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-black font-semibold rounded-lg shadow hover:bg-green-700 hover:text-white">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>