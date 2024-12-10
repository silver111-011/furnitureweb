<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Detail</title>
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

 
  <div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $furniture->name }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storageapp/' . $furniture->imagepath) }}" alt="{{ $furniture->name }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <p><strong>Price:</strong> {{ $furniture->price }}</p>
                            <p><strong>Description:</strong> {{ $furniture->description }}</p>
                            <p><strong>Location:</strong> {{ $furniture->seller->location }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <div class="row mt-3 justify-content-center">
            <div class="col-sm-3 hov" style="background-color: #DEAA50; margin-right:30px">
            <center>

            <a href="{{route('createorder',$furniture->id)}}" class="btn hov mb-1" style="text-decoration: none; color:black;">Order Now</a>
            </center>
            </div>

            <div class="col-sm-3 hov"style="background-color: #DEAA50;">
            <center>
            <a href="{{route('addtocart',$furniture->id)}}" class="btn" style="text-decoration: none; color:black;">Add to cart<i class="fa fa-cart-plus" aria-hidden="true"></i></a>
            </center>
          
            </div>
           
        </div>
</div>



<script>
  function toggleCart() {
    var cartDetails = document.getElementById('cart-details');
    if (cartDetails.style.display === 'none' || cartDetails.style.display === '') {
        cartDetails.style.display = 'block';
    } else {
        cartDetails.style.display = 'none';
    }
}

</script>
    <!-- custom javascript ends -->
</body>

</html>