<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\ConfigModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //Get.admin/config.列出全部
    public function index ()
    {
        $data = ConfigModel::orderBy('conf_order','asc')->get();
        foreach ($data as $k=>$v){
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html ='<input type="text" class="lg" name="conf_content[]"
                    value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html ='<textarea type="text" class="lg" name="conf_content[]"
                    >'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->field_value);
                    $str='';
                    foreach($arr as $m=>$n){
                        $r = explode('|',$n);
                        $c = ($v->conf_content==$r[0])?'checked':'';
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'  ';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
       return view('admin.config.index',compact('data'));
    }
    //Get.admin/config/create.创建链接
    public function create ()
    {
        return view('admin.config.add');
    }

    //Post.admin/config.创建链接提交
    public function store ()
    {
        $config_data = Input::except('_token');
        $rules=[
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $message=[
            'conf_name.required'=>'导航名称必需填写！',
            'conf_title.required'=>'导航URL必须填写！',
        ];
        $validator = Validator::make($config_data,$rules,$message);
        if($validator->passes()){
            $re = ConfigModel::create($config_data);
            if($re){
                return redirect('admin/config');
            }else {
                return back()->with('errors','链接数据添加失败！');
            }
        }
        else{
            return back()->withErrors($validator);
        }
    }
    //Get.admin/config/{config}/edit.修改编辑某个类
    public function edit ($conf_id)
    {
        $field=ConfigModel::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }
    //Put.admin/config/{config} 更新某个分类
    public function update ($conf_id)
    {
        $inputs = Input::except('_method','_token');
        $re = ConfigModel::where('conf_id',$conf_id)->update($inputs);
        if($re){
            return redirect('admin/config');
        }else{
            return back()->with('errors','修改数据失败！');
        }
    }
    //Delete.admin/config/{config}.删除某一个类
    public function destroy ($conf_id)
    {
        $re = ConfigModel::where('conf_id',$conf_id)->delete();
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
    //post.admin/config/changecontent
    public function changecontent()
    {
        $inputs = Input::all();
        //dd($inputs);
    }
    //
    public function changeorder()
    {
        $inputs = Input::all();
        $datas_find = ConfigModel::find($inputs['conf_id']);
        $datas_find['conf_order'] = $inputs['conf_order'];
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
