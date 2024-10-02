@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{!! $detail->cate->name !!}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news-list') }}">Tin tức</a></li>
                    <li class="breadcrumb-item active"></a>{!! $detail->cate->name !!}</li>
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
        	<div class="col-xl-9">
            	<div class="single_post">
                	<h2 class="blog_title">{{ $detail->title }}</h2>
                    <ul class="list_none blog_meta">
                        <li><a ><i class="ti-calendar"></i>{{ date('d/m/Y', strtotime($detail->created_at)) }} </a></li>
                    </ul>
                    <div class="blog_img">
                        <img src="{{ Helper::showImage($detail->image_url) }}" alt="{!! $detail->title !!}">
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            <div class="content-text clearfix">
                                <?php echo $detail->content; ?>
                            </div>
                        	<!-- <div class="blog_post_footer">
                                <div class="row justify-content-between align-items-center">                                    
                                    <div class="col-md-12 mb-3 mb-md-0">

                                        <ul class="social_icons text-md-right">
                                            <li><a href="#" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="#" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="#" class="sc_google"><i class="ion-social-googleplus"></i></a></li>
                                            <li><a href="#" class="sc_youtube"><i class="ion-social-youtube-outline"></i></a></li>
                                            <li><a href="#" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>  
                <hr>     
                <div class="related_post">
                	<div class="content_title">
                    	<h5>Bài Viết Liên Quan</h5>
                    </div>
                    <div class="row">
                        @foreach ($otherList as $item)
                            <div class="col-md-6">
                                <div class="blog_post blog_style2 box_shadow1">
                                    <div class="blog_img">
                                        <a href="{{ route('news-detail', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                            <img src="{{ Helper::showImage($item->image_url) }}" alt="{!! $item->title !!}">
                                        </a>
                                    </div>
                                    <div class="blog_content bg-white">
                                        <div class="blog_text">
                                            <h5 class="blog_title"><a href="{{ route('news-detail', ['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->title }}</a></h5>
                                            <ul class="list_none blog_meta">
                                                <li><a href="#"><i class="ti-calendar"></i> {{ date('d/m/Y', strtotime($item->created_at)) }}</a></li>
                                            </ul>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach                        
                	</div>
                </div>                
            </div>
        	<div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
            	<div class="sidebar">               	
                   
                	<div class="widget">
                    	<h5 class="widget_title">Tin tức nổi bật</h5>
                        <ul class="widget_recent_post">
                            @foreach ($hotArr as $news)
                                <li>
                                    <div class="post_footer">
                                        <div class="post_img">
                                            <a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}"><img src="{{ Helper::showImage($news->image_url) }}" alt="{!! $news->title !!}"></a>
                                        </div>
                                        <div class="post_content">
                                            <h6><a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}">{{ $news->title }}</a></h6>
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


@stop