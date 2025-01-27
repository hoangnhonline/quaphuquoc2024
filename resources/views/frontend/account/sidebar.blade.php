<div class="col-sm-3" id="left_column">  
  <!-- block category -->
      <div class="block left-module">
          <p class="title_block">Thông tin tài khoản</p>
          <div class="block_content">
              <!-- layered -->
              <div class="layered layered-category">
                  <div class="layered-content">
                      <ul class="tree-menu">
                          <li {{ $routeName == "account-info" ? "class=active" : "" }}>
                              <a href="{{ route('account-info') }}" title="Cập nhật thông tin"> Cập nhật thông tin</a>
                          </li>
                          <li {{ $routeName == "order-history" || $routeName == "order-detail" ? "class=active" : "" }}>
                              <a href="{{ route('order-history') }}" title="Đơn hàng của tôi"> Đơn hàng của tôi</a>
                          </li>
                          <li {{ $routeName == "notification" ? "class=active" : "" }}>
                              <a href="{{ route('notification') }}" title="Thông báo của tôi"> Thông báo của tôi</a>
                          </li>
                          @if(Session::get('facebook_id') == null)
                          <li {{ $routeName == "change-password" ? "class=active" : "" }}>
                              <a href="{{ route('change-password') }}" title="Đổi mật khẩu"> Đổi mật khẩu</a>
                          </li>
                          @endif
                          <li>
                              <a href="{{ route('user-logout') }}" title="Thoát tài khoản">Thoát tài khoản </a>
                          </li>
                      </ul>
                  </div>
              </div>
              <!-- ./layered -->
          </div>
      </div>
      <!-- ./block category  -->
      <!-- Banner silebar -->
      @include('frontend.partials.banner-slidebar')
      <!-- ./Banner silebar -->
</div> 
