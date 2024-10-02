@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sản phẩm    
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('product.index') }}">Sản phẩm</a></li>
      <li class="active">Thêm mới</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('product.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('product.store') }}" id="dataForm">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Thêm mới</h3>
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
                <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin</a></li>
                   
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Hình ảnh</a></li>                    
                    <li role="presentation"><a href="#meta_seo" aria-controls="meta_seo" role="tab" data-toggle="tab">Meta SEO</a></li>   
                                       
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="form-group col-md-4 none-padding">
                          <label for="email">Danh mục chính<span class="red-star">*</span></label>
                          <select class="form-control select2" name="parent_id" id="parent_id">
                            <option value="">--Chọn--</option>
                            @foreach( $loaiSpArr as $value )
                            <option value="{{ $value->id }}" {{ $value->id == old('parent_id') || $value->id == $parent_id ? "selected" : "" }}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                          <div class="form-group col-md-4 none-padding pleft-5">
                          <label for="email">Danh mục cấp 1<span class="red-star">*</span></label>

                          <select class="form-control select2" name="cate_id" id="cate_id">
                            <option value="">--Chọn--</option>
                            @foreach( $cateArr as $value )
                            <option value="{{ $value->id }}" {{ $value->id == old('cate_id') || $value->id == $cate_id ? "selected" : "" }}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4 none-padding pleft-5">
                          <label for="email">Danh mục cấp 2</label>

                          <select class="form-control select2" name="cate_child_id" id="cate_child_id">
                            <option value="">--Chọn--</option>
                            @foreach( $cateChildArr as $value )
                            <option value="{{ $value->id }}" {{ $value->id == old('cate_child_id') ? "selected" : "" }}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>   
                        <div class="form-group" >                  
                          <label>Tên <span class="red-star">*</span></label>
                          <input type="text" autocomplete="off" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>                      
                
                        <div class="row">
                          <div class="form-group col-md-6" >                  
                              <label>Giá<span class="red-star">*</span></label>
                              <input type="text" autocomplete="off" class="form-control number" name="price" id="price" value="{{ old('price') }}">
                          </div>
                          <div class="col-md-6">
                            <label>Số lượng tồn</label>                  
                            <input type="text" autocomplete="off" class="form-control number" name="so_luong_ton" id="so_luong_ton" value="{{ old('so_luong_ton') }}">
                          </div>
                        </div>
                        <div class="col-md-6 none-padding">
                          <div class="checkbox">
                              <label><input type="checkbox" name="is_hot" value="1" {{ old('is_hot') == 1 ? "checked" : "" }}> <span class="cate-name" style="color: red">SẢN PHẨM HOT</span></label>
                          </div>                          
                        </div>
                        <div class="col-md-6 none-padding pleft-5">
                            <div class="checkbox">
                              <label><input type="checkbox" name="is_sale" value="1" {{ old('is_sale') == 1 ? "checked" : "" }}> <span class="cate-name" style="color: red">SẢN PHẨM SALES</span> </label>
                          </div>
                        </div>
                        <div class="form-group">                  
                          <label>Giá khuyến mãi</span></label>                  
                          <input type="text" autocomplete="off" class="form-control" name="price_sale" id="price_sale" value="{{ old('price_sale') }}">
                        </div>

                      <div class="clearfix"></div> 
                      <div class="form-group" style="display: none;">
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" name="is_primary" value="1"> Sản phẩm đại diện </label>
                        </div>                                                  
                          <input type="text" class="form-control" placeholder="Tên đại diện hiển thị" name="name_primary" id="name_primary" value="{{ old('name_primary') }}">
                      </div>
                   
                      <div class="form-group col-md-12" style="margin-top:10px; margin-bottom: 10px;">
                          @foreach($iconList as $icon)
                            <div class="col-xs-3">
                              <label><input type="checkbox" name="icon_id[]" value="{{ $icon->id }}" {{ in_array($icon->id, old('icon_id', [])) ? "checked" : "" }}>
                              {{ $icon->content }}</label>
                            </div>
                          @endforeach
                        </div>
                        <div class="row">
                          
                          <div class="form-group col-xs-6">
                        <label for="thuonghieu_id">Thương hiệu</label>

                          <select class="form-control select2" name="thuonghieu_id" id="thuonghieu_id">
                            <option value="">--Chọn--</option>
                            @foreach( $thuonghieuList as $value )
                            <option value="{{ $value->id }}" {{ $value->id == old('thuonghieu_id') ? "selected" : "" }}>{{ $value->name }}</option>
                            @endforeach
                          </select>
                      </div>
                       <div class="form-group col-xs-6">                  
                          <label>Xuất xứ</span></label>                  
                          <input type="text" autocomplete="off" class="form-control" name="xuat_xu" id="xuat_xu" value="{{ old('xuat_xu') }}">
                        </div>
                        </div>
                      
                        <div class="row">
                           <div class="form-group col-xs-6">                  
                            <label>Dung tích</span></label>                  
                            <input type="text" autocomplete="off" class="form-control" name="dung_tich" id="dung_tich" value="{{ old('dung_tich') }}">
                          </div>
                           <div class="form-group col-xs-6">                  
                            <label>Trọng lượng</span></label>                  
                            <input type="text" autocomplete="off" class="form-control" name="trong_luong" id="trong_luong" value="{{ old('trong_luong') }}">
                          </div>
                        </div>
                       <div class="clearfix"></div> 
                      <div class="row">
                          <div class="form-group col-md-6">
                            <label>Hướng dẫn sử dụng</label>
                            <textarea class="form-control" rows="6" name="huong_dan" id="huong_dan">{{ old('huong_dan') ? old('huong_dan') : "" }}</textarea>
                          </div>

                        <div class="form-group col-md-6">
                          <label>Hướng dẫn bảo quản</label>
                          <textarea class="form-control" rows="6" name="bao_quan" id="bao_quan">{{ old('bao_quan') ? old('bao_quan') : "" }}</textarea>
                        </div>
                      </div>                      
                       
                      <div class="form-group">
                        <label>Thành phần</label>
                        <textarea class="form-control" rows="10" name="thanh_phan" id="thanh_phan">{{ old('thanh_phan') ? old('thanh_phan') : "" }}</textarea>
                      </div>

                                              
                        <div class="clearfix"></div>
                    </div><!--end thong tin co ban-->                    
                  
                     <div role="tabpanel" class="tab-pane" id="settings">                       
                        <div class="form-group" style="margin-top:10px; margin-bottom:10px">

                              <div class="col-md-12">

                                  <button class="btn btn-success btnMultiUpload" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Chọn hình ảnh</button>
                                  <div class="clearfix"></div>
                                  <div id="div-image" style="margin-top:10px"></div>
                              </div>
                              <div style="clear:both"></div>
                          </div>
                     </div><!--end hinh anh-->
                     <div role="tabpanel" class="tab-pane" id="meta_seo">   
                       <div class="form-group">
                          <label>Meta title </label>
                          <input type="text" autocomplete="off" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Meta desciption</label>
                          <textarea class="form-control" rows="6" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                        </div>  

                        <div class="form-group">
                          <label>Meta keywords</label>
                          <textarea class="form-control" rows="4" name="meta_keywords" id="meta_keywords">{{ old('meta_keywords') }}</textarea>
                        </div>  
                        <div class="form-group">
                          <label>Custom text</label>
                          <textarea class="form-control" rows="6" name="custom_text" id="custom_text">{{ old('custom_text') }}</textarea>
                        </div>
                     </div>
                  </div>

                </div>
                  
            </div>
            <div class="box-footer">
              <input type="hidden" name="str_sp_sosanh" id="str_sp_sosanh" value="{{ old('str_sp_sosanh') }}" >
              <input type="hidden" name="str_sp_tuongtu" id="str_sp_tuongtu" value="{{ old('str_sp_tuongtu') }}" >
              <input type="hidden" name="str_sp_phukien" id="str_sp_phukien" value="{{ old('str_sp_phukien') }}" >
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('product.index')}}">Hủy</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      
 <input type="hidden" name="image_pro" id="image_pro" value="{{ old('image_pro') }}"/> 
 <input type="hidden" name="pro_name" id="pro_name" value="{{ old('pro_name') }}"/>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@include ('backend.product.search-modal')
