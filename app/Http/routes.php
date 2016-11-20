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

Route::get('/', function () {
//    return view('welcome');
    echo 'blog';
});

//登录路由(get 和post方法)
Route::any('admin/login','Admin\LoginController@login');
//验证码路由
Route::get('admin/code','Admin\LoginController@code');

Route::get('admin/getCode','Admin\LoginController@getCode');

//设置session
Route::get('/setSession','TestController@setSession');
//获得session
Route::get('/getSession','TestController@getSession');
//获取crypt加密
Route::get('admin/crypt','Admin\LoginController@crypt');


