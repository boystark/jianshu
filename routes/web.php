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
//前台用户模块
Route::group(['namespace'=>'IndexCtr'], function () {
    //注册
    Route::get('/register', 'RegisterCtr@index');
    Route::post('/register', 'RegisterCtr@register');
    //首页
    Route::get('/', 'LoginCtr@index');
    //通知
    Route::get('/notices', 'NoticeCtr@index');

    Route::get('/show/{post}', 'LoginCtr@show');

    Route::get('/login', 'LoginCtr@log');
    Route::post('/login', 'LoginCtr@login');
    //登出
    Route::get('/logout', 'LoginCtr@logout');

    //个人中心
    Route::get('/user/{user}', 'UserCtr@index');
    //关注
    Route::post('/user/{user}/fan', 'UserCtr@fan');
    //取消关注
    Route::post('/user/{user}/unfan', 'UserCtr@unfan');

    //个人设置页面
    Route::get('/user/{user}/setting', 'UserCtr@setting');
    Route::post('/user/{user}/setting', 'UserCtr@settingStore');

    //专题详情页
    Route::get('/topic/{topic}', 'TopicCtr@show');
    //
    Route::post('/topic/{topic}/submit', 'TopicCtr@submit');
});

//前台文章
Route::group([ 'namespace'=>'IndexCtr'], function () {
    Route::get('/posts/search','ArticleCtr@search');

    //创建文章
    Route::get('posts/add', 'ArticleCtr@add');
    Route::post('/posts', 'ArticleCtr@store');

    //文章列表页
    Route::get('/posts', 'ArticleCtr@index');
    //文章详情页
    Route::get('/posts/{post}', 'ArticleCtr@show');

    //编辑文章
    Route::get('/posts/{post}/edit', 'ArticleCtr@edit');
    Route::put('/posts/{post}', 'ArticleCtr@update');
    //删除文章
    Route::get('/posts/{post}/delete', 'ArticleCtr@del');

    //图片上传
    Route::post('/post/image/upload','ArticleCtr@imageUpload');

    //提交评论
    Route::post('/posts/{post}/comment','ArticleCtr@comment');

    //赞
    Route::get('/posts/{post}/zan','ArticleCtr@zan');
    //取消赞
    Route::get('/posts/{post}/unzan','ArticleCtr@unzan');


});