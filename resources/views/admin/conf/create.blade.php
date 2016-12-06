@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;  添加网站配置首页
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
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                <a href="{{url('admin/conf')}}"><i class="fa fa-recycle"></i>全部网站配置</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <form action="{{url('admin/conf')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>网站配置标题：</th>
                    <td>
                        <input type="text" class="lg" name="conf_title">
                    </td>
                </tr>
                <tr>
                    <th>网站配置变量名：</th>
                    <td>
                        <input type="text" class="lg" name="conf_name">
                    </td>
                </tr>
                <tr>
                    <th>网站配置类型：</th>
                    <td>
                        <input type="radio" class="lg" name="field_type" value="input" checked onclick="hideValue();">input
                        <input type="radio" class="lg" name="field_type" value="textarea" onclick="hideValue();">textarea
                        <input type="radio" class="lg" name="field_type" value="radio" onclick="hideValue();">radio
                    </td>
                </tr>
                <tr id="field_value">
                    <th>网站配置类型值：</th>
                    <td>
                        <input type="text" size = '5' name="field_value"><i class="require">*</i>1|开启 0|关闭
                    </td>
                </tr>
                <tr>
                    <th>网站配置备注：</th>
                    <td>
                        <textarea name="conf_tips" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>网站配置排序：</th>
                    <td>
                        <input type="text" size = '5' name="conf_order">
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
    <script>
        function hideValue(){
            var objValue = $("input[name='field_type']:checked").val();
            if(objValue == 'radio'){
                $('#field_value').show();
            }else{
                $('#field_value').hide();
            }
        }
        $(function(){
            $('#field_value').hide();
        });
    </script>
    @endsection


