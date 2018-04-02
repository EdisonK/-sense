<?php

namespace App\Http\Controllers;

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
}
