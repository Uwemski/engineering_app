<x-donpas-layout title="Checkout">

    <x-slot name="styles">
        <style>
            /* ── LIGHT BODY OVERRIDE for cart page ── */
            body { background:#f5f4f0 !important; color:#1a1a1a !important; }

            .form-title {
                font-family: 'DM Serif Display', serif;
                font-size: 2rem;
                color: #1a1a1a;
                margin-bottom: 0.25rem;
                letter-spacing: -0.5px;
            }

            .form-subtitle {
                font-size: 0.875rem;
                color: #888;
                margin-bottom: 2.5rem;
            }

            .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #555;
        }

        .form-input {
            padding: 0.75rem 1rem;
            border: 1.5px solid #e5e2d9;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: #1a1a1a;
            background: #fafaf8;
            transition: all 0.2s ease;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }
        </style>
    </x-slot>
    <x-donpas-header>
        eyebrow => 'Your Order'
        title => 'YOUR'
        highlight => 'CHECKOUT'
        description => ''
        breadcrumbs => "[
            [ 'Label'=>'Home', 'url'=> '/'],
            ['label'=>'Products','url'=>'/guest'],
            ['label'=>'cart',]
        
        ]"

    </x-donpas-header>

    <section>
       <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4 form-title">
                            <h3 class="mb-4 text-center">Checkout</h3>

                            {{-- Checkout Form --}}
                            <form action="{{route('cart.process.checkout')}}" method="POST"> @csrf {{-- Customer Details --}} <div class="row mb-4 form-group"> <div class="col-md-6 mb-3"> <label for="name" class="form-label fw-bold">Full Name</label> <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name ?? '') }}" required> </div> <div class="col-md-6 mb-3 form-group"> <label for="email" class="form-label fw-bold">Email</label> <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email ?? '') }}" required> </div> <div class="col-md-6 mb-3 form-group"> <label for="phone" class="form-label fw-bold">Phone Number</label> <input type="tel" name="phone" id="phone" class="form-control" required> </div> <div class="col-md-6 mb-3 form-group"> <label for="address" class="form-label fw-bold">Delivery Address</label> <input type="text" name="address" id="address" class="form-control" required> </div> </div> {{-- Order Summary --}} <h5 class="fw-bold mt-4 mb-3">Order Summary</h5> <div class="table-responsive"> <table class="table table-bordered align-middle text-center"> <thead class="table-light"> <tr> <th>Product</th> <th>Qty</th> <th>Price (₦)</th> <th>Total (₦)</th> </tr> </thead> <tbody> @php $grandTotal = 0; @endphp @foreach(session('cart', []) as $id => $details) @php $total = $details['price'] * $details['quantity']; @endphp <tr> <td>{{ $details['name'] }}</td> <td>{{ $details['quantity'] }}</td> <td>{{ number_format($details['price'], 2) }}</td> <td>{{ number_format($total, 2) }}</td> </tr> @php $grandTotal += $total; @endphp @endforeach </tbody> <tfoot class="fw-bold"> <tr> <td colspan="3" class="text-end">Grand Total</td> <td>₦{{ number_format($grandTotal, 2) }}</td> </tr> </tfoot> </table> </div> {{-- Submit --}} <div class="text-center mt-4"> <button type="submit" class="btn btn-success px-4 py-2"> Confirm & Place Order </button> </div> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    

</x-donpas-layout>