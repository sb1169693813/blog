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

//Route::get('/', function () {
////    return view('welcome');
//    echo 'blog';
//});


//验证码路由
Route::get('admin/code','Admin\LoginController@code');
Route::get('admin/server','Admin\IndexController@server');
Route::get('admin/getCode','Admin\LoginController@getCode');


//登录首页(get 和post方法)
Route::any('admin/login','Admin\LoginController@login');
//登录中间件
Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台首页
    Route::get('index','IndexController@index');
//后台首页主体info部分
    Route::get('info','IndexController@info');
    //登出
    Route::any('logout','LoginController@logout');
    Route::any('pass','IndexController@pass');

    //文章分类
    Route::resource('category','CategoryController');
    //分类order排序
    Route::post('category/cateOrder','CategoryController@cateOrder');
    //文章
    Route::resource('article','ArticleController');
    //友情链接
    Route::resource('link','LinkController');
    //自定义导航
    Route::resource('nav','NavController');
    //网站配置
    Route::resource('conf','ConfController');

    Route::any('upload','CommonController@upload');
    //友情order排序
    Route::post('link/changeOrder','LinkController@changeOrder');
    //自定义导航order排序
    Route::post('nav/changeOrder','NavController@changeOrder');
    //网站配置order排序
    Route::post('conf/changeOrder','ConfController@changeOrder');

    //网站配置修改
    Route::post('conf/changeContent','ConfController@changeContent');
    //测试文件写入
    Route::get('config/putfile','ConfController@putFile');
});

//前台路由
Route::group(['namespace'=>'Home'],function(){
    //前台首页
    Route::get('/','IndexController@index');
    //前台文章列表页
    Route::get('lists/{cate_id}','IndexController@lists');
    //前台文章详情页面
    Route::get('news/{art_id}','IndexController@news');
});

//设置session
Route::get('/setSession','TestController@setSession');
//获得session
Route::get('/getSession','TestController@getSession');
//获取crypt加密
Route::get('admin/crypt','Admin\LoginController@crypt');

Route::get('token',function(){
    dd(session('_token'));
});


