<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;
use App\Article;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeInfo = Type::all();
        $pageSize = config('app.pageSize');

        $where = [];
        $type_id = \request()->type_id;
        if($type_id){
            $where[] = ['type.type_id','like',"%$type_id%"];
        }
        $title = \request()->input('title');
        if($title){
            $where[] = ['title','like',"%$title%"];
        }

        $articleInfo =  Article::join('type','article.type_id','=','type.type_id')->where($where)->paginate($pageSize);
        $query = \request()->all();
        return view('admin.article.index',['articleInfo'=>$articleInfo,'typeInfo'=>$typeInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $typeInfo = Type::all();
        return view('admin.article.create',['typeInfo'=>$typeInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            //required是必填的意思 unique是唯一的意思
            'title' => 'required|unique:article',
            'type_id' => 'required',
            'important' => 'required',
            'display' => 'required',
        ],[
            'title.required'=>'文章标题必填',
            'title.unique'=>'文章标题已存在',
            'type_id.required'=>'文章分类必填',
            'important.required'=>'文章重要性必填',
            'display.required'=>'是否显示必填',
        ]);

        $data = $request->except('_token');
        if($request->hasFile('upload')){
            $data['upload'] = $this->upload('upload');
        }
        $articleInfo = Article::create($data);
        if($articleInfo){
            return redirect('/article/index');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = \request()->file($filename);
            $res = $photo->store('photo');
            return $res;
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
        $data = Article::find($id);
        $typeInfo = Type::all();
        return view('admin.article.edit',['data'=>$data],['typeInfo'=>$typeInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ArticlePost $request, $id)
    {
        $data = $request->except('_token');
        if($request->hasFile('upload')){
            $data['upload'] = $this->upload('upload');
        }
        $res = Article::where('id',$id)->update($data);
        return redirect('article/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $res=0;
        $id=$request->input('id');
        $ArticleInfo = Article::find($id);
        $result=$ArticleInfo->delete();
        $result==true && $res=1;
        return  $res;
    }

    public function checkOnly(){
        $title = request()->title;

        $count =  Article::where('title',$title)->count();
        echo $count;
    }
}
