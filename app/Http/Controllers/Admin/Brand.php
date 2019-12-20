<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Http\Request;
use DB;
use App\Brande;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = \request()->page??1;
        $brand_name = \request()->brand_name??'';
        $brand_desc = \request()->brand_desc??'';
       // echo 'data_'.$page;
//        $data = Cache::get('data_'.$page.'_'.$brand_name.'_'.$brand_desc);
        $data = Redis::get('data_'.$page.'_'.$brand_name.'_'.$brand_desc);
        //var_dump($data);
        if(!$data){
            echo 'db===';
            //DB
            //$data = DB::table('brand')->get();
            //ORM
            $pageSize = config('app.pageSize');

            $brand_name = request()->brand_name;
            $where = [];
            if($brand_name){
                $where[] = ['brand_name','like',"%$brand_name%"];
            }
            $brand_desc = request()->brand_desc;
            if($brand_desc){
                $where[] = ['brand_desc','like',"%$brand_desc%"];
            }
            $data = Brande::where($where)->paginate($pageSize);

//            Cache::put('data_'.$page.'_'.$brand_name.'_'.$brand_desc, $data, 60);
            $data = serialize($data);
            Redis::setex('data_'.$page.'_'.$brand_name.'_'.$brand_desc,2, $data);
    }
        $data = unserialize($data);
        $query = request()->all();
        return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
    //public function store(\App\Http\Requests\StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种验证 在接受值的前面
        /*
        $request->validate([
            //required是必填的意思 unique是唯一的意思
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填'
        ]);
        */

        //接收排除_token的值
        $data = $request->except('_token');
        /*
           //只接收某个字段的值
            //$data = $request->only(['brand_name','brand_desc']);
            //删除数据
           //unset($data['_token']);
            //DB添加
           $res = DB::table('brand')->insert($data);
        */

        //第三种验证  在接收到值的后面
        $validator = \Validator::make($data, [
            'brand_name' => 'required|unique:brand|alpha_dash',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
            'brand_name.alpha_dash'=>'品牌名称是数字字母下划线组成'
        ]);

        if ($validator->fails()) {
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }

        //文件上传
        //判断有没有文件上传
        if($request->hasFile('brand_logo')){
            $data['brand_logo'] = $this->upload('brand_logo');
        }

        //ORM添加
        $brand = Brande::create($data);
        if($brand->brand_id ){
            return redirect('/brand/index');
        }
        //echo $brand->brand_id;
        //save添加
        /*
        $brand = new Brande;
        $brand->brand_name = $data['brand_name'];
        $brand->brand_url = $data['brand_url'];
        $brand->brand_logo = $data['brand_logo'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->save();
        */
    }

    //封装文件上传的方法
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

    /**
     * Display the specified resource.
     *展示单条详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$id){
            return;
        }
        //DB查询一条信息
        //$data = DB::table('brand')->where('brand_id',$id)->first();
        //ORM 查询一条信息
        $data = Brande::find($id);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreBrandPost $request, $id)
    {
        //验证
        //接值
        $data = $request->except('_token');
        //判断有没有文件上传
        if($request->hasFile('brand_logo')){
            $data['brand_logo'] = $this->upload('brand_logo');
        }
        //更新入库
        $res = Brande::where('brand_id',$id)->update($data);
        return redirect('brand/index');
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort(404);
        }
        //DB删除
        //$res = DB::table('brand')->where('brand_id',$id)->delete();
        //ORM删除
        $res = Brande::destroy($id);
        if($res){
            return redirect('brand/index');
        }
    }

    public function checkOnly(){
        $brand_name = \request()->brand_name;
        $count = Brande::where('brand_name',$brand_name)->count();
        echo  $count;
    }
}
