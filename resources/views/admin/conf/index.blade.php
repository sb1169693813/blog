@extends('layouts.admin')
@section('content')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部网站配置
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                    <a href="{{url('admin/conf')}}"><i class="fa fa-recycle"></i>全部网站配置</a>
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
                        <th>标题</th>
                        <th>变量名</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc"><input type="text" name="order" size="1" value="{{$v->conf_order}}" onchange="changeOrder(this,'{{$v->conf_id}}');"></td>
                            <td class="tc">{{$v->conf_id}}</td>
                            <td>{{$v->conf_title}}</td>
                            <td>{{$v->conf_name}}</td>
                            <td>{{$v->conf_tips}}</td>
                            <td>
                                <a href="{{url('admin/conf/'.$v->conf_id.'/edit')}}">修改</a>
                                <a href="javascript:void(0);" onclick="delArt({{$v->conf_id}})">删除</a>
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
                 url:"{{url('admin/conf')}}/"+art_id,
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
            //alert(objValue);
            $.ajax({
                type: "post",
                url: "{{url('admin/conf/changeOrder')}}",
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

