@include('includes.admin.admin',['admin'=>$admin])
<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 pt-2 ">

    <div class="d-flex flex-column flex-md-row">
            <div class="fs-4  col-xs-6 col-md-11 text-secondary fw-bolder">Categories</div>
            <div class="col-xs-6 col-md-1">
                <a href="{{route('catform')}}" class="btn" style="padding-top:3px; padding-bottom:3px; padding-right:16px;padding-left:16px; background-color:#DEAA50;">Add</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
        <table class="table tablestriped">
            <thead>
                <th>S/N</th>
                <th>Categroy Name</th>
               
                <th colspan="2">Action</th>
                </thead>
                 <tbody>
                 @if($category->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any category yet </div>
                @else
                
                @foreach($category as $cat)
                <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$cat->name}}</td>
                    <td><a href="{{route('catform',$cat->id)}}" class="text-info">Edit</a></td>
                    <td> <a href="#" data-toggle="modal" data-target="#confirmDeleteModalcat{{ $cat->id }}" class="text-danger">Delete</a></td>
                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModalcat{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                    <form method="POST" action="{{ route('catdele', [$cat->id]) }}">
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
