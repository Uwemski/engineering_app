<x-guest-layout>

    {{-- Top Navigation --}}
    <nav class="bg-slate-900 border-b border-slate-700 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Brand --}}
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-amber-500 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 4h8l-1 1v5l5 5c1 1 0 3-2 3H6c-2 0-3-2-2-3l5-5V5L8 4z"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold text-lg tracking-wide">
                        EngineerCraft
                    </span>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center space-x-6">

                    <a href="#" class="hidden md:block text-slate-300 hover:text-white">
                        Products
                    </a>

                    {{-- Cart --}}
                    <a href="{{ route('cart') }}"
                       class="relative flex items-center space-x-2 text-slate-300 hover:text-white">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                        </svg>

                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ count(session('cart', [])) }}
                            </span>
                        @endif

                        <span class="hidden sm:block">Cart</span>
                    </a>

                </div>
            </div>
        </div>
    </nav>

    {{-- Page Wrapper --}}
    <div class="pt-24 pb-16 bg-slate-100 min-h-screen">

        <div class="max-w-7xl mx-auto px-6">

            {{-- Page Header --}}
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-slate-800">
                    Engineering Equipment Catalog
                </h1>
                <p class="text-slate-600 mt-2">
                    Industrial-grade tools and precision machinery.
                </p>
            </div>

            {{-- Search --}}
            <div class="mb-8">
                <form action="{{ route('product.search') }}" method="POST"
                      class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="text"
                           name="name"
                           placeholder="Search tools, machines, parts..."
                           class="flex-1 px-4 py-3 rounded-md border border-slate-300 focus:ring-2 focus:ring-amber-500 focus:outline-none">

                    <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-md font-medium">
                        Search
                    </button>
                </form>
            </div>

            {{-- Products Grid --}}
           @if($products->count() > 0)
    <div class="space-y-4">

@foreach($products as $product)

    <div class="bg-white border border-slate-200 rounded-md p-4 hover:shadow-sm transition">

        <div class="flex gap-4 items-start">

            {{-- Small Fixed Image --}}
            <div class="w-28 h-28 flex-shrink-0 bg-slate-100 rounded overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>

            {{-- Product Info --}}
            <div class="flex-1">

                <h3 class="text-lg font-semibold text-slate-800 mb-1">
                    {{ $product->name }}
                </h3>

                <p class="text-sm text-slate-600 mb-3 leading-snug">
                    {{ $product->description }}
                </p>

                <div class="flex items-center justify-between flex-wrap gap-3">

                    <div class="text-xl font-bold text-slate-900">
                        ₦{{ number_format($product->price) }}
                    </div>

                    <form method="POST"
                          action="{{ route('add.to.cart', $product->id) }}"
                          class="flex items-center gap-2">

                        @csrf

                        <input type="number"
                               name="quantity"
                               min="1"
                               value="1"
                               class="w-16 border border-slate-300 rounded px-2 py-1 text-sm text-center focus:ring-1 focus:ring-amber-500 focus:outline-none">

                        <button type="submit"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-1.5 text-sm rounded">
                            Add
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endforeach

</div>

@endif


        </div>
    </div>

</x-guest-layout>
