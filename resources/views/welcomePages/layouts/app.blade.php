

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
    <head>
        <title>DKO PARTNERS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
         <meta name="keywords" content="événements, tickets">
        <meta name="author" content="dko sarl">
        
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('welcome/images/logo.png')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/all.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/lightcase.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/swiper.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('welcome/css/style.css') }}">
    </head>
@yield('stylesheets')
<body>
<div id="wrapper" class="wrapper">

    <!-- Header Section Start -->
    @include('welcomePages.layouts.header')
    <!-- Header Section End -->

    @yield('content')

    <!-- Footer Section Start -->
    @include('welcomePages.layouts.footer')
<!-- Footer Section End -->
</div>
<!-- /#page -->

<script defer src="{{asset('welcome/js/jquery.js')}}"></script>
    <script defer src="{{asset('welcome/js/snap.svg-min.js')}}"></script>
    <script defer src="{{asset('welcome/js/classie.js')}}"></script>
    <script defer src="{{asset('welcome/js/main3.js')}}"></script>
  	<script defer src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/fontawesome.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/jquery.counterup.min.js')}}"></script>
	<script defer src='{{asset('welcome/js/jquery.easing.js')}}'></script> 
  	<script defer src="{{asset('welcome/js/parallax.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/swiper.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/lightcase.js')}}"></script>
  	<script defer src="{{asset('welcome/js/circular-countdown.js')}}"></script>
  	<script defer src="{{asset('welcome/js/jquery.countdown.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/jQuery.scrollSpeed.js')}}"></script>
  	<script defer src="{{asset('welcome/js/jquery.jticker.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/waypoints.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/isotope.pkgd.min.js')}}"></script>
  	<script defer src="{{asset('welcome/js/functions.js')}}"></script>
  	<script defer src="{{asset('welcome/js/wow.min.js')}}"></script>
    <script defer src="{{asset('welcome/js/theia-sticky-sidebar.js')}}"></script>

</body>
</html>