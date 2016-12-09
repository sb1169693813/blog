@extends('layouts.home')
@section('homeinfo')
    <title>孙斌个人博客</title>
    <meta name="keywords" content="个人博客模板,博客模板" />
    <meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
@endsection
@section('homecontent')
    <div class="template">
        <div class="box">
            <h3>
                <p><span>最热文章</span>推荐 Recommend</p>
            </h3>
            <ul>
                @foreach($hot as $h)
                    <li><a href="{{url('news/'.$h->art_id)}}"  target="_blank"><img src="{{url($h->art_thumb)}}"></a><span>{{$h->art_title}}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <article>
        <h2 class="title_tj">
            <p>文章<span>推荐</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($artlist as $al)
            <h3>{{$al->title}}</h3>
            <figure><img src="{{url($al->art_thumb)}}"></figure>
            <ul>
                <p>{{$al->art_description}}</p>
                <a title="{{$al->art_title}}" href="{{url('news/'.$al->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <p class="dateview"><span>{{date('Y-m-d',strtotime($al->art_time))}}</span><span>作者：{{$al->editor}}</span></p>
                {{--<span>个人博客：[<a href="/news/life/">程序人生</a>]</span>--}}
            @endforeach
        </div>
        <aside class="right">
            <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
            <div class="news">
                @parent
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    @foreach($link as $l)
                    <li><a href="{{$l->url}}" target="_blank">{{$l->name}}</a></li>
                    @endforeach
                </ul>
            </div>
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

