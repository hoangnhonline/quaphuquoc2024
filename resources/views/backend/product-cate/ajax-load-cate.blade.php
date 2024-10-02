<option value="">--Chọn--</option>  
@if($items->count() > 0)
    @foreach($items as $cate)
    <option value="{{ $cate->id }}">
    	{{ $cate->name }}
    </option>
    @endforeach
@endif