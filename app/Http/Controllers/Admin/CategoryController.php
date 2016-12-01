<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //admin.category.index全部分类列表
    public function index()
    {
        $categorys = (new Category)->index();
        //dd($categorys);
        return view('admin.category.index',compact('categorys'));
    }

    //ajax cate_order排序
    public function cateOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $rows = $cate->update();
        if($rows > 0){
            //  更新成功
            $jsondata['msg'] = '分类排序更新成功！';
            $jsondata['code'] = 1;
        }else{
            $jsondata['msg'] = '分类排序更新失败！';
            $jsondata['code'] = -1;
        }
        return $jsondata;
    }

    //admin.category.create 添加分类页面
    public function create()
    {
        $pid = Category::where('cate_pid',0)->get();
        return view('admin.category.create',compact('pid'));
    }

    //POST admin/category   添加分类执行
    public function store()
    {
        $input = Input::all();
        $rules = [
            'cate_name'=>'required',
        ];
        $message = [
          'cate_name.required'=>'分类名称不能为空！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()) {
            //验证通过
            $addData['cate_name'] = $input['cate_name'];
            $addData['cate_title'] = $input['cate_title'];
            $addData['cate_keywords'] = $input['cate_keywords'];
            $addData['cate_description'] = $input['cate_description'];
            $addData['cate_order'] = $input['cate_order'];
            $addData['cate_pid'] = $input['cate_pid'];
            $category = new Category();
            $category->fill($addData);
              $rows = $category->save();
            if($rows > 0){
                //添加成功
                return redirect('admin/category');
            }else{
                //失败
                $errors['error'] = '原密码错误！';
                return back()->withErrors($errors);
            }
        }else{
            return back()->withErrors($validator);
        }

        //dd($input);
    }
    //GET admin/category/{category}/edit更新分类页面
    public function edit($cate_id)
    {
        //根据id获得一条记录
        $category = Category::find($cate_id);
        //获得所有的cate_pid=0的cate_id
        $pid = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('category','pid'));
    }

    //PUT admin/category/{category}更新分类执行
    public function update($cate_id)
    {
        //排除不需要的数据
        $input = Input::except('_token','_method');
        //验证提交过来的数据
        //规则
        $rules = [
            'cate_name'=>'required',
        ];
        //对应中文
        $message = [
            'cate_name.required'=>'分类名不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //验证通过之后，更新数据
           $rows =  Category::where('cate_id',$cate_id)->update($input);
            if($rows > 0){
                //更新成功
                return redirect('admin/category');//分类首页
            }else{
                //更新失败
                $errors['error'] = '分类信息更新失败，请稍后重试！';
                return back()->withErrors($errors);
            }
        }else{
            //验证失败
            return back()->withErrors($validator);
        }
       // dd($input);
    }

    //DELETE admin/category/{category}删除单个分类
    public function destroy($cate_id)
    {
        $rows = Category::where('cate_id',$cate_id)->delete();
        if($rows > 0){
            $jsondata['code'] = 1;
            $jsondata['msg'] = '删除成功！';
        }else{
            $jsondata['code'] = -1;
            $jsondata['msg'] = '删除失败！请稍后重试！';
        }

        return $jsondata;
    }

    //admin/category/{category}显示单个分类信息
    public function show()
    {

    }
}
