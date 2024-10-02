@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{!! $rs->name !!}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fe-parent-cate', $rsParent->slug) }}">{{ $rsParent->name }}</a></li>
                                   
                    <li class="breadcrumb-item active">{!! $rs->name !!}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<div class="main_content">
<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
    	<div class="row">
			<div class="col-12">            	
                <div class="row shop_container grid">
                    @if ($productList->count() > 0)
                        @foreach($productList as $product)                 
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product">
                                <!-- <span class="pr_flash">New</span> -->
                                <div class="product_img">
                                    <a href="{{ route('product.detail', [$product->slug , $product->id]) }}">
                                        <img src="{{ Helper::showImage($product['image_url']) }}" alt="{!! $product['name'] !!}">
                                    </a>                                    
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
                    @else
                        <div class="col-12">
                            <p class="text-center">
                                Sản phẩm đang được cập nhật.
                            </p>
                        </div>

                    @endif  	
                </div>
        		<div class="row">
                    <div class="col-12 mt-2 mt-md-4 d-flex justify-content-center">
                            {{ $productList->links() }}
                    </div> 
                </div> 
        	</div>
        </div>
    </div>
</div>
</div>
@stop
