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
    <link rel="stylesheet" href="{{ asset('/css/uikit.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/css/uikit-theme.css') }}"  type="text/css"/>


    <title><?php echo $component->title; ?></title>
</head>

<body class="sidebar-mini layout-fixed ">
<nav id="navHead" class="uk-navbar uk-navbar-container uk-box-shadow-large uk-position-z-index" style="z-index: 9;"
uk-sticky="show-on-up: true">
    <div class="uk-navbar-left uk-width-1-1 uk-flex-between">
      <div class="uk-navbar-item uk-padding-remove">
        <a class="uk-navbar-toggle uk-box-shadow-hover-large" id="leftSidenavToggler" style="width: 60px;">
            <span uk-navbar-toggle-icon></span>
        </a>
        <a class="uk-navbar-toggle" href="#">
            <span uk-icon="home"></span> <span class="uk-margin-small-left uk-visible@m">Component Name</span>
        </a>
        
        </div>
          <div class="uk-navbar-item uk-padding-remove">
            <a class="uk-navbar-toggle" id="searchBarToggler" href="#">
              <span uk-icon="search"></span>
            </a>
            @if(!isset($user))
            <a class="uk-navbar-toggle" href="#" uk-toggle="target: #login-modal">
              <span uk-icon="sign-in"></span> <span class="uk-margin-small-left ">Login</span>
            </a>
            @endif
            @if(isset($user))
            <button class="uk-button uk-button-default" ><span uk-icon="user"></span> <span class="uk-margin-small-left "><?php echo $user->name; ?></span></button>
            <div uk-dropdown="mode: click" class="uk-box-shadow-large">
              <ul class="uk-nav uk-dropdown-nav">
                  <li class=""><a class="uk-width-1-1 uk-flex-between" 
                  href="{{ route('logout')}}?token={{ csrf_token() }}">Sign out <span class="" uk-icon="sign-out"></span></a></li>
                  <li class="uk-nav-divider"></li>
                  <!-- <li class="uk-active"><a href="#">Active</a></li>
                  <li><a href="#">Item</a></li>
                  <li class="uk-nav-header">Header</li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li> -->
              </ul>
          </div>
            @endif
            <!-- <form action="javascript:void(0)">
                <input class="uk-input uk-form-width-small" type="text" placeholder="Input">
                <button class="uk-button uk-button-default">Button</button>
            </form>
            <form action="javascript:void(0)">
                <button class="uk-button uk-button-default">Login</button>
            </form> -->
          <button  uk-toggle="target: #offcanvas-overlay" class="uk-button uk-button-default" ><span class="uk-visible@l">Applications</span> <span uk-icon="grid"></span></button>
          <div uk-dropdown="mode: click" class="uk-box-shadow-large">
              <ul class="uk-nav uk-dropdown-nav">
                  <li class=""><a class="uk-width-1-1 uk-flex-between" href="{{ route('home')}}">Diary <span class="" uk-icon="home"></span></a></li>
                  <li class="uk-nav-divider"></li>
                  <!-- <li class="uk-active"><a href="#">Active</a></li>
                  <li><a href="#">Item</a></li>
                  <li class="uk-nav-header">Header</li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li> -->
              </ul>
          </div>
        </div>
    </div>
</nav>

<nav uk-sticky="position: top" id="searchBar" 
 class="uk-background-default uk-box-shadow-xlarge uk-preserve-color uk-padding-small uk-position-z-index uk-width-1-1 uk-hidden"
uk-sticky="show-on-up: true" style="z-index: 9;">
<form action="javascript:void(0)" class="uk-flex-between" uk-grid style="max-width: 800px; margin-left: auto; margin-right: auto;">
    <div class="uk-width-expand uk-padding-remove" >
      <input class="uk-input uk-width-expand" type="text" placeholder="Input">

    </div>
    <div class="uk-width-auto" style="padding-left: 4px;">
      <button class="uk-button uk-button-default uk-button-inshadow">Search</button>
    </div>
    <a class="uk-navbar-toggle" id="searchBarCloser"><span uk-icon="close"></span></a>
  </form>
</nav>
<script>
  let searchbartoggler = document.querySelector("#searchBarToggler");
  let searchbarcloser = document.querySelector("#searchBarCloser");
  let searchbar = document.querySelector("#searchBar");
  searchbartoggler.addEventListener("click", function(){
    toggleSearchBar();
  });
  searchbarcloser.addEventListener("click", function(){
    toggleSearchBar();
  });

  function toggleSearchBar(){
    if (searchbar.classList.contains("uk-hidden"))
    {
      searchbar.classList.remove("uk-hidden");
    } else {
      searchbar.classList.add("uk-hidden");
    }
  };
</script>

@if(!isset($user))
<!-- This is the login modal -->
<div id="login-modal" uk-modal>
  <div class="uk-modal-dialog uk-modal-body uk-padding-small">
    <form action="{{ route('auth.checkmain')}}" method="POST">
      <fieldset class="uk-fieldset">
        <legend class="uk-legend">Sign In</legend>
        @csrf
        <div class="uk-margin">
            <input class="uk-input" type="text" placeholder="Login email" name="email">
        </div>
        <div class="uk-margin">
            <input class="uk-input" type="text" placeholder="password" name="password" >
        </div>
      </fieldset>
      <p class="uk-text-right">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        <input type="submit" value="LOGIN" class="uk-button uk-button-primary"/>
      </p>
      <hr>
      <a href="#" class="uk-button uk-button-text">Not a member? Sign UP!</a>
    </div>
  </form>
  </div>
  @endif

  <div id="offcanvas-overlay" uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar uk-background-muted">

        <button class="uk-offcanvas-close" type="button" uk-close></button>


        <h3>Applications:</h3>
        <ul class="uk-nav uk-dropdown-nav">
                  <li class=""><a class="uk-width-1-1 uk-flex-between" href="{{ route('home')}}">Diary <span class="" uk-icon="home"></span></a></li>
                  <li class="uk-nav-divider"></li>
                  <li class=""><a class="uk-width-1-1 uk-flex-between" href="{{ route('home')}}">Diary <span class="" uk-icon="home"></span></a></li>
                  <li class="uk-nav-divider"></li>
                  <!-- <li class="uk-active"><a href="#">Active</a></li>
                  <li><a href="#">Item</a></li>
                  <li class="uk-nav-header">Header</li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li>
                  <li><a href="#">Item</a></li> -->
              </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

    </div>
</div>

<?php /*
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
*/ ?>



<div class="menu-minimized" id="mainWrapper">
  <div class="uk-width-1-1 ">
  {{-- side navigation menu (dynamical)   --}}
  @include('Template.sidenav')  

    <main class="col-main ms-sm-auto p-0" id="mainWrapper">
    <!-- <div class="uk-margin"></div> -->
    @yield('page-content')

    @include('bootstrap.footer') 
    </main>
  </div>
</div>



<?php /*
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
*/ ?>
</div>


{{-- vendors and page scripts file   --}}
  @include('Template.scripts')
</body>
</html>