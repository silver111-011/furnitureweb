@include('includes.seller.sellerlanding',['seller'=>$seller])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Ordered Furniture</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
       <center>
        @if(Session::has('success'))
        <h6 class="text-success mt-1">{{Session::get('success')}}</h6>
        @endif

        @if(Session::has('fail'))
        <h6 class=" text-danger mt-1">{{Session::get('fail')}}</h6>
        @endif
        </center>
        <h5 class="text-secondary">Contact 0734569045 for any dispute</h5>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Status</th>
                <th>Location</th>
                <th>Quantity</th>
                <th>Ordered At</th>
                <th>Name</th>
                <th>Price</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
        @if($orderitems->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any orders yet </div>
                @else
                
            @foreach($orderitems as $order)
            <tr>
            <td>{{$loop->index+1}}</td>
            @if($order->item_status == 'onprocess' && $order->is_dispute == 0 )
                <td class="text-info">{{ $order->item_status }}</td>
            @elseif($order->is_dispute == 1)
            <td class="text-danger">{{'dispute'}}</td>
            @else
            <td class="text-success">{{ $order->item_status }}</td>
            @endif
                <td>{{ $order->location }}</td>
                <td>{{ $order->quantity_ordered }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>{{ $order->furniture->name }}</td>
                <td>{{ $order->furniture->price }}</td>     
                <td><a href="{{route('downloadimage',$order->furniture->id)}}" class="text-info">
                <img src="{{ asset('storageapp/'.$order->furniture->imagepath) }}" alt="" style="border-radius:50%; height:40px;width:40px;">
                </a></td>
               
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
           

    </div>
</main>







<!-- cdn links ends -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>