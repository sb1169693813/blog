<?php

namespace App\Http\Controllers\Home;

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
        //模板分享
        View::share('navs',$navs);
    }
}
