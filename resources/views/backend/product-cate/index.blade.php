@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Danh mục chính 
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'product-cate.index' ) }}">Danh mục chính</a></li>
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
      <a href="{{ route('product-cate.create') }}" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 1%;white-space:nowrap">Thứ tự</th>
              <th>Tên</th>
              <th style="text-align:center">Danh mục cấp 1</th>  
              <th style="text-align:center">Danh mục cấp 2</th>         
              <th width="1%" style="white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>
                <td style="vertical-align:middle;text-align:center">
                  <img src="{{ URL::asset('backend/dist/img/move.png')}}" class="move img-thumbnail" alt="Cập nhật thứ tự"/>
                </td>
                <td>                  
                  <a href="{{ route( 'product-cate.edit', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                  
                  @if( $item->is_hot == 1 )
                  <span class="label label-danger">Nổi bật</span>
                  @endif
               
                  <p>{{ $item->description }}</p>
                </td>
                <td style="text-align:center"><a style="font-size: 17px; font-weight: bold;" href="{{ route('cate.index', [$item->id])}}">{{ $item->cates->count() }}</a></td>               
                <td style="text-align:center"><a style="font-size: 17px; font-weight: bold;" href="{{ route('cate-child.index', ['parent_id' => $item->id])}}">{{ $item->cateChild->count() }}</a></td>  
                <td style="white-space:nowrap; text-align:right">
                <a class="btn btn-default btn-sm" href="{{ route('fe-parent-cate', $item->slug ) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                 
                  <a href="{{ route( 'product-cate.edit', [ 'id' => $item->id ]) }}" class="btn-sm btn btn-warning">Chỉnh sửa</a>                 
                  @if( $item->cates->count() == 0)
                  <a onclick="return callDelete('{{ $item->name }}','{{ route( 'product-cate.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
                  @endif
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
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("loai_sp", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
@stop