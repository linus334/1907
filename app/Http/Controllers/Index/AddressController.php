<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addres;
use App\Area;

class AddressController extends Controller
{
    public function index(){
        //查询所有收货地址 列表展示
        $info = session("user");
        $id = $info['id'];
        $where=[
            ['id','=',$id],
            ['is_del','=',1]
        ];

        $data=Addres::where($where)->get();

        $area_model=Area::all();
        foreach ($data as $k=>$v){
            $data[$k]['province']=$area_model->where('id',$v['province'])->values('name');
            $data[$k]['city']=$area_model->where('id',$v['city'])->values('name');
            $data[$k]['area']=$area_model->where('id',$v['area'])->values('name');
        }

        //查询所有省份 作为第一个下拉菜单的值
        $provinceInfo=$this->getAreaInfo(0);
        return view('index.address.address',['provinceInfo'=>$provinceInfo,'data'=>$data]);
    }

    //获取区域信息
    function getAreaInfo($pid){
        $where=[
            ['pid','=',$pid]
        ];
        return Area::where($where)->get();
    }
    function getArea(){
      $id=\request()->id;
        $info=$this->getAreaInfo($id);
        echo json_encode($info);
    }

    function save(){
        $data=\request()->all();
//dd($data);
        $info = session("user");
        $id = $info['id'];
        $data['id']=$id;

        //判断当前添加的数据是否设为默认
        if(!empty($data['is_default'])){
            //把当前用户所有人的id_default=2
            $where=[
                ['id','=',$id],
                ['is_del','=',1]
            ];
            $result=Addres::where($where)->update(['is_default'=>2]);
        }
        $res=Addres::all($data);
        if($res){
            echo json_encode(['font' => '添加成功', 'code' => 1]);
        }else{
            echo json_encode(['font'=>'添加失败','code'=>2]);
        }

    function user(){
        return view('index.address.user');
    }
    function addres(){
        $data = Addres::all();

        return view('index.address.addres',['data'=>$data]);
    }
}}
