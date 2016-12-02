@extends('layouts.admin')
@section('content')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部文章
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>查看次数</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        {{--{{$v}}--}}
                        <tr>
                            <td class="tc">{{$v->art_id}}</td>
                            <td>
                                <a href="#">{{$v->art_title}}</a>
                            </td>
                            <td>{{$v->art_view}}</td>
                            <td>{{$v->art_editor}}</td>
                            <td>{{date('Y-m-d H:i:s',strtotime($v->art_time))}}</td>
                            <td>
                                <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                                <a href="javascript:void(0);" onclick="delArt({{$v->art_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{$data->links()}}
                </div>
                <style>
                    .result_content ul li span {
                        font-size: 15px;
                        padding: 6px 12px;
                    }
                </style>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        function delArt(art_id) {
            layer.confirm('您确定要删除这个分类吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
               $.ajax({
                 type:"DELETE",
                 url:"{{url('admin/article')}}/"+art_id,
                 data: {},
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 },
                 dataType: "json",
                 success: function (jsondata) {
                         if(jsondata.code > 0){
                            //删除成功
                             location.href=location.href;
                            layer.alert(jsondata.msg, {icon: 6});
                        }else{
                            layer.alert(jsondata.msg, {icon: 5});
                        }
                     //alert(jsondata);
                     }
                 });
//            layer.msg('的确很重要', {icon: 1});
            }, function(){
                //alert(456);
            });
        }
    </script>
    @endsection

