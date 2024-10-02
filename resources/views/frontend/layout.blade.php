<!DOCTYPE html>
<html lang="vi">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="chodacsandanang" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{!! $seo['description'] !!}">
<meta name="keywords" content="{!! $seo['keywords'] !!}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- SITE TITLE -->
<title>{!! $seo['title'] !!}</title>
<meta property="og:url"                content="{{ url()->current() }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{!! $seo['title'] !!}" />
<meta property="og:description"        content="{!! $seo['description'] !!}" />
<meta property="og:image"              content="{!! isset($socialImage) && $socialImage ? Helper::showImage($socialImage) : Helper::showImage($settingArr['banner']) !!}" />
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico?ver=1.0') }}">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<!-- Google Font -->
<link href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap') }}" rel="stylesheet"> 
<link href="{{ asset('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap') }}" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/simple-line-icons.css') }}">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css') }}">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css?v=1.0.7') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body>

<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->
<!--popup-->

<!-- START HEADER -->
@include('frontend.partials.header')
<!-- END HEADER -->
@yield('content')
<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
	<div class="container">	
    	<div class="row align-items-center">	
            <div class="col-md-6">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>Nhận thông tin khuyến mãi</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form">
                    <form method="POST" action="{{ route('register.newsletter') }}">
                        {{csrf_field()}}
                        <input type="email" name="email" required="" class="form-control rounded-0" placeholder="Nhập email của bạn">
                        <button type="submit" class="btn btn-dark rounded-0">Đăng kí</button>
                    </form>
                    @if(Session::has('msg'))
                            <p style="color: #ffffff; padding-top: 10px;">
                                {{ Session::get('msg') }}
                            </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->

<!-- START FOOTER -->
@include('frontend.partials.footer')

<input type="hidden" id="route-add-product" value="{{ route('cart.add-product') }}" />
<input type="hidden" id="route-remove-product" value="{{ route('cart.remove-product') }}" />
<input type="hidden" id="route-cart" value="{{ route('cart') }}" />
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<!-- Latest jQuery --> 
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script> 
<!-- popper min js -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Latest compiled and minified Bootstrap --> 
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script> 
<!-- owl-carousel min js  --> 
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script> 
<!-- magnific-popup min js  --> 
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script> 
<!-- waypoints min js  --> 
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script> 
<!-- parallax js  --> 
<script src="{{ asset('assets/js/parallax.js') }}"></script> 
<!-- countdown js  --> 
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script> 
<!-- imagesloaded js --> 
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- isotope min js --> 
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<!-- jquery.dd.min js -->
<script src="{{ asset('assets/js/jquery.dd.min.js') }}"></script>
<!-- slick js -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- elevatezoom js -->
<script src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
<!-- Google Map Js -->
<script src="{{ asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyD7TypZFTl4Z3gVtikNOdGSfNTpnmq-ahQ&amp;callback=initMap') }}"></script>
<!-- scripts js --> 
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@yield('javascript_page')


</body>
</html>