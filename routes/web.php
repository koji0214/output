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

Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    // ログイン画面からホーム画面への遷移
    Route::get('/', 'HomeController@index')->name('home');
    
    // 起床管理用
    Route::resource('wake', 'WakeController');
    
    // 問題管理用
    Route::resource('question', 'QuestionController');
    
    // タスク管理用
    Route::resource('task', 'TaskController');
    
    // 起床時間登録
    Route::resource('home', 'HomeController');

});
    