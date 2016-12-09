<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //
    public function __construct()
    {
        //友情链接
        $navs =  Nav::all();
        //最热的6片文章列表(view最多的排序)
        $hot =  Article::orderBy('art_view','desc')->take(6)->get();
        //5片点击最多的文章标题
        $rank = Article::orderBy('art_view','desc')->take(5)->get();
        //模板分享
        View::share('navs',$navs);
        View::share('hot',$hot);
        View::share('rank',$rank);
    }
}
