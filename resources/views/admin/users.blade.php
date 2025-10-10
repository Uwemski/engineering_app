<x-app-layout>
    <x-slot name="header">
        View Users
    </x-slot>

    <div class="max-w-3xl mt-10 bg-white shadow-md rounded-2xl p-8 ml-15">
        
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Create Product</h2>

        @if(session('error'))
            <div>{{session('error')}}</div>
        @endif

        @if(session('success'))
            <div>{{session('success')}}</div>
        @endif
        <!-- table -->
        <table border="1" class="table-auto">

            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Manage roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $serial_no=1?>
                @foreach($users as $user)
                <tr>
                    <td>{{$serial_no}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        <form action="{{route('users.edit', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role" id="">
                                <option value="admin" {{$user->role == 'admin' ? 'selected': ''}}>Admin</option>
                                <option value="engineer" {{$user->role == 'engineer' ? 'selected': ''}}>Engineer</option>
                                <option value="client" {{$user->role == 'client' ? 'selected': ''}}>Client</option>
                            </select>

                            <button class="bg-blue-500 text-grey-900 px-4 py-2 rounded hover:bg-blue-600">Modify</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST">
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