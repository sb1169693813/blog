<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends CommonController
{
    //admin/article/create 全部分类列表
    public function create()
    {
        $category = new Category();
        $categorys = $category->index();
       // dd($categorys);
        return view('admin.article.create',compact('categorys'));
    }
    //POST admin/article   添加分类执行
    public function store()
    {

    }
}
