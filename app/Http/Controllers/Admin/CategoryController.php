<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //admin.category.index全部分类列表
    public function index()
    {
        $categorys = (new Category)->index();
        //dd($categorys);
        return view('admin.category.index',compact('categorys'));
    }

    //admin.category.create添加分类
    public function create()
    {

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
