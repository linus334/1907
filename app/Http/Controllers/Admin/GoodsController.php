<?php

namespace App\Http\Controllers\Admin;

use App\Goods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brande;
use App\Cate;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
//        $goods =Goods::all();
        $data = Goods::join('brand','brand.brand_id','=','goods.brand_id')->join('cate','cate.cate_id','=','goods.cate_id')->paginate($pageSize);
        return view('admin.goods.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brandInfo = Brande::all();
        $cateInfo = Cate::all();
        $info = postCateInfo($cateInfo);
        return view('admin.goods.create',['brandInfo'=>$brandInfo],['info'=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        //判断有没有文件上穿
        if($request->hasFile('goods_img')){
            $data['goods_img'] = $this->upload('goods_img');
        }

        $goodsInfo = Goods::create($data);
        if($goodsInfo){
            return redirect('/goods/index');
        }
    }

    //文件上传
    public function upload($fileName){
//        验证文件是否上传成功
        if(\request()->file($fileName)->isValid()){
            //接收文件
            $photo = \request()->file($fileName);
            //系统自动生成文件
            $store_result = $photo->store('photo');

            return $store_result;
        }
        exit('为获取到上传文件或者上传文件出错');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
    }
}
