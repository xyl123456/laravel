<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use App\Http\Model\UserModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function Index() {
/*       echo "hello Index!";
       // $pdo = DB::connection()->getPdo();
       // dd($pdo);
       //$users = DB::select('select * from blog_admin');
       // return view('AdminView',compact('users'));
        $temps = DB::table('admin')->where('id','>',2)->get();
        dd($temps);
       $users = Admin::where('id',3)->get();
        dd($users);
       $user = Admin::find(3);
        $user->user_name = "wangwu";
        $user->update();
        dd($user);*/
        //return view('admin.index');
        return view('admin.homeindex');
    }

    public function quit ()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
    public function info ()
    {
        return view('admin.info');
    }
    public function pass ()
    {
        if($input_data=Input::all())
        {
            $values=[
                'password'=>'required|between:6,20|confirmed',
            ];
            $error_msg=[
                'password.required'=>'密码不能为空',
                'password.between'=>'密码长度必须大于6',
                'password.confirmed'=>'确认密码和新密码不一致',
            ];
         $validator = Validator::make($input_data,$values,$error_msg);
            if($validator->passes()){
                $pass_data = $input_data['password_o'];
                $user_data = UserModel::first();
                if(Crypt::decrypt($user_data['user_pass'])==$pass_data){
                    $user_data['user_pass']=Crypt::encrypt($input_data['password']);
                    $user_data->update();
                    return back()->with('errors',"修改成功！");
                }else{
                    return back()->with('errors',"原密码错误！");
                }
            }
            else {
                return back()->withErrors($validator);
            }
        }else {
            return view('admin.pass');
        }

    }
}
