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
     * 获取客问卷列表
     * vito
     * */
    public function getQuestionnaireList(Request $request)
    {
        $query = Questionnaire::where('id','>',0)->where('delete',0);
        if($keywords = trim($request->keywords)){
            $query->where('title','like',"%$keywords%");
        }
        $questionnaireList = $query->get();
//        $questionnaireList->load('question','question.option');
        return $this->successWithData($questionnaireList,'获取问卷列表成功！');
    }


    /*
     * 添加问卷主题的问题
     * vito
     * */
    public function createQuestion(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $this->validate($request,[
            'q_id' => 'required|integer',
            'question' => 'required|string'

        ]);
        $create_at = date('Y-m-d H:i:s');
        $question = Question::create([
            'q_id' => trim($request->q_id),
            'question' => trim($request->question),
            'create_at' => $create_at,
            'creator_id' => $user['id'],
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
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $this->validate($request,[
            'question_id' => 'required|integer',
            'option' => 'required|string',
            'description' => 'required|string'
        ]);
        $option = Option::create([
            'question_id' => trim($request->question_id),
            'option' => trim($request->option),
            'description' => trim($request->description),
            'creator_id' => $user['id']
        ]);
        if($option){
            return $this->successWithData($option,'问题选项创建成功！');
        }else{
            return $this->fail('问题选项创建失败！');
        }

    }
    /*
     *获取问卷问题列表
     *vito
     * */
    public function getQuestionList(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];
        $this->validate($request,[
            'q_id' => 'required|integer',
            'per_page' => 'nullable|integer'
        ]);
        $questionnaire = Questionnaire::where('creator_id',$creator_id)->find(trim($request->q_id));
        if($questionnaire->delete == 1){
            return $this->fail('该问卷已经被删除，您无法访问！');
        }
        if(!($per_page = $request->per_page)){
            $per_page = 10;
        }
        $q_id = $request->q_id;
        $query = Question::where('id','>',0)->where('q_id',$q_id);
        $questionList = $query->paginate($per_page);
        $questionList->load('option');
        return $this->successWithData($questionList,'获取问题列表成功！');
    }

    /*
     * 更新问卷问题选项
     * vito
     * */
    public function updateQuestionOption(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];

        $this->validate($request,[
            'id' => 'required|integer',
            'option' => 'required|string',
            'description' => 'required|string'
        ]);
        $option = Option::where("creator_id",$creator_id)->find(trim($request->id));
        if(!$option){
            return $this->fail('没有获取到需要更新的object！');
        }
        $option->option = trim($request->option);
        $option->description = trim($request->description);
        $bool = $option->save();
        if($bool){
            return $this->success('更新成功！');
        }else{
            return $this->fail('更新失败！');
        }

    }
    /*
    * 更新问卷问题
    * vito
    * */
    public function updateQuestion(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];

        $this->validate($request,[
            'id' => 'required|integer',
            'question' => 'required|string'
        ]);
        $question = Question::where("creator_id",$creator_id)->find(trim($request->id));
        if(!$question){
            return $this->fail('没有获取到需要更新的object！');
        }
        $question->question = trim($request->question);
        $bool = $question->save();
        if($bool){
            return $this->success('更新成功！');
        }else{
            return $this->fail('更新失败！');
        }
    }
    /*
     * 跟新问卷
     * vito
     * */
    public function updateQuestionnaire(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];

        $this->validate($request,[
            'id' => 'required|integer',
            'title' => 'required|string'
        ]);
        $questionnaire = Questionnaire::where("creator_id",$creator_id)->find(trim($request->id));
        if(!$questionnaire){
            return $this->fail('没有获取到需要更新的object！');
        }
        $questionnaire->title = trim($request->title);
        $bool = $questionnaire->save();
        if($bool){
            return $this->success('更新成功！');
        }else{
            return $this->fail('更新失败！');
        }

    }
    /*
     * 删除问卷(做个假删)
     * vito
     * */
    public function deleteQuestionnaire(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];

        $this->validate($request,[
            'id' => 'required|integer'
        ]);
        $questionnaire = Questionnaire::where("creator_id",$creator_id)->find(trim($request->id));
        if(!$questionnaire){
            return $this->fail('没有获取到需要更新的object！');
        }
        $questionnaire->delete = 1;//设置为1表示删了，0表示未删
        $bool = $questionnaire->save();
        if($bool){
            return $this->success('问卷删除成功！');
        }else{
            return $this->fail('问卷删除失败！');
        }

    }
    /*
     *获取我的问卷列表
     *vito
     * */
    public function getMyQuestionnaireList(Request $request)
    {
        $sess_key = $request->header('sess_key');
        $user = User::user($sess_key);
        $creator_id = $user['id'];
        $query = Questionnaire::where('creator_id',$creator_id)->where('delete',0);
        if($keywords = trim($request->keywords)){
            $query->where('title','like',"%$keywords%");
        }
        $questionnaireList = $query->get();
//        $questionnaireList->load('question','question.option');
        return $this->successWithData($questionnaireList,'获取我的问卷列表成功！');

    }


}
