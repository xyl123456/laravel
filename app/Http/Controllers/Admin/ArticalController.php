<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\ArtiModel;
use App\Http\Model\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticalController extends CommonController
{
    //get.admin/art
    public function index()
    {
        $data = ArtiModel::orderBy('art_id','desc')->paginate(10);
        return view('admin.artical.index',compact('data'));
    }
    //post.admin/art提交信息
    public function store()
    {
        $inputs= Input::except('_token');
        $rules=[
            'art_title'=>'required',
            'cate_id'=>'required',
        ];
        $message=[
            'art_title.required'=>'文章标题必需填写',
            'cate_id.required'=>'文章分类必需填写',
        ];
        $validator = Validator::make($inputs,$rules,$message);
        if($validator->passes()){
           $re = ArtiModel::create($inputs);
            if($re){
                return redirect('admin/art');
            }
            else{
                return back()->with('errors','数据库写入失败！');
            }
        }else {
            return back()->withErrors($validator);
        }
    }
    //get.admin/art/create
    public function create()
    {
        $dates = (new CateModel)->tree();
        return view('admin.artical.add',compact('dates'));
    }
    //get.admin/art/{art}
    public function show()
    {

    }
    //DELETE.admin/art/{art}
    public function destory()
    {

    }
    //put.admin/art/{art}
    public function update($art_id)
    {
        $inputs = Input::except('_method','_token');
        $re = ArtiModel::where('art_id',$art_id)->update($inputs);
        if($re){
            return redirect('admin/art');
        }else{
            return back()->with('errors','修改数据失败！');
        }
    }
    //get.admin/art/{art}/edit
    public function edit($art_id)
    {
        $field=ArtiModel::find($art_id);
        $data=(new CateModel)->tree();
        return view('admin.artical.edit',compact('field','data'));
    }

    //Delete.admin/art/{art}.删除某一个类
    public function destroy ($art_id)
    {
        $re = ArtiModel::where('art_id',$art_id)->delete();
        if($re){
            $data=[
                'states'=>0,
                'msg'=>'删除成功！',
            ];
        }else{
            $data=[
                'states'=>1,
                'msg'=>'删除失败！',
            ];
        }
        return $data;
    }
}
