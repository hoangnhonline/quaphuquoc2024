@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    So sánh giá
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'product.index' ) }}">Sản phẩm</a></li>
    <li class="active">So sánh giá</li>
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
          <form class="form-inline" id="searchForm" role="form" method="GET" action="{{ route('compare.index') }}">
            <div class="form-group">
              <label for="email">Danh mục chính</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">--Tất cả--</option>
                @foreach( $loaiSpArr as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['parent_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
              <div class="form-group">
              <label for="email">Danh mục cấp 1</label>

              <select class="form-control" name="cate_id" id="cate_id">
                <option value="">--Tất cả--</option>
                @foreach( $cateArr as $value )
                <option value="{{ $value->id }}" {{ $value->id == $arrSearch['cate_id'] ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">Tên</label>
              <input type="text" class="form-control" name="name" value="{{ $arrSearch['name'] }}">
            </div>            
            <button type="submit" style="margin-top:-5px" class="btn btn-primary btn-sm">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( {{ $items->total() }} sản phẩm )</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
           {{ $items->appends( $arrSearch )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>             
              <th style="text-align:left">Sản phẩm</th>
              <th style="white-space:nowrap; text-align:right">
                <img src="{{ URL::asset('uploads/images/icho.jpg')}}" width="100" />
              </th>                           
              <th style="white-space:nowrap; text-align:right">
                <img src="{{ URL::asset('uploads/images/tiki.jpg')}}" width="80" />
              </th>
              <th style="white-space:nowrap; text-align:right">
                <img src="{{ URL::asset('uploads/images/lazada.jpg')}}" width="80" />
              </th>
              <th style="white-space:nowrap; text-align:right">
                <img src="{{ URL::asset('uploads/images/adayroi.jpg')}}" width="80" />
              </th>
              <!--<th style="white-space:nowrap; text-align:right">
                <img src="{{ URL::asset('uploads/images/sendo.jpg')}}" width="80" />
              </th>-->
              <th width="white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; 
              $str_id = '';
              ?>
              @foreach( $items as $product )
                <?php $i ++; 
                $str_id .= $product->id.",";
                $nameArr[$product->id] = $product->name;
                ?>
              <tr id="row-{{ $product->id }}">
                <td><span class="order">{{ $i }}</span></td>              
                <td>                  
                  <a style="color:#333;font-weight:bold" href="{{ route( 'product.edit', [ 'id' => $product->id ]) }}">{{ $product->name }}</a>                         
                </td>
                <td style="white-space:nowrap; text-align:right">
                      @if( $product->is_sale == 1)                              
                      <span id="icho-{{ $product->id }}">{{ number_format($product->price_sale) }}</span>
                      <span class="value" id="value-icho-{{ $product->id }}">{{ $product->price_sale }}</span>      
                      @else
                      <span id="icho-{{ $product->id }}">{{ number_format($product->price) }}</span>
                      <span class="value" id="value-icho-{{ $product->id }}">{{ $product->price }}</span>
                      @endif 
                </td>
                <td style="white-space:nowrap; text-align:right">
                  <span id="tiki-{{ $product->id }}"><i class="fa fa-spin fa-spinner"></i></span>
                  <span class="value" id="value-tiki-{{ $product->id }}"></span>
                </td>
                <td style="white-space:nowrap; text-align:right">
                  <span id="lazada-{{ $product->id }}"><i class="fa fa-spin fa-spinner"></i></span>
                  <span class="value" id="value-lazada-{{ $product->id }}"></span>
                </td>
                <td style="white-space:nowrap; text-align:right">
                  <span id="adayroi-{{ $product->id }}"><i class="fa fa-spin fa-spinner"></i></span>
                  <span class="value" id="value-adayroi-{{ $product->id }}"></span>
                </td>
                <!--<td style="white-space:nowrap; text-align:right">
                  <span id="sendo-{{ $product->id }}"><i class="fa fa-spin fa-spinner"></i></span>
                  <span class="value" id="value-sendo-{{ $product->id }}"></span>
                </td>-->
                <td>
                </td>
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          </table>
          <div style="text-align:center">
           {{ $items->appends( $arrSearch )->links() }}
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
<style type="text/css">
#searchForm div{
  margin-right: 7px;
}
span.value{
  display: none;
}
span.equal {
  color: blue;
}
span.bad{
  color:red;
}
span.ok{
  color:#4CAF50;
}
</style>
@stop
@section('javascript_page')
<script type="text/javascript">
$(document).ready(function(){
  <?php 
  if($str_id != ''){
    $idArr = explode(',', $str_id);    
  ?>
  @foreach($idArr as $id)
  @if($id > 0)
    search({{ $id }},'{{ $nameArr[$id]}}', 'tiki');
    search({{ $id }},'{{ $nameArr[$id]}}', 'lazada');
    search({{ $id }},'{{ $nameArr[$id]}}', 'adayroi');
  
  @endif
  @endforeach
  <?php } ?>
  $('#parent_id').change(function(){
    $('#cate_id').val('');
    $('#searchForm').submit();
  });
  $('#cate_id').change(function(){
    $('#searchForm').submit();
  });
});  
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
function search(id, name, site){
  $.ajax({
    url : '{{ route('crawler.search-price-other-site') }}',
    type : 'POST',
    data : {
      name : name,
      site : site,
      async: false,
      _token : '{{ csrf_token() }}'
    },
    success : function(data){      
      var valueIcho = parseInt($('#value-icho-'  + id).html());
      console.log(valueIcho);
      if(data > 0){

        $('#' + site + '-'  + id).html(formatNumber(data));
        $('#value-' + site + '-'  + id).html(data);

        if(parseInt(data) < valueIcho){
          $('#icho-'  + id).removeClass('ok').addClass('bad');
        }
        if(parseInt(data) == valueIcho && !$('#value-icho-'  + id).hasClass("bad")){
          $('#icho-'  + id).removeClass('ok').addClass('equal');
          $('#' + site + '-'  + id).addClass('equal');
        }
        if(parseInt(data) > valueIcho){
          $('#icho-'  + id).addClass('ok');
        }
      }else{
        $('#' + site + '-'  + id).html('<span style="color:red">X</span>');
      }
    }
  });
}
</script>
@stop