<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">

    <title>Login Page</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center ">
            <div class="col-md-6 text-center mt-5">

                <div class="hold p-3" style="box-shadow: 0px 0px 14px rgba(0,0,0,0.2);">
                    <form action="{{route('login-auth')}}" method="POST">
                        @csrf
                        <h4>ONLINE-FURNITURES</h4>
                       
                        @if($toorders ==1)
                        <h5 class="text-secondary">Login to view your orders with 123 as password</h5>
                        @else
                        <h2>Login to post furniture</h2>
                        @endif
                        <input type="email" name="email" placeholder="Enter your Email" class="form-control mb-2">
                        <input type="password" name="password" placeholder="Enter your password" class="form-control mb-2 ">
                        <button type="submit" name="login" class="btn backg btn-block" style="background-color:#DEAA50;">Login</button>
                        <h6>Don't have an account click <a href="{{route('signup')}}">Here</a></h6>
                        @if(Session::has('success'))
                        <div class="alert alert-success mt-1">{{Session::get('success')}}</div>
                        @endif

                        @if(Session::has('fail'))
                        <div class="alert alert-danger mt-1">{{Session::get('fail')}}</div>
                        @endif
                        <a href="{{route('home')}}" class="form-control mt-3 hov text-center">------Back to Home Page------</a>



                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>