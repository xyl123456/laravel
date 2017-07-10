<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\ArtiModel;
use App\Http\Model\CateModel;
use App\Http\Model\LinksModel;
use App\Http\Model\NavsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Home\CommonController;

class IndexController extends CommonController
{
    public function index()
    {
        //热点文章6篇
        $hosts = ArtiModel::orderBy('art_view','desc')->take(6)->get();
        //推荐文章5篇
        $datas = ArtiModel::orderBy('art_time','desc')->paginate(5);

        return view("home.index",compact('hosts','datas'));
    }
    public function cate($cate_id)
    {
        //查看分类信息自增
        CateModel::where('cate_id',$cate_id)->increment('cate_view');

        $data = ArtiModel::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
        //获取子分类信息
        $submenu = CateModel::where('cate_pid',$cate_id)->get();
        $field = CateModel::find($cate_id);
        return view("home.list",compact('field','data','submenu'));

    }
    //get a/{art_id}
    public function artical($art_id)
    {
        //查看次数自增
        ArtiModel::where('art_id',$art_id)->increment('art_view');

        $field = ArtiModel::Join('category','art.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        $article['pre']=ArtiModel::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next']=ArtiModel::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        $data = ArtiModel::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->get();
        return view("home.new",compact('field','article','data'));
    }
}
