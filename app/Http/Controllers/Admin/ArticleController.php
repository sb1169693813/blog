<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //GET admin/article
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(3);
       // dd($data);
        return view('admin.article.index',compact('data'));
    }
    //GET admin/article/create全部文章列表
    public function create()
    {
        //分类名称
        $category = new Category();
        $categorys = $category->index();
       // dd($categorys);
        return view('admin.article.create',compact('categorys'));
    }
    //POST admin/article   添加文章执行
    public function store()
    {
        //接收post传过来的数据
        $input = Input::except('_token');
        //验证数据
        $rules = [
            'art_title'=>'required',
            'editorValue'=>'required',
            'cate_id'=>'required',
        ];
        $message = [
            'art_title.required'=>'文章标题不能为空！',
            'editorValue.required'=>'文章内容不能为空！',
            'cate_id.required'=>'请选择文章分类!',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            //验证通过
            //添加数据到数据库
            $addData['cate_id'] = $input['cate_id'];
            $addData['art_title'] = $input['art_title'];
            $addData['art_tag'] = $input['art_tag'];
            $addData['art_description'] = $input['art_description'];
            $addData['art_thumb'] = $input['art_thumb'];
            $addData['art_editor'] = $input['art_editor'];
            $addData['art_content'] = $input['editorValue'];
            $addData['art_time'] = date('Y-m-d H:i:s',strtotime('now'));
            $addData['art_view'] = 0;
            $rows =  (new Article)->fill($addData)->save();
            if($rows > 0){
                //添加成功,跳到文章首页 admin/article
                return  redirect('admin/article');

            }else{
                //添加失败
                $errors['errors'] = '添加文章失败，请稍后重试';
                return back()->withErrors($errors);
            }
        }else{
            //验证失败
            return back()->withErrors($validator);
        }

       // dd($input);
    }

    // GET  admin/article/{article}/edit
    public function edit($art_id){

    }

    //DELETE admin/article/{article}删除单个分类
    public function destroy($art_id)
    {
        $rows = Article::where('art_id',$art_id)->delete();
        if($rows > 0){
            $jsondata['code'] = 1;
            $jsondata['msg'] = '删除成功！';
        }else{
            $jsondata['code'] = -1;
            $jsondata['msg'] = '删除失败！请稍后重试！';
        }

        return $jsondata;
    }
}
