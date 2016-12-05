<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinkController extends CommonController
{
    //GET admin/link
    public function index()
    {
        $link = new Link();
        $data = $link->orderBy('order','asc')->paginate(3);
        // dd($data);
        return view('admin.link.index',compact('data'));
    }
    //GET admin/link/create添加友情链接页面
    public function create()
    {
        return view('admin.link.create');
    }
    //POST admin/link   添加友情链接执行
    public function store()
    {
        //post接受过来的数据
       $input =  Input::except('_token');
        //dd($input);
        //数据验证
        $rules = [
            'name'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'名称不能为空！',
            'order.numeric'=>'排序必须是数字！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
           //插入数据
           $result =  Link::create($input);
            //dd($rows);
            if($result){
                return redirect('admin/link');
            }else{
                $errors['errors'] = '友情链接添加失败，请重新添加！';
                return back()->withErrors($errors);
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    // GET  admin/link/{link}/edit
    public function edit($id)
    {
        //文章数据
        $data = Link::find($id);
        return view('admin.link.edit',compact('data'));
    }
    //PUT admin/link/{article}      | admin.link.update
    public function update($id)
    {
        //排除不需要的数据
        $input = Input::except('_token','_method');
        //验证提交过来的数据
        //规则
        $rules = [
            'name'=>'required',
            'order'=>'numeric',
        ];
        //对应中文
        $message = [
            'name.required'=>'名称不能为空！',
            'order.numeric'=>'排序必须是数字！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //验证通过之后，更新数据
            $link = new Link();
            $lin =  $link->find($id);
            $updateData['name'] = $input['name'];
            $updateData['title'] = $input['title'];
            $updateData['url'] = $input['url'];
            $updateData['order'] = $input['order'];
            $rows = $lin->update($updateData);
            if($rows > 0){
                //更新成功
                return redirect('admin/link');//分类首页
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
    //DELETE admin/link/{link}删除单个友情链接
    public function destroy($id)
    {
        $rows = Link::where('id',$id)->delete();
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
        $cate = Link::find($input['id']);
        $cate->order = $input['order'];
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
