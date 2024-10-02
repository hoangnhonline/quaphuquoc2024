<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/test', function() {
    return view('frontend.email.thanks');
});
Route::post('/get-child', ['uses' => 'Frontend\HomeController@getChild', 'as' => 'get-child']);
Route::group(['prefix' => 'social-auth'], function () {
    Route::group(['prefix' => 'facebook'], function () {
        Route::get('redirect/', ['as' => 'fb-auth', 'uses' => 'SocialAuthController@redirect']);
        Route::get('callback/', ['as' => 'fb-callback', 'uses' => 'SocialAuthController@callback']);
        Route::post('fb-login', ['as' => 'ajax-login-by-fb', 'uses' => 'SocialAuthController@fbLogin']);
    });

    Route::group(['prefix' => 'google'], function () {
        Route::get('redirect/', ['as' => 'gg-auth', 'uses' => 'SocialAuthController@googleRedirect']);
        Route::get('callback/', ['as' => 'gg-callback', 'uses' => 'SocialAuthController@googleCallback']);
    });

});

Route::group(['prefix' => 'authentication'], function () {
    Route::post('check_login', ['as' => 'auth-login', 'uses' => 'AuthenticationController@checkLogin']);
    Route::post('check_login_order', ['as' => 'auth-login-order', 'uses' => 'AuthenticationController@checkLoginOrder']);
    Route::post('login_ajax', ['as' =>  'auth-login-ajax', 'uses' => 'AuthenticationController@checkLoginAjax']);
    Route::get('/user-logout', ['as' => 'user-logout', 'uses' => 'AuthenticationController@logout']);
});




Route::group(['namespace' => 'Frontend'], function()
{
    Route::get('dang-nhap', ['as' => 'dang-nhap', 'uses' => 'AccountController@loginForm']);
    Route::get('dang-ky', ['as' => 'dang-ky', 'uses' => 'AccountController@registerForm']);

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/load-slider', ['as' => 'load-slider', 'uses' => 'HomeController@loadSlider']);
    Route::get('/count-message', ['as' => 'count-message', 'uses' => 'HomeController@getNoti']);

    Route::post('/send-contact', ['as' => 'send-contact', 'uses' => 'ContactController@store']);    
    Route::get('san-pham/{slug}-{id}.html', ['as' => 'product.detail', 'uses' => 'ProductController@detail']);    

    // Route::get('/tin-tuc/{slug}-{id}.html', ['as' => 'news-detail', 'uses' => 'HomeController@newsDetail']);
   
    Route::get('gio-hang', ['as' => 'cart', 'uses' => 'CartController@index']);
    
    Route::group(['prefix' => 'cart'], function () {
        Route::post('add-product', ['as' => 'cart.add-product', 'uses' => 'CartController@addProduct']);
        Route::post('remove-product', ['as' => 'cart.remove-product', 'uses' => 'CartController@removeProduct']);
        Route::get('del-product', ['as' => 'cart.del-product', 'uses' => 'CartController@deleteAll']);
        Route::get('thanh-toan', ['as' => 'cart.checkout', 'uses' => 'CartController@checkout']);
        Route::post('hoan-tat', ['as' => 'cart.done', 'uses' => 'CartController@storeOrder']);
        Route::get('thanh-cong', ['as' => 'cart.thanh-cong', 'uses' => 'CartController@success']);
    });
    Route::group(['prefix' => 'tai-khoan'], function () {
        Route::get('don-hang-cua-toi', ['as' => 'order-history', 'uses' => 'OrderController@history']);
        Route::get('thong-bao-cua-toi', ['as' => 'notification', 'uses' => 'CustomerController@notification']);
        Route::get('thong-tin-tai-khoan', ['as' => 'account-info', 'uses' => 'CustomerController@accountInfo']);
        Route::get('doi-mat-khau', ['as' => 'change-password', 'uses' => 'CustomerController@changePassword']);
        Route::post('save-new-password', ['as' => 'save-new-password', 'uses' => 'CustomerController@saveNewPassword']);
        Route::get('/chi-tiet-don-hang/{order_id}', ['as' => 'order-detail', 'uses' => 'OrderController@detail']);
        Route::post('/huy-don-hang', ['as' => 'order-cancel', 'uses' => 'OrderController@huy']);
        Route::post('/forget-password', ['as' => 'forget-password', 'uses' => 'CustomerController@forgetPassword']);
        Route::get('/reset-password/{key}', ['as' => 'reset-password', 'uses' => 'CustomerController@resetPassword']);
        Route::post('save-reset-password', ['as' => 'save-reset-password', 'uses' => 'CustomerController@saveResetPassword']);
    });
    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('/', ['as' => 'all-product', 'uses' => 'ProductController@index']);
       
    });
    
    Route::post('/dang-ki-newsletter', ['as' => 'register.newsletter', 'uses' => 'HomeController@registerNews']);
    Route::get('/cap-nhat-thong-tin', ['as' => 'cap-nhat-thong-tin', 'uses' => 'CartController@updateUserInformation']);
    Route::group(['prefix' => 'thu-vien-g-family'], function () {
        Route::get('/', ['as' => 'news-list', 'uses' => 'NewsController@newsList']);
        Route::get('/{slugArticlesCateParent}/{slug}', ['as' => 'news-cate-list', 'uses' => 'NewsController@newscateList']);

        Route::get('/{slugArticlesCateParent}', ['as' => 'news-cate-parent', 'uses' => 'NewsController@newsCateParentList']);
        Route::get('/{slug}.html', ['as' => 'news-detail', 'uses' => 'NewsController@newsDetail']);
    });
   
    Route::post('/get-district', ['as' => 'get-district', 'uses' => 'DistrictController@getDistrict']);
    Route::post('/get-ward', ['as' => 'get-ward', 'uses' => 'WardController@getWard']);
    Route::group(['prefix' => 'tai-khoan'], function () {
        Route::post('/update', ['as' => 'update-customer', 'uses' => 'CustomerController@update']);
        Route::post('/register', ['as' => 'register-customer', 'uses' => 'CustomerController@register']);
        Route::post('/register-ajax', ['as' => 'register-customer-ajax', 'uses' => 'CustomerController@registerAjax']);
        Route::post('/checkemail', ['as' => 'checkemail-customer', 'uses' => 'CustomerController@isEmailExist']);
    });
        
    Route::get('/tim-kiem.html', ['as' => 'product.search', 'uses' => 'ProductController@search']);
    Route::get('lien-he.html', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::get('{slugProductCate}/{slug}/', ['as' => 'fe-cate', 'uses' => 'ProductController@cate']);
    Route::get('{slugProductCate}', ['as' => 'fe-parent-cate', 'uses' => 'ProductController@parentCate']);
    
    Route::get('{slugProductCate}/{slug}/{slugCateChild}/', ['as' => 'fe-cate-child', 'uses' => 'ProductController@cateChild']);
     Route::get('/gioi-thieu/{slug}.html', ['as' => 'about-articles', 'uses' => 'NewsController@newsDetail']);

});


