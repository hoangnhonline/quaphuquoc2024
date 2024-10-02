<footer class="footer_dark">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img width="150" src="{{ asset('assets/images/logo-gfamily.png') }}" alt="logo"/></a>
                        </div>
                        <p>Chuyên cung cấp các loại đặc sản với chất lượng đảm bảo và giá cả hợp lí.</p>
                    </div>
                    
                </div>  
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">GIỚI THIỆU</h6>
                        <ul class="widget_links">
                            @foreach($articlesAbout as $articles)
                            <li><a href="{{ route('about-articles', ['slug' => $articles->slug, 'id' => $articles->id]) }}">{!! $articles->title !!}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>              
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Hỗ trợ khách hàng</h6>
                        <ul class="widget_links">
                            <li><a href="{{ route('fe-parent-cate', 'phuong-thuc-thanh-toan') }}">Phương thức thanh toán</a></li>
                            <li><a href="{{ route('fe-parent-cate', 'hinh-thuc-van-chuyen') }}">Hình thức vận chuyển</a></li>
                            <li><a href="{{ route('fe-parent-cate', 'chinh-sach-doi-tra') }}">Chính sách đổi trả</a></li>
                            <li><a href="{{ route('fe-parent-cate', 'cam-ket-chat-luong') }}">Cam kết chất lượng</a></li>
                            <li><a href="{{ route('fe-parent-cate', 'bao-mat-thong-tin') }}">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Thông tin liên hệ</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>98 Đường số 19, P8, Gò Vấp</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:gorganicfamily@gmail.com">gorganicfamily@gmail.com</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p><a href="tel:0968882920">096 888 2920</a></p>
                            </li>
                        </ul>

                    </div>
                    <div class="widget">
                            <ul class="social_icons social_white">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                </div>
             
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0 text-center text-md-left">© 2024 Bản quyền thuộc công ty G-Organic Family</p>
                </div>
                <div class="col-md-6">
                    <ul class="footer_payment text-center text-lg-right">
                        <li><a href="#"><img src="{{ asset('assets/images/visa.png') }}" alt="visa"></a></li>
                        <li><a href="#"><img src="{{ asset('assets/images/discover.png') }}" alt="discover"></a></li>
                        <li><a href="#"><img src="{{ asset('assets/images/master_card.png') }}" alt="master_card"></a></li>
                        <li><a href="#"><img src="{{ asset('assets/images/paypal.png') }}" alt="paypal"></a></li>
                        <li><a href="#"><img src="{{ asset('assets/images/amarican_express.png') }}" alt="amarican_express"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
