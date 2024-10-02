@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Thương hiệu
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('thuong-hieu.index') }}">banner</a></li>
      <li class="active">Chỉnh sửa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm " href="{{ route('thuong-hieu.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('thuong-hieu.update') }}">
      <input type="hidden" name="id" value="{{ $detail->id }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif              
               <div class="form-group">
                  <label>Tên</label>
                  <input type="text" name="name" id="name" value="{{ old('name', $detail->name) }}" class="form-control">
                </div>
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">
                    <label class="col-md-3 row">Logo</label>
                    <div class="col-md-9">
                        <img id="thumbnail_image"
                             src="{{ $detail->image_url ? Helper::showImage($detail->image_url ) : asset('backend/dist/img/img.png') }}"
                             class="img-thumbnail" width="145" height="85">

                        <button class="btn btn-default btn-sm btnSingleUpload" data-set="image_url"
                                data-image="thumbnail_image" type="button"><span
                                class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                        </button>
                        <input type="hidden" name="image_url" id="image_url" value="{{ $detail->image_url }}"/>  
                    </div>
                    <div style="clear:both"></div>
                </div>
               
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('thuong-hieu.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
     
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
@stop