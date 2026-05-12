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
                <div id="resultDiv" class='mb-3'></div>

                <form id="contactForm" action="{{route('enquiry.store')}}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Contact us</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = document.getElementById('contactForm');
            const formData = new FormData(this);
            const messageDiv = document.getElementById('resultDiv');

            fetch(form.action, {
                method: form.method,
                'headers':{
                    'x-csrf-token': '{{csrf_token()}}',
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status)
                return response.json()
            })
            .then(data => {
                if(data.success) {
                    messageDiv.innerHTML = `<p style='color:green'>${data.message}</p>`
                    this.reset();
                }else{
                    messageDiv.innerHTML = `<p style='color:red'>${data.error}</p>`
                }
                
            })
            .catch(error => {
                console.error(error)
                messageDiv.innerHTML = `<p style='color:red'>Something went wrong</p>`
            })
        })
    </script>
</x-guest-layout>