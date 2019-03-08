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
    Route::get('/', function() { return view('welcome'); });

    //Mob 日志
    Route::get('/mob/common/love/tick', 'mob\common\LoveController@tick_get');
});
