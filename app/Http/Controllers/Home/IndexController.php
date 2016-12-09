<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Link;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    //前台首页
    public function index()
    {

//        dd($hot);
        //文章列表（有阅读全文的，按发布时间排序）
        $artlist =  Article::orderBy('art_time','desc')->paginate(5);
        //8篇最新文章标题
        $new = Article::orderBy('art_time','desc')->take(8)->get();

//        //网站导航
//       $navs =  Nav::all();
        //友情链接
        $link = Link::orderBy('order','asc')->get();
        return view('Home.index',compact('navs','hot','artlist','new','rank','link'));
    }

    //前台文章列表页（分类）
    public function lists($cate_id)
    {
        //分类信息
        $cate = Category::find($cate_id);
        // //图文列表4篇（带分页）
        $article = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
       // dd($article);
        //右边的子分类
        $childs = Category::where('cate_pid',$cate_id)->get();
        return view('Home.lists',compact('navs','cate','article','childs','hot','rank'));
    }

    //前台文章详情页面
    public function news($art_id)
    {
        //category联article表
        $article = Article::join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        //上一篇
        $pre = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        //下一篇
        $next = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        //相关的文章
        $related = Article::where('cate_id',$article->cate_id)->orderBy('art_time','desc')->take(6)->get();
       //dd($related);
        return view('Home.news',compact('navs','article','pre','next','related','hot','rank'));
    }
}
