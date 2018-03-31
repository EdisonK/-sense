<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class RegisterController extends Controller
{
    /*
     * 登陆接口
     * vito
     * */
    public function login(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        return $this->successWithData('','123');
    }

    /*
     * 注册用户
     *vito
     * */
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'phone' => 'nullable|string'
        ]);
        $create_at = date("Y-m-d H:i:s");

        $user = User::create([
            'name' => trim($request->name),
            'username' => trim($request->username),
            'password' => md5(trim($request->password)),
            'phone' => $request->phone?trim($request->phone):null,
            'create_at' =>$create_at
        ]);
        if($user){
            return $this->successWithData($user,'注册成功！');
        }else{
            return $this->fail('注册失败！');
        }

    }
}
