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

//Route::get('/test', function (Request $request) {
//    var_dump("777");
//    return $request->user();
//});
//登录接口
Route::post('/login', "RegisterController@login");
Route::post('/register', "RegisterController@register");


//获取问题列表的问卷列表
Route::get('questionnaire/getQuestionnaireList', "QuestionnaireController@getQuestionnaireList");
Route::get('questionnaire/getQuestionList', "QuestionnaireController@getQuestionList");//获取问卷题目的列表


Route::group(['middleware' => 'check.login'], function() {
    Route::get('/getUserList', "RegisterController@getUserList");
    //添加主题
    Route::post('questionnaire/createQuestionnaire', "QuestionnaireController@createQuestionnaire");
    Route::post('questionnaire/createQuestion', "QuestionnaireController@createQuestion");
    Route::post('questionnaire/createQuestionOption', "QuestionnaireController@createQuestionOption");

    //更新选项
    Route::post('questionnaire/updateQuestionOption', "QuestionnaireController@updateQuestionOption");
    //更新问题
    Route::post('questionnaire/updateQuestion', "QuestionnaireController@updateQuestion");
    //更新问卷
    Route::post('questionnaire/updateQuestionnaire', "QuestionnaireController@updateQuestionnaire");
    //删除问卷(假删)
    Route::post('questionnaire/deleteQuestionnaire', "QuestionnaireController@deleteQuestionnaire");

    //获取我的问卷列表
    Route::get('questionnaire/getMyQuestionnaireList', "QuestionnaireController@getMyQuestionnaireList");
    //获取问卷题目的列表
    Route::get('questionnaire/getQuestionList', "QuestionnaireController@getQuestionList");







});



