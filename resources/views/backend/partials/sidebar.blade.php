<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ URL::asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->full_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview {{ in_array($routeName, ['product.index', 'product.create', 'product.edit', 'product-cate.index', 'product-cate.edit', 'product-cate.create', 'cate.index', 'cate.edit', 'cate.create', 'cate-child.index', 'cate-child.edit', 'cate-child.create']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-opencart"></i> 
          <span>Sản phẩm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array($routeName, ['product.index', 'product.edit']) ? "class=active" : "" }}><a href="{{ route('product.index') }}"><i class="fa fa-circle-o"></i> Sản phẩm</a></li>
          <li {{ $routeName == "product.create" ? "class=active" : "" }}><a href="{{ route('product.create') }}"><i class="fa fa-circle-o"></i> Thêm sản phẩm</a></li>
          <li {{ in_array($routeName, ['product-cate.index', 'product-cate.edit', 'product-cate.create']) ? "class=active" : "" }}><a href="{{ route('product-cate.index') }}"><i class="fa fa-circle-o"></i> Danh mục chính</a></li>
          <li {{ in_array($routeName, ['cate.index', 'cate.edit', 'cate.create']) ? "class=active" : "" }}><a href="{{ route('cate.index') }}"><i class="fa fa-circle-o"></i> Danh mục cấp 1</a></li>
          <li {{ in_array($routeName, ['cate-child.index', 'cate-child.edit', 'cate-child.create']) ? "class=active" : "" }}><a href="{{ route('cate-child.index') }}"><i class="fa fa-circle-o"></i> Danh mục cấp 2</a></li>
        </ul>
      </li>
      <li class="treeview {{ $routeName == "orders.index" ? "active" : "" }}">
        <a href="{{ route('orders.index') }}">
          <i class="fa fa-reorder"></i> 
          <span>Đơn hàng</span>         
        </a>
      </li>
      <li {{ in_array($routeName, ['customer.edit', 'customer.index']) ? "class=active" : "" }}>
        <a href="{{ route('customer.index') }}">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Khách hàng</span>         
        </a>       
      </li>
      <li class="treeview {{ in_array($routeName, ['pages.index', 'pages.create']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-twitch"></i> 
          <span>Trang</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array($routeName, ['pages.index', 'pages.edit']) ? "class=active" : "" }}><a href="{{ route('pages.index') }}"><i class="fa fa-circle-o"></i> Trang</a></li>
          <li {{ in_array($routeName, ['pages.create']) ? "class=active" : "" }}><a href="{{ route('pages.create') }}"><i class="fa fa-circle-o"></i> Thêm trang</a></li>          
        </ul>
      </li>
      <li class="treeview {{ in_array($routeName, ['articles.index', 'articles.create', 'articles.edit','articles-cate.create', 'articles-cate.index', 'articles-cate.edit']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Bài viết</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ in_array($routeName, ['articles.edit', 'articles.index']) ? "class=active" : "" }}><a href="{{ route('articles.index') }}"><i class="fa fa-circle-o"></i> Bài viết</a></li>
          <li {{ in_array($routeName, ['articles.create']) ? "class=active" : "" }} ><a href="{{ route('articles.create', ['cate_id' => 1]) }}"><i class="fa fa-circle-o"></i> Thêm bài viết</a></li>
          <li {{ in_array($routeName, ['articles-cate.create', 'articles-cate.index', 'articles-cate.edit']) ? "class=active" : "" }} ><a href="{{ route('articles-cate.index') }}"><i class="fa fa-circle-o"></i> Danh mục bài viết</a></li>          
        </ul>
       
      </li>
      
      <li>
        <a target="_blank" href="{{ env('APP_URL')}}/backend/dist/js/kcfinder/browse.php?type=images">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Thư viện ảnh</span>         
        </a>       
      </li>
      <li {{ in_array($routeName, ['newsletter.edit', 'newsletter.index']) ? "class=active" : "" }}>
        <a href="{{ route('newsletter.index') }}">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Newsletter</span>         
        </a>       
      </li>
      <li {{ in_array($routeName, ['contact.edit', 'contact.index']) ? "class=active" : "" }}>
        <a href="{{ route('contact.index') }}">
          <i class="fa fa-pencil-square-o"></i> 
          <span>Liên hệ</span>          
        </a>       
      </li>
      <li {{ in_array($routeName, ['banner.list', 'banner.edit', 'banner.create']) ? "class=active" : "" }}>
        <a href="{{ route('banner.list') }}">
          <i class="fa fa-file-image-o"></i> 
          <span>Banner</span>
          
        </a>       
      </li>
      <li {{ in_array($routeName, ['icons.list', 'icons.edit', 'icons.create']) ? "class=active" : "" }}>
        <a href="{{ route('icons.index') }}">
          <i class="fa fa-area-chart"></i>
          <span>Icons</span>          
        </a>       
      </li> 
      <li {{ in_array($routeName, ['report.index']) ? "class=active" : "" }}>
        <a href="{{ route('report.index') }}">
          <i class="fa fa-area-chart"></i>
          <span>Thống kê</span>          
        </a>       
      </li> 
      <li class="treeview {{ in_array($routeName, ['loai-thuoc-tinh.index', 'thuoc-tinh.index', 'color.index']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa  fa-gears"></i>
          <span>Cài đặt</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ $routeName == "settings.index" ? "class=active" : "" }}><a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i> Thông tin</a></li>
          <li {{ $routeName == "info-seo.index" ? "class=active" : "" }}><a href="{{ route('info-seo.index') }}"><i class="fa fa-circle-o"></i> Cài đặt SEO</a></li>
          <li {{ $routeName == "account.index" ? "class=active" : "" }}><a href="{{ route('account.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
        <!--   <li {{ $routeName == "loai-thuoc-tinh.index" ? "class=active" : "" }}><a href="{{ route('loai-thuoc-tinh.index') }}"><i class="fa fa-circle-o"></i> Loại thuộc tính</a></li>
          <li {{ $routeName == "thuoc-tinh.index" ? "class=active" : "" }}><a href="{{ route('thuoc-tinh.index') }}"><i class="fa fa-circle-o"></i> Thuộc tính</a></li>
          <li {{ $routeName == "color.index" ? "class=active" : "" }}><a href="{{ route('color.index') }}"><i class="fa fa-circle-o"></i> Màu sắc</a></li>  -->     
        </ul>
      </li>
      <!--<li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<style type="text/css">
  .skin-blue .sidebar-menu>li>.treeview-menu{
    padding-left: 15px !important;
  }
</style>