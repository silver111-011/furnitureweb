@include('includes.seller.sellerlanding',['seller'=>$seller])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">

    <div class="container-fluid p-3 p-md-4 ">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="fs-4 text-secondary fw-bolder">Add Furniture</div>
            <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
        </div>
        <hr>
    </div>

    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">
        <form action="{{$furnitures->id?route('furnitureedit',$furnitures->id):route('furniturepost')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(Session::has('fail'))
            <div class="alert alert-danger text-center mt-1">{{Session::get('fail')}}</div>
            @endif
            <div class="container-fluid p-3 p-md-4">
                <div class="container form-control bg-light pr-4 pl-4 pb-4">
                    <label for="title">Furniture Name</label><br>
                    <input type="text" name="name" class="form-control" value="{{$furnitures->name}}" required>
                </div>
            </div>
            <div class="container-fluid p-3 p-md-4">
                <div class="container form-control bg-light pr-4 pl-4 pb-4">
                    <label for="title">Furniture Category</label><br>
                    <select name="category" class="form-control mb-3" required>
                    @if($furnitures->id)
                        <option value="{{$furnitures->category->id}}">{{$furnitures->category->name}}</option>
                        @if($categories->count() >0)
                       @foreach($categories as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                        @endif
                    @else
              
                 
                       @if($categories->count() >0)
                       @foreach($categories as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                        @endif
                        @endif

                    </select>
                </div>
            </div>
                <div class="container-fluid p-3 p-md-4">
                    <div class="container form-control bg-light pr-4 pl-4 pb-4">
                        <label for="title">Furniture Quantity</label><br>
                        <input type="number" name="quantity" class="form-control" value="{{$furnitures->quantity}}" required>
                    </div>
                </div>

                <div class="container-fluid p-3 p-md-4">
                    <div class="container form-control bg-light pr-4 pl-4 pb-4">
                        <label for="title">Furniture price</label><br>
                        <input type="number" name="price" class="form-control"value="{{$furnitures->price}}" required>
                    </div>
                </div>

                @if($furnitures->count()>0)
                <div class="container-fluid  p-3 p-md-4" style="margin-top:-20px">
                    <div class="container form-control bg-light pr-4 pl-4 pb-4 ">
                        <label for="title">Furniture Image</label><br>
                        <input type="file" accept=".jpg, .png, " name="furnitureimg" id="crimage">
                    </div>
                </div>
                @else
                <div class="container-fluid  p-3 p-md-4" style="margin-top:-20px">
                    <div class="container form-control bg-light pr-4 pl-4 pb-4 ">
                        <label for="title">Furniture Image</label><br>
                        <input type="file" accept=".jpg, .png, " name="furnitureimg" id="crimage" required>
                    </div>
                </div>
                @endif

                <div class="container-fluid  p-3 p-md-4" style="margin-top:-20px">
                    <div class="container form-control bg-light pr-4 pl-4 pb-4 ">
                        <label for="title">description</label><br>
                        <textarea class="form-control" name="description" id="plan">{{$furnitures->description}}</textarea>
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