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
          <h1>Thanh Toán</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
          <li class="breadcrumb-item active">Thanh toán</li>
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
          <div class="medium_divider"></div>
          <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
          <div class="medium_divider"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="heading_s1">
            <h4>Thông Tin Mua Hàng</h4>
          </div>
          <form method="POST" action="{{ route('cart.done') }}" id="paymentForm" name="paymentForm">
            {{ csrf_field() }}
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            @if (Session::get('login'))
              <div class="form-group">
                <input type="text" required class="form-control" name="full_name" value="{{ old('full_name') ? old('full_name') : Session::get('username') }}"
                  placeholder="Họ và tên *">
              </div>
              <div class="form-group">
              <input class="form-control" type="text" name="email" value="{{ old('email') ? old('email') : Session::get('email') }}"
                placeholder="Địa chỉ email">
            </div>
            @else
              <div class="form-group">
                <input type="text" required class="form-control" name="full_name" value="{{ old('full_name') }}"
                  placeholder="Họ và tên *">
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="email" value="{{ old('email') }}"
                  placeholder="Địa chỉ email">
              </div>
            @endif
            
            <div class="form-group">
              <input class="form-control" required type="text" name="phone" value="{{ old('phone') }}"
                placeholder="Số điện thoại *">
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <div class="custom_select">

                  <select name="city_id" class="form-control" id="city_id" data-bv-field="city_id">
                    <option value="">Tỉnh/Thành*</option>
                    <@foreach($listCity as $city) <option value="{{ $city->id }}"
                      {{ old('city_id') == $city->id ? "selected" : "" }}>{!! $city->name !!}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="custom_select">
                  <select name="district_id" class="form-control" id="district_id">
                    <option value="">Quận/Huyện</option>
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="custom_select">
                  <select name="ward_id" class="form-control" id="ward_id">
                    <option value="">Phường/Xã</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="address" value="{{ old('address') }}" required=""
                placeholder="Địa chỉ *">
            </div>
            <div class="form-group mb-0">
              <textarea rows="5" class="form-control" name="notes" placeholder="Ghi chú"></textarea>
            </div>
            <div class="payment_method" style="margin-top: 20px">
              <div class="heading_s1">
                <h4>Phương thức thanh toán</h4>
              </div>
              <div class="payment_option">
                <div class="custome-radio">
                  <input class="form-check-input" type="radio" value="2" name="method_id" id="method_id0"
                    checked="checked">
                  <label class="form-check-label" for="method_id0">Giao hàng và thu tiền tại nhà</label>
                  <p data-method="2" class="payment-text">Quý khách có thể trả tiền mặt khi giao hàng.</p>
                </div>
                <div class="custome-radio">
                  <input class="form-check-input" value="1" type="radio" name="method_id" id="method_id1">
                  <label class="form-check-label" for="method_id1">Chuyển khoản ngân hàng</label>
                  <!-- <p data-method="1" class="payment-text">Quý khách có thể lựa chọn chuyển khoản tới trong những ngân hàng sau. </p> -->
                  <div class="payment_box payment_method_bacs">
                    <div class="box-info-payment">
                      <div class="info-payment-top">
                        Quý khách có thể lựa chọn chuyển khoản tới ngân hàng sau:
                      </div>
                      <div class="info-payment-center">
                        <ul class="list-bank">
                          <li class="info-payment-item d-flex">
                            <div class="payment-thumb">
                              <img src="{{ asset('assets/images/ngan-hang-techcombank.png') }}">
                            </div>
                            <div class="payment-detail">
                              <div class="payment-bankname">Ngân hàng TMCP Kỹ thương Việt Nam (Techcombank)- Chi
                                nhánh Thanh Khê - PGD 29. 3</div>
                              <div class="payment-detail-row">
                                <div class="detail-row row-name"><b>Chủ tài khoản:</b> <span class="row-txt">Phạm
                                    Thị Ngọc Ly</span></div>
                                <div class="detail-row row-number"><b>Số tài khoản:</b> <span
                                    class="row-txt">19035529510011</span></div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-fill-out btn-block" id="btnPayment">Đặt Hàng</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="order_review">
          <div class="heading_s1">
            <h4>Đơn hàng của bạn</h4>
          </div>
          <div class="table-responsive order_table">
            <table class="table">
              @php
              $totalAll=0;
              @endphp
              <thead>
                <tr>
                  <th>Sản phẩm</th>
                  <th class="text-right">Thành tiền</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cart as $product_id => $product)
                <tr>
                  <td>{!! $product['name'] !!} <span class="product-qty">x {{ $product['amount'] }}</span></td>
                  @php
                  $totalAll += $product['total_price'];
                  @endphp
                  <td class="text-right">{{ number_format($product['total_price']) }} VNĐ</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Tạm Tính</th>
                  <td class="product-subtotal text-right">{{ number_format($totalAll) }} VNĐ</td>
                </tr>
                <tr>
                  <th>Shipping</th>
                  <td>-</td>
                </tr>
                <tr>
                  <th>Tổng Cộng</th>
                  <td class="product-subtotal text-right cart_total_amount_end">{{ number_format($totalAll) }} VNĐ</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END SECTION SHOP -->
</div>
<!-- END MAIN CONTENT -->
@stop
@section('javascript_page')
<script type="text/javascript">  
  $(document).ready(function () {

    $('#paymentForm').submit(function(){
      $('#btnPayment').html('Đang xử lý...').attr('disabled', 'disabled');
    });
    var city_id = {{ old('city_id', 0) }};
    var district_id = {{ old('district_id', 0) }};
    var ward_id = {{ old('ward_id', 0) }};
    if (city_id > 0) {
      getChild('district', 'city_id', city_id, '#district_id', district_id);    
    }
    if (district_id > 0) {
      getChild('ward', 'district_id', district_id, '#ward_id', ward_id);
    }
  
    if (district_id > 0) {
      getChild('ward', 'district_id', district_id, '#ward_id', ward_id);
    } 
    $('#city_id').change(function () {
      getChild('district', 'city_id', $(this).val(), '#district_id', district_id);
    }); 
    $('#district_id').change(function () {
      getChild('ward', 'district_id', $(this).val(), '#ward_id', ward_id);
    });

  });

  function getChild(mod, col, id, obj_apply, child_col_value = 0) {
    $.ajax({
      url: '{{ route('get-child') }}',
      data: {
        mod: mod,
        col: col,
        id: id
      },
      type: 'POST',
      dataType: 'html',
      success: function (data) {
        $(obj_apply).html(data);
        if (child_col_value > 0) $(obj_apply).val(child_col_value);
      }
    });

  }
</script>
@endsection