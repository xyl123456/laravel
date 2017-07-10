@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{'$admin/info'}}">首页</a> &raquo; 导航列表
</div>

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <h3>导航列表页面</h3>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>新增导航</a>
                <a href="{{url('admin/nav')}}"><i class="fa fa-recycle"></i>显示全部导航</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>导航名称</th>
                    <th>导航别名</th>
                    <th>导航URL</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,'{{$v->navs_id}}')"  value="{{$v->navs_order}}">
                    </td>
                    <td class="tc">{{$v->navs_id}}</td>
                    <td>
                        <a href="#">{{$v->navs_name}}</a>
                    </td>
                    <td>{{$v->navs_alias}}</td>
                    <td>{{$v->navs_url}}</td>
                    <td>
                        <a href="{{url('admin/nav/'.$v->navs_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="deleCate({{$v->navs_id}})">删除</a>
                    </td>
                </tr>
                    @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder (Obj,navs_id){
        var $navs_order=$(Obj).val();
        $.post('{{url('admin/nav/changeorder')}}',{'_token':'{{csrf_token()}}','navs_order':$navs_order,
        'navs_id':navs_id},function (data){
            if(data.state==0){
                layer.alert(data.msg, {icon: 6});
            }else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
    function deleCate (navs_id) {
        //询问框
        layer.confirm('您是确定要删除该链接吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/nav/')}}/"+navs_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                if(data.states==0){
                    location.href=location.href;
                    layer.alert($data.msg, {icon: 6});
                }else{
                    layer.msg($data.msg, {icon: 5});
                }
            });
        }, function(){

            });
    }
</script>
@endsection
