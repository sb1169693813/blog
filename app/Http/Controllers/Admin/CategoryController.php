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

    // admin/category   添加分类执行
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
    
    //admin/category/{category}更新分类
    public function update()
    {

    }

    //admin/category/{category}删除单个分类
    public function destroy()
    {

    }

    //admin/category/{category}显示单个分类信息
    public function show()
    {

    }

    //admin/category/{category}/edit编辑分类
    public function edit()
    {

    }
}
