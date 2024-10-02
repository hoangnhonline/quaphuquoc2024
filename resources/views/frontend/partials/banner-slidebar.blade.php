<?php 
$bannerArr = DB::table('banner')->where(['object_id' => 2, 'object_type' => 3])->orderBy('display_order', 'asc')->get();
?>
@if($bannerArr)
<div class="block left-module">
  @foreach($bannerArr as $banner)
 <div class="banner-opacity" style="margin-bottom:10px">
  @if($banner->ads_url !='')
  <a href="{{ $banner->ads_url }}">
  @endif
  <img alt="banner" class="lazy" data-original="{{ Helper::showImage($banner->image_url) }}" title="banner">
  @if($banner->ads_url !='')
  </a>
  @endif
  </div>
  @endforeach                        
</div>
@endif