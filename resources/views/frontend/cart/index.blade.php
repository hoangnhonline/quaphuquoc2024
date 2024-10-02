@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Giỏ Hàng</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Giỏ hàng</li>
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
                @php
                    $totalAll=0;
                @endphp
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($cart))
                                @foreach ($cart as $product_id => $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{ route('product.detail', [$product['slug'] , $product_id]) }}"><img src="{{ Helper::showImage($product['image_url']) }}" alt="{!! $product['name'] !!}"></a>
                                            </td>
                                            <td class="product-name" data-title="{!! $product['name'] !!}">
                                                <a href="{{ route('product.detail', [$product['slug'] , $product_id]) }}">{!! $product['name'] !!}</a>
                                            </td>
                                            <td class="product-price" data-title="Giá">{{ number_format($product['price']) }}đ</td>                                           
                                            <td class="product-quantity" data-title="Số lượng">{{ $product['amount'] }}</td>
                                            @php
                                                $totalAll += $product['total_price'];
                                            @endphp
                                            <td class="product-subtotal" data-title="Total">{{ number_format($product['total_price']) }}đ</td>
                                            <td class="product-remove btnRemoveCart" product-id="{{ $product_id }}" data-title="Xóa sản phẩm"><a href="javascript:;"><i class="ti-close"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" style="color: #687188;">
                                            Giỏ hàng chưa có sản phẩm nào.
                                        </td>
                                    </tr> 
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">

                                            <div class="col-lg-6 col-md-6 mb-3 mb-md-0 text-center text-md-left">
                                                <a class="btn btn-fill-line" href="{{ route('home') }}">Tiếp tục mua hàng</a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 text-center text-md-right">
                                                <form action="{{ route('cart.del-product') }}" method="get">
                                                    <button class="btn btn-line-fill" type="submit">Xóa Tất Cả</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- <div class="medium_divider"></div> -->
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row justify-content-end">
                @if(!empty($cart))
                <div class="col-md-6">

                    <div class="border p-3 p-md-4">
                        <div class="heading_s1 mb-3">
                            <h6>Tổng Tiền</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>    
                                        <td class="cart_total_label">Tạm Tính</td>
                                        <td class="cart_total_amount"><strong>{{ number_format($totalAll) }}đ</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Phí Vận Chuyển</td>
                                        <td class="cart_total_amount">-</td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="12" class="px-0">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col-md-12">
                                                    <div class="coupon field_form input-group">
                                                        <input type="text" value="" class="form-control form-control-sm" placeholder="Nhập mã giảm giá">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-fill-out btn-sm" type="submit">Áp dụng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td class="cart_total_label">Tổng Cộng</td>
                                        <td class="cart_total_amount_end"><strong>{{ number_format($totalAll) }}đ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (isset($arrProductInfo) && isset($cart))
                            <a href="{{ route('cart.checkout') }}" class="btn btn-fill-out">Tiến hành thanh toán</a>
                        @else 
                            <a class="btn btn-fill-out-dark">Tiến hành thanh toán</a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
@stop