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
session_start();
Route::any('/send','Admin\SendController@index');
Route::get('/','Home\IndexController@index');
Route::get('cate/{cate_id}','Home\IndexController@cate');
Route::get('a/{art_id}','Home\IndexController@artical');

//App http通信
Route::any('admin/app','Admin\AppController@index');

Route::any('admin/login','Admin\LoginController@login');
Route::get('admin/getcode','Admin\LoginController@getcode');
Route::get('admin/code','Admin\LoginController@makecode');
Route::get('admin/quit','Admin\IndexController@quit');

Route::group(['middleware'=>['admin.login']], function () {
    Route::get('admin/index','Admin\IndexController@index');
    Route::get('admin/info','Admin\IndexController@info');
    Route::any('admin/pass','Admin\IndexController@pass');
    Route::post('admin/cate/changeorder','Admin\CategoryController@changeorder');
    Route::resource('admin/cate','Admin\CategoryController');
    Route::resource('admin/art','Admin\ArticalController');
//链接
    Route::resource('admin/link','Admin\LinksController');
    Route::post('admin/link/changeorder','Admin\LinksController@changeorder');
//NV导航条
    Route::resource('admin/nav','Admin\NavsController');
    Route::post('admin/nav/changeorder','Admin\NavsController@changeorder');
//配置修改
    Route::resource('admin/config', 'Admin\ConfigController');
    Route::post('admin/config/changeorder','Admin\ConfigController@changeorder');
    Route::any('admin/upload','Admin\CommonController@upload');
    Route::post('admin/config/changecontent','Admin\ConfigController@changecontent');

});
