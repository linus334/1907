<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use DB;
use Illuminate\Support\Facades\Cache;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = \request()->page;
        $admin_name = \request()->admin_name;
        $data = Cache::get('data/'.$page.'/'.$admin_name);
        if(!$data) {
            echo 'db...';
            $admin_name = \request()->admin_name;
            $where = [];
            if ($admin_name) {
                $where[] = ['admin_name', 'like', "%$admin_name%"];
            }
            //DB::connection()->enableQueryLog();//开启监听
            $data = Admin::where($where)->paginate(1);

            Cache::put('data/'.$page.'/'.$admin_name, $data, 60);
        }
//        $logs = DB::getQueryLog();
//        dd($logs);
        $query = \request()->all();
        return view('admin.admin.index',['data'=>$data],['query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
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

        //验证
        $validator = \Validator::make($data, [
            'admin_name' => 'required|unique:admin',
            'admin_pwd' => 'required',
            ],[
            'admin_name.required' => '名称不能为空',
            'admin_name.unique' => '名称已存在',
            'admin_pwd.required' => '密码不能为空',
        ]);

        if ($validator->fails()) {
            return redirect('admin/create')
                ->withErrors($validator)
                ->withInput();
        }

        $res = Admin::create($data);
        if($res){
            return redirect('/admin/index');
        }
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
        if(!$id){
            return;
        }
        $adminInfo = Admin::find($id);
        return view('admin.admin.edit',['adminInfo'=>$adminInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\AdminPost $request, $id)
    {
        $data = $request->except('_token');
        $res = Admin::where('admin_id',$id)->update($data);
        return redirect('admin/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort(404);
        }
        $res = Admin::destroy($id);
        return redirect('/admin/index');
    }
}
