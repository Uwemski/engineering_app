<x-guest-layout>
    <!-- //header goes here  -->
    <x-slot name="header">
        <h1>Contact Us</h1>
    </x-slot-header>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @else(session('error'))
                    <div class="alert alert-warning">{{session('error')}}</div>
                @endif

                <form action="{{route('enquiry.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="Name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required value="{{old('name')}}">
                    </div>
                    @error('name')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    <div class="mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required value="{{old('email')}}">
                    </div>
                    @error('email')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    <div class="mb-3">
                        <label for="message">Message</label><br>
                        <textarea name="message" id="message" class="form-select-control"required>{{old('message')}}</textarea>
                    </div>
                    @error('message')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    <div class="text-center">
                        <button class="btn btn-primary">Contact us</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>