@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Liên hệ</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Liên Hệ</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION CONTACT -->
<div class="section pb_70">
	<div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-map2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Địa chỉ</span>
                        <p>550/15 Điện Biên Phủ, Thanh Khê, Đà Nẵng</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-envelope-open"></i>
                    </div>
                    <div class="contact_text">
                        <span>Email</span>
                        <a href="mailto:info@sitename.com">chodacsandanang@gmail.com </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="contact_wrap contact_style3">
                    <div class="contact_icon">
                        <i class="linearicons-tablet2"></i>
                    </div>
                    <div class="contact_text">
                        <span>Hotline</span>
                        <p>0877 580 111</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CONTACT -->

<!-- START SECTION CONTACT -->
<div class="section pt-0">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-6">
            	<div class="heading_s1">
                	<h4>GỬI THÔNG TIN CHO GFAMILY.VN</h4>
                </div>
                <p class="leads">Hãy gửi cho chúng tôi thắc mắc hoặc phản hồi của bạn về sản phẩm.</p>
                <div class="field_form">
                    <form method="POST" action="{{ route('send-contact') }}">
                        <div class="row">
                            {!! csrf_field() !!}
                            @if(Session::has('message'))
                            <div class="form-group col-md-12">
                                <div class="alert alert-success fade in alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                                    <strong>Thành công! </strong>{{Session::get('message')}}
                                </div>
                            </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="form-group col-md-12">
                                    <div class="alert alert-danger fade in alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                                        <strong>Lỗi! </strong>{{$errors->first()}}
                                    </div>
                                </div>
                                <!-- <div class="notification error">
                                    <span class="notification-icon">
                                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                                    </span>
                                    <span class="notification-text">{{$errors->first()}}</span>
                                </div> -->
                            @endif	
                            <input type="hidden" name="type" value="1"> 
                            <div class="form-group col-md-12" >
                                <input type="radio" name="gender" value="1" id="gender1" checked="checked"> <label for="gender1">Anh</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="2" id="gender2"> <label for="gender2">Chị</label>
                            </div>
                            <div class="form-group col-md-12">
                                <input required placeholder="Nhập họ và tên *" id="full_name" class="form-control" name="full_name" type="text" value="{{ old('full_name') }}">
                             </div>
                            <div class="form-group col-md-6">
                                <input required placeholder="Nhập Email *" id="email" class="form-control" name="email" type="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <input required placeholder="Nhập số điện thoại *" id="phone" class="form-control" name="phone" value="{{ old('phone') }}" >
                            </div>
                            <div class="form-group col-md-12">
                                <textarea required placeholder="Nội dung liên hệ *" id="content" class="form-control" name="content" rows="4">{{ old('content') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <!-- <button type="submit" title="Submit Your Message!" class="btn btn-fill-out" id="submitButton" name="submit" value="Submit">Gửi tin nhắn</button> -->
                                <button type="submit" title="Submit Your Message!" class="btn btn-fill-out">Gửi tin nhắn</button>
                            </div>
                            <div class="col-md-12">
                                <div id="alert-msg" class="alert-msg text-center"></div>
                            </div>
                        </div>
                    </form>		
                </div>
            </div>
            <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
            	<div id="map" class="contact_map2" data-zoom="16" data-latitude="16.066475" data-longitude="108.184373" data-icon="{{ asset('assets/images/marker.png') }}"></div>
                
                <!-- <div id="map-canvas"></div> -->
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CONTACT -->


</div>
<!-- END MAIN CONTENT -->

@endsection