<x-admin-layout>
    

    <div class="container">
        <div class="row">
            <table border='1' class="ttable table-hover">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Price(&#8358;)</th>   
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                        $serial_no = 1;
                    ?> 

                    @foreach($enquiries as $enq)
                    <tr>                    
                        <td>{{$serial_no}}</td>
                        <td>{{$enq->name}}</td>
                        <td>{{$enq->email}}</td>
                        <td>{{$enq->message}}</td>
                    </tr>
                    <?php $serial_no ++?>
                    @endforeach
                </tbody>

            </table>
            {{$enquiries->links()}}
        </div>
    </div>

</x-admin-layout>