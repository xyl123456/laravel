<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\LinksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //Get.admin/link.列出全部
    public function index ()
    {
       //$data = LinksModel::all();
        $data = LinksModel::orderBy('links_order','asc')->get();
       // $data = $this->orderBy('links_order','asc')->get()
       return view('admin.links.index',compact('data'));
    }
    //Get.admin/link/create.创建链接
    public function create ()
    {
        return view('admin.links.add');
    }

    //Post.admin/link.创建链接提交
    public function store ()
    {
        $links_data = Input::except('_token');
        $rules=[
            'links_name'=>'required',
            'links_url'=>'required',
        ];
        $message=[
            'links_name.required'=>'链接名称必需填写！',
            'links_url.required'=>'链接URL必须填写！',
        ];
        $validator = Validator::make($links_data,$rules,$message);
        if($validator->passes()){
            $re = LinksModel::create($links_data);
            if($re){
                return redirect('admin/link');
            }else {
                return back()->with('errors','链接数据添加失败！');
            }
        }
        else{
            return back()->withErrors($validator);
        }
    }
    //Get.admin/link/{link}/edit.修改编辑某个类
    public function edit ($links_id)
    {
        $field=LinksModel::find($links_id);
        return view('admin.links.edit',compact('field'));
    }
    //Put.admin/link/{link} 更新某个分类
    public function update ($links_id)
    {
        $inputs = Input::except('_method','_token');
        $re = LinksModel::where('links_id',$links_id)->update($inputs);
        if($re){
            return redirect('admin/link');
        }else{
            return back()->with('errors','修改数据失败！');
        }
    }
    //Delete.admin/link/{link}.删除某一个类
    public function destroy ($links_id)
    {
        $re = LinksModel::where('links_id',$links_id)->delete();
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
    //
    public function changeorder()
    {
        $inputs = Input::all();
        $datas_find = LinksModel::find($inputs['links_id']);
        $datas_find['links_order'] = $inputs['links_order'];
        $re = $datas_find->update();
        if($re ==1){
            $data=[
                'state'=>'0',
                'msg'=>'排序更新成功!',
            ];
        }else {
            $data=[
                'state'=>'1',
                'msg'=>'排序更新失败!',
            ];
        }
        return $data;
    }
}
