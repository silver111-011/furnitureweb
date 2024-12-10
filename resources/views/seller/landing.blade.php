@include('includes.seller.sellerlanding',['seller'=>$seller])


<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Posted Furniture</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
        <table class="table tablestriped">
            <thead>
                <th>S/N</th>
                <th> Name</th>
                <th> price</th>
                <th> quantity</th>
                <th> description</th>
                <th>Posted At</th>
                <th> image</th>
                <th>Sold quantity</th>
                <th colspan="2">Action</th>
                 <tbody>
                 @if($furnitureposts->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any furniture post yet </div>
                @else
                
                @foreach($furnitureposts as $furniture)
                <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$furniture->name}}</td>
                <td>{{$furniture->price}}</td>
                <td>{{$furniture->quantity}}</td>
                @if(strlen( $furniture->description) > 30)
                    <td>{{substr( $furniture->description, 0, 30)."..."}}</td>
                    @else
                    <td>{{$furniture->description}}</td>
                    @endif
                    <td>{{ $furniture->created_at->diffForHumans() }}</td>
                    <td><a href="{{route('downloadimage',$furniture->id)}}" class="text-info">image</a></td>
                    <td>{{$furniture->ordered_quantity}}</td>
                    <td><a href="{{route('furnitureform',$furniture->id)}}">Edit</a></td>
                    <td> <a href="#" data-toggle="modal" data-target="#confirmDeleteModalfurniture{{ $furniture->id }}" class="text-danger">Delete</a></td>
                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModalfurniture{{ $furniture->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                    <form method="POST" action="{{ route('furnituredelete', [$furniture->id]) }}">
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

              


            </thead>

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