<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if(strtoupper($input['code'])!=$_code){
                //验证验证码
                return back()->with('msg','验证码错误');
            }
            $user = User::first();
            //验证用户名
            if($user->user_name != $input['user_name'])
            {
                return back()->with('msg','用户名错误');
            }

            //验证用户密码
//            if(Crypt::decrypt($user->user_password) != $input['user_password'])
            if(!Hash::check($input['user_password'], $user->user_password))
            {
                return back()->with('msg','密码错误');
            }

            //讲用户名存储在session中
            session(['user_info'=>$user]);
            return redirect('admin/index');
        }else {
            return view('admin.login');
        }
    }

    //退出
    public function logout()
    {
        //清空session
        session(['user_info'=>null]);
        return redirect('admin/login');
    }
    //生成验证码
    public function code()
    {
        $code = new \Code;
        $code->make();
    }

    public function getCode()
    {
        $code = new \Code;
        echo $code->get();
    }

    public function crypt()
    {
        $str = '123456';
        $enstr = Hash::make($str);
        echo $enstr;
    }

}
