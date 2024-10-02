@extends('backend.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sản phẩm tương thích : <span style="color:red">{{ $detail->name }}</span>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('product.index') }}">Sản phẩm</a></li>
      <li class="active">Sản phẩm tương thích</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ URL::previous() }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('product.save-sp-tuong-thich') }}" id="dataForm">
    <input type="hidden" name="id" value="{{ $detail->id }}" id="id">
    <input type="hidden" name="back_url" value="{{ URL::previous() }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Chọn sản phẩm tương thích</h3>
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
               
                @if($detail->cate_id == 31)
                <div class="col-md-4">
                    <button class="btn btn-warning btn-sm btnLienQuan" data-value="32" type="button" id="btnCpu">CPU</button>
                    <div class="clearfix"></div>
                    <div id="dataCpu" class="col-md-12 none-padding" style="min-height:150px; margin-top:5px">
                        @if(isset($spSelected[32]) && !empty($spSelected[32]))
                        <table class="table table-responsive table-bordered">                       
                        @foreach($spSelected[32] as $product_id)
                          <tr id="row-32-{{ $productArr[$product_id]->id }}">
                            <td width="80%">{{ $productArr[$product_id]->name }} 
                            <input type="hidden" name="sp_tuongthich_32[]" value="{{ $productArr[$product_id]->id }}">
                            </td>
                            <td>      
                            <button class="btn btn-sm btn-danger btnRemoveTuongThich" type="button" data-value="{{ $productArr[$product_id]->id }}" data-type="32">Xóa</button>
                            </td>
                          </tr>
                         
                        @endforeach                        
                        </table>
                        @endif

                    </div>
                </div>               
                <div class="col-md-4">
                    <button class="btn btn-warning btn-sm btnLienQuan" data-value="85" type="button" id="btnCpu">VGA</button>
                    <div class="clearfix"></div>
                    <div id="dataVga" class="col-md-12 none-padding" style="min-height:150px; margin-top:5px">
                        @if(isset($spSelected[85]) && !empty($spSelected[85]))
                        <table class="table table-responsive table-bordered">                       
                        @foreach($spSelected[85] as $product_id)
                          <tr id="row-85-{{ $productArr[$product_id]->id }}">
                            <td width="80%">{{ $productArr[$product_id]->name }} 
                            <input type="hidden" name="sp_tuongthich_85[]" value="{{ $productArr[$product_id]->id }}">
                            </td>
                            <td>      
                            <button class="btn btn-sm btn-danger btnRemoveTuongThich" type="button" data-value="{{ $productArr[$product_id]->id }}" data-type="85">Xóa</button>
                            </td>
                          </tr>
                         
                        @endforeach                        
                        </table>
                        @endif

                    </div>
                </div>                               
                <div class="col-md-4">
                    <button class="btn btn-warning btn-sm btnLienQuan" data-value="35" type="button" id="btnRam">RAM</button>
                    <div class="clearfix"></div>
                    <div id="dataRam" class="col-md-12 none-padding" style="min-height:150px; margin-top:5px">
                        @if(isset($spSelected[35]) && !empty($spSelected[35]))
                        <table class="table table-responsive table-bordered">                       
                        @foreach($spSelected[35] as $product_id)
                          <tr id="row-35-{{ $productArr[$product_id]->id }}">
                            <td width="80%">{{ $productArr[$product_id]->name }} 
                            <input type="hidden" name="sp_tuongthich_35[]" value="{{ $productArr[$product_id]->id }}">
                            </td>
                            <td>      
                            <button class="btn btn-sm btn-danger btnRemoveTuongThich" type="button" data-value="{{ $productArr[$product_id]->id }}" data-type="35">Xóa</button>
                            </td>
                          </tr>
                         
                        @endforeach                        
                        </table>
                        @endif

                    </div>
                </div>                
                @endif
                @if($detail->cate_id == 85)
                <div class="col-md-6">
                    <button class="btn btn-warning btn-sm btnLienQuan" data-value="33" type="button" id="btnNguon">Nguồn</button>
                    <div class="clearfix"></div>
                    <div id="dataNguon" class="col-md-12 none-padding" style="min-height:150px; margin-top:5px">
                        @if(isset($spSelected[33]) && !empty($spSelected[33]))
                        <table class="table table-responsive table-bordered">                       
                        @foreach($spSelected[33] as $product_id)
                          <tr id="row-33-{{ $productArr[$product_id]->id }}">
                            <td width="80%">{{ $productArr[$product_id]->name }} 
                            <input type="hidden" name="sp_tuongthich_33[]" value="{{ $productArr[$product_id]->id }}">
                            </td>
                            <td>      
                            <button class="btn btn-sm btn-danger btnRemoveTuongThich" type="button" data-value="{{ $productArr[$product_id]->id }}" data-type="33">Xóa</button>
                            </td>
                          </tr>
                         
                        @endforeach                        
                        </table>
                        @endif

                    </div>
                </div>                                                             
                <div class="col-md-6">
                    <button class="btn btn-warning btn-sm btnLienQuan" data-value="89" type="button" id="btnCase">Thùng máy - Case</button>
                    <div class="clearfix"></div>
                    <div id="dataCase" class="col-md-12 none-padding" style="min-height:150px; margin-top:5px">
                        @if(isset($spSelected[89]) && !empty($spSelected[89]))
                        <table class="table table-responsive table-bordered">                       
                        @foreach($spSelected[89] as $product_id)
                          <tr id="row-89-{{ $productArr[$product_id]->id }}">
                            <td width="80%">{{ $productArr[$product_id]->name }} 
                            <input type="hidden" name="sp_tuongthich_89[]" value="{{ $productArr[$product_id]->id }}">
                            </td>
                            <td>      
                            <button class="btn btn-sm btn-danger btnRemoveTuongThich" type="button" data-value="{{ $productArr[$product_id]->id }}" data-type="89">Xóa</button>
                            </td>
                          </tr>
                         
                        @endforeach                        
                        </table>
                        @endif

                    </div>
                </div>                
                @endif
            </div>
            <div class="box-footer">
              <input type="hidden" name="str_sp_bo_mach_chinh" id="str_sp_bo_mach_chinh" value="{{ $str_sp_bo_mach_chinh }}" >

              <input type="hidden" name="str_sp_card_man_hinh" id="str_sp_card_man_hinh" value="{{ $str_sp_card_man_hinh }}" >
              <input type="hidden" name="str_sp_bo_vi_xu_ly" id="str_sp_bo_vi_xu_ly" value="{{ $str_sp_bo_vi_xu_ly }}" >
              <input type="hidden" name="str_sp_bo_nho" id="str_sp_bo_nho" value="{{ $str_sp_bo_nho }}" >
              <input type="hidden" name="str_sp_nguon" id="str_sp_nguon" value="{{ $str_sp_nguon }}" >
              <input type="hidden" name="str_sp_case" id="str_sp_case" value="{{ $str_sp_case }}" >
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Lưu</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ URL::previous() }}">Hủy</a>
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
@include ('backend.product.tuong-thich.search-modal-tuong-thich')
<input type="hidden" id="route_upload_tmp_image_multiple" value="{{ route('image.tmp-upload-multiple') }}">
<style type="text/css">
  .nav-tabs>li.active>a{
    color:#FFF !important;
    background-color: #3C8DBC !important;
  }

