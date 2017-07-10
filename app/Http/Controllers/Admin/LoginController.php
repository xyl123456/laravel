<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources\org\code\Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
/*       $st= Crypt::encrypt('123456');
        dd($st);*/
        //需要csrf_field 产生tokenkey
        if($input_data=Input::all()){
           //dd($input_data);
            $code_data=new \Code();
            $_code = $code_data->get();
           if(strtoupper($input_data['code'])!=$_code){
               return back()->with('msg','验证码错误');
           }
            $user_data=UserModel::first();
            $user_pass_data=Crypt::decrypt($user_data['user_pass']);
            if(($input_data['user_name']!=$user_data['user_name'])||($input_data['user_pass']!=$user_pass_data))
            {
                return back()->with('msg','用户名或者密码错误');
            }else
            {
                session(['user'=>$user_data]);
                return redirect('admin/index');
            }
        }
       else {
          // dd(Crypt::decrypt($str));

            return view('admin.login');
       }
    }

/*    public function getcode()
    {
        $code = new \Code();
        $code_date=$code->get();
        return $code_date;
    }*/

    public function makecode()
    {
        $code = new \Code();
        $code->make();
    }

}
