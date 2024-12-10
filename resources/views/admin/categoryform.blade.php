@include('includes.admin.admin',['admin'=>$admin])
<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Add Categories</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>
   
    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
        <form action="{{$cat->id?route('catedit',$cat->id):route('categorypost')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(Session::has('fail'))
            <div class="alert alert-danger text-center mt-1">{{Session::get('fail')}}</div>
            @endif
            <div class="container-fluid p-3 p-md-4">
                <div class="container form-control bg-light pr-4 pl-4 pb-4">
                    <label for="title">Category Name</label><br>
                    <input type="text" name="name" class="form-control" value="{{$cat->name}}" required>
                </div>
            </div>
            

                <button type="submit"  class="col-sm-3 btn backg btn-block m-3 m-md-4">Send</button>

        </form>

    </div>
</main>

<!-- cdn links ends -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>