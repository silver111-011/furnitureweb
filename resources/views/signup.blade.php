<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/signUp.css')}}" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body>
    
<div class="container mt-md-3 mt-xs-1 pt-md-5 pt-xs-2" >
   
       
        <div class="row justify-content-center">
        <div class="col-md-8 bg-light text text-center"style=" box-shadow: 0px 0px 14px rgba(0,0,0,0.2);">
            <h4 class="mt-3">Create a Seller's Account</h4>
            <form action="{{route('seller-register')}}" method="POST" class="text text-center" enctype="multipart/form-data">
            @csrf
            <div class="row">
  <div class="col-md-6">
      <input type="text" name="fname" placeholder="First name" class="form-control back mb-2" required>
  </div>
  <div class="col-md-6">
      <input type="text" name="lname" placeholder="Last name" class="form-control back mb-2" required>
  </div>
</div>
   <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
   <div class="row">
   <divbhjj class="col-md-6">
           <select name="location" class="form-control mb-3" required>
             <option>Location</option>
              <option value="Arusha">Arusha</option>
               <option value="Dar-es-salaam" >Dar-es-salaam</option>
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
            </divbhjj>
  <div class="col-md-6">
      <input type="tel" name="phone" placeholder="Phone (0xxxxxxxxx)" class="form-control back mb-2" pattern="[0-9]{10}" required>
  </div>
</div>
   <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
   <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control mb-3" required>
 
   <button type="submit" name="submit" class="btn backg form-control btn-block">signUp</button>
   @if(Session::has('success'))
      <div class="alert alert-success mt-1">{{Session::get('success')}}</div>
      @endif

     @if(Session::has('fail'))
       <div class="alert alert-danger mt-1">{{Session::get('fail')}}</div>
       @endif
   <a href="{{route('home')}}" class="form-control mt-3  text-center">-----Back to Home Page-----</a>
    <a href="{{ route('login') }}" class="form-control mt-3  text-center">-----Back to Login Page-----</a>
    </form>
        </div>
    </div>
</div>    
</body>
</html>
