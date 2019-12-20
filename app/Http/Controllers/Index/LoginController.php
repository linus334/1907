<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Reg;
class LoginController extends Controller
{
    public function send(){
        $email = request()->email;
        $code = rand(100000,999999);
        $info = ['email'=>$email,'code'=>$code,'add_time'=>time()];
        session(['info'=>$info]);
//        $message = '您正在白钢的爸爸珠宝注册,验证码是:'.$code;
        $res = $this->sendemail($email,$code);
    }


public function sendemail($email,$code){
    Mail::send('index.login.email' , ['code'=>$code] ,function($message)use($email){
        //设置主题
        $message->subject("欢迎注册滕浩有限公司");
        //设置接收方
        $message->to($email);
    });
}

//    public function sendemail($email,$message){
//        \Mail::raw($message ,function($message)use($email) {
//            //设置主题
//            $message->subject("欢迎注册滕浩有限公司");
//            //设置接收方
//            $message->to($email);
//        });
//    }

    public function do_reg(){
        $data = request()->except('_token');
        $info = session('info');
        if($data['code']!=$info['code']){
            echo '验证码有误';die;
        }
        if(time()-$info['add_time']>60){
            echo '验证码超时';die;
        }
        if($data['pwd']!=$data['pwds']){
            echo '两次密码不一致';die;
        }
//        $data['pwd'] = Hash::make($data['pwd']);
//        $data['pwds'] = Hash::make($data['pwds']);
        $res = Reg::create($data);
        return redirect('/login');
    }

    public function do_login(){
        $data = \request()->except('_token');
        $where = [
            ['email','=',$data['email']],
            ['pwd','=',$data['pwd']]
        ];
        $res = Reg::where($where)->first();
        session(['user'=>$res]);
        if($res){
//            echo '登陆成功';
            return redirect()->intended('/');
        }else{
            //echo '登陆失败';
            return redirect('/login')->with("msg","登陆失败");
        }
    }
}
