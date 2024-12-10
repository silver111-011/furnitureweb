
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- ... other head elements ... -->
       <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/fland.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/scrollbar.css')}}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css' />
  </head>

  <body  class="noscrollbar noscrollbarfire">
    <div class="wrapper">
      <div id="overlay"></div>
      <!-- sidebar start -->
      <div class="sidebar shadow "style="background-color:#584420; height:115vh;">
        <div class="admin_brand d-flex justify-content-between align-items-baseline">
          <div>
            <a class="nav-link fw-bold" href="#">
              <span class="icon"><i class="fas fa-code"></i></span>
              <span class="menu">Online-Furnitures</span>
            </a>
          </div>
          <div class="d-block d-md-none">
            <a href="javascript:void(0)" id="close_sidebar"><i class="fas fa-times-circle fa-lg"></i></a>
          </div>
        </div>

        <ul class="nav nav-pills flex-column">

          <li class="nav-item">
            <a class="nav-link" href="{{route('admin')}}">
              <span class="icon" data-bs-toggle="tooltip" data-bs-title="Dashboard"><i
                  class="fas fa-dashboard"></i></span>
              <span class="menu">Dashboard</span>
            </a>
          </li>

           

     


          <li class="nav-item">
              <a class="nav-link" href="{{route('admin')}}">
                <span class="icon" data-bs-toggle="tooltip" data-bs-title="Manage">
                  <i class="fas fa-cube"></i>
                </span>
                <span class="menu">Manage Users</span>
              </a>
            </li>

            
        

            <li class="nav-item">
              <a class="nav-link" href="{{route('catview')}}" id="btnInv">
                <span class="icon" data-bs-toggle="tooltip" data-bs-title="View">
                  <i class="fas fa-cube"></i>
                </span>
                <span class="menu">Manage Categories</span>
              </a>
            </li>

            

            <li class="nav-item">
              <a class="nav-link" href="{{route('modeview')}}" id="btnInv">
                <span class="icon" data-bs-toggle="tooltip" data-bs-title="View">
                  <i class="fas fa-cube"></i>
                </span>
                <span class="menu">Registor Moderator</span>
              </a>
            </li>

           


          <li class="nav-item">
            <a class="nav-link" href="{{route('adminlogout')}}">
              <span class="icon" data-bs-toggle="tooltip" data-bs-title="Logout"><i class="fas fa-sign-out"></i></span>
              <span class="menu">Logout</span>
            </a>
          </li>

        </ul>
      </div>
      <!-- sidebar end -->

      <div class="content">
        <!-- top navbar start -->
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
          <div class="container-fluid px-3">

            <button class="navbar-toggler border-0" type="button" id="show_sidebar_phone">
              <span class="navbar-toggler-icon"></span>
            </button>


            <a class="navbar-brand d-none d-md-block" href="javascript:void(0)" id="show_sidebar_pc">
              <i class="fas fa-bars fa-lg"></i>
            </a>



            <div class="ms-auto d-flex align-items-center">

              <div class="nav-item d-none d-md-block me-2" data-bs-toggle="tooltip" data-bs-title="Full Screen"
                data-bs-placement="left">
                <a href="#" class="nav-link" id="fullscreen">
                  <i class="fa-solid fa-expand"></i>
                </a>
              </div>

              <div class="dropdown">

                <a class="nav-link dropdown-toggle py-1 px-3 rounded-1" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="fas fa-user-circle me-1"></i>{{$admin->fname}}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{route('adminlogout')}}"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                  </li>
                </ul>
              </div>


            </div>


          </div>
        </nav>
        <!-- top navbar end -->