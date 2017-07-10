@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{'$admin/info'}}">首页</a> &raquo; 文章列表
</div>
<!--面包屑导航 结束-->
{{--
<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <th width="120">选择分类:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" placeholder="关键字"></td>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->--}}

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <h3>分类列表页面</h3>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/art/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>标题</th>
                    <th>点击</th>
                    <th>编辑</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">{{$v->art_id}}</td>
                    <td>
                        <a href="#">{{$v->art_title}}</a>
                    </td>
                    <td>{{$v->art_view}}</td>
                    <td>{{$v->art_editor}}</td>
                    <td>{{date('Y-m-d',$v->art_time)}}</td>
                    <td>
                        <a href="{{url('admin/art/'.$v->art_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>
                    </td>
                </tr>
                    @endforeach
            </table>

            <div class="page_list">
                <ul>
                    {{$data->links()}}
                </ul>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>
<script>
    function changeOrder (Obj,cate_id){
        var $cate_order=$(Obj).val();
        $.post('{{url('admin/cate/changeorder')}}',{'_token':'{{csrf_token()}}','cate_order':$cate_order,
        'cate_id':cate_id},function (data){
            if(data.state==0){
                layer.alert(data.msg, {icon: 6});
            }else {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
    function delArt (art_id) {
        //询问框
        layer.confirm('您是确定要删除该条目吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/art/')}}/"+art_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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
