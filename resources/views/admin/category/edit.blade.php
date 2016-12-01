@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;  修改分类首页
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
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/category/'.$category->cate_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父分类：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==顶级分类==</option>
                            @foreach($pid as $p)
                            <option value="{{$p->cate_id}}"
                            @if($p->cate_id == $category->cate_pid)
                                selected
                                    @endif
                            >{{$p->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>分类名称：</th>
                    <td>
                        <input type="text" name="cate_name" value="{{$category->cate_name}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类标题：</th>
                    <td>
                        <input type="text" class="lg" name="cate_title" value="{{$category->cate_title}}">
                    </td>
                </tr>

                <tr>
                    <th>分类关键字：</th>
                    <td>
                        <textarea name="cate_keywords">{{$category->cate_keywords}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>分类描述：</th>
                    <td>
                        <textarea name="cate_description">{{$category->cate_description}}</textarea>
                    </td>
                </tr>
                {{--cate_order--}}
                <tr>
                    <th><i class="require">*</i>分类排序：</th>
                    <td>
                        <input type="text" class="sm" name="cate_order"  value="{{$category->cate_order}}">
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


