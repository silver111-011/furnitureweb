@include('includes.admin.admin',['admin'=>$admin])
<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Users</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
        <table class="table tablestriped">
            <thead>
                <th>S/N</th>
                <th>First Name</th>
                <th> Last Name</th>
                <th> Phone</th>
                <th> Location</th>
                <th>Role</th>
                <th>Status</th>
                <th colspan="2">Action</th>
                </thead>
                 <tbody>
                 @if($users->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any user yet </div>
                @else
                
                @foreach($users as $user)
                <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->lname}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->location}}</td>
                <td>{{$user->role}}</td>
                @if($user->is_blocked == 0)
                <td class="text-success">{{'Not blocked'}}</td>
                @else
                <td class="text-danger">{{'blocked'}}</td>
                @endif

                    <td><a href="{{route('unblockuser',$user->id)}}" class="text-info">Unblock</a></td>
                    <td> <a href="#" data-toggle="modal" data-target="#confirmDeleteModaluser{{ $user->id }}" class="text-danger">Block</a></td>
                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModaluser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Blocking</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to block this user?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form method="GET" action="{{ route('blockuser', [$user->id]) }}">
                                        @csrf
                                      
                                        <button type="submit" class="btn btn-danger">Block</button>
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
