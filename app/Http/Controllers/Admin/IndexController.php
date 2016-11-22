<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //后台首页
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    //更改密码
    public function pass()
    {
        //是否接收post
        if($input = Input::all()){
            //验证规则
            $rulers = [
                'password'=>'required|between:6,20|confirmed',//新密码必须,新密码在6-20位,和确认密码一致
            ];
            //验证提示的信息
            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位！',
                'password.confirmed'=>'新密码和确认密码必须一致！',
            ];
            //使用验证器验证
            $validator = Validator::make($input,$rulers,$message);
            //验证通过
            if($validator->passes()){
                //判断原密码是否和数据库中密码一致
                $user = User::find(1);
//                dd( $validator);
//                exit;
                if(Crypt::decrypt($user->user_password) == $input['password_o']){
                    $user->user_password = Crypt::encrypt($input['password']);
                    $user->update();
                    return redirect('admin/index');
                }else{
                    $errors['error'] = '原密码错误！';
                   return back()->withErrors($errors);
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            //返回密码更改的页面
            return view('admin.pass');
        }
    }
    //打印服务器信息
    public function server()
    {
        dd($_SERVER);
    }
}
