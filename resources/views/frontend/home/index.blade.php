@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
        <div class="carousel-inner">
                <!-- <div class="carousel-item active background_bg" data-img-src="{{ asset('assets/images/banner-dac-san-da-nang.jpg') }}  ">
                </div> -->
            @if ($banners->count() > 0)
                <?php $i=1; ?>
                @foreach ($banners as $banner)
                <div class="carousel-item background_bg {{ $i==1 ? "active" : "" }}" data-img-src="{{ Helper::showImage($banner->image_url) }}">
                    <div class="banner_slide_content">
                        <div class="container"><!-- STRART CONTAINER -->
                            <div class="row">
                                <div class="col-lg-7 col-9">
                                    <div class="banner_content overflow-hidden">
                                        @if($banner->small_text)
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">{!! $banner->small_text !!}</h5>
                                        @endif
                                        @if($banner->large_text)
                                        <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{!! $banner->large_text !!}</h2>
                                        @endif
                                        @if($banner->type == 2)
                                        <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="{{ $banner->ads_url }}" data-animation="slideInLeft" data-animation-delay="1.5s">Chi tiết</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- END CONTAINER-->
                    </div>
                </div>
                <?php $i+=1; ?>
                @endforeach
            @endif
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
</div>
<!-- END SECTION BANNER -->
<!-- END SECTION SHOP -->
<div class="section pb_20 small_pt">
    <div class="container-fluid px-2">
        <div class="row g-0">
            @if ($banner_sales->count() > 0)
                <?php $i=1; ?>
                @foreach ($banner_sales as $banner)
            <div class="col-md-4">
                <div class="sale_banner">
                    <a class="hover_effect1" href="#">
                        <img src="{{ Helper::showImage($banner->image_url) }}" alt="{!! $banner->small_text !!}">
                    </a>
                </div>
            </div>           
            @endforeach
            @endif
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
<div class="main_content">
   
<!-- START SECTION SHOP -->
@foreach($loaiSp as $parent)
@if(!empty($productArr[$parent->id]))
<div class="section small_pt pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2><a href="{{ route('fe-parent-cate', $parent->slug) }}" title="{!! $parent->name !!}">{!! $parent->name !!}</a></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">               
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                        <div class="row shop_container justify-content-center">
                            @foreach ($productArr[$parent->id] as $product)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        @if($product->is_hot == 1)
                                            <span class="pr_flash bg-danger">Hot</span>
                                        @endif
                                        <div class="product_img">
                                            @if($product->thumbnail)
                                            <a href="{{ route('product.detail', [$product->slug , $product->id]) }}">
                                                <img src="{{ Helper::showImage($product->thumbnail->image_url) }}" alt="{!! $product->name !!}">
                                            </a>                   
                                            @endif                         
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.detail', [$product->slug , $product->id]) }}">{!! $product->name !!}</a></h6>
                                            <div class="product_price">
                                                <span class="price">
                                                    @if($product->price > 0)
                                                        {{ $product->is_sale == 1  ? number_format($product->price_sale) : number_format($product->price) }}đ
                                                    @else
                                                        Liên hệ
                                                    @endif
                                                </span>
                                                @if($product->is_sale == 1)
                                                    <del>{{ number_format($product->price) }}đ</del>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:100%"></div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach                           
                        </div>
                    </div>                    
                </div>
            </div>
        </div> 
    </div>
</div>
@endif
@endforeach
 <div class="section pb_20">
        <div class="container">
            <div class="row">
                @if ($banner_sales2->count() > 0)
                <?php $i=1; ?>
                @foreach ($banner_sales2 as $banner)
                <div class="col-md-6">
                    <div class="single_banner">
                        <img src="{{ Helper::showImage($banner->image_url) }}" alt="{!! $banner->large_text !!}">
                        <div class="single_banner_info">
                            @if($banner->small_text)
                            <h5 class="single_bn_title1">{!! $banner->small_text !!}</h5>
                            @endif
                            @if($banner->large_text)
                            <h3 class="single_bn_title">{!! $banner->large_text !!}</h3>
                            @endif
                            @if($banner->type == 2)
                            <a href="{{ $banner->ads_url }}" class="single_bn_link">Chi tiết</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
<!-- START SECTION SHOP -->
@foreach($loaiSp as $parent)
@if(!empty($productArr[$parent->id]))
<div class="section small_pt pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2><a href="{{ route('fe-parent-cate', $parent->slug) }}" title="{!! $parent->name !!}">{!! $parent->name !!}</a></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">               
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                        <div class="row shop_container justify-content-center">
                            @foreach ($productArr[$parent->id] as $product)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        @if($product->is_hot == 1)
                                            <span class="pr_flash bg-danger">Hot</span>
                                        @endif
                                        <div class="product_img">
                                            @if($product->thumbnail)
                                            <a href="{{ route('product.detail', [$product->slug , $product->id]) }}">
                                                <img src="{{ Helper::showImage($product->thumbnail->image_url) }}" alt="{!! $product->name !!}">
                                            </a>                   
                                            @endif                         
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.detail', [$product->slug , $product->id]) }}">{!! $product->name !!}</a></h6>
                                            <div class="product_price">
                                                <span class="price">
                                                    @if($product->price > 0)
                                                        {{ $product->is_sale == 1  ? number_format($product->price_sale) : number_format($product->price) }}đ
                                                    @else
                                                        Liên hệ
                                                    @endif
                                                </span>
                                                @if($product->is_sale == 1)
                                                    <del>{{ number_format($product->price) }}đ</del>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:100%"></div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach                           
                        </div>
                    </div>                    
                </div>
            </div>
        </div> 
    </div>
</div>
@endif
@endforeach

<!-- START SECTION BLOG -->
<div class="section small_pt pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="heading_s1 text-center">
                    <h2>TIN TỨC NỔI BẬT </h2>
                </div>
                <p class="leads text-center">Cập nhật tin tức mới nhất về sức khỏe</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($articlesList as $news)
            <div class="col-lg-4 col-md-6">
                <div class="blog_post blog_style1 box_shadow1">
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
                                <li><a ><i class="fa fa-user"></i>Admin</a></li>
                            </ul>
                            <p>{!! $news->description !!}</p>
                            <a href="{{ route('news-detail', ['slug' => $news->slug, 'id' => $news->id]) }}" class="btn btn-fill-line border-2 btn-xs rounded-0">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- END SECTION BLOG -->

@stop