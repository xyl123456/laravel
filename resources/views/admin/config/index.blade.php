@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{'$admin/info'}}">首页</a> &raquo; 网络配置
</div>

<!--搜索结果页面 列表 开始-->

    <div class="result_wrap">
        <!--快捷导航 开始-->
        <h3>网络配置页面</h3>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增网络配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>显示全部网络配置</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('admin/config/changecontent')}}" method="post">
                {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>标题</th>
                    <th>名称</th>
                    <th>内容</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,'{{$v->conf_id}}')"  value="{{$v->conf_order}}">
                    </td>
                    <td class="tc">{{$v->conf_id}}</td>
                    <td>
                        <a href="#">{{$v->conf_title}}</a>
                    </td>
                    <td>
                        <a href="#">{{$v->conf_name}}</a>
                    </td>
                    <td>
                        <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">
                        {!! $v->_html !!}
                    </td>
                    <td>
                        <a href="{{url('admin/config/'.$v->conf_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="deleCate({{$v->conf_id}})">删除</a>
                    </td>
                </tr>
                    @endforeach
            </table>
            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>
            </form>
        </div>
    </div>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder (Obj,conf_id){
        var $conf_order=$(Obj).val();
        $.post('{{url('admin/config/changeorder')}}',{'_token':'{{csrf_token()}}','conf_order':$conf_order,
        'conf_id':conf_id},function (data){
            if(data.state==0){
                layer.alert(data.msg, {icon: 6});
            }else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
    function deleCate (conf_id) {
        //询问框
        layer.confirm('您是确定要删除该链接吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/config/')}}/"+conf_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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
