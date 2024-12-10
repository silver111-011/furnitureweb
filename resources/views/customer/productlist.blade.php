<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link type="text/css" rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <link type="text/css" rel="stylesheet" href="{{asset('assets/css/index.css')}}">
</head>
<style>
  .search-group {
    display: flex;
    align-items: center;

  }

  .search-input {
    border: 2px solid lightblue;
    border-right: none;
    border-radius: 15px 0 0 15px;
  }

  .search-button {
    border: 2px solid lightblue;
    border-left: none;
    border-radius: 0 15px 15px 0;
    background-color: white;
    padding: 0 10px;
    height: 41px;
  }

  .cart-container {
        position: relative;
        display: inline-block;
        font-size: 24px; /* Adjust the size as needed */
    }
    .fa-shopping-cart {
        border: 2px solid #976e21;
        border-radius: 50%;
        padding: 10px; /* Adjust the padding as needed */
        color: #976e21;
    }
    .cart-count {
        position: absolute;
        top: 0px;
        right: 0px;
        color: black;
        padding: 5px;
        min-width: 20px;
        height: 20px;
        text-align: center;
        font-weight: bold;
        line-height: 20px;
    }

    .cart-details {
      z-index: 2;
        display: none;
        position: absolute;
        right: 0;
        top: 50px;
        width: 300px;
        background: white;
        border: 1px solid #ccc;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .cart-details ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .cart-details ul li {
        padding: 5px 0;
        border-bottom: 1px solid #ccc;
    }
    .cart-details button {
        margin-top: 10px;
        background: #DEAA50;
        border: none;
        cursor: pointer;
    }
</style>

<body>
  <div class="row m-2  mt-2 p-3" style="box-shadow: 0px 0px 14px rgba(0,0,0,0.2);">
    <div class="col-sm-1" style="border-right:2px solid black ;">
      <a href="{{route('home')}}" style="color:black;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
    <div class="col-sm-10">
      <center>
      <form action="{{route('search')}}">
        <div class="col-sm-10">
          <div class="search-group">
          
              @csrf
            <input type="search" name="search" class="form-control search-input" placeholder="Search for Furniture">
            <button class="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
          
          </div>

        </div>
        </form>
      </center>

    </div>

    <div class="col-sm-1 carthov">
    <div class="cart-container">
        <i class="fa fa-shopping-cart" aria-hidden="true" onclick="toggleCart()"></i>
        @if(session()->has('cart') && array_sum(array_column(session('cart'), 'quantity')) > 0)
            <span class="cart-count">
                {{ array_sum(array_column(session('cart'), 'quantity')) }}
            </span>
        @else
            <span class="cart-count">0</span>
        @endif
    </div>
    <div id="cart-details" class="cart-details">
        @if(session()->has('cart') && !empty(session('cart')))
            @php
                $total = 0;
            @endphp
            <ul>
                @foreach(session('cart') as $id => $details)
                    <li>{{ $details['name'] }} - {{ $details['quantity'] }} x Tsh{{ $details['price'] }}</li>
                    @php
                        $total += $details['quantity'] * $details['price'];
                    @endphp
                @endforeach
                <li><strong>Total: Tsh{{ $total }}</strong></li>
            </ul>
            <button class="btn btn-block form-control" ><a href="{{route('createorder')}}">Order</a></button>
        @else
            <p>Your cart is empty</p>
        @endif
    </div>
</div>
</div>
      @if(Session::has('success'))
      <center>
      <h6 class="text-success m-2">{{Session::get('success')}}</h6>
      </center>
     
     @endif
  <div class="catholder hovbtn" style=" margin-left:20px; margin-bottom:10px; ">
    <button type="button" class="form-controll" id="btnall" style="border-radius:5px; padding-left:15px;padding-right:17px;">All</button>
    <button type="button" id="btnhome" style="border-radius:5px; margin-left:10px;">Home</button>
    <button type="button" id="btnoffice" style="border-radius:5px; margin-left:10px;">Office</button>
    <button type="button" id="btnschool" style="border-radius:5px;  margin-left:10px;">School</button>
    <button type="button" id="btnluxury" style="border-radius:5px;  margin-left:10px;">Luxury</button>
  </div>
  <div class="container-fluid">
    <!-- start of all container -->
    @if($search != null)
    <div class="search" id="divsearch" style="display:block;">
<div class="row mt-2 ml-1">
  @if($searchfurnitures->count()==0)
  <div class="alert alert-info text-center col-sm-11 mt-3">Results not found</div>
  @else


  @foreach($searchfurnitures as $search)
  <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
    <a class="hov" href="{{route('furnituredetail',$search->id)}}" style="text-decoration:none;cursor:pointer;">
      <img src="{{ asset('storageapp/'.$search->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
      <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$search->price}}</h4>
    </a>
  </div>
  @endforeach
  @endif

