<?php

namespace App\Http\Controllers\Moni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Cache;
class StudentController extends Controller
{
    public function index(){
        $page = \request()->page;
        $data = Cache::get('data_'.$page);
        if(!$data) {
            echo 'dd....';
            $data = Student::paginate(2);
            Cache::put('data_'.$page, $data, 10);
        }
        return view('moni.index',['data'=>$data]);
    }
}
