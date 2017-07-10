<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //Get.admin/cate.列出全部
    public function index ()
    {
       // $categorys = CateModel::tree();
        $categorys = (new CateModel)->tree();
        return view('admin.category.index')->with('data',$categorys);
    }
    //Get.admin/cate/create.创建类
    public function create ()
    {
        $dates=CateModel::where('cate_pid',0)->get();
        return view('admin.category.add',compact('dates'));
    }

    //Post.admin/cate.创建分类提交
    public function store ()
    {
        $creat_data = Input::except('_token');
        $rules=[
            'cate_name'=>'required',
        ];
        $message=[
            'cate_name.required'=>'文章名称必需填写！',
        ];
        $validator = Validator::make($creat_data,$rules,$message);
        if($validator->passes()){
           $re = CateModel::create($creat_data);
            if($re){
                return redirect('admin/cate');
            }else {
                return back()->with('errors','填写数据库失败！');
            }
        }
        else{
            return back()->withErrors($validator);
        }
    }
    //Get.admin/cate/{cate}.显示某一个类
    public function show ()
    {

    }

    //Delete.admin/cate/{cate}.删除某一个类
    public function destroy ($cate_id)
    {
        $re = CateModel::where('cate_id',$cate_id)->delete();
        CateModel::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
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
    //Get.admin/cate/{cate}/edit.修改编辑某个类
    public function edit ($cate_id)
    {
        $field=CateModel::find($cate_id);
        $dates=CateModel::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','dates'));
    }
    //Put.admin/cate/{cate} 更新某个分类
    public function update ($cate_id)
    {
       $inputs = Input::except('_method','_token');
       $re = CateModel::where('cate_id',$cate_id)->update($inputs);
        if($re){
            return redirect('admin/cate');
        }else{
            return back()->with('errors','修改数据失败！');
        }

    }

    public function changeorder()
    {
        $inputs = Input::all();
        $datas_find = CateModel::find($inputs['cate_id']);
        $datas_find['cate_order'] = $inputs['cate_order'];
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
