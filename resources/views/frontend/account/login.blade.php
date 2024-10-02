@extends('frontend.layout') 
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Login</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đăng nhập</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Đăng nhập</h3>
                        </div>
                        <form method="post" action="{{ route('auth-login') }}">
                        	{{csrf_field()}}
                        		@if (count($errors) > 0)
				                  <div class="alert alert-danger">
				                      <ul>
				                          @foreach ($errors->all() as $error)
				                              <li>{{ $error }}</li>
				                          @endforeach
				                      </ul>
				                  </div>
				                @endif
	                            @if(Session::has('error'))
	                            <div class="alert alert-danger">
	                                {{ Session::get('error') }}
	                            </div>
	                            @endif

                            <div class="form-group">
                                <input type="text" required="" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required="" type="password" name="password" placeholder="Mật khẩu">
                            </div>
                            <!-- <div class="login_footer form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Ghi nhớ</span></label>
                                    </div>
                                </div>
                                <a href="#">Quên mật khẩu?</a>
                            </div> -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">Đăng nhập</button>
                            </div>
                        </form>
                        <div class="different_login">
                            <span> Hoặc</span>
                        </div>
                        <ul class="btn-login list_none text-center">
                            <li><a href="{{ route('fb-auth') }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                            <!-- <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li> -->
                        </ul>
                        <div class="form-note text-center">Bạn chưa có tài khoản? <a href="{{ route('dang-ky') }}">Đăng ký ngay</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->
@stop

@section('javascript_page')
   
@stop
