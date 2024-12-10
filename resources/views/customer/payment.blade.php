<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>payments</title>
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
<center>
  <div class="container mt-2 col-sm-6" style="box-shadow: 0px 0px 14px rgba(0,0,0,0.2);">
    <h3 class="text-secondary">Payments</h3>
    <hr>
    <h6 class="text-secondary"> Your order is successfuly created you can login with your email and a default passord of 123 to check the order status</h6>
    <hr>
        <h6 class="text-danger"> Pay Tsh {{$totalcost}} to mobile number {{$sellerphone}} </h6>
        <a href="{{route('payments',$orderid)}}" class="btn form-control mb-3" style=" background-color :#DEAA50;">Pay Now</a>
  
  </div>
  </center>




  <!-- custom javascript ends -->
</body>

</html>