@extends('layouts.admin')
@section('content')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部友情链接
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                    <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>全部友情链接</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>名字</th>
                        <th>链接</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc"><input type="text" name="order" size="1" value="{{$v->order}}" onchange="changeOrder(this,'{{$v->id}}');"></td>
                            <td class="tc">{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td><a href="{{$v->url}}">{{$v->url}}</a></td>
                            <td>
                                <a href="{{url('admin/link/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript:void(0);" onclick="delArt({{$v->id}})">删除</a>
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
                 url:"{{url('admin/link')}}/"+art_id,
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
        
        function  changeOrder(obj,id) {
            var objValue = obj.value;
            //alert(value);
            $.ajax({
                type: "post",
                url: "{{url('admin/link/changeOrder')}}",
                data: {'order': objValue, 'id': id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                dataType: "json",
                success: function (jsondata) {
                    if(jsondata.code > 0){
                        //更新成功
                        layer.alert(jsondata.msg, {icon: 6});
                        //location.href='{{url("admin/category")}}';
                    }else{
                        layer.alert(jsondata.msg, {icon: 5});
                    }
                }
            });

        }
    </script>
    @endsection

