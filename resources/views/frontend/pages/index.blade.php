@extends('frontend.layout') 
@include('frontend.partials.meta')
@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>{{ $detail->title }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active">{{ $detail->title }}</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- STAT SECTION FAQ --> 
<div class="section">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
                <h2 class="page-heading">
                    <span class="page-heading-title2">{{ $detail->title }}</span>
                </h2>
            	<div class="term_conditions">
                    <?php echo $detail->content; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION FAQ --> 
<style type="text/css">
#content-page h1{margin: 10px 0 20px;font-size: 32px;color: #4e5665;}
#content-page h2{margin: 10px 0;font-size: 24px;}
#content-page h3{margin: 10px 0 5px;font-size: 16px;color: #7F7F7F;}
#content-page h1,h2,h3{font-weight: bold;}
#content-page p{
    margin-bottom: 5px;
}
#content-page th {
    padding-top: 11px;
    padding-bottom: 11px;
    background-color: #4CAF50;
    color: white;
}
#content-page table{
    border-left: 1px solid #ddd;
    border-top: 1px solid #ddd;
}
#content-page table td, table th {
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    text-align: left;
    padding: 8px;
}
#content-page h1.title-page{
    text-align: left;
    font-size: 23px;
    text-transform: uppercase;
}
#content-page h3{
    padding: 10px 0 0;
}
#content-page .entry-content{
    font-size: 14px;
}

#content-page #help-navigation {
    float: left;
    padding-top: 10px;
    width: 247px;
}
#content-page .nolist {
    list-style: none;
    padding: 0;
    margin: 0;
}
#content-page #help-navigation ul li {
    border-bottom: 1px solid #f2f2f2;
    display: block;
    height: 38px;
    margin-bottom: 0;
}
#content-page #help-navigation ul li {
    border-bottom: 1px solid #f2f2f2;
    display: block;
    height: 38px;
    margin-bottom: 0;
}
#content-page #help-navigation ul li a {
    background-image: url(../img/help-left-menu-arrow.png);
    background-position: 236px center;
    background-repeat: no-repeat;
    color: #0a63c7;
    display: block;
    height: 38px;
    line-height: 38px;
    padding-left: 15px;
}
#content-page #help-navigation ul li a:hover, #content-page #help-navigation ul li.active a {
    background-color: #ebeef4;
}
#content-page #help-main {
    float: right;
    width: 712px;
}

/*---Reset css---*/
@media (min-width: 1200px) {
    #content-page #help-main {
        width: 889px;
    }
}
@media (max-width: 1200px) {

}
@media (max-width: 992px) {
    #content-page #help-navigation{
        display: none;
    }
    #content-page #help-main {
        float: none;
        width: 100%;
    }
}

</style>
@endsection
  