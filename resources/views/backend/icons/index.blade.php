@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Quản lí icon
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'icons.index') }}">Banner</a></li>
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

      <a href="{{ route('icons.create') }}" class="btn btn-info" style="margin-bottom:5px;">Tạo mới</a>
    
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>     
              <th style="width:150px">Icon</th>             
              <th>Text</th>
              <th width="1%" style="white-space:nowrap">Thứ tự</th>
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
                  <img class="img-thumbnail banner" width="200" src="{{ $item->image_url ? Helper::showImage($item->image_url) : URL::asset('backend/dist/img/no-image.jpg') }}" />
                </td>                                                             
                
                <td>
                  {{ $item->content }}
                 
                </td>
                <td>{{ $item->display_order }}</td>
                <td style="white-space:nowrap; text-align:right">                 
                  <a href="{{ route( 'icons.edit', [ 'id' => $item->id]) }}" class="btn-sm btn btn-warning">Chỉnh sửa</a>                 
                
                  <a onclick="return callDelete('{{ $item->content }}','{{ route( 'icons.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger">Xóa</a>
                
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

</script>
@stop