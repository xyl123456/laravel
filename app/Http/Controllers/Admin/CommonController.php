<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function upload()
    {
        $file=Input::file('Filedata');
        if($file->isValid()){
          $clientName= $file->getClientOriginalName();
          $tmpName=$file->getFileName();//获取缓存tmp的文件夹中文件
            $realPath = $file->getRealPath();//获取缓存的绝对路径
            $entension = $file->getClientOriginalExtension();//上传文件的后缀
            $newname = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file -> move(base_path().'/uploads',$newname);
            $filepath='uploads/'.$newname;
            return $filepath;
        }
    }
}
