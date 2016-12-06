<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavController extends CommonController
{
    //
    //GET admin/nav
    public function index()
    {
        $nav = new Nav();
        $data = $nav->orderBy('nav_order','asc')->paginate(10);
        // dd($data);
        return view('admin.nav.index',compact('data'));
    }
    //GET admin/nav/create添加友情链接页面
    public function create()
    {
        return view('admin.nav.create');
    }
    //POST admin/nav   添加友情链接执行
    public function store()
    {
        //post接受过来的数据
        $input =  Input::except('_token');
        //dd($input);
        //数据验证
        $rules = [
            'nav_name'=>'required',
            'nav_order'=>'numeric',
        ];
        $message = [
            'nav_name.required'=>'自定义导航名称不能为空！',
            'nav_order.numeric'=>'自定义导航排序必须是数字！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //插入数据
            $result =  Nav::create($input);
            //dd($rows);
            if($result){
                return redirect('admin/nav');
            }else{
                $errors['errors'] = '友情链接添加失败，请重新添加！';
                return back()->withErrors($errors);
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    // GET  admin/nav/{nav}/edit
    public function edit($id)
    {
        //文章数据
        $data = Nav::find($id);
        return view('admin.nav.edit',compact('data'));
    }
    //PUT admin/nav/{article}      | admin.nav.update
    public function update($id)
    {
        //排除不需要的数据
        $input = Input::except('_token','_method');
        //验证提交过来的数据
        //规则
        $rules = [
            'nav_name'=>'required',
            'nav_order'=>'numeric',
        ];
        //对应中文
        $message = [
            'nav_name.required'=>'名称不能为空！',
            'nav_order.numeric'=>'排序必须是数字！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //验证通过之后，更新数据
            $nav = new Nav();
            $lin =  $nav->find($id);
            $updateData['nav_name'] = $input['nav_name'];
            $updateData['nav_alias'] = $input['nav_alias'];
            $updateData['nav_url'] = $input['nav_url'];
            $updateData['nav_order'] = $input['nav_order'];
            $rows = $lin->update($updateData);
            if($rows > 0){
                //更新成功
                return redirect('admin/nav');//分类首页
            }else{
                //更新失败
                $errors['error'] = '友情链接更新失败，请稍后重试！';
                return back()->withErrors($errors);
            }
        }else{
            //验证失败
            return back()->withErrors($validator);
        }
    }
    //DELETE admin/nav/{nav}删除单个友情链接
    public function destroy($id)
    {
        $rows = Nav::where('nav_id',$id)->delete();
        if($rows > 0){
            $jsondata['code'] = 1;
            $jsondata['msg'] = '删除成功！';
        }else{
            $jsondata['code'] = -1;
            $jsondata['msg'] = '删除失败！请稍后重试！';
        }
        return $jsondata;
    }

    public function changeOrder()
    {
        //echo 'sunbin';
        $input = Input::all();
        $cate = Nav::find($input['id']);
        $cate->nav_order = $input['order'];
        $rows = $cate->update();
        if($rows > 0){
            //  更新成功
            $jsondata['msg'] = '友情链接排序更新成功！';
            $jsondata['code'] = 1;
        }else{
            $jsondata['msg'] = '友情链接排序更新失败！';
            $jsondata['code'] = -1;
        }
        return $jsondata;
    }

    public function show()
    {

    }
}
