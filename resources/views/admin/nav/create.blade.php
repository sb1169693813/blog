@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;  添加自定义导航首页
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if(count($errors) > 0)
                <div class="mark">
                    @foreach($errors->all() as $e)
                    {{$e}}
                        @endforeach
                    </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>添加自定义导航</a>
                <a href="{{url('admin/nav')}}"><i class="fa fa-recycle"></i>全部自定义导航</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <form action="{{url('admin/nav')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>自定义导航名称：</th>
                    <td>
                        <input type="text" class="lg" name="nav_name">
                    </td>
                </tr>
                <tr>
                    <th>自定义导航别名：</th>
                    <td>
                        <input type="text" class="lg" name="nav_alias">
                    </td>
                </tr>
                <tr>
                    <th>自定义导航url：</th>
                    <td>
                        <input type="text" class="lg" name="nav_url">
                    </td>
                </tr>
                <tr>
                    <th>自定义导航排序：</th>
                    <td>
                        <input type="text" size = '5' name="nav_order">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    @endsection


