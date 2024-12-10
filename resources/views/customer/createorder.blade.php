<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Order</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link type="text/css" rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <link type="text/css" rel="stylesheet" href="{{asset('assets/css/index.css')}}">
  <link href="{{asset('assets/css/signUp.css')}}" rel="stylesheet">
</head>

<body>

<div class="row m-2 mt-2">
<div class="col-sm-1" style="border-right:2px solid black ;">
<center>
<a href="{{route('productlists')}}" style="color:black;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
</center>
    </div>
</div>
  <div class="container mt-2" >
    <h3 class="text-secondary">Customer information</h3>
    <hr>
    @if($productlist->id)
    <form action="{{route('postorder',$productlist->id)}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('postorder')}}" method="POST" enctype="multipart/form-data">
      @endif
      @csrf
      <div class="row">
        <div class="col-md-6">
          <input type="text" name="fname" placeholder="First name" class="form-control back mb-2" value="" required>
        </div>
        <div class="col-md-6">
          <input type="text" name="lname" placeholder="Last name" class="form-control back mb-2" value="" required>
        </div>
      </div>
      <input type="email" name="email" placeholder="Email" class="form-control mb-3" value="" required>
      <div class="row">
        <div class="col-md-6">
          <select name="location" class="form-control mb-3" required>
            <option>Location</option>
            <option value="Arusha">Arusha</option>
            <option value="Dar-es-salaam">Dar-es-salaam</option>
            <option value="Dodoma">Dodoma</option>
            <option value="Geita">Geita</option>
            <option value="Iringa">Iringa</option>
            <option value="Kagera">Kagera</option>
            <option value="katavi">Katavi</option>
            <option value="kigoma">Kigoma</option>
            <option value="Kilimanjaro">Kilimanjaro</option>
            <option value="Lindi">Lindi</option>
            <option value="Manyara">Manyara</option>
            <option value="Mara">Mara</option>
            <option value="Mbeya">Mbeya</option>
            <option value="Morogoro">Morogoro</option>
            <option value="Mtwara">Mtwara</option>
            <option value="Mwanza">Mwanza</option>
            <option value="Njombe">Njombe</option>
            <option value="Pemba Kasikazini">Pemba Kasikazini</option>
            <option value="Pemba Kusini">Pemba Kusini</option>
            <option value="Pwani">Pwani</option>
            <option value="Rukwa">Rukwa</option>
            <option value="Ruvuma">Ruvuma</option>
            <option value="Shinyanga">Shinyanga</option>
            <option value="Simiyu">Simiyu</option>
            <option value="Singida">Singida</option>
            <option value="Tabora">Tanga</option>
            <option value="zanzibar">Zanzibar(koani)</option>
            <option value="Unguja Kasikazini">Unguja Kasikazini</option>
            <option value="Unguja magharibi">Unguja Magharibi</option>
          </select>
        </div>
        <div class="col-md-6">
          <input type="tel" name="phone" placeholder="Phone (0xxxxxxxxx)" class="form-control back mb-2" value="" pattern="[0-9]{10}" required>
        </div>
      </div>

      <h3 class="text-secondary">Order information</h3>
      <h6 class="text-secondary">To remove an item in order list put quantiy zero</h6>
      <hr>
     
      @if($productlist->id)
      <div class="row">
      <div class="col" >
        <img src="{{ asset('storageapp/'.$productlist->imagepath) }}" alt="" style="border-radius:50%; height:40px;width:40px;">
      </div>
      <div class="col">
        <h6 class="text-secondary">{{$productlist->name}}</h6>
      </div>
      <div class="col">
        <h6 class="text-secondary">{{$productlist->price}}</h6>
      </div>
      <div class="col">
       <div class="row">
       <h6 class="text-secondary col-sm-3">quantity:</h6>
        <input type="number"class="col-sm-4" name="quantity" style="border-top:none;border-left:none;border-right:none;" pattern="[0-9]{10}" value="1">
       </div>
      </div>
      <hr class="col-sm-12">
      </div>
      @endif
      @if(session()->has('cart') && !empty(session('cart')))
    @php 
        $itemCount = 0;
        
    @endphp
    @foreach(session('cart') as $id => $details)
        @php 
            $itemCount++;
        @endphp
        <div class="row">
            <div class="col">
                <img src="{{ asset('storageapp/'.$details['photo']) }}" alt="" style="border-radius:50%; height:40px; width:40px;">
            </div>
            <div class="col">
                <h6 class="text-secondary">{{ $details['name'] }}</h6>
            </div>
            <div class="col">
                <h6 class="text-secondary">{{ $details['price'] }}</h6>
            </div>
            <div class="col">
                <div class="row">
                    <h6 class="text-secondary col-sm-3">Quantity:</h6>
                    <input type="number" class="col-sm-4" name="quantity{{ $itemCount }}" style="border-top:none; border-left:none; border-right:none;" pattern="[0-9]*" value="{{ $details['quantity'] }}">
                </div>
            </div>
            <hr class="col-sm-12">
        </div>
    @endforeach
@endif



      <button type="submit" name="submit" class="btn backg form-control btn-block mt-2 mb-2" style=" background-color :#DEAA50;">Submit Order</button>
      <div class="payments">

      </div>
      <center>
      @if(Session::has('success'))
      <div class="alert alert-success mt-3">{{Session::get('success')}}</div>
      @endif

      @if(Session::has('fail'))
      <div class="alert alert-danger mt-3">{{Session::get('fail')}}</div>
      @endif
      </center>
    </form>
  </div>




  <!-- custom javascript ends -->
</body>

</html>