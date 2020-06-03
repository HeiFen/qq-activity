<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 检查登录状态
Route::post('login-check', 'Api\LoginController@checkLogin')->name('check_login');
// 领取活动
Route::post('send-activity', 'Api\SendController@index')->name('sendActivity');
