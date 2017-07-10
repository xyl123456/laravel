@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;编辑文章分类
</div>
<!--面包屑导航 结束-->
<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>编辑文章页面</h3>
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
            <a href="#"><i class="fa fa-plus"></i>新增文章</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/cate/'.$field->cate_id)}}" method="post">
        <input type="hidden"  name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==主分类信息==</option>
                        @foreach($dates as $d)
                        <option value="{{$d->cate_id}}"
                        @if($d->cate_id == $field->cate_pid) selected
                        @endif>{{$d->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>文章标题：</th>
                <td>
                    <input type="text" name="cate_title" value="{{$field->cate_title}}">
                    <p>标题可以写30个字</p>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章名称：</th>
                <td>
                    <input type="text" class="lg" name="cate_name" value="{{$field->cate_name}}">
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>文章关键字：</th>
                <td>
                    <input type="text" class="sm" name="cate_keywords" value="{{$field->cate_keywords}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章描述：</th>
                <td><input type="text" class="lg" name="cate_description" value="{{$field->cate_description}}"></td>
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
