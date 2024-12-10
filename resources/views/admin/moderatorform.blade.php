@include('includes.admin.admin',['admin'=>$admin])

<main class="bg-light bg-opacity-25 min-vh-100 noscrollbar noscrollbarfire">
<div class="container-fluid p-3 p-md-4 ">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="fs-4 text-secondary fw-bolder">Moderator Form</div>
        <div class="text-secondary lead fw-normal" id="curr_date_time"></div>
    </div>
    <hr>
</div>
  


    <div class="flex-md-row holder p-3 p-md-4 noscrollbar noscrollbarfire " style="height: 90vh; ">


        <form action="{{$mode->id?route('modeedit',$mode->id):route('modepost')}}" method="POST" class="text text-center" enctype="multipart/form-data">
            @if(Session::has('success'))
            <div class="alert alert-success mt-1">{{Session::get('success')}}</div>
            @endif

            @if(Session::has('fail'))
            <div class="alert alert-danger mt-1">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="fname" placeholder="First name" class="form-control back mb-2" value="{{$mode->fname}}" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" placeholder="Last name" class="form-control back mb-2" value="{{$mode->lname}}" required>
                </div>
            </div>
            <input type="email" name="email" placeholder="Email" class="form-control mb-3" value="{{$mode->email}}" required>
            <div class="row">
                <divbhjj class="col-md-6">
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
                </divbhjj>
                <div class="col-md-6">
                    <input type="tel" name="phone" placeholder="Phone (0xxxxxxxxx)" class="form-control back mb-2" value="{{$mode->phone}}" pattern="[0-9]{10}" required>
                </div>
            </div>
            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control mb-3" required>

            <button type="submit" name="submit" class="btn backg form-control btn-block">signUp</button>


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