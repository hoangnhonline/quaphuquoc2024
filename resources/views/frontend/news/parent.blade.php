@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<!-- <h1>Ẩm thực đà nẵng</h1> -->
                    <h1>{{ isset($cateParentDetail) ? $cateParentDetail->name : "Tin Tức" }}</h1>
                    
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    @if (isset($cateParentDetail))
                        <li class="breadcrumb-item"><a href="{{ route('news-list') }}">Thư viện G-Family</a></li>
                        <li class="breadcrumb-item active">{!! $cateParentDetail->name !!}</li>
                    @else
                        <li class="breadcrumb-item active">Thư viện G-Family</li>
                    @endif
                    
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION BLOG -->
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9">
                <div class="row blog_thumbs">
                    @if ( $newsList->count() > 0 )
                        @foreach( $newsList as $news )
                        <div class="col-12">
                            <div class="blog_post blog_style2">
                                <div class="blog_img">
                                    <a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}">
                                        <img src="{{ Helper::showImage($news->image_url) }}" alt="{!! $news->title !!}">
                                    </a>
                                </div>
                                <div class="blog_content bg-white">
                                    <div class="blog_text">
                                        <h6 class="blog_title"><a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}">{!! $news->title !!}</a></h6>
                                        <ul class="list_none blog_meta">
                                            <li><a ><i class="ti-calendar"></i> {{ date('d/m/Y', strtotime($news->created_at)) }}</a></li>
                                            <li><a ><i class="fa fa-user"></i>{!! $news->name !!}</a></li>
                                        </ul>
                                        <p>{!! $news->description !!}</p>
                                        <a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}" class="btn btn-fill-line border-2 btn-xs rounded-0">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>Không có bài đăng nào.</p>     
                    @endif                    
                </div>
                <div class="row">
                    <div class="col-12 mt-2 mt-md-4 d-flex justify-content-center">
                            {{ $newsList->links() }}
                    </div> 
                </div> 

            </div>
        	<div class="col-lg-3 mt-4 pt-2 mt-lg-0 pt-lg-0">
            	<div class="sidebar">
                	
                	<div class="widget">
                    	<h5 class="widget_title">Tin nổi bật</h5>
                        <ul class="widget_recent_post">
                            @foreach ($hotArr as $news)
                                <li>
                                    <div class="post_footer">
                                        <div class="post_img">
                                            <a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}"><img src="{{ Helper::showImage($news->image_url) }}" alt="{!! $news->title !!}"></a>
                                        </div>
                                        <div class="post_content">
                                            <h6><a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}">{!! $news->title !!}</a></h6>
                                            <p class="small m-0">{{ date('d/m/Y', strtotime($news->created_at)) }}</p>
                                        </div>
                                    </div>
                                </li> 
                            @endforeach
                    	</ul>
                    </div>
                    
                    <div class="widget">
                        @if(isset($banner_news))
                            @foreach ($banner_news as $banner)
                                <div class="shop_banner">
                                    <div class="banner_img overlay_bg_20">
                                        <img src="{{ Helper::showImage($banner->image_url) }}" alt="sidebar_banner_news">
                                    </div> 
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->
</div>
<!-- END MAIN CONTENT -->
@stop