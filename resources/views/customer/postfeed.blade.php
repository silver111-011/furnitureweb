@include('includes.customer.customerorders',['customer'=>$customer])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Feedback for {{$furniture->name}}</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
   <center>
    <div class="card col-sm-8">
                <div class="card-header">Feedback</div>
                <form action="{{route('feedbackpost',$furniture->id)}}" method="post">
                    @csrf
                <div class="card-body">
              
                     <textarea name="feedback" class="form-control mb-2" id="" cols="15" rows="8" required></textarea>
                     <button type="submit"  class="btn  btn-block form-control" style="background-color:#DEAA50">Send</button>
                 

                        @if(Session::has('fail'))
                        <h6 class=" text-danger mt-1">{{Session::get('fail')}}</h6>
                        @endif
                </div>
                </form>
            </div>
            </center> 

    </div>
</main>







<!-- cdn links ends -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>