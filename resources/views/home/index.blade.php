@extends('layouts/home')
@section('info')
  <title>后盾个人博客</title>
  <meta name="keywords" content="个人博客模板,博客模板" />
  <meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
@endsection
@section('content')
  <div class="banner">
    <section class="box">
      <ul class="texts">
        <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
        <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
        <p>加了锁的青春，不会再因谁而推开心门。</p>
      </ul>
      <div class="avatar"><a href="#"><span>后盾</span></a> </div>
    </section>
  </div>
  <div class="template">
    <div class="box">
      <h3>
        <p><span>站长推荐</span>美文 Templates</p>
      </h3>
      <ul>
        @foreach($hosts as $k=>$v)
        <li><a href="{{url('a/'.$v->art_id)}}"  target="_blank"><img src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span></li>
        @endforeach
      </ul>
    </div>
  </div>
  <article>
    <h2 class="title_tj">
      <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">
      @foreach($datas as $n=>$m)
      <h3>{{$m->art_title}}</h3>
      <figure><img src="{{url($m->art_thumb)}}"></figure>
      <ul>
        <p>{{$m->art_description}}</p>
        <a title="/" href="{{'a/'.$m->art_id}}" target="_blank" class="readmore">阅读全文>></a>
      </ul>
      <p class="dateview">
        <span>{{date('Y-m-d',$m->art_time)}}</span><span>作者：{{$m->art_editor}}</span><span>个人博客：[<a href="/news/life/">操蛋人生</a>]</span></p>
      @endforeach
      <div class="page">
        <ul>
        {{$datas->links()}}
        </ul>
      </div>
    </div>
    <aside class="right">
      <!-- Baidu Button BEGIN -->
      <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
      <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
      <script type="text/javascript" id="bdshell_js"></script>
      <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
      </script>
      <!-- Baidu Button END -->
      <!-- 天气信息-->
      <div class="weather" style="float:left"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
      <div class="news">
      @parent
      </div>
    </aside>

    <div class="list_tab">
      <tr>
        <th>PH值</th>
        <td>
          <input id="phdata" type="text" >
        </td>
        <br/>
      </tr>
      <tr>
        <th>水温</th>
        <td>
          <input id="tempdata" type="text">
        </td>
        <br/>
      </tr>
      <tr>
        <th>溶解氧</th>
        <td>
          <input id="oxgdata" type="text">
        </td>
        <br/>
      </tr>
    </div>
    <button type="button" id="btn"  onclick="sendctrl(this)">控制按钮</button>

  </article>
  <script type="text/javascript">
    window.setInterval(queryphData, 10000);
    //window.setInterval(queryoxgData, 14000);
    function queryphData() {
      $.ajax({
        type : "POST",//提交方式
        url : '{{url('/send')}}',
        data : {
          '_token'     : "{{csrf_token()}}",
          'device'     : '2',
          'type'       : '2',
          'devid'    : '0',
          'cmdtype'     :'query'
        },
        success : function(result){
          var jsonObj = jQuery.parseJSON(result);
          if( jsonObj.message =='success'){
            if(jsonObj.data){
              document.getElementById('phdata').setAttribute('value',jsonObj.data.ph);
              queryoxgData();
            }
          }
        }
      });
    }
    function queryoxgData(){
      $.ajax({
                type : "POST",//提交方式
                url : '{{url('/send')}}',
                data : {
                  '_token'     : "{{csrf_token()}}",
                  'device'     : '1',
                  'type'       : '1',
                  'devid'    : '0',
                  'cmdtype'     :'query'
                },
                success : function(result){
                  var jsonObj = jQuery.parseJSON(result);
                  if( jsonObj.message =='success'){
                    document.getElementById('tempdata').setAttribute('value',jsonObj.data.tem);
                    document.getElementById('oxgdata').setAttribute('value',jsonObj.data.oxygen);
                  }
                }
              }
      );}

    //控制函数
    var times=0;
    var states='0';
    var colorState;
    function sendctrl(btn)
    {
      if(times % 2==0){
        states='1';//按键按下开启
        colorState="#C0FF3E";
      }
      if(times % 2==1){
        states='0';//按键关闭
        colorState="#BDBDBD";
      }
      times++;
      $.ajax({
                type : "POST",//提交方式
                url : '{{url('/send')}}',
                data : {
                  '_token'     : "{{csrf_token()}}",
                  'device'     : '1',
                  'type'       : '1',
                  'devid'       : '1',
                  'cmder'       : 'power',
                  'value'     : states,
                  'cmdtype'     :'control'
                },
                success : function(result){
                  var jsonObj = jQuery.parseJSON(result);
                  if( jsonObj.message =='success'){
                    btn.style.background=colorState;
                  }
                }
              });
    }
  </script>
@endsection