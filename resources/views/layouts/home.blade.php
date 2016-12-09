<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('homeinfo')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $n)
        <a href="{{$n->nav_url}}"><span>{{$n->nav_name}}</span><span class="en">{{$n->nav_alias}}</span></a>
        @endforeach
    </nav>
</header>
<div class="banner">
    <section class="box">
        <ul class="texts">
            <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
            <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
            <p>加了锁的青春，不会再因谁而推开心门。</p>
        </ul>
        <div class="avatar"><a href="#"><span>后盾</span></a> </div>
    </section>
</div>

@section('homecontent')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($hot as $n)
            <li><a href="{{url('news/'.$n->art_id)}}" title="{{$n->art_title}}" target="_blank">{{$n->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($rank as $h)
            <li><a href="{{url('news/'.$h->art_id)}}" title="{{$h->art_title}}" target="_blank">{{$h->art_title}}</a></li>
        @endforeach
    </ul>
    @show
<footer>
    <p>Design by 后盾网 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.houdunwang.com</a> <a href="/">网站统计</a></p>
</footer>
<script src="{{asset('resources/views/home/js/silder.js')}}"></script>
</body>
</html>