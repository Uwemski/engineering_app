<x-client-layout>
    <x-slot name="header">

    </x-slot-header>

    <div class="container">
        <div class="row mb-4" style="margin-top: 3rem">
            <form action="{{route('quotation.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="sub">Subject</label>
                    <input type="text" name="subject" id="sub" class="form-control" required>
                </div>
                @error('subject')
                    <small style="color:red">{{$message}}</small>
                @enderror
                <div class="mb-3">
                    <label for="desc">Description</label>
                    <input type="text" name="description" id="desc" class="form-control"  required>
                </div>
                @error('description')
                    <small style='color:red'>{{$message}}</small>
                @enderror
                <div class="mb-3">
                    <label for="">Attachment</label>
                    <input type="file">
                </div>
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="text" name="quotation_price" id="" class="form-control">
                </div>
                @error('quotation_price')
                    <small style='color:red'>{{$message}}</small>
                @enderror
                <div class="mb-3">
                    <button class="btn btn-primary" style="background-color:green;color: white;padding:15px; border-radius: 12px; margin-top: 13px">Request</button>
                </div>
            </form>
        </div>
    </div>

</x-client-layout>