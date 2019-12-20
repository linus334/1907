<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class UsersController extends Controller
{
    public function index(){
        return view('admin.users.index');
    }
   public function create(){
        $data = \request()->except('_token');

        $res = Admin::where('admin_name',$data['admin_name'])->first();

        if($data['admin_name']!=$res['admin_name']||$data['admin_pwd']!=$res['admin_pwd']){
           echo '失败';
        }else{
            session(['admin'=>$res]);
            return redirect('/admin/index');
        }
    }
}
