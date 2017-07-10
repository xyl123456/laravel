<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{url('resources/views/home/js/jquery.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k=>$v)<a href="index.html"><span>{{$v->navs_name}}</span><span class="en">{{$v->navs_alias}}</span></a>@endforeach
    </nav>
</header>
@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($news as $k=>$v)
            <li><a href="{{'a/'.$v->art_id}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
        @endforeach

    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($ords as $h)
            <li><a href="{{'a/'.$h->art_id}}" title="{{$h->art_title}}" target="_blank">{{$h->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="links">
        <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
        @foreach($links as $l)
            <li><a href="{{$l->links_url}}" target="_blank">{{$l->links_name}}</a></li>
        @endforeach
    </ul>
    @show
<footer>
    <p>Design by 后盾网 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.houdunwang.com</a> <a href="/">网站统计</a></p>
</footer>
{{--<script src="{{asset('resources/views/home/js/silder.js')}}"></script>--}}
</body>
</html>
