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
      <li><a href="{{ route('articles.index') }}">Bài viết</a></li>
      <li class="active">Chỉnh sửa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default" href="{{ route('articles.index') }}" style="margin-bottom:5px">Quay lại</a>
    <a class="btn btn-primary btn-sm" href="{{ route('news-detail', [$detail->slug, $detail->id ]) }}" target="_blank" style="margin-top:-6px"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
    <form role="form" method="POST" action="{{ route('articles.update') }}">
    <div class="row">
      <!-- left column -->
      <input name="id" value="{{ $detail->id }}" type="hidden">
      <div class="col-md-7">
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
                <div class="row">
                <div class="form-group col-xs-6">
                    <label for="parent_id">Danh mục chính<span class="red-star">*</span></label>
                    <select class="form-control select2" name="parent_id" id="parent_id">
                      <option value="">-- chọn --</option>
                      
                        @foreach( $cateParent as $value )
                        <option value="{{ $value->id }}" {{ $value->id == old('parent_id', $detail->parent_id) ? "selected" : "" }}>{{ $value->name }}</option>
                        @endforeach
                      
                    </select>
                  </div>               
                  <div class="form-group col-xs-6">
                    <label for="cate_id">Danh mục <span class="red-star">*</span></label>
                    <select class="form-control select2" name="cate_id" id="cate_id">
                      <option value="">-- chọn --</option>
                      @if( $cateArr->count() > 0)
                        @foreach( $cateArr as $value )
                        <option value="{{ $value->id }}" {{ $value->id == old('cate_id', $detail->cate_id)  ? "selected" : "" }}>{{ $value->name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>                           
                </div>                          
                
                <div class="form-group" >
                  
                  <label>Tiêu đề <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ $detail->title }}">
                </div>
                <span class=""></span>
                <div class="form-group">                  
                  <label>Slug <span class="red-star">*</span></label>                  
                  <input type="text" class="form-control" name="slug" id="slug" value="{{ $detail->slug }}">
                </div>
                
                <div class="form-group" style="margin-top:10px;margin-bottom:10px">
                    <label class="col-md-3 row">Thumbnail ( 540 x 360px)</label>
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
                <div style="clear:both"></div>                
                <!-- textarea -->
                <div class="form-group">
                  <label>Mô tả</label>
                  <textarea class="form-control" rows="6" name="description" id="description">{{ $detail->description }}</textarea>
                </div> 
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="is_hot" value="1" {{ $detail->is_hot == 1 ? "checked" : "" }}>
                      Bài viết nổi bật
                    </label>
                  </div>               
                </div>
                <div class="form-group">
                  <label>Ẩn/hiện</label>
                  <select class="form-control" name="status" id="status">                  
                    <option value="0" {{ $detail->status == 0 ? "selected" : "" }}>Ẩn</option>
                    <option value="1" {{ $detail->status == 1 ? "selected" : "" }}>Hiện</option>                  
                  </select>
                </div>
                <div class="form-group">
                  <label>Tags</label>
                  <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">                  
                    @if( $tagArr->count() > 0)
                      @foreach( $tagArr as $value )
                      <option value="{{ $value->id }}" {{ in_array($value->id, $tagSelected) ? "selected" : "" }} >{{ $value->name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label>Chi tiết</label>
                  <textarea class="form-control" rows="4" name="content" id="content">{{ $detail->content }}</textarea>
                </div>
                  
            </div>                             
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('articles.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thông tin SEO</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Meta title </label>
                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $detail->meta_title }}">
              </div>
              <!-- textarea -->
              <div class="form-group">
                <label>Meta desciption</label>
                <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ $detail->meta_description }}</textarea>
              </div>  

              <div class="form-group">
                <label>Meta keywords</label>
                <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ $detail->meta_keywords }}</textarea>
              </div>  
              <div class="form-group">
                <label>Custom text</label>
                <textarea class="form-control" rows="4" name="custom_text" id="custom_text">{{ $detail->custom_text }}</textarea>
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
@section('javascript_page')
<script type="text/javascript">
    $(document).ready(function(){
      $(".select2").select2();
      var editor = CKEDITOR.replace( 'content',{
          language : 'vi',
          filebrowserBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=files') }}",
          filebrowserImageBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=images') }}",
          filebrowserFlashBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=flash') }}",
          filebrowserUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=files') }}",
          filebrowserImageUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=images') }}",
          filebrowserFlashUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=flash') }}",
          height : 500
      });
      $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      var files = "";
      $('#file-image').change(function(e){
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
      
      
      $('#title').change(function(){
         var name = $.trim( $(this).val() );
         if( name != '' && $('#slug').val() == ''){
            $.ajax({
              url: $('#route_get_slug').val(),
              type: "POST",
              async: false,      
              data: {
                str : name
              },              
              success: function (response) {
                if( response.str ){                  
                  $('#slug').val( response.str );
                }                
              },
              error: function(response){                             
                  var errors = response.responseJSON;
                  for (var key in errors) {
                    
                  }
                  //$('#btnLoading').hide();
                  //$('#btnSave').show();
              }
            });
         }
      });
      $('#parent_id').change(function(){
        $.ajax({
            url: "{{ route('articles-cate.ajax-load-cate')}}",
            type: "GET",
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
      $('#btnLoadMovies').click(function(){
        if( $('#url').val() != '' ){
          $('#spanLoad').removeClass('glyphicon glyphicon-download-alt').addClass('fa fa-spin fa-spinner');
          $.ajax({
              url: $('#route_get_movies_external').val(),
              type: "POST",
              async: true,
              data: {          
                  url : $('#url').val()                
              },              
              success: function(response){      
                  $('#title').val(response.title);
                  $('#slug').val(response.slug);
                  $('#thumbnail_image').attr('src', response.image_url);
                  $('#image_url').val(response.image_url);                
                  $('#spanLoad').removeClass('fa fa-spinner fa-spin').addClass('glyphicon glyphicon-download-alt');              
                                      
              }
          });
        }
      });
    });
    
</script>
@stop
