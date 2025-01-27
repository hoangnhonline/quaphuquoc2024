@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Bài viết
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'articles.index' ) }}">Bài viết</a></li>
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
      <a href="{{ route('articles.create') }}" class="btn btn-info" style="margin-bottom:5px">Tạo mới</a>
      <div class="panel panel-default">
     
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('articles.index') }}" id="formSearch">
          <div class="form-group">              
              <select class="form-control select2" name="parent_id" id="parent_id" style="width: 300px">
                <option value="">--Danh mục chính--</option>>
                @foreach( $cateParent as $value )
                <option value="{{ $value->id }}" {{ $value->id == $parent_id ? "selected" : "" }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>                 
            <div class="form-group">            
              <select class="form-control select2" name="cate_id" id="cate_id">
                <option value="">--Danh mục--</option>
                @if( $cateArr->count() > 0)
                  @foreach( $cateArr as $value )
                  <option value="{{ $value->id }}" {{ $value->id == $cate_id ? "selected" : "" }}>{{ $value->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>            
            <div class="form-group">
              <label for="title"></label>
              <input type="text" placeholder="Tiêu đề..." class="form-control" name="title" value="{{ $title }}">
            </div>
            <button type="submit" class="btn btn-info">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <span class="value">{{ $items->total() }} bài viết )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div style="text-align:center">
            {{ $items->appends( ['cate_id' => $cate_id, 'title' => $title] )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>              
              <th>Thumbnail</th>
              <th>Danh mục</th>
              <th>Tiêu đề</th>             
              <th width="1%" style="white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>       
                <td>
                  <img class="img-thumbnail lazy" data-original="{{ Helper::showImage($item->image_url)}}" width="145">
                </td>  
                <td>
                  @if($item->cateParent)
                  <a href="{{ route('articles.index', ['parent_id' => $item->parent_id]) }}">{{ $item->cateParent->name }}</a> /
                  @endif
                  @if($item->cate)
                   <a href="{{ route('articles.index', ['cate_id' => $item->cate_id]) }}">{{ $item->cate->name }}</a>
                  @endif
                </td>      
                <td>                  
                  <a href="{{ route( 'articles.edit', [ 'id' => $item->id ]) }}">{{ $item->title }}</a>
                  
                  @if( $item->is_hot == 1 )
                  <img class="img-thumbnail" src="{{ URL::asset('backend/dist/img/star.png')}}" alt="Nổi bật" title="Nổi bật" />
                  @endif

                  <p>{{ $item->description }}</p>
                </td>
                
                <td style="white-space:nowrap"> 
                  <a class="btn btn-default btn-sm" href="{{ route('news-detail', [$item->slug, $item->id ]) }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>                 
                  <a href="{{ route( 'articles.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning">Chỉnh sửa</a>                 
                  
                  <a onclick="return callDelete('{{ $item->title }}','{{ route( 'articles.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger">Xóa</a>
                  
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
            {{ $items->appends( ['cate_id' => $cate_id, 'title' => $title] )->links() }}
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
  $('#parent_id, #cate_id').change(function(){
    $('#formSearch').submit();
  });
  $('#parent_id').change(function(){
    $.ajax({
        url: $('#route_get_cate_by_parent').val(),
        type: "POST",
        async: false,
        data: {          
            parent_id : $(this).val(),
            type : 'list'
        },
        success: function(data){
            $('#cate_id').html(data).select2('refresh');                      
        }
    });
  });
  $('.select2').select2();

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