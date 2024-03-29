<?php 
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\Route;
  use Illuminate\Foundation\Auth\User;
  $routed = explode('.', Route::currentRouteName())[0];
  $section = "";
  if (isset(explode('.', Route::currentRouteName())[1])){
    $section = explode('.', Route::currentRouteName())[1];
  };
  $component = Controller::getComponent($routed);
  $user = User::where('id', '=', session('LoggedUser'))->first();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-grid.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-reboot.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-utilities.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/font/bootstrap-icons.css') }}"  type="text/css"/>

    <title><?php echo $component->title; ?></title>
</head>

<body class="sidebar-mini layout-fixed ">
<header class="navbar navbar-dark sticky-top bg-darker flex-nowrap p-0 shadow">
  <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">
  <button id="leftSidenavToggler" class="navbar-toggler  collapsed nav-toggler"
   type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <span><?php echo $component->name; ?></span>
</div>
  <?php echo $routed; ?>
  <input class="form-control form-control-dark w-100 rounded-0 border-0 top-search" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" id="appTrigger" href="#">Apps</a>
    </div>
  </div>
  <div class="app-menu d-none" id="appMenu">
    <a href="{{ route('budger')}}" class="app-item 
    <?php if ($routed == "budger"){echo "current"; }; ?>
    ">
      <span>BUDGET</span><span><i class="bi-currency-bitcoin" role="img" aria-label="Budget"></i></span>
    </a>
    <a href="{{ route('eventor')}}"  class="app-item 
    <?php if ($routed == "eventor"){echo "current"; }; ?>
    ">
    <span>EVENTS</span><span><i class="bi-calendar-check" role="img" aria-label="Events"></i>
    </a>
    <a  href="{{ route('warehouser')}}" class="app-item 
    <?php if ($routed == "warehouser"){echo "current"; }; ?>
    ">
    <span>WAREHOUSE</span><span><i class="bi-upc-scan" role="img" aria-label="Warehouse"></i>
    </a>
    <a href="{{ route('stuffer')}}"  class="app-item 
    <?php if ($routed == "stuffer"){echo "current"; }; ?>
    ">
      STUFF</span><span><i class="bi-boombox" role="img" aria-label="Stuff"></i>
    </a>
    <span class="small-gap"></span>
    <a href="{{ route('home')}}"  class="app-item 
    <?php if ($routed == "home" || $routed == ""){echo "current"; }; ?>
    ">
    <span>HOME</span><span><i class="bi-house" role="img" aria-label="Home"></i>
    </a>
    @if(!isset($user))

    


    <span class="small-gap"></span>
    <form style="display: flex; flex-direction: column;" action="{{ route('auth.checkmain')}}" method="POST">
    @csrf
    <input type="text" placeholder="Login email" name="email" style="padding: 6px;"/>
    <span class="small-gap"></span>
    <input type="password" placeholder="password" name="password" style="padding: 6px;"/>
    <span class="small-gap"></span>
    <input type="submit" value="LOGIN" class="btn app-item login-btn" style="padding: 12px; border-radius: 0px; border: none;"/>
    </form>
    <span class="small-gap"></span>
    <a href="{{ route('registration')}}"  class="app-item register-btn">
    <span>Registration</span><span><i class="bi-door-open" role="img" aria-label="Sign in"></i>
    </a>
    @endif
    @if(isset($user))
    <span class="small-gap"></span>
    <a href="{{ route('logout')}}?token={{ csrf_token() }}"  class="app-item login-btn">
    <span>LOGOUT</span><span><i class="bi-door-open" role="img" aria-label="Sign in"></i>
    </a>

    @endif

  </div>
</header>

<div class="container-fluid sea hero menu-minimized" id="mainWrapper">
  <div class="row">
  {{-- side navigation menu (dynamical)   --}}
  @include('bootstrap.sidenav')  

    <main class="col-main ms-sm-auto p-0" id="mainWrapper">
    @yield('page-content')

    @include('bootstrap.footer') 
    </main>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content br-0">
      <div class="modal-header p-2 br-0 modal-head-dark">
        <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="box-shadow: -1px 2px 17px rgb(0 114 255 / 95%);">
        
        <div class="alert alert-danger d-none" role="alert">
          Wrong login or password!
        </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control border-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <br>
  <!-- 
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label> 


      </div>-->
      <div class="modal-footer p-0 pt-2" style="display: flex;
    justify-content: space-between;">
        <div class="" style="    float: left;
    display: flex;
    align-content: center;
    flex-direction: column;">
          <a href="#">Register new account</a>
          <a href="#">Recover account</a>
        </div>
        <div class="group">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

</div>


{{-- vendors and page scripts file   --}}
  @include('bootstrap.scripts')
</body>
</html>