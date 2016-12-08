<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Link;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    //前台首页
    public function index()
    {
        //最热的6片文章列表(view最多的排序)
        $hot =  Article::orderBy('art_view','desc')->take(6)->get();
//        dd($hot);
        //文章列表（有阅读全文的，按发布时间排序）
        $artlist =  Article::orderBy('art_time','desc')->paginate(5);
        //8篇最新文章标题
        $new = Article::orderBy('art_time','desc')->take(8)->get();
        //5片点击最多的文章标题
        $rank = Article::orderBy('art_view','desc')->take(5)->get();
//        //网站导航
//       $navs =  Nav::all();
        //友情链接
        $link = Link::orderBy('order','asc')->get();
        return view('Home.index',compact('navs','hot','artlist','new','rank','link'));
    }

    //前台文章列表页
    public function lists()
    {

        return view('Home.lists',compact('navs'));
    }
    //前台文章详情页面
    public function news()
    {

        return view('Home.news',compact('navs'));
    }
}
