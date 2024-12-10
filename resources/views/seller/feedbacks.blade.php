@include('includes.seller.sellerlanding',['seller'=>$seller])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Feedbacks</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">

     
        @if($feedbacks->count()==0)
                <div class="alert alert-info text-center mt-1"> You have no any feedbacks yet </div>
                @else
                
            @foreach($feedbacks as $feed)
            <div class="feed">
                            <div class="names" style="display: flex;">
                                <div class="col-1" style="height:30px; width:30px; border-radius:50%; background-color:#DEAA50;">
                                    <center>
                                        <h6 class="text-secondary" style="font-size:18px; padding-top:2px;">
                                            {{ strtoupper(substr($feed->user->fname, 0, 1)) }}
                                        </h6>
                                    </center>

                                </div>
                                <h6 class="col-11 m-1 ">{{ $feed->user->fname.' '.$feed->user->lname }}</h6>
                            </div>

                            <div class="com" style="padding-left:30px; padding-right:30px;">
                            <h6 class="text-secondary">Feeds for {{$feed->furniture->name}}</h6>
                                <h6  class="col-12 text-secondary" style="font-family: sans-serif;">
                                  
                                    {{ $feed->feedback }}
                            
                                </h6>
                            </div>
                            <hr>
                        </div>
            @endforeach
            @endif
  

    </div>
</main>







<!-- cdn links ends -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>