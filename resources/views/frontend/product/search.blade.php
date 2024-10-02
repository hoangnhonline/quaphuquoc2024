@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Tìm kiếm</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Kết quả tìm kiếm</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section small_pt pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              
                <p>
                    @if (!isset($productArr))                    
                        Vui lòng nhập từ khóa để tìm kiếm.                   
                    @elseif ( $productArr->total() > 0 )                    
                        Có {{ $productArr->total() }} kết quả tìm kiếm phù hợp từ khóa '{{ $tu_khoa }}'                    
                    @else                    
                        Không tìm thấy kết quả tìm kiếm phù hợp từ khóa '{{ $tu_khoa }}'                  
                    @endif                 
                </p>  
              
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                        <div class="row shop_container">
                          @if (isset($productArr))
                            @foreach ($productArr as $product)
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="{{ route('product.detail', [$product->slug, $product->id]) }}">
                                                <img src="{{ Helper::showImage($product->images[0]->image_url) }}" alt="{!! $product->name !!}">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart btnMuaHome" product-id="{{ $product->id }}"><a href="javascript:;"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.detail', [$product->slug, $product->id]) }}">{!! $product->name !!}</a></h6>
                                            <div class="product_price">
                                                <span class="price">{{ number_format($product->price) }}đ</span>
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
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->
</div>
@stop