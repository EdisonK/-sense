<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Cache;


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
        $username = trim($request->username);
        $password = md5(trim($request->password));
        $user = User::where('username',$username)->first();
        if($user->password != $password){
            return $this->fail('密码错误，登陆失败！');
        }
        $uuid = Uuid::uuid1()->toString();
        $key = 'user'.$uuid;
        Cache::put($key,$user,120);
        return $this->successWithData($user,'登陆成功！');
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

        $check = User::where('username',trim($request->username))->first();
        if($check){
            return $this->fail('该用户名已经存在！');
        }

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
/*
 * 获取用户列表
 * vito
 *
 * */
    public function getUserList(Request $request)
    {
        $this->validate($request,[
            'keywords' => 'nullable|string'
        ]);
        $query = User::select('id','name','username');
        if($keywords = ($request->keywords)){
            $query->orWhere('name','like',"%$keywords%")->orWhere('username','like',"%$keywords%");
        }
        $userList = $query->get();
        return $this->successWithData($userList,'获取用户信息成功！');
    }
}
