@extends('layouts.home')
@section('homeinfo')
    <title>个人博客</title>
    <meta name="keywords" content="个人博客模板,博客模板" />
    <meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
@endsection
@section('homecontent')
<article class="blogs">
    <h1 class="t_nav"><span>{{$cate->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('lists/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a></h1>
    <div class="newblog left">
        @foreach($article as $a)
        <h2>{{$a->art_title}}</h2>
        <p class="dateview"><span>发布时间：{{date('Y-m-d',strtotime($a->art_time))}}</span><span>作者：{{$a->art_editor}}</span><span>分类：[<a href="{{url('lists/'.$cate->cate_id)}}">{{$cate->cate_name}}</a>]</span></p>
        <figure><img src="{{url($a->art_thumb)}}"></figure>
        <ul class="nlist">
            <p>{{$a->art_description}}</p>
            <a title="{{$a->art_description}}" href="{{url('a/'.$a->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
        </ul>
        <div class="line"></div>
        <div class="blank"></div>
        {{--<div class="ad">--}}
            {{--<img src="images/ad.png">--}}
        {{--</div>--}}
        @endforeach
        <div class="page">
        {{$article->links()}}
        </div>
    </div>
    <aside class="right">
        <div class="rnav">
            <ul>
                @foreach($childs as $k=>$c)
                <li class="rnav{{$k+1}}"><a href="{{url('lists/'.$c->cate_id)}}" target="_blank">{{$c->cate_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="news">
            @parent
        </div>
        {{--<div class="visitors">--}}
            {{--<h3><p>最近访客</p></h3>--}}
            {{--<ul>--}}

            {{--</ul>--}}
        {{--</div>--}}
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <!-- Baidu Button END -->
    </aside>
</article>
@endsection