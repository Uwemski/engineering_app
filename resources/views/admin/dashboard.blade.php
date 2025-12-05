<x-admin-layout>
        <div class="row">
            <div class="col-md-4">
                <h1>Welcome Admin</h1>
            </div>

            <div class="d-flex d-flex-row justify-content-center">
                <div class="card mt-3 bg-success mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Number Of Registered Users</h5>
                        <p class="card-text text-center" style="font-size: 3rem; font-weight: 700">{{$user_amount}}</p>
                        {{-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> --}}
                    </div>
                </div>

            <div class="card mt-4 bg-primary mx-1" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Number Of Registerd Products</h5>
                    <p class="card-text text-center" style="font-size: 3rem; font-weight: 700">{{$products}}</p>
                            {{-- <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>

            <div class="card mt-5 bg-secondary mx-1" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Number Of Orders</h5>
                    <p class="card-text text-center" style="font-size: 3rem;  font-weight: 700">{{$order_amount}}</p>
                            {{-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>
        </div>
    </div>




</x-admin-layout>