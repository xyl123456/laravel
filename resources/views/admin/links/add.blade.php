@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;添加链接
</div>
<!--面包屑导航 结束-->
<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加链接页面</h3>
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
            <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>新增链接</a>
            <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>显示全部链接</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/link')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th>链接标题：</th>
                <td>
                    <input type="text" name="links_title">
                    <p>标题可以写30个字</p>
                </td>
            </tr>
            <tr>
                <th>链接名称：</th>
                <td>
                    <input type="text" class="md" name="links_name" >
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>：链接URL</th>
                <td>
                    <input type="text" class="lg" name="links_url" value="http://">
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
