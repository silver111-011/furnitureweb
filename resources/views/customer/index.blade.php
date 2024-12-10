<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/index.css')}}">
  
   
</head>
<body>
    <!-- nav bar starts -->
<nav class="navbar navbar-expand-lg bg-white shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Tz-FuRnItUrEs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse hov" id="navbarNav">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link" style="color:#DEAA50;" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:#DEAA50;" href="{{route('signup')}}">SignUp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:#DEAA50;" href="{{route('login')}}">LogIn</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" style="color:#DEAA50;" href="{{route('login','1')}}">Orders</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- nav bar ends -->

<!-- hero section starts -->

<section id="home" class="bg-cover hero-section">
    <div class="overlay"> </div>
    <div class="container text-light text-center ">
<div class="row anch ">
    <div class="col-12">
    <h1 class="display-4" > Decorate Your House,  <br> </h1>
    <h2>with the best furnitures</h2>
    <h2>From us</h2>
    </div>
    <div class="col-xs-4 mt-3">
    <a href="{{route('productlists')}}">Buy Now</a>
    </div>
    
</div>
    </div>  
</section>
<!-- hero section ends -->

<!-- sample products -->
<section id="sample">

<div class="container text-center">
  <div class="row">

  <div class="col-12 section-intro">
    <h1>Sample Products</h1>
    <div class="divider"></div>
  </div>
  </div>

  <div class="row ">
   

  <div class="col ">
      <div class="sample">
        <div class="sample-img">
          <img src="{{asset('assets/images/home-chair.png')}}" alt="image unavailable" style="height: 260px;">
        <a href="customer/productList.php"><h5 class="mt-2">View more </h5> </a> 
      </div>
    </div>
  </div>

  <!-- end of the first sample -->

  <div class="col ">
      <div class="sample">
        <div class="sample-img">
          <img src="{{asset('assets/images/home-table.png')}}" alt="image unavailable" style="height:260px;">
        <a href="{{route('productlists')}}"><h5 class="mt-2 ">view more </h5> </a> 
      </div>
    </div>
  </div>

  <div class="col ">
      <div class="sample">
        <div class="sample-img">
          <img src="{{asset('assets/images/number-3.png')}}" alt="image unavailable" style="height: 260px;">
        <a href="{{route('productlists')}}"><h5 class="mt-2">view more </h5> </a> 
      </div>
    </div>
  </div>
  </div>
</div>
</section>
<!-- end of sample prodctus -->

<!-- start of cont section -->
<div class="container-fluid text-center">
<div class="row">

<div class="col-12 section-intro">
  <h1>Contact Us </h1>
  <div class="divider"></div>
</div>
</div>
</div>
</div>

<div class="cont container-fluid text-start">
    <div class="row">
      <div class="col-sm-2">

      </div>
        <div class="col-sm-5 left">
        <h2>Tz-Furniture:</h2>
       <h4>Adress: PO Box,234</h4>
       <h4>Email: furnitureadmin@gmail.com</h4>
       <h4>Phone: +255672345789</h4>
       <h4>Location: Morogoro</h4>

        </div>


        <div class="col-sm-3 left">
        <h2>Quick Links:</h2>
       <h4><a href="{{route('signup')}}">SignUp</a></h4>
       <h4><a href="{{route('login')}}">LogIn</a></h4>
       <h4><a href="#">Home</a></h4>
       

        </div>

    </div>


</div>
</body>
</html>