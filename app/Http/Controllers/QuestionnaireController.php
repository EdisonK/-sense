<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{

    /*
     * 创建文件主题
     * vito
     * */
    public function createQuestionnaire(Request $request)
    {
//        这种写法，不知道是不是显得不够简洁
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $create_at = date('Y-m-d H:i:s');

        $this->validate($request,[
            'title' => 'required|string'
        ]);
        $questionnaire = Questionnaire::create([
            'title' => trim($request->title),
            'creator_id' => $user['id'],
            'create_at' => $create_at
        ]);
        if($questionnaire){
            return $this->successWithData($questionnaire,'文件主题创建成功！');
        }else{
           return $this->fail('问卷主题创建失败！');
        }
    }


    /*
     * 添加问卷主题的问题
     * vito
     * */
    public function createQuestion(Request $request)
    {
        $this->validate($request,[
            'q_id' => 'required|integer',
            'question' => 'required|string'

        ]);
        $create_at = date('Y-m-d H:i:s');
        $question = Question::create([
            'q_id' => trim($request->q_id),
            'question' => trim($request->question),
            'create_at' => $create_at
        ]);
        if($question){
            return $this->successWithData($question,'问题创建成功！');
        }else{
            return $this->fail('问题创建失败！');
        }
    }
    /*
     * 添加问题选项
     * vito
     * */
    public function  createQuestionOption(Request $request)
    {
        $this->validate($request,[
            'question_id' => 'required|integer',
            'option' => 'required|string',
            'description' => 'required|string'

        ]);
        $option = Option::create([
            'question_id' => trim($request->question_id),
            'option' => trim($request->option),
            'description' => trim($request->description)
        ]);
        if($option){
            return $this->successWithData($option,'问题选项创建成功！');
        }else{
            return $this->fail('问题选项创建失败！');
        }

    }
    /*
     *
     *
     * */




}
