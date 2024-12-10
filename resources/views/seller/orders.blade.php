@include('includes.seller.sellerlanding',['seller'=>$seller])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Orders</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3  noscrollbar noscrollbarfire " style="height: 90vh; ">
        <center>
            @if(Session::has('success'))
            <h6 class="text-success mt-1">{{Session::get('success')}}</h6>
            @endif

            @if(Session::has('fail'))
            <h6 class="text-danger mt-1">{{Session::get('fail')}}</h6>
            @endif
        </center>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Ordered At</th>
                    <th>Price</th>
                    <th>Total Furniture</th>
                    <th>C Name</th>
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
                    <td>{{$order->customer->fname}}</td>


                    <td><a href="{{route('toorderedfurniture',$order->id)}}" style="color:blue;">View items</a></td>
                    <td> <a href="#" data-toggle="modal" data-target="#confirmDeleteModal{{ $order->id }}" class="text-danger">Delete</a></td>
                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form method="POST" action="{{ route('orderdele', [$order->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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