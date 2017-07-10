@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;编辑导航
</div>
<!--面包屑导航 结束-->
<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>编辑导航页面</h3>
        <div class="result_title">
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @elseif(is_string($errors))
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>新增导航</a>
            <a href="{{url('admin/nav')}}"><i class="fa fa-recycle"></i>显示全部导航</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/nav/'.$field->navs_id)}}" method="post">
        <input type="hidden"  name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>ID：</th>
                <td>
                    <input type="text" name="navs_id" value="{{$field->navs_id}}">
                </td>
            </tr>
            <tr>
                <th>导航排序：</th>
                <td>
                    <input type="text" name="navs_order" value="{{$field->navs_order}}">
                </td>
            </tr>
            <tr>
                <th>导航名称：</th>
                <td>
                    <input type="text" class="md" name="navs_name" value="{{$field->navs_name}}">
                </td>
            </tr>
            <tr>
                <th>导航别名：</th>
                <td>
                    <input type="text" class="md" name="navs_alias" value="{{$field->navs_alias}}">
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>导航url：</th>
                <td>
                    <input type="text" class="lg" name="navs_url" value="{{$field->navs_url}}">
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
