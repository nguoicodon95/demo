<!DOCTYPE html>
<html lang="en-US" hackable="on">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('assets/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.nouislider.min.css') }}" type="text/css">
    <link rel="stylesheet" href="/assets/css/icon.css" type="text/css">
    @stack('css-rel')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" type="text/css">

    <title>Cho thuê nhà nghỉ, ngôi nhà, căn hộ & Phòng cho Thuê - iStayhere.vn</title>
    @stack('css-style')
    <script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
</head>

<body onunload="" class="{{ $class_body or '' }}page-homepage" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        @include('defaults.homepage.shared._header')
        <!-- Page Canvas-->
        @yield('container')
        <!-- end Page Canvas-->
        <!--Page Footer-->
        @include('defaults.homepage.shared._footer')
        <!--end Page Footer-->
    </div>
    <!-- end Inner Wrapper -->

    @include('_shares.login_form')
    @include('_shares.reg_form')
</div>
<!-- end Outer Wrapper-->

<script type="text/javascript" src="{{ asset('assets/js/before.load.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/smoothscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.nouislider.all.min.js') }}"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBtBjg0sZP5k1pkKmz7TjVBX1Fuj-2ijhs"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/maps.js') }}"></script>


@stack('js-include')
@stack('js-script')
<script>
    $(window).load(function(){
        var rtl = false; // Use RTL
        initializeOwl(rtl);
    });
    autoComplete();
</script>
<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>
