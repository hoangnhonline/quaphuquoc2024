@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fe-parent-cate', $detail->productCate->slug) }}">{!!
                            $detail->productCate->name !!}</a></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img id="product_img" src='{{ Helper::showImage($socialImage) }}'
                                data-zoom-image="{{ Helper::showImage($socialImage) }}" alt="{!! $detail->name !!}" />
                            <a href="#" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4"
                            data-slides-to-scroll="1" data-infinite="false">
                            @foreach ($detail->images as $image)
                            <div class="item">
                                <a href="#" class="product_gallery_item {{ Helper::showImage($socialImage)==Helper::showImage($image->image_url) ? "active" : "" }}"
                                    data-image="{{ Helper::showImage($image->image_url) }}"
                                    data-zoom-image="{{ Helper::showImage($image->image_url) }}">
                                    <img id="product_img" src="{{ Helper::showImage($image->image_url) }}"
                                        alt="{!! $detail->name !!}" />
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <div class="page-title">
                        <h1 style="font-size: 22px">{!! $detail->name !!}</h1>
                    </div>
                            <div class="product_price">
                                <span class="price">
                                    @if($detail->price > 0)
                                    {{ $detail->is_sale == 1  ? number_format($detail->price_sale) : number_format($detail->price) }}đ
                                    @else
                                    Liên hệ
                                    @endif
                                </span>
                                @if($detail->is_sale == 1)
                                <del>{{ number_format($detail->price) }}đ</del>
                                @endif
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:100%"></div>
                                </div>
                            </div>
                            @if($detail->icons)
                            <div class="product_sort_info">
                                <ul class="row">
                                    @foreach($detail->icons as $icon)
                                    <li class="text-center">
                                        <img class="lazy" src="{{ Helper::showImage($icon->icon->image_url) }}"
                                        alt="{!! $icon->icon->content !!}" />
                                       
                                        <p>{!! $icon->icon->content !!}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <hr />
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input id="quantity-product" type="text" name="quantity" value="1" title="Qty" class="qty" size="2" maxlength="2">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <div class="cart_btn">
                                <button class="btn btn-fill-out btn-addtocart btnMuaDetail" product-id="{{ $detail->id }}" type="button"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                        <hr />
                        <ul class="product-meta">
                            <li>Loại sản phẩm: <a href="{{ route('fe-parent-cate', $detail->productCate->slug) }}">{!! $detail->cate->name !!}</a> 
                                @if($detail->cateChild)
                                > <a href="{{ route('fe-parent-cate', $detail->productCate->slug) }}">{!! $detail->cateChild->name !!}</a>
                                @endif
                            </li>
                            @if($detail->xuat_xu)
                            <li>Xuất xứ: {!! $detail->xuat_xu !!}</li>
                            @endif
                            @if($detail->thuonghieu)
                            <li>Thương hiệu: {!! $detail->thuonghieu->name !!}</li>
                            @endif
                            @if($detail->dung_tich)
                            <li>Dung tích: {!! $detail->dung_tich !!}</li>
                            @endif
                            @if($detail->trong_luong)
                            <li>Trọng lượng: {!! $detail->trong_luong !!}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description"
                                    role="tab" aria-controls="Description" aria-selected="true">Hướng dẫn sử dụng</a>
                            </li>
                            <li class="nav-item">                                
                                <a class="nav-link" id="baoquan-tab" data-toggle="tab" href="#baoquan"
                                    role="tab" aria-controls="baoquan" >Cách bảo quản</a>                              
                            </li>
                            <li class="nav-item">                                
                                <a class="nav-link" id="thanhphan-tab" data-toggle="tab" href="#thanhphan"
                                    role="tab" aria-controls="thanhphan">Thành phần</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">

                            <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                aria-labelledby="Description-tab">
                                {!! $detail->huong_dan !!}
                            </div>
                            <div class="tab-pane fade" id="baoquan" role="tabpanel"
                                aria-labelledby="baoquan-tab">
                                {!! $detail->bao_quan !!}
                            </div>
                            <div class="tab-pane fade" id="thanhphan" role="tabpanel"
                                aria-labelledby="thanhphan-tab">
                                {!! $detail->thanh_phan !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="small_divider"></div>
                        <div class="divider"></div>
                    </div>
                </div>
                <div class="container">
                @if($relatedList)
                <div class="col-xs-12" style="margin-top: 20px">
                        <div class="heading_s1">
                            <h3 class="text-left">Sản phẩm liên quan</h3>
                        </div>
                        <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                            @foreach($relatedList as $product)
                         
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        @if($product->thumbnail)
                                        <a href="{{ route('product.detail', [$product->slug , $product->id]) }}">
                                            <img src="{{ Helper::showImage($product->thumbnail->image_url) }}" alt="{!! $product['name'] !!}">
                                        </a>                   
                                        @endif                
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title">
                                            <a href="{{ route('product.detail', [$product->slug , $product->id]) }}">{!! $product['name'] !!}</a>
                                        </h6>
                                        <div class="product_price">
                                                <span class="price">
                                                    @if($product['price'] > 0)
                                                        {{ $product['is_sale'] == 1 ? number_format($product['price_sale']) : number_format($product['price']) }}đ
                                                    @else
                                                        Liên hệ
                                                    @endif
                                                </span>
                                                @if($product['is_sale'] == 1)
                                                    <del>{{ number_format($product['price']) }}đ</del>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END SECTION SHOP -->
@endsection
@section('javascript_page')
<script src="{{ URL::asset('assets/vendor/zoom/jquery.zoom.min.js') }}"></script>
<!-- Js bxslider -->
<script src="{{ URL::asset('assets/vendor/bx-slider/jquery.bxslider.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ URL::asset('assets/vendor/countdown/jquery.countdown.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/updown.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.bxslider .item').each(function () {
            $(this).zoom();
        });

        $(".bxslider").bxSlider({
            controls: false,
            pagerCustom: '.pro-thumb-img',
            nextText: '<i class="fa fa-angle-right"></i>',
            prevText: '<i class="fa fa-angle-left"></i>'
        });

        $(".pro-thumb-img").bxSlider({
            slideMargin: 20,
            maxSlides: 4,
            pager: false,
            controls: true,
            slideWidth: 80,
            infiniteLoop: false,
            nextText: '<i class="fa fa-angle-right"></i>',
            prevText: '<i class="fa fa-angle-left"></i>'
        });
        /** COUNT DOWN **/
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                var fomat =
                    '<i class="fa fa-clock-o"></i> <b>Thời gian còn lại:</b> <span>%D ngày,</span> <span>%H</span> : %M<span class="minute"></span> : %S<span class="seconds"></span>';
                $this.html(event.strftime(fomat));
            });
        });
    });
</script>
@stop