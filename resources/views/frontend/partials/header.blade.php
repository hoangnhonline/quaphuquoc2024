<header class="header_wrap fixed-top header_with_topbar">
	<div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <ul class="contact_detail text-center text-lg-left">
                            <li><i class="ti-mobile"></i><a href="tel:0968882920">096 888 2920</a></li>
                            <li><i class="ti-email"></i><a href="mailto:gorganicfamily@gmail.com">gorganicfamily@gmail.com</a></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="text-center text-md-right">
                       	<ul class="header_list">
                        	<!-- <li><a href="compare.html"><i class="ti-control-shuffle"></i><span>Compare</span></a></li>
                            <li><a href="wishlist.html"><i class="ti-heart"></i><span>Wishlist</span></a></li> -->
                            @if(!Session::get('login'))
                            <li><a href="{{ route('dang-nhap') }}"><i class="fas fa-sign-in-alt"></i><span>Đăng nhập</span></a></li>
                            <li><a href="{{ route('dang-ky') }}"><i class="fa fa-user-plus"></i><span>Đăng ký</span></a></li>
                            @else  
                            <li class="dropdown ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
                                    <i class=""></i><span class="">Chào, {{ Session::get('username') }}</span>
                                </a>
                                <ul class="dropdown-menu">            
                                    <li><a href="{{ route('change-password') }}" >Đổi mật khẩu</a></li> 
                                    <li><a href="{{ route('user-logout') }}" >Thoát</a></li>
                                </ul>
                            </li>          
                            @endif
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
    	<div class="container">
            <nav class="navbar navbar-expand-lg"> 
                <a class="navbar-brand" href="{{ route('home') }}" title="Trang chủ">
                    <img class="logo_light" src="{{ asset('assets/images/logo-gfamily-light.png') }}" alt="logo gfamily light version" />
                    <img class="logo_dark" src="{{ asset('assets/images/logo-gfamily.png') }}" alt="logo gfamily" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <li>                            
                            <a  class="nav-link  nav_item {{ in_array($routeName, ['home']) ? 'active' : '' }}" name="home-page" title="Trang chủ"  href="{{ route('home') }}">Trang chủ</a>
                        </li>            
                        @foreach($loaiSp as $loai)
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="{{ route('fe-parent-cate', $loai->slug) }}" data-bs-toggle="dropdown">{!! $loai->name !!}</a>
                            <div class="dropdown-menu dropdown-reverse">
                                <ul>
                                    @foreach($loai->cates as $cate)
                                    <li>
                                        <a class="dropdown-item menu-link" href="{{ route('fe-cate', [$loai->slug, $cate->slug]) }}">{!! $cate->name !!}</a>
                                        <div class="dropdown-menu">
                                            <ul> 
                                                @foreach($cate->cateChild as $child)
                                                <li><a class="dropdown-item nav-link nav_item" href="{{ route('fe-cate-child', [$loai->slug, $cate->slug, $child->slug]) }}">{!! $child->name !!}</a></li>
                                                @endforeach                
                                            </ul>
                                        </div>
                                    </li>            
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endforeach
                       
                        <li class="dropdown">
                            <a 
                            class="dropdown-toggle nav-link {{ in_array($routeName, ['contact']) ? 'active' : '' }}"  href="{{ route('news-list') }}" data-bs-toggle="dropdown">Thư viện G-Family</a>
                            <div class="dropdown-menu dropdown-reverse">
                                <ul>
                                    @foreach($articlesCateParent as $cateParent)
                                    <li>
                                        <a class="dropdown-item menu-link" href="{{ route('news-cate-parent', [$cateParent->slug]) }}">{!! $cateParent->name !!}</a>
                                        <div class="dropdown-menu">
                                            <ul> 
                                                @foreach($cateParent->cates as $child)
                                                <li><a class="dropdown-item nav-link nav_item" href="{{ route('news-cate-list', [$cateParent->slug, $child->slug]) }}">{!! $child->name !!}</a></li>
                                                @endforeach                
                                            </ul>
                                        </div>
                                    </li>            
                                    @endforeach
                                </ul>
                            </div>

                        </li> 
                       <!--  <li><a class="nav-link nav_item {{ in_array($routeName, ['contact']) ? 'active' : '' }}"  href="{{ route('contact') }}">Liên hệ</a></li>  
                        --> <!-- <li><a class="nav-link nav_item {{ Request::is('banh-keo') ? 'active' : '' }}"  href="{{ route('fe-parent-cate', 'banh-keo') }}">Bánh kẹo</a></li> -->
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <!-- ============incon Search========== -->
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form action="{{ route('product.search') }}" method="GET">
                                <input type="text" placeholder="Nhập sản phẩm cần tìm" class="form-control" id="search_input" name="keyword" value="{{ isset($tu_khoa) ? $tu_khoa : "" }}">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div><div class="search_overlay"></div>
                    </li>
                    <!-- ==========icon Cart============ -->
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="{{ route('cart') }}" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">{{ $totalProductCart }}</span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                        @if(Session::has('cart') && Session::get('cart'))
                            @php
                                $cart = Session::get('cart');                               
                                $totalAll=0;
                            @endphp
                            <ul class="cart_list">
                                @foreach ($cart as $product_id => $product)
                                    <li>
                                        <a href="#" class="item_remove btnRemoveCart" product-id="{{ $product_id }}"><i class="ion-close"></i></a>
                                        <a href="{{ route('product.detail', [ $product['slug'] , $product_id]) }}"><img src="{{ Helper::showImage($product['image_url']) }}" alt="{!! $product['name'] !!}">{!! $product['name'] !!}</a>                                        
                                        <span class="cart_quantity">{{ $product['amount'] }} x <span class="cart_amount"> <span class="price_symbole">{{ number_format($product['price']) }}</span></span>đ</span>
                                    </li>
                                    @php                                     
                                        $totalAll += $product['total_price'];
                                    @endphp
                                @endforeach
                            </ul>
                        
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Tạm tính:</strong> <span class="cart_price"> <span class="price_symbole">{{ number_format($totalAll) }}</span></span>đ</p>
                            </div>
                        @else 
                            <div>
                                <p style="text-align: center; margin-top:25px; margin-bottom:10px;">Giỏ hàng chưa có sản phẩm nào.</p>
                            </div>
                        @endif
                            <div>
                                @if(Session::has('cart') && Session::get('cart'))
                                    <p class="cart_buttons"><a href="{{ route('cart') }}" class="btn btn-fill-line rounded-0 view-cart">Giỏ hàng</a><a href="{{ route('cart.checkout') }}" class="btn btn-fill-out rounded-0 view-cart">Thanh Toán</a></p>
                                @else
                                    <p class="cart_buttons"><a href="{{ route('cart') }}" class="btn btn-fill-line rounded-0 view-cart">Giỏ hàng</a><a class="btn btn-fill-out-dark rounded-0 view-cart">Thanh Toán</a></p>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>