<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => env('DEV_DOMAIN_PREFIX') . 'www.nebula-fund.com'], function () {


    Route::get('/common/tool/parsexlsx', 'web\common\ToolController@parsexlsx_get');
    Route::post('/common/tool/uploadxlsx_ajax', 'web\common\ToolController@uploadxlsx_ajax_post');

    Route::get('/common/tool/qrcode', 'web\common\ToolController@qrcode_get');


    Route::get('/user/account/login', 'web\user\AccountController@login_get');



    //需要登录才能访问的，没有登录自动跳转到登录页面
    Route::group(['middleware' => 'web.login'], function () {
        Route::get('/', 'web\trade\EarnController@ratelist_get');

        Route::get('/trade/earn/ratelist', 'web\trade\EarnController@ratelist_get');
    });

    Route::get('/trade/earn/ratelist_ajax', 'web\trade\EarnController@ratelist_ajax_get');
    Route::get('/trade/earn/totallist_ajax', 'web\trade\EarnController@totallist_ajax_get');

    Route::post('/user/account/login_ajax', 'web\user\AccountController@login_ajax_post');
    Route::post('/user/account/signout_ajax', 'web\user\AccountController@signout_ajax_post');



    //Mob 页面
    Route::get('/mob/common/love/tick', 'mob\common\LoveController@tick_get');
});
