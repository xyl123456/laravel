<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\ArtiModel;
use App\Http\Model\LinksModel;
use App\Http\Model\NavsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs=NavsModel::all();
        View::share('navs',$navs);
        //最新文章8篇
        $news = ArtiModel::orderBy('art_time','desc')->take(8)->get();
        View::share('news',$news);

        //文章排行5篇
        $ords = ArtiModel::orderBy('art_view','desc')->take(5)->get();
        View::share('ords',$ords);
        //友情链接
        $links = LinksModel::orderBy('links_order','desc')->get();
        View::share('links',$links);

    }
}