<input type="hidden" id="route_upload_tmp_image_multiple" value="{{ route('image.tmp-upload-multiple') }}">
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<style type="text/css">
  .nav-tabs>li.active>a{
    color:#FFF !important;
    background-color: #3C8DBC !important;
  }

</style>
@stop
@section('javascript_page')
<script type="text/javascript">

$(document).on('click', '.remove-image', function(){
  if( confirm ("Bạn có chắc chắn không ?")){
    $(this).parents('.col-md-3').remove();
  }
});

    $(document).ready(function(){
      $('#btnUploadPro').click(function(){        
        $('#file-pro').click();
      });      
      var files = "";
      $('#file-pro').change(function(e){
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
                $('#thumbnail_image_pro').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_pro' ).val( response.image_path );
                $( '#pro_name' ).val( response.image_name );
              }
            },
            error: function(response){                             
                var errors = response.responseJSON;                           
            }
          });
        }
      });
       
      $('#parent_id').change(function(){
            $.ajax({
              url : "{{ route('product-cate.ajax-load-cate') }}",
              data: {
                parent_id : $(this).val()
              },
              type : "GET", 
              success : function(data){  
                if(data != ''){
                  $('#cate_id').html(data).select2();                    
                }
              }        
          });
    
      });
      $('#cate_id').change(function(){
            $.ajax({
              url : "{{ route('cate.ajax-load-cate') }}",
              data: {
                cate_id : $(this).val()
              },
              type : "GET", 
              success : function(data){  
                if(data != ''){
                  $('#cate_child_id').html(data).select2();                    
                }
              }        
          });
    
      });
      $(".select2").select2();
      $('#dataForm').submit(function(){   
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      var editor = CKEDITOR.replace( 'thanh_phan',{
          language : 'vi',
          height: 300,
          filebrowserBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=files') }}",
          filebrowserImageBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=images') }}",
          filebrowserFlashBrowseUrl: "{{ URL::asset('/backend/dist/js/kcfinder/browse.php?type=flash') }}",
          filebrowserUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=files') }}",
          filebrowserImageUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=images') }}",
          filebrowserFlashUploadUrl: "{{ URL::asset('/backend/dist/js/kcfinder/upload.php?type=flash') }}"
      });
      var editor2 = CKEDITOR.replace( 'bao_quan',{
          language : 'vi',
          height : 300,
          toolbarGroups : [
            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },           
            '/',
            
          ]
      });
      var editor3 = CKEDITOR.replace( 'huong_dan',{
          language : 'vi',
          height : 300,
          toolbarGroups : [
            
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
            { name: 'links', groups: [ 'links' ] },           
            '/',
            
          ]
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
             dataForm.append('file[]', value);
          });
          
          dataForm.append('date_dir', 0);
          dataForm.append('folder', 'tmp');
          //console.log(dataForm);return false;
          $.ajax({
            url: $('#route_upload_tmp_image_multiple').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#div-image').append(response);
                if( $('input.thumb:checked').length == 0){
                  $('input.thumb').eq(0).prop('checked', true);
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
     

      $('#name').change(function(){
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
     
     
      
    });
    
</script>
@stop
