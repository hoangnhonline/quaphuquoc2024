<header class="main-header">
  <!-- Logo -->
  <a href="{{ Auth::user()->email != "huongll@icho.vn" ? route('product.index') : route('product.short') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{ asset('assets/images/logo-gfamily.png') }}" alt="logo" width="180px"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{ asset('assets/images/logo-gfamily-light.png') }}" alt="logo" width="100px"></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->

    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">     
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
            <i class="fa fa-gears"></i><span class="hidden-xs">Chào {{ Auth::user()->full_name }}</span>
          </a>
          <ul class="dropdown-menu">            
            <li class="user-footer">
            <div class="pull-left">
                <a href="{{ route('account.change-pass') }}" class="btn btn-success btn-flat">Đổi mật khẩu</a>
              </div>             
              <div class="pull-right">

                <a href="{{ route('backend.logout') }}" class="btn btn-danger btn-flat">Thoát</a>
              </div>
            </li>
          </ul>
        </li>          
      </ul>
    </div>
  </nav>
</header>