@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{'$admin/info'}}">首页</a> &raquo; 链接列表
</div>

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <h3>链接列表页面</h3>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>新增链接</a>
                <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>显示全部链接</a>
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
                    <th>链接名称</th>
                    <th>链接标题</th>
                    <th>链接URL</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,'{{$v->links_id}}')"  value="{{$v->links_order}}">
                    </td>
                    <td class="tc">{{$v->links_id}}</td>
                    <td>
                        <a href="#">{{$v->links_name}}</a>
                    </td>
                    <td>{{$v->links_title}}</td>
                    <td>{{$v->links_url}}</td>
                    <td>
                        <a href="{{url('admin/link/'.$v->links_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="deleCate({{$v->links_id}})">删除</a>
                    </td>
                </tr>
                    @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder (Obj,links_id){
        var $links_order=$(Obj).val();
        $.post('{{url('admin/link/changeorder')}}',{'_token':'{{csrf_token()}}','links_order':$links_order,
        'links_id':links_id},function (data){
            if(data.state==0){
                layer.alert(data.msg, {icon: 6});
            }else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
    function deleCate (links_id) {
        //询问框
        layer.confirm('您是确定要删除该链接吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/link/')}}/"+links_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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
