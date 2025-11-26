<x-admin-layout>
    

    <div class="container">
        <div class="row">
            <table>
                <thead>
                    <tr>
                    
                        <th>S/N</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Price</th>   
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($quotations as $quotes)
                    <tr>                    
                        <td>S/N</td>
                        <td>{{$quotes->subject}}</td>
                        <td>{{$quotes->description}}</td>
                        <td>{{$quotes->price}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

<x-admin-layout>