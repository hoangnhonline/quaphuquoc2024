@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Sản phẩm</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sản phẩm</li>
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
			<div class="col-12">            	
                @if ($products->count() > 0 ) 
                    <div class="row shop_container loadmore" data-item="8" data-item-show="4" data-finish-message="No More Item to Show" data-btn="Load More">
                        @foreach ($products as $product )
                            <div class="col-lg-3 col-md-4 col-6 grid_item">
                                <div class="product">
                                    @if($product->is_hot == 1)
                                    <span class="pr_flash bg-danger">Hot</span>
                                    @endif
                                    <div class="product_img">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <img src="{{ Helper::showImage($product->images[0]->image_url) }}" alt="{!! $product->name !!}">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart btnMuaHome" product-id="{{ $product->id }}"><a href="#"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="{{ route('product.detail', $product->slug) }}">{!! $product->name !!}</a></h6>
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
                    </div>
                @else
                <p>Chưa có sản phẩm nào.</p>   
                @endif
        	</div>
        </div>
    </div>
</div>
</div>
<!-- END SECTION SHOP -->
@stop