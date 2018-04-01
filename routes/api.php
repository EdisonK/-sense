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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {
    var_dump("777");
//    return $request->user();
});
//登录接口
Route::post('/login', "RegisterController@login");
Route::post('/register', "RegisterController@register");
Route::get('/getUserList', "RegisterController@getUserList");





Route::group(['middleware' => 'check.login'], function() {
    Route::get('/test', function (Request $request) {
        var_dump("777");
//    return $request->user();
    });

});

//需要放到中间件中
//添加主题
Route::post('/createQuestionnaire', "QuestionnaireController@createQuestionnaire");