</style>
@stop
@section('javascript_page')
<script type="text/javascript">
function filterAjax(cate_id){  
  $('#parent_id_search').val(7);
  $('#cate_id_search').val(cate_id);  
  var str_params = $('#formSearchAjaxTuongThich').serialize();
  $.ajax({
          url: '{{ route("product.ajax-search-tuong-thich") }}',
          type: "POST",
          async: true,      
          data: str_params + '&cate_id=' + cate_id,
          beforeSend:function(){
            $('#contentSearch').html('<div style="text-align:center"><img src="{{ URL::asset('backend/dist/img/loading.gif')}}"></div>');
          },        
          success: function (response) {
            $('#contentSearchTuongThich').html(response);
            $('#myModalSearch').modal('show');
            //$('.selectpicker').selectpicker();            
            //check lai nhung checkbox da checked
            if( cate_id == "31"){
              var str_checked = $('#str_sp_bo_mach_chinh').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }else if( cate_id == "32"){
              var str_checked = $('#str_sp_bo_vi_xu_ly').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }else if( cate_id == "35"){
              var str_checked = $('#str_sp_bo_nho').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }else if( cate_id == "33"){
              var str_checked = $('#str_sp_nguon').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }else if( cate_id == "89"){
              var str_checked = $('#str_sp_case').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }else{
              var str_checked = $('#str_sp_card_man_hinh').val();
              tmpArr = str_checked.split(",");              
              for (i = 0; i < tmpArr.length; i++) { 
                  $('input.checkSelect[value="'+ tmpArr[i] +'"]').prop('checked', true);
              }
            }
          }
    });
}

