@if( !empty( $rsUpload ))
<?php $i = 0; ?>
<div class="row">
	@foreach( $rsUpload as $tmp)
    <?php $i++; ?>

	<div class="col-md-3" style="height: 200px">
		<img class="img-thumbnail" src="{{ Helper::showImage($tmp['image_path']) }}" style="width:100%">
		<div class="checkbox">
			<input type="hidden" name="image_tmp_url[]" value="{{ $tmp['image_path'] }}">
			<input type="hidden" name="image_tmp_name[]" value="{{ $tmp['image_name'] }}">
		    <label>
		    	<input type="radio" name="thumbnail_id" class="thumb" value="{{ $tmp['image_path'] }}"> Ảnh đại diện </label>
		    <button class="btn btn-danger btn-sm remove-image" type="button" data-value="{{ $tmp['image_path'] }}" data-id="" >Xóa</button>
	  	</div>
	</div>
	@if($i%4 == 0)
    </div><!--row--><div class="row">
    @endif
	@endforeach
@endif