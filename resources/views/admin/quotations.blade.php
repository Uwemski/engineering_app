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

                    @foreach($quotations as $quotes)
                    <tr>                    
                        <td>{{$serial_no}}</td>
                        <td>{{$quotes->subject}}</td>
                        <td>{{$quotes->description}}</td>
                        <td>{{$quotes->quotation_price}}</td>
                    </tr>
                    <?php $serial_no ++?>
                    @endforeach
                </tbody>

            </table>
            {{$quotations->links()}}
        </div>
    </div>

</x-admin-layout>