$(document).on('click', '.checkSelect', function(){
  var cate_id = $('#cate_id_search').val();
  console.log(cate_id);
  var obj = $(this);
  if( cate_id == "31"){
    var str_sp_bo_mach_chinh = $('#str_sp_bo_mach_chinh').val();
    if(obj.prop('checked') == true){
      str_sp_bo_mach_chinh += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_bo_mach_chinh = str_sp_bo_mach_chinh.replace(str, '');
    }
    $('#str_sp_bo_mach_chinh').val(str_sp_bo_mach_chinh);
  }else if( cate_id == "32"){
    var str_sp_bo_vi_xu_ly = $('#str_sp_bo_vi_xu_ly').val();
    if(obj.prop('checked') == true){
      str_sp_bo_vi_xu_ly += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_bo_vi_xu_ly = str_sp_bo_vi_xu_ly.replace(str, '');
    }
    $('#str_sp_bo_vi_xu_ly').val(str_sp_bo_vi_xu_ly);
  }else if( cate_id == "35"){
    var str_sp_bo_nho = $('#str_sp_bo_nho').val();
    if(obj.prop('checked') == true){
      str_sp_bo_nho += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_bo_nho = str_sp_bo_nho.replace(str, '');
    }
    $('#str_sp_bo_nho').val(str_sp_bo_nho);
  }else if( cate_id == "33"){
    var str_sp_nguon = $('#str_sp_nguon').val();
    if(obj.prop('checked') == true){
      str_sp_nguon += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_nguon = str_sp_nguon.replace(str, '');
    }
    $('#str_sp_nguon').val(str_sp_nguon);
  }else if( cate_id == "89"){
    var str_sp_case = $('#str_sp_case').val();
    if(obj.prop('checked') == true){
      str_sp_case += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_case = str_sp_case.replace(str, '');
    }
    $('#str_sp_case').val(str_sp_case);
  }else{ // so sanh
    var str_sp_card_man_hinh = $('#str_sp_card_man_hinh').val();
    if(obj.prop('checked') == true){
      str_sp_card_man_hinh += obj.val() + ',';
    }else{
      var str = obj.val() + ',';
      str_sp_card_man_hinh = str_sp_card_man_hinh.replace(str, '');
    }
    $('#str_sp_card_man_hinh').val(str_sp_card_man_hinh);
  }
});
$(document).on('click', '.btnRemoveTuongThich', function(){
  if( confirm ("Bạn có chắc chắn không ?")){
    var obj = $(this);
    var type = obj.attr('data-type');
    var value = obj.attr('data-value');
    if( type == "31"){
      var name = "bo_mach_chinh";
    }else if(type == "32"){
      var name = "bo_vi_xu_ly";
    }else if(type == "35"){
      var name = "bo_nho";
    }else if(type == "33"){
      var name = "nguon";
    }else if(type == "89"){
      var name = "case";
    }else{
      var name = "card_man_hinh";
    }
    var str_sp = $('#str_sp_' + name).val();
   
      var str = value + ',';
    
      str_sp = str_sp.replace(str, '');
    
    
    $('#str_sp_' + name).val(str_sp);
    $('#row-'+ type + '-' + value).remove(); 
  }
});

$(document).on('click', '#btnSearchAjax', function(){
  filterAjax($('#cate_id_search').val());
});
$(document).on('keypress', '#name_search', function(e){
  if(e.which == 13) {
      e.preventDefault();
      filterAjax($('#cate_id_search').val());
  }
});
$(document).on('click', 'button.btnSaveSearch',function(){
  var cate_id = $('#cate_id_search').val();  
  console.log(cate_id);
  if (cate_id == "31"){
    str_value = $('#str_sp_bo_mach_chinh').val();
  }else if( cate_id == "32"){
    str_value = $('#str_sp_bo_vi_xu_ly').val();
  }else if( cate_id == "35"){
    str_value = $('#str_sp_bo_nho').val();
  }else if( cate_id == "33"){
    str_value = $('#str_sp_nguon').val();
  }else if( cate_id == "89"){
    str_value = $('#str_sp_case').val();
  }else{
    str_value = $('#str_sp_card_man_hinh').val();
  }
  if( str_value != '' ){
    
    $.ajax({
          url: '{{ route("product.ajax-save-tuong-thich") }}',
          type: "POST",
          async: true,      
          data: {          
            cate_id : cate_id,    
            str_value : str_value,
            _token: "{{ csrf_token() }}"
          },     
          success: function (response) {
            if (cate_id == "31"){
              
              $('#dataMainboard').html(response);

            }else if( cate_id == "32"){

              $('#dataCpu').html(response);

            }else if( cate_id == "35"){

              $('#dataRam').html(response);

            }else if( cate_id == "33"){

              $('#dataNguon').html(response);

            }else if( cate_id == "89"){

              $('#dataCase').html(response);

            }else{

              $('#dataVga').html(response);

            }
            $('#myModalSearch').modal('hide');
            
          }
    });
    
  }else{
    alert('Vui lòng chọn ít nhất 1 sản phẩm.');
    return false;
  }

});
    $(document).ready(function(){
      $('.btnLienQuan').click(function(){
        var type = $(this).attr('data-value');
        if( type == "31") {
          $('#label-search').html("Mainboard tương thích");
        }else if( type == "32" ){
          $('#label-search').html("CPU tương thích");
        }else if( type == "33" ){
          $('#label-search').html("Nguồn tương thích");
        }else if( type == "89" ){
          $('#label-search').html("Thùng máy - case tương thích");
        }else if( type == "35" ){
          $('#label-search').html("RAM tương thích");
        }else{
          $('#label-search').html("VGA tương thích");
        }
        filterAjax(type);
      });      
      
      $(".select2").select2();
      $('#dataForm').submit(function(){        
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
      
     
      
    });
    
</script>
@stop
