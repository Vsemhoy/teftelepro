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

    <link rel="stylesheet" href="{{ asset('/css/adminlte/OverlayScrollbars.css') }}"  type="text/css"/>
    <title>ADMINSIDE</title>
</head>

<body class="sidebar-mini layout-fixed ">

<header class="navbar navbar-dark sticky-top bg-darker flex-nowrap p-0 shadow">
  <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">
  <button class="navbar-toggler  collapsed nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <span>Budget</span>  
</div>
  
  <input class="form-control form-control-dark w-100 rounded-0 border-0 top-search" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Apps</a>
    </div>
  </div>
</header>

<div class="container-fluid sea hero">
  <div class="row">
    
    @yield('page-content')
  </div>
</div>



</body>
</html>