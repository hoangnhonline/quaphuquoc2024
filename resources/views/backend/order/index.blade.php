@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Đơn hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'orders.index' ) }}">Đơn hàng</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <div class="panel panel-default">       
        <div class="panel-body">
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('orders.index') }}">  
            <div class="form-group">
              <select class="form-control select2" name="time_type" id="time_type" style="width: 150px">
                <option value="">--Thời gian--</option>
                <option value="1" {{ $time_type == 1 ? "selected" : "" }}>Theo tháng</option>
                <option value="2" {{ $time_type == 2 ? "selected" : "" }}>Khoảng ngày</option>
                <option value="3" {{ $time_type == 3 ? "selected" : "" }}>Ngày cụ thể </option>
              </select>
            </div>
            @if($time_type == 1)
            <div class="form-group  chon-thang">
                <select class="form-control select2" id="month_change" name="month">
                  <option value="">--THÁNG--</option>
                  @for($i = 1; $i <=12; $i++)
                  <option value="{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}" {{ $month == $i ? "selected" : "" }}>{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group  chon-thang">
                <select class="form-control select2" id="year_change" name="year">
                  <option value="">--NĂM--</option>                  
                  <option value="2024" {{ $year == 2024 ? "selected" : "" }}>2024</option>
                  <option value="2025" {{ $year == 2025 ? "selected" : "" }}>2025</option>
                  <option value="2026" {{ $year == 2026 ? "selected" : "" }}>2026</option>
                  <option value="2027" {{ $year == 2027 ? "selected" : "" }}>2027</option>
                </select>
              </div>
            @endif
            @if($time_type == 2 || $time_type == 3)
            <div class="form-group chon-ngay">
              <input type="text" class="form-control datepicker" autocomplete="off" name="created_at_from" placeholder="@if($time_type == 2) Từ ngày @else Ngày @endif " value="{{ $arrSearch['created_at_from'] }}" style="width: 110px">
            </div>
            @if($time_type == 2)
            <div class="form-group chon-ngay den-ngay">
              <input type="text" class="form-control datepicker" autocomplete="off" name="created_at_to" placeholder="Đến ngày" value="{{ $arrSearch['created_at_to'] }}" style="width: 110px">
            </div>
             @endif
            @endif          
            <div class="form-group">              
              <select class="form-control select2" name="status" id="status">
                <option value="-1"
                @if(-1 == $arrSearch['status'])
                  selected 
                  @endif   
                >--Tất cả trạng thái--</option>
                 @foreach($list_status as $index => $status)
                  <option value="{{$index}}" 
                  @if($index == $arrSearch['status'])
                  selected 
                  @endif                    
                    >{{$status}}</option>
                  @endforeach
              </select>
            </div>
             
            <div class="form-group">              
              <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Email hoặc Tên khách hàng" value="{{ $arrSearch['name'] }}" style="width:250px">
            </div>                         
            <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $orders->total() }} đơn hàng )</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $orders->appends( $arrSearch )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">           
             <tr>
              <th style="width: 1%">No.</th>
              <th style="width: 1%;white-space:nowrap;width:200px"> Đơn hàng</th>
              <th style="text-align:center;width:150px">Ngày đặt hàng</th>
              <th style="text-align:right;width:200px">Giao hàng đến</th>           
              <th style="text-align:right;width:100px">Tổng hoá đơn</th>
              <th width="120px" style="white-space:nowrap">Trạng thái</th>
              <th style="white-space:nowrap; width: 1%"> </th>
            </tr>
            <tbody>

              @if($orders->count() > 0)
              <?php $i = 0; ?>
                @foreach($orders as $order)
                <?php $i++; ?>
                <tr>
                <td style="text-align:center">{{ $i }}</td>                
                <td>
                <a href="" style="font-size:14px; font-weight:bold">
                <?php 

                ?>
                #{{ str_pad($order->id, 6,'0', STR_PAD_LEFT) }}</a> 
                <span style="color:#555"> bởi {{$order->full_name}}</span>
                <br>
                <a href="mailto:">{{ $order->email }}</a>
                <br>
                {{ $order->phone }}
                </td>
                <td style="text-align:center;width:150px;white-space:nowrap">{{ date('d-m-Y H:i ', strtotime($order->created_at))}}</td>
                <td>

                <a href="http://maps.google.com/maps?&q={{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}" target="_blank"> 
                {{ $order->full_name }}, {{ $order->address }}, {{ $order->ward_id ? Helper::getName($order->ward_id, 'ward') : "" }}, {{ $order->district_id ? Helper::getName($order->district_id, 'district') : "" }}, {{ $order->city_id ? Helper::getName($order->city_id, 'city') : "" }}</a>
                </td>
                             
                <td style="text-align:right;width:100px">{{number_format($order->tong_tien)}}</td>
                <td>
                  <select class="select-change-status form-control" order-id="{{$order->id}}" customer-id="{{$order->customer_id}}" >
                    @foreach($list_status as $index => $status)
                    <option value="{{$index}}"
                      @if($index == $order->status)
                        selected
                      @endif
                      >{{$status}}</option>
                    @endforeach
                  </select>
                </td>
                <td style="text-align:right">
                  @if($order->customer_id > 0)
                  <button class="btn btn-danger btn-sm sendNoti" data-type="2" data-customer-id="{{ $order->customer_id }}" data-order-id="{{ $order->id }}" >Gửi tin nhắn 
                  <?php 
                  $countMess = App\Models\CustomerNotification::countMessOrderCustomer($order->customer_id, $order->id);

                  ?>
                  @if($countMess > 0)
                  <span class="badge">{{ $countMess }}</span>
                  @endif
                  </button>  
                   @endif  
                  <a href="{{route('order.detail', $order->id)}}?status={{ $arrSearch['status'] }}&name={{ $arrSearch['name'] }}&date_from={{ $arrSearch['date_from'] }}&date_to={{ $arrSearch['date_to'] }}" class="btn btn-info btn-sm">Chi tiết</a>
                                 
               
                </td>
                </tr>
                @endforeach
              @else
              <tr>
                <td colspan="5">Không có dữ liệu.</td>
              </tr>
              @endif
          </tbody>
          </table>
          <div style="text-align:center">
           {{ $orders->appends( $arrSearch )->links() }}
          </div> 
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
</section>
<!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">

$(document).ready(function(){
  $('#searchForm select').change(function(){
    $('#searchForm').submit();

  });
  $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
  $('.select-change-status').change(function(){
    var status_id = $(this).val();
    var order_id  = $(this).attr('order-id');
    var customer_id = $(this).attr('customer-id');
    update_status_orders(status_id, order_id, customer_id);
  });

  function update_status_orders(status_id, order_id, customer_id) {
    $.ajax({
      url: '{{route('orders.update')}}',
      type: "POST",
      data: {
        status_id : status_id,
        order_id : order_id,
        customer_id : customer_id
      },
      success: function (response) {
        location.reload()
      },
      error: function(response){

      }
    });
  }

});

</script>
@stop