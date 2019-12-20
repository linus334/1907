<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminGoods;
class AdminGoodosController extends Controller
{
    public function index(){
        return view('admin.admingoods.index');
    }
    public function create(){
        $data = request()->except('_token');
        $data['add_time'] = time();
        if(request()->hasFile('g_logo')){
            $data['g_logo'] = $this->upload('g_logo');
        }
        $res = AdminGoods::create($data);
        if($res){
            return redirect('/zhanshi');
        }
    }
    public function upload($fileName){
        //验证文件是否上传成功
        if(request()->file($fileName)->isValid()){
            //接收文件
            $photo = request()->file($fileName);
            //系统自动生成存放文件
            $store_result = $photo->store('photo');
            return $store_result;
        }
        exit('为获取到上传文件或者上传文件出错');
    }

    public function zhanshi(){
        $data = AdminGoods::all();
        return view('admin.admingoods.zhanshi',['data'=>$data]);
    }
}
