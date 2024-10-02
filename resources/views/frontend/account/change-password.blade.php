@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Đổi mật khẩu</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active">Đổi mật khẩu</li>
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
        <div class="col-lg-3 col-md-4">
          <div class="dashboard_menu">
            <ul class="nav nav-tabs flex-column" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#change-password" role="tab"
                  aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Đổi mật khẩu</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders"
                  aria-selected="false"><i class="ti-shopping-cart-full"></i>Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                  aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>My Address</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab"
                  aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Account details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user-logout') }}"><i class="ti-lock"></i>Logout</a>
              </li> -->
            </ul>
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="tab-content dashboard_content">
            <div class="tab-pane fade active show" id="change-password" role="tabpanel" aria-labelledby="dashboard-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Đổi mật khẩu</h3>
                </div>
                <div class="card-body">
                  @if (session('error'))
                  <div class="alert alert-danger">
                    <ul>
                      <li>{{ session('error') }}</li>
                    </ul>
                  </div>
                  @endif
                  @if (session('success'))
                  <div class="alert alert-success">
                    <ul>
                      <li>{{ session('success') }}</li>
                    </ul>
                  </div>
                  @endif
                  <form class="form-horizontal bv-form" role="form" id="changePasswordForm" method="POST"
                    action="{{ route('save-new-password') }}">

                    {{ csrf_field() }}
                    <div class="form-group row">
                      <label for="old_pass" class="col-lg-3 control-label visible-lg-block">Mật khẩu hiện tại</label>
                      <div class="col-lg-9 input-wrap has-feedback">
                        <input type="password" name="old_pass" class="form-control address" id="old_pass" value=""
                          placeholder="Nhập mật khẩu hiện tại" data-bv-field="old_pass" maxlength="30">
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="old_pass"
                          data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập mật khẩu hiện tại.</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_pass" class="col-lg-3 control-label visible-lg-block">Mật khẩu mới</label>
                      <div class="col-lg-9 input-wrap has-feedback">
                        <input type="password" name="new_pass" class="form-control address" id="new_pass" value=""
                          placeholder="Nhập mật khẩu mới" data-bv-field="new_pass" maxlength="30">
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="new_pass"
                          data-bv-result="NOT_VALIDATED" style="display: none;">Vui lòng nhập mật khẩu mới từ 6 đến 30
                          ký tự.</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="re_new_pass" class="col-lg-3 control-label visible-lg-block">Xác nhận mật khẩu
                        mới</label>
                      <div class="col-lg-9 input-wrap has-feedback">
                        <input type="password" name="re_new_pass" class="form-control address" id="re_new_pass" value=""
                          placeholder="Nhập lại mật khẩu mới" data-bv-field="re_new_pass" maxlength="30">
                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="re_new_pass"
                          data-bv-result="NOT_VALIDATED" style="display: none;">Nhập lại mật khẩu mới từ 6 đến 30 ký
                          tự
                          và trùng khớp với mật khẩu vừa nhập.</small>
                      </div>
                    </div>
                    <div class="form-group row end">
                      <div class="col-lg-3"></div>
                      <div class="col-lg-9">
                        <div id="btnSavePassword" class="btn btn-primary btn-custom3" value="update">Cập nhật</div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Orders</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Total</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#1234</td>
                          <td>March 15, 2020</td>
                          <td>Processing</td>
                          <td>$78.00 for 1 item</td>
                          <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                        </tr>
                        <tr>
                          <td>#2366</td>
                          <td>June 20, 2020</td>
                          <td>Completed</td>
                          <td>$81.00 for 1 item</td>
                          <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
              <div class="row">
                <div class="col-lg-6">
                  <div class="card mb-3 mb-lg-0">
                    <div class="card-header">
                      <h3>Billing Address</h3>
                    </div>
                    <div class="card-body">
                      <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                      <p>New York</p>
                      <a href="#" class="btn btn-fill-out">Edit</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-header">
                      <h3>Shipping Address</h3>
                    </div>
                    <div class="card-body">
                      <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                      <p>New York</p>
                      <a href="#" class="btn btn-fill-out">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Account Details</h3>
                </div>
                <div class="card-body">
                  <p>Already have an account? <a href="#">Log in instead!</a></p>
                  <form method="post" name="enq">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>First Name <span class="required">*</span></label>
                        <input required="" class="form-control" name="name" type="text">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Last Name <span class="required">*</span></label>
                        <input required="" class="form-control" name="phone">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Display Name <span class="required">*</span></label>
                        <input required="" class="form-control" name="dname" type="text">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Email Address <span class="required">*</span></label>
                        <input required="" class="form-control" name="email" type="email">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Current Password <span class="required">*</span></label>
                        <input required="" class="form-control" name="password" type="password">
                      </div>
                      <div class="form-group col-md-12">
                        <label>New Password <span class="required">*</span></label>
                        <input required="" class="form-control" name="npassword" type="password">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Confirm Password <span class="required">*</span></label>
                        <input required="" class="form-control" name="cpassword" type="password">
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->
</div>
<div class="clearfix"></div>
@endsection

@section('javascript_page')
<script type="text/javascript">
  var customer_district_id = '{{ $customer->district_id }}';
  var customer_ward_id = '{{ $customer->ward_id }}';
  $(document).ready(function () {

    $('#btnSavePassword').click(function () {
      $(this).attr('disabled', '');
      validateData();
    });

  });


  function validateData() {
    var error = [];

    var old_pass = $('#old_pass').val();
    var new_pass = $('#new_pass').val();
    var re_new_pass = $('#re_new_pass').val();


    if (!old_pass.length) {
      error.push('old_pass');
    }

    if (!new_pass.length || new_pass.length < 6 || new_pass.length > 30) {
      error.push('new_pass');
    }

    if (!re_new_pass.length || new_pass.length < 6 || new_pass.length > 30 || new_pass != re_new_pass) {
      error.push('re_new_pass');
    }

    var list = ['old_pass', 'new_pass', 're_new_pass'];

    for (i in list) {
      $('#' + list[i]).next().hide();
      $('#' + list[i]).parent().removeClass('has-error');
    }

    if (error.length) {
      for (i in error) {
        $('#' + error[i]).parent().addClass('has-error');
        $('#' + error[i]).next().show();
      }

      $('#btnSavePassword').removeAttr('disabled');
    } else {
      $('#changePasswordForm').submit();
    }
  }
</script>
@endsection