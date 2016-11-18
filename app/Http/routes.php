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

Route::get('/test', function () {
//    return view('welcome');
    echo 123;
});

Route::group(['middleware'=>['web']],function(){
    //登录路由
    Route::get('admin/login','Admin\LoginController@login');
    //验证码路由
    Route::get('admin/code','Admin\LoginController@code');
});
