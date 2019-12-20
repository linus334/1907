<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文章编辑</title>
</head>
<body>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{url('/article/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    文章标题: <input type="text" name="title" value="{{$data->title}}"><br>
    文章分类: <select name="type_id" id="">
        <option value="">--请选择--</option>
        @foreach($typeInfo as $v)
            @if($v->type_id==$data->type_id)

            <option value="{{$v->type_id}}" selected>{{$v->type_name}}</option>
            @else
                <option value="{{$v->type_id}}" selected>{{$v->type_name}}</option>
            @endif
        @endforeach
    </select>

    <br>
    文章重要性: <input type="radio" name="important" value="1" {{$data->important==1?'checked':''}}>普通
                <input type="radio" name="important" value="2" {{$data->important==2?'checked':''}}>置顶<br>
    是否显示: <input type="radio" name="display" value="1" {{$data->display==1?'checked':''}}>显示
              <input type="radio" name="display" value="2" {{$data->display==2?'checked':''}}>不显示 <br>
    文章作者: <input type="text" name="author" value="{{$data->author}}"><br>
    作者emali: <input type="text" name="email" value="{{$data->email}}"><br>
    关键字: <input type="text" name="Keyword" value="{{$data->keyword}}"><br>
    网页描述: <textarea name="desc" id="" cols="30" rows="10" >{{$data->desc}}</textarea><br>
    文件上传: <input type="file" name="upload"><br>
            <img src="{{env('UPLOAD_URL')}}{{$data->upload}}" width="100">
    <button>提交</button>
</form>
</body>
</html>