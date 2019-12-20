<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use Illuminate\Support\Facades\Auth;
use App\user;
class LoginController extends Controller
{
   public function login(){
       return view('admin.login.index');
   }

   public function loginDo(){
        $data = request()->except('_token');
//        $where= [
//            ['username','=',$data['username']]
//        ];
//        $LoginInfo = Login::where($where)->first();
//        if($data['username']==$LoginInfo['username']&&$data['pwd']==$LoginInfo['pwd']){
//            return redirect('brand/create');
//        }else{
//            return redirect('login/index');
//        }
       if (Auth::attempt($data)) {
           // 认证通过...
           return redirect('/brand/index');
       }else{
           return redirect('/login/index')->with('msg','账号或密码有误');
       }
   }
   public function doReg(){
       $data = request()->except('_token');
       $data['password'] = bcrypt($data['password']);
       $res = User::create($data);
       if($res){
           return redirect('/login/index');
       }else{
           return redirect('reg');
       }
   }
}
