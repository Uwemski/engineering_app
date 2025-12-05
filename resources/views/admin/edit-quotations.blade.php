<x-admin-layout>

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('admin.quotations.update', $id->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3">
                    <label for="">Admin Message</label>
                    <textarea name="admin_message" id="" class="form-control-select"></textarea>
                </div>
                <button>Send</button>
            </form>
        </div>
    </div>


</x-admin-layout>