</div>
</div>
@endif
    <!-- search container -->
    <div class="home" id="divall" style="display:block;">

      <div class="row mt-2 ml-1">
        @if($furnitureall->count()==0)
        <div class="alert alert-info text-center col-sm-11 mt-3">No any Home furnitures yet</div>
        @else


        @foreach($furnitureall as $furniture)
        <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
          <a class="hov" href="{{route('furnituredetail',$furniture->id)}}" style="text-decoration:none;cursor:pointer;">
            <img src="{{ asset('storageapp/'.$furniture->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
            <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$furniture->price}}</h4>
          </a>
        </div>
        @endforeach
        @endif

      </div>
    </div>

    <!-- start of home container -->
    <div class="home" id="divhome" style="display:none;">

      <div class="row mt-2 ml-1">
        @if($furniturehome->count()==0)
        <div class="alert alert-info text-center col-sm-11 mt-3">No any Home furnitures yet</div>
        @else


        @foreach($furniturehome as $furnitureh)
        <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
          <a class="hov" href="{{route('furnituredetail',$furnitureh->id)}}" style="text-decoration:none;cursor:pointer;">
            <img src="{{ asset('storageapp/' . $furnitureh->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
            <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$furnitureh->price}}</h4>
          </a>
        </div>
        @endforeach
        @endif

      </div>
    </div>
    <!-- end of home container -->
    <!-- start of office container -->

    <!-- start of office container -->
    <div id="divoffice" style="display:none; margin-top:px;">

      <div class="row mt-2 ml-1">
        @if($furnitureoffice->count()==0)
        <div class="alert alert-info text-center col-sm-11 mt-3">No any Office furnitures yet</div>
        @else


        @foreach($furnitureoffice as $furniture)
        <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
          <a class="hov" href="{{route('furnituredetail',$furniture->id)}}" style="text-decoration:none;cursor:pointer;">
            <img src="{{ asset('storageapp/'.$furniture->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
            <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$furniture->price}}</h4>
          </a>
        </div>
        @endforeach
        @endif

      </div>
    </div>
    <!-- end of office container -->

    <!-- start of school container  -->
    <div class="school" id="divschool" style="display:none;">

      <div class="row mt-2 ml-1">
        @if($furnitureschool->count()==0)
        <div class="alert alert-info text-center col-sm-11 mt-3">No any School furnitures yet</div>
        @else


        @foreach($furnitureschool as $furniture)
        <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
          <a class="hov" href="{{route('furnituredetail',$furniture->id)}}" style="text-decoration:none;cursor:pointer;">
            <img src="{{ asset('storageapp/'.$furniture->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
            <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$furniture->price}}</h4>
          </a>
        </div>
        @endforeach
        @endif

      </div>
    </div>

    <!-- end of school container  -->

    <!-- start of Luxury container  -->
    <div class="home" id="divluxury" style="display:none;">

      <div class="row mt-2 ml-1">
        @if($furnitureluxury->count()==0)
        <div class="alert alert-info text-center col-sm-11 mt-3">No any Home furnitures yet</div>
        @else


        @foreach($furnitureluxury as $furnitureh)
        <div class="col-sm-2 mt-3 text-center hov" style="  position: relative; overflow: hidden;">
          <a class="hov" href="{{route('furnituredetail',$furnitureh->id)}}" style="text-decoration:none;cursor:pointer;">
            <img src="{{ asset('storageapp/' . $furnitureh->imagepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius:10px;">
            <h4 style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); z-index: 1;">{{$furnitureh->price}}</h4>
          </a>
        </div>
        @endforeach
        @endif

      </div>
    </div>

    <!-- end of school container  -->

  </div>






  <!-- custom javascript starts -->
  <script>
document.addEventListener("DOMContentLoaded", () => {
 
        var divall = document.getElementById("divall");
        var divhome = document.getElementById("divhome");
        var divoffice = document.getElementById("divoffice");
        var divschool = document.getElementById("divschool");
        var divluxury = document.getElementById("divluxury");
        var divseach = document.getElementById("divsearch");

        var btnall = document.getElementById("btnall");
        var btnhome = document.getElementById("btnhome");
        var btnschool = document.getElementById("btnschool");
        var btnoffice = document.getElementById("btnoffice");
        var btnluxury = document.getElementById("btnluxury");

        btnall.addEventListener('click', () => {
            divall.style.display = 'block';
            divhome.style.display = 'none';
            divoffice.style.display = 'none';
            divschool.style.display = 'none';
            divluxury.style.display = 'none';
            divsearch.style.display = 'none';
        });

        btnhome.addEventListener('click', () => {
            divhome.style.display = 'block';
            divall.style.display = 'none';
            divoffice.style.display = 'none';
            divschool.style.display = 'none';
            divluxury.style.display = 'none';
            divsearch.style.display = 'none';

        });

        btnschool.addEventListener('click', () => {
            divschool.style.display = 'block';
            divall.style.display = 'none';
            divhome.style.display = 'none';
            divoffice.style.display = 'none';
            divluxury.style.display = 'none';
            divsearch.style.display = 'none';

        });

        btnoffice.addEventListener('click', () => {
            divschool.style.display = 'none';
            divall.style.display = 'none';
            divhome.style.display = 'none';
            divoffice.style.display = 'block';
            divluxury.style.display = 'none';
            divsearch.style.display = 'none';

        });

        btnluxury.addEventListener('click', () => {
            divall.style.display = 'none';
            divschool.style.display = 'none';
            divhome.style.display = 'none';
            divoffice.style.display = 'none';
            divluxury.style.display = 'block';
            divsearch.style.display = 'none';

        });
});

function toggleCart() {
    var cartDetails = document.getElementById('cart-details');
    if (cartDetails.style.display === 'none' || cartDetails.style.display === '') {
        cartDetails.style.display = 'block';
    } else {
        cartDetails.style.display = 'none';
    }
}

</script>
@if($search != null )
  <script>
  divall.style.display = 'none';
   divschool.style.display = 'none';
  divhome.style.display = 'none';
            divoffice.style.display = 'none';
            divluxury.style.display = 'none';
  </script>
  @endif

  <!-- custom javascript ends -->
</body>

</html>