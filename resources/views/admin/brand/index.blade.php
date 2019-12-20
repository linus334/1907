<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <h2>列表展示</h2>
    <hr/>
    <a href="{{url('brand/create')}}">添加</a>

    <form action="">
        <input type="text" name="brand_name" placeholder="请输入品牌名称" value="{{$query['brand_name']??''}}">
        <input type="text" name="brand_desc" placeholder="请输入简介" value="{{$query['brand_desc']??''}}">
        <button>搜索</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>品牌id</th>
            <th>品牌名称</th>
            <th>品牌网址</th>
            <th>品牌LOGO</th>
            <th>品牌简介</th>
            <th>状态</th>
        </tr>
        </thead>
        <tbody>
       @php $i=1 @endphp
        @foreach($data as $v)
        <tr @if($i%2==0) class="active" @else class="success" @endif>
            <td>{{$v->brand_id}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->brand_url}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" height="100"></td>
            <td>{{$v->brand_desc}}</td>
            <td>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-primary">编辑</a>
                <a href="{{url('/brand/delete/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
            @php $i++ @endphp
        @endforeach
        </tbody>
    </table>
    {{$data->appends($query)->links()}}
</body>
</html>