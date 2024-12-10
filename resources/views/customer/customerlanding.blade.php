@include('includes.customer.customerorders',['customer'=>$customer])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">My Orders</div>
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
                    <th>Payment Status</th>
                    <th>Ordered At</th>
                    <th>Price</th>
                    <th>Total Furniture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($orders->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any orders yet </div>
                @else

                @foreach($orders as $order)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    @if($order->order_status == 'onprocess' && $order->has_dispute == 0 )
                    <td class="text-info">{{ 'onprocess' }}</td>
                    @elseif($order->has_dispute == 1)
                    <td class="text-danger">{{'dispute'}}</td>
                    @else
                    <td class="text-success">{{ $order->status }}</td>
                    @endif
                 
                    @if($order->is_paid == 0)
                    <td>{{ 'Not paid' }}</td>
                    @else
                    <td>{{ 'Paid' }}</td>
                    @endif
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{$order->item_number}}</td>

                    <td><a href="{{route('orderedfurniture',$order->id)}}" style="color:blue;">View items</a></td>
                    <td><a href="{{route('topayments',[$order->total_amount,$order->id])}}" style="color:blue;">Pay</a></td>

        
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