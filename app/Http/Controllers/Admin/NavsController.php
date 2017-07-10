<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\NavsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //Get.admin/nav.列出全部
    public function index ()
    {

       //$data = NavsModel::all();
        $data = NavsModel::orderBy('navs_order','asc')->get();
       // $data = $this->orderBy('navs_order','asc')->get()
       return view('admin.Navs.index',compact('data'));
    }
    //Get.admin/nav/create.创建链接
    public function create ()
    {
        return view('admin.Navs.add');
    }

    //Post.admin/nav.创建链接提交
    public function store ()
    {
        $navs_data = Input::except('_token');
        $rules=[
            'navs_name'=>'required',
            'navs_url'=>'required',
        ];
        $message=[
            'navs_name.required'=>'导航名称必需填写！',
            'navs_url.required'=>'导航URL必须填写！',
        ];
        $validator = Validator::make($navs_data,$rules,$message);
        if($validator->passes()){
            $re = NavsModel::create($navs_data);
            if($re){
                return redirect('admin/nav');
            }else {
                return back()->with('errors','链接数据添加失败！');
            }
        }
        else{
            return back()->withErrors($validator);
        }
    }
    //Get.admin/nav/{nav}/edit.修改编辑某个类
    public function edit ($navs_id)
    {
        $field=NavsModel::find($navs_id);
        return view('admin.Navs.edit',compact('field'));
    }
    //Put.admin/nav/{nav} 更新某个分类
    public function update ($navs_id)
    {
        $inputs = Input::except('_method','_token');
        $re = NavsModel::where('navs_id',$navs_id)->update($inputs);
        if($re){
            return redirect('admin/nav');
        }else{
            return back()->with('errors','修改数据失败！');
        }
    }
    //Delete.admin/nav/{nav}.删除某一个类
    public function destroy ($navs_id)
    {
        $re = NavsModel::where('navs_id',$navs_id)->delete();
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
        $datas_find = NavsModel::find($inputs['navs_id']);
        $datas_find['navs_order'] = $inputs['navs_order'];
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
