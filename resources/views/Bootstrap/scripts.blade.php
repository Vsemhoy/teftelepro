<!-- BEGIN VENDOR JS-->
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/bootstrap.esm.js')}}"></script>
<script src="{{asset('js/template/leftsidenav.js')}}"></script>
<script src="{{asset('js/template/appnav.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
@yield('vendor-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<?php /*
@if ($configData['isCustomizer']=== true)
<script src="{{asset('js/scripts/customizer.js')}}"></script>
@endif */ ?>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->