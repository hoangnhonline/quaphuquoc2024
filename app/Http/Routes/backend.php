<?php
// Authentication routes...
Route::get('backend/login', ['as' => 'backend.login-form', 'uses' => 'Backend\UserController@loginForm']);
Route::post('backend/login', ['as' => 'backend.check-login', 'uses' => 'Backend\UserController@checkLogin']);
Route::get('backend/logout', ['as' => 'backend.logout', 'uses' => 'Backend\UserController@logout']);
Route::group(['namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => 'isAdmin'], function()
{    
    Route::group(['prefix' => 'compare'], function () {
        Route::get('/', ['as' => 'compare.index', 'uses' => 'CompareController@index']);
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
        Route::post('/update', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);
    });
    Route::group(['prefix' => 'report'], function () {
        Route::get('/', ['as' => 'report.index', 'uses' => 'ReportController@index']);     
        Route::post('/search-price-other-site', ['as' => 'crawler.search-price-other-site', 'uses' => 'CompareController@search']);
    });
    
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', ['as' => 'pages.index', 'uses' => 'PagesController@index']);
        Route::get('/create', ['as' => 'pages.create', 'uses' => 'PagesController@create']);
        Route::post('/store', ['as' => 'pages.store', 'uses' => 'PagesController@store']);
        Route::get('{id}/edit',   ['as' => 'pages.edit', 'uses' => 'PagesController@edit']);
        Route::post('/update', ['as' => 'pages.update', 'uses' => 'PagesController@update']);
        Route::get('{id}/destroy', ['as' => 'pages.destroy', 'uses' => 'PagesController@destroy']);
    });
    Route::group(['prefix' => 'color'], function () {
        Route::get('/', ['as' => 'color.index', 'uses' => 'ColorController@index']);
        Route::get('/create', ['as' => 'color.create', 'uses' => 'ColorController@create']);
        Route::post('/store', ['as' => 'color.store', 'uses' => 'ColorController@store']);
        Route::get('{id}/edit',   ['as' => 'color.edit', 'uses' => 'ColorController@edit']);
        Route::post('/update', ['as' => 'color.update', 'uses' => 'ColorController@update']);
        Route::get('{id}/destroy', ['as' => 'color.destroy', 'uses' => 'ColorController@destroy']);
    });
    Route::group(['prefix' => 'customernoti'], function () {
        Route::get('/', ['as' => 'customernoti.index', 'uses' => 'CustomerNotificationController@index']);
        Route::get('/create', ['as' => 'customernoti.create', 'uses' => 'CustomerNotificationController@create']);
        Route::post('/store', ['as' => 'customernoti.store', 'uses' => 'CustomerNotificationController@store']);
        Route::get('{id}/edit',   ['as' => 'customernoti.edit', 'uses' => 'CustomerNotificationController@edit']);
        Route::post('/update', ['as' => 'customernoti.update', 'uses' => 'CustomerNotificationController@update']);
        Route::get('{id}/destroy', ['as' => 'customernoti.destroy', 'uses' => 'CustomerNotificationController@destroy']);
    });
    Route::group(['prefix' => 'info-seo'], function () {
        Route::get('/', ['as' => 'info-seo.index', 'uses' => 'InfoSeoController@index']);
        Route::get('/create', ['as' => 'info-seo.create', 'uses' => 'InfoSeoController@create']);
        Route::post('/store', ['as' => 'info-seo.store', 'uses' => 'InfoSeoController@store']);
        Route::get('{id}/edit',   ['as' => 'info-seo.edit', 'uses' => 'InfoSeoController@edit']);
        Route::post('/update', ['as' => 'info-seo.update', 'uses' => 'InfoSeoController@update']);
        Route::get('{id}/destroy', ['as' => 'info-seo.destroy', 'uses' => 'InfoSeoController@destroy']);
    });
    Route::group(['prefix' => 'newsletter'], function () {
        Route::get('/', ['as' => 'newsletter.index', 'uses' => 'NewsletterController@index']);
        Route::post('/store', ['as' => 'newsletter.store', 'uses' => 'NewsletterController@store']);
        Route::get('{id}/edit',   ['as' => 'newsletter.edit', 'uses' => 'NewsletterController@edit']);
        Route::get('/export',   ['as' => 'newsletter.export', 'uses' => 'NewsletterController@download']);
        Route::post('/update', ['as' => 'newsletter.update', 'uses' => 'NewsletterController@update']);
        Route::get('{id}/destroy', ['as' => 'newsletter.destroy', 'uses' => 'NewsletterController@destroy']);
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', ['as' => 'customer.index', 'uses' => 'CustomerController@index']);
        Route::post('/store', ['as' => 'customer.store', 'uses' => 'CustomerController@store']);
        Route::get('{id}/edit',   ['as' => 'customer.edit', 'uses' => 'CustomerController@edit']);
        Route::get('/export',   ['as' => 'customer.export', 'uses' => 'CustomerController@download']);
        Route::post('/update', ['as' => 'customer.update', 'uses' => 'CustomerController@update']);
        Route::get('{id}/destroy', ['as' => 'customer.destroy', 'uses' => 'CustomerController@destroy']);
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/', ['as' => 'contact.index', 'uses' => 'ContactController@index']);
        Route::post('/store', ['as' => 'contact.store', 'uses' => 'ContactController@store']);
        Route::get('{id}/edit',   ['as' => 'contact.edit', 'uses' => 'ContactController@edit']);
        Route::get('/export',   ['as' => 'contact.export', 'uses' => 'ContactController@download']);
        Route::post('/update', ['as' => 'contact.update', 'uses' => 'ContactController@update']);
        Route::get('{id}/destroy', ['as' => 'contact.destroy', 'uses' => 'ContactController@destroy']);
    });
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', ['as' => 'events.index', 'uses' => 'EventsController@index']);
        Route::get('/create', ['as' => 'events.create', 'uses' => 'EventsController@create']);
        Route::post('/store', ['as' => 'events.store', 'uses' => 'EventsController@store']);
        Route::get('{id}/edit',   ['as' => 'events.edit', 'uses' => 'EventsController@edit']);
        Route::post('/update', ['as' => 'events.update', 'uses' => 'EventsController@update']);
        Route::get('{id}/destroy', ['as' => 'events.destroy', 'uses' => 'EventsController@destroy']);
        Route::get('destroy-product/{event_id}/{product_id}', ['as' => 'events.destroy-product', 'uses' => 'EventsController@destroyProduct']);
        Route::get('/product-event/{event_id}', ['as' => 'events.product-event', 'uses' => 'EventsController@productEvent']);
        Route::post('/ajax-search', ['as' => 'events.ajax-search', 'uses' => 'EventsController@ajaxSearch']);
        Route::post('/ajax-save-product', ['as' => 'events.ajax-save-product', 'uses' => 'EventsController@ajaxSaveProduct']);
    });
    
    Route::group(['prefix' => 'product-cate'], function () {
        Route::get('/', ['as' => 'product-cate.index', 'uses' => 'ProductCateController@index']);
        Route::get('/create', ['as' => 'product-cate.create', 'uses' => 'ProductCateController@create']);
        Route::get('/thuoc-tinh', ['as' => 'product-cate.thuoc-tinh', 'uses' => 'ProductCateController@thuocTinh']);
        Route::get('/ajax-load-cate', ['as' => 'product-cate.ajax-load-cate', 'uses' => 'ProductCateController@ajaxLoadCate']);
        Route::get('/edit-thuoc-tinh', ['as' => 'product-cate.edit-thuoc-tinh', 'uses' => 'ProductCateController@editThuocTinh']);
        Route::get('/list-thuoc-tinh', ['as' => 'product-cate.list-thuoc-tinh', 'uses' => 'ProductCateController@listThuocTinh']);
        Route::post('/store-thuoc-tinh', ['as' => 'product-cate.store-thuoc-tinh', 'uses' => 'ProductCateController@storeThuocTinh']);
        Route::post('/update-thuoc-tinh', ['as' => 'product-cate.update-thuoc-tinh', 'uses' => 'ProductCateController@updateThuocTinh']);
        Route::post('/store', ['as' => 'product-cate.store', 'uses' => 'ProductCateController@store']);
        Route::get('{id}/edit',   ['as' => 'product-cate.edit', 'uses' => 'ProductCateController@edit']);
        Route::post('/update', ['as' => 'product-cate.update', 'uses' => 'ProductCateController@update']);
        Route::get('{id}/destroy', ['as' => 'product-cate.destroy', 'uses' => 'ProductCateController@destroy']);
        Route::get('{id}/destroy-thuoc-tinh', ['as' => 'product-cate.destroyThuocTinh', 'uses' => 'ProductCateController@destroyThuocTinh']);
    });
    Route::group(['prefix' => 'convert'], function () {
        Route::get('/', ['as' => 'convert.index', 'uses' => 'ConvertController@index']);
    });
    Route::group(['prefix' => 'loai-thuoc-tinh'], function () {
        Route::get('/', ['as' => 'loai-thuoc-tinh.index', 'uses' => 'LoaiThuocTinhController@index']);
        Route::get('/create', ['as' => 'loai-thuoc-tinh.create', 'uses' => 'LoaiThuocTinhController@create']);
        Route::post('/store', ['as' => 'loai-thuoc-tinh.store', 'uses' => 'LoaiThuocTinhController@store']);

        Route::get('{id}/edit',   ['as' => 'loai-thuoc-tinh.edit', 'uses' => 'LoaiThuocTinhController@edit']);
        Route::post('/update', ['as' => 'loai-thuoc-tinh.update', 'uses' => 'LoaiThuocTinhController@update']);
        Route::get('{id}/destroy', ['as' => 'loai-thuoc-tinh.destroy', 'uses' => 'LoaiThuocTinhController@destroy']);
        Route::get('/ajax-get-loai-thuoc-tinh-by-id', ['as' => 'loai-thuoc-tinh.ajax-get-loai-thuoc-tinh-by-id', 'uses' => 'LoaiThuocTinhController@getLoaiThuocTinhByLoaiId']);
    });
    Route::group(['prefix' => 'thuoc-tinh'], function () {
        Route::get('/', ['as' => 'thuoc-tinh.index', 'uses' => 'ThuocTinhController@index']);
        Route::get('/create', ['as' => 'thuoc-tinh.create', 'uses' => 'ThuocTinhController@create']);
        Route::post('/store', ['as' => 'thuoc-tinh.store', 'uses' => 'ThuocTinhController@store']);
        Route::get('{id}/edit',   ['as' => 'thuoc-tinh.edit', 'uses' => 'ThuocTinhController@edit']);
        Route::post('/update', ['as' => 'thuoc-tinh.update', 'uses' => 'ThuocTinhController@update']);
        Route::get('{id}/destroy', ['as' => 'thuoc-tinh.destroy', 'uses' => 'ThuocTinhController@destroy']);
    });
    Route::group(['prefix' => 'cate'], function () {
        Route::get('/', ['as' => 'cate.index', 'uses' => 'CateController@index']);
        Route::get('/create}', ['as' => 'cate.create', 'uses' => 'CateController@create']);
        Route::post('/store', ['as' => 'cate.store', 'uses' => 'CateController@store']);
        Route::get('{id}/edit',   ['as' => 'cate.edit', 'uses' => 'CateController@edit']);
        Route::post('/update', ['as' => 'cate.update', 'uses' => 'CateController@update']);
        Route::get('{id}/destroy', ['as' => 'cate.destroy', 'uses' => 'CateController@destroy']);
        Route::get('/ajax-load-cate', ['as' => 'cate.ajax-load-cate', 'uses' => 'CateController@ajaxLoadCate']);
    });
    Route::group(['prefix' => 'cate-child'], function () {
        Route::get('/', ['as' => 'cate-child.index', 'uses' => 'CateChildController@index']);
        Route::get('/create', ['as' => 'cate-child.create', 'uses' => 'CateChildController@create']);
        Route::post('/store', ['as' => 'cate-child.store', 'uses' => 'CateChildController@store']);
        Route::get('{id}/edit',   ['as' => 'cate-child.edit', 'uses' => 'CateChildController@edit']);
        Route::post('/update', ['as' => 'cate-child.update', 'uses' => 'CateChildController@update']);
        Route::get('{id}/destroy', ['as' => 'cate-child.destroy', 'uses' => 'CateChildController@destroy']);
    });
    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', ['as' => 'banner.index', 'uses' => 'BannerController@index']);
        Route::get('/create/', ['as' => 'banner.create', 'uses' => 'BannerController@create']);
        Route::get('/list', ['as' => 'banner.list', 'uses' => 'BannerController@lists']);
        Route::post('/store', ['as' => 'banner.store', 'uses' => 'BannerController@store']);
        Route::get('/edit',   ['as' => 'banner.edit', 'uses' => 'BannerController@edit']);
        Route::post('/update', ['as' => 'banner.update', 'uses' => 'BannerController@update']);
        Route::get('{id}/destroy', ['as' => 'banner.destroy', 'uses' => 'BannerController@destroy']);
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', ['as' => 'product.index', 'uses' => 'ProductController@index']);
        Route::get('/short', ['as' => 'product.short', 'uses' => 'ProductController@short']);
        Route::get('/ajax-get-detail-product', ['as' => 'ajax-get-detail-product', 'uses' => 'ProductController@ajaxDetail']);        
        Route::get('/create/', ['as' => 'product.create', 'uses' => 'ProductController@create']);
        Route::get('/tuong-thich', ['as' => 'product.tuong-thich', 'uses' => 'ProductController@spTuongThich']);
        Route::post('/store', ['as' => 'product.store', 'uses' => 'ProductController@store']);
        Route::post('/ajax-save-info', ['as' => 'product.ajax-save-info', 'uses' => 'ProductController@ajaxSaveInfo']);
        Route::get('{id}/edit',   ['as' => 'product.edit', 'uses' => 'ProductController@edit']);
        Route::post('/update', ['as' => 'product.update', 'uses' => 'ProductController@update']);
        Route::post('/ajax-search', ['as' => 'product.ajax-search', 'uses' => 'ProductController@ajaxSearch']);
        Route::post('/ajax-search-tuong-thich', ['as' => 'product.ajax-search-tuong-thich', 'uses' => 'ProductController@ajaxSearchTuongThich']);
        Route::get('{id}/destroy', ['as' => 'product.destroy', 'uses' => 'ProductController@destroy']);
        Route::post('/ajax-save-related', ['as' => 'product.ajax-save-related', 'uses' => 'ProductController@ajaxSaveRelated']);
        Route::post('/ajax-save-tuong-thich', ['as' => 'product.ajax-save-tuong-thich', 'uses' => 'ProductController@ajaxSaveTuongThich']);        
        Route::post('/save-sp-tuong-thich', ['as' => 'product.save-sp-tuong-thich', 'uses' => 'ProductController@saveSpTuongThich']);        

    });
    Route::post('/tmp-upload', ['as' => 'image.tmp-upload', 'uses' => 'UploadController@tmpUpload']);
    Route::post('/tmp-upload-multiple', ['as' => 'image.tmp-upload-multiple', 'uses' => 'UploadController@tmpUploadMultiple']);
    Route::post('/update-order', ['as' => 'update-order', 'uses' => 'GeneralController@updateOrder']);
    Route::post('/ck-upload', ['as' => 'ck-upload', 'uses' => 'UploadController@ckUpload']);
    Route::post('/get-slug', ['as' => 'get-slug', 'uses' => 'GeneralController@getSlug']);

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', ['as' => 'orders.index', 'uses' => 'OrderController@index']);
        Route::post('/update', ['as' => 'orders.update', 'uses' => 'OrderController@update']);
        Route::get('/{order_id}/chi-tiet', ['as' => 'order.detail', 'uses' => 'OrderController@orderDetail']);
        Route::post('/delete-order-detail', ['as' => 'order.detail.delete', 'uses' => 'OrderController@orderDetailDelete']);
    });

     Route::group(['prefix' => 'articles-cate'], function () {
        Route::get('/', ['as' => 'articles-cate.index', 'uses' => 'ArticlesCateController@index']);
        Route::get('/create', ['as' => 'articles-cate.create', 'uses' => 'ArticlesCateController@create']);
        Route::post('/store', ['as' => 'articles-cate.store', 'uses' => 'ArticlesCateController@store']);
        Route::get('{id}/edit',   ['as' => 'articles-cate.edit', 'uses' => 'ArticlesCateController@edit']);
        Route::post('/update', ['as' => 'articles-cate.update', 'uses' => 'ArticlesCateController@update']);
        Route::get('{id}/destroy', ['as' => 'articles-cate.destroy', 'uses' => 'ArticlesCateController@destroy']);
        Route::get('/ajax-load-cate', ['as' => 'articles-cate.ajax-load-cate', 'uses' => 'ArticlesCateController@ajaxLoadCate']);
    });
     Route::group(['prefix' => 'articles-cate-parent'], function () {
        Route::get('/', ['as' => 'articles-cate-parent.index', 'uses' => 'ArticlesCateParentController@index']);
        Route::get('/create', ['as' => 'articles-cate-parent.create', 'uses' => 'ArticlesCateParentController@create']);
        Route::post('/store', ['as' => 'articles-cate-parent.store', 'uses' => 'ArticlesCateParentController@store']);
        Route::get('{id}/edit',   ['as' => 'articles-cate-parent.edit', 'uses' => 'ArticlesCateParentController@edit']);
        Route::post('/update', ['as' => 'articles-cate-parent.update', 'uses' => 'ArticlesCateParentController@update']);
        Route::get('{id}/destroy', ['as' => 'articles-cate-parent.destroy', 'uses' => 'ArticlesCateParentController@destroy']);
    });
    Route::group(['prefix' => 'tag'], function () {
        Route::get('/', ['as' => 'tag.index', 'uses' => 'TagController@index']);
        Route::get('/create', ['as' => 'tag.create', 'uses' => 'TagController@create']);
        Route::post('/store', ['as' => 'tag.store', 'uses' => 'TagController@store']);
        Route::get('{id}/edit',   ['as' => 'tag.edit', 'uses' => 'TagController@edit']);
        Route::post('/update', ['as' => 'tag.update', 'uses' => 'TagController@update']);
        Route::get('{id}/destroy', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);
    });
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account.index', 'uses' => 'AccountController@index']);
        Route::get('/change-password', ['as' => 'account.change-pass', 'uses' => 'AccountController@changePass']);
        Route::post('/store-password', ['as' => 'account.store-pass', 'uses' => 'AccountController@storeNewPass']);
        Route::get('/update-status/{status}/{id}', ['as' => 'account.update-status', 'uses' => 'AccountController@updateStatus']);
        Route::get('/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
        Route::post('/store', ['as' => 'account.store', 'uses' => 'AccountController@store']);
        Route::get('{id}/edit',   ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
        Route::post('/update', ['as' => 'account.update', 'uses' => 'AccountController@update']);
        Route::get('{id}/destroy', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);
    });
    Route::group(['prefix' => 'articles'], function () {
        Route::get('/', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
        Route::get('/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);
        Route::post('/store', ['as' => 'articles.store', 'uses' => 'ArticlesController@store']);
        Route::get('{id}/edit',   ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
        Route::post('/update', ['as' => 'articles.update', 'uses' => 'ArticlesController@update']);
        Route::get('{id}/destroy', ['as' => 'articles.destroy', 'uses' => 'ArticlesController@destroy']);
    });
    Route::group(['prefix' => 'icons'], function () {
        Route::get('/', ['as' => 'icons.index', 'uses' => 'IconController@index']);
        Route::get('/create', ['as' => 'icons.create', 'uses' => 'IconController@create']);
        Route::post('/store', ['as' => 'icons.store', 'uses' => 'IconController@store']);
        Route::get('{id}/edit',   ['as' => 'icons.edit', 'uses' => 'IconController@edit']);
        Route::post('/update', ['as' => 'icons.update', 'uses' => 'IconController@update']);
        Route::get('{id}/destroy', ['as' => 'icons.destroy', 'uses' => 'IconController@destroy']);
    });
    Route::group(['prefix' => 'thuong-hieu'], function () {
        Route::get('/', ['as' => 'thuong-hieu.index', 'uses' => 'ThuongHieuController@index']);
        Route::get('/create', ['as' => 'thuong-hieu.create', 'uses' => 'ThuongHieuController@create']);
        Route::post('/store', ['as' => 'thuong-hieu.store', 'uses' => 'ThuongHieuController@store']);
        Route::get('{id}/edit',   ['as' => 'thuong-hieu.edit', 'uses' => 'ThuongHieuController@edit']);
        Route::post('/update', ['as' => 'thuong-hieu.update', 'uses' => 'ThuongHieuController@update']);
        Route::get('{id}/destroy', ['as' => 'thuong-hieu.destroy', 'uses' => 'ThuongHieuController@destroy']);
    });